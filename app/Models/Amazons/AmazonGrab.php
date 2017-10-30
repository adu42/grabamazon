<?php
/**
 * Created by PhpStorm.
 * User: 杜兵
 * Date: 2017/1/4
 * Time: 13:34
 * 相关best seller的分类自动设置active，否则放弃
 * 相关best seller rank的商品在一定的范围内自动active，否则放弃
 */

namespace App\Models\Amazons;

use App\Models\Amazons\AmazonHtmlRules;
use App\Ado\Models\Tables\Core\Setting;
use Cache;
use Log;
use App\Models\Amazons\AmazonCategory;
use App\Models\Amazons\AmazonProduct;
use App\Models\Amazons\AmazonBadWords;
use App\Models\Amazons\AmazonProductRank;
use App\Models\Amazons\AmazonFocusTag;
use App\Models\Amazons\AmazonOkProduct;
use App\Models\Amazons\AmazonOkProductImage;
use DB;
use Mockery\Exception;
use Storage;
use File;
use TesseractOCR as Tesseract;
use Goutte\Client as GoutteClient;
use App\Models\Helpers\SelectorDOM;
use Symfony\Component\DomCrawler\Crawler;
use Symfony\Component\CssSelector\CssSelectorConverter;
use GuzzleHttp\Client as GuzzleHttpClient;
use GuzzleHttp\Cookie\CookieJar;
use Kaishiyoku\HtmlPurifier\HtmlPurifier;
use LogicException;
use InvalidArgumentException;


class AmazonGrab
{
    protected $maxRankLevel = 3;  //分类三级别，才可以进来，否则产品比较差，分类太细不需要
    protected $amazonCategory;
    protected $amazonProduct;
    protected $amazonBadWords;
    protected $amazonProductRank;
    protected $amazonFocusTag;
    protected $amazonOkProduct;
    protected $amazonOkProductImage;
    protected $client;
    protected $cookieJar;
    // protected $headers;
    //  protected $times = 2;   //多少次切换一下header头信息发送过去
    protected $changeTimes = 2;
    protected $update_time;
    protected $catelog_per_num = 10;
    protected $baseUrl = 'https://www.amazon.com';
    protected $grabInterval = 86400; //秒
    protected $wait_seconds = 4;
    protected $userAgent;
    protected $rank_min;
    protected $rank_max;
    protected $debug = true;


    public function __construct(AmazonCategory $amazonCategory, AmazonBadWords $amazonBadWords, AmazonProduct $amazonProduct, AmazonProductRank $amazonProductRank,
                                GuzzleHttpClient $client,
                                CookieJar $cookieJar,
                                AmazonFocusTag $amazonFocusTag,
                                AmazonOkProduct $amazonOkProduct,
                                AmazonOkProductImage $amazonOkProductImage
    )
    {
        $this->amazonBadWords = $amazonBadWords;
        $this->amazonCategory = $amazonCategory;
        $this->amazonProduct = $amazonProduct;
        $this->amazonProductRank = $amazonProductRank;
        $this->amazonFocusTag = $amazonFocusTag;
        $this->amazonOkProduct = $amazonOkProduct;
        $this->amazonOkProductImage = $amazonOkProductImage;
        $this->client = $client;
        $this->cookieJar = $cookieJar;
        $this->update_time = date('Y-m-d H:i:s');
        $this->setGrabInterval();
        $this->setUserAgent();
    }

    /**
     * 获取浏览器userAgent
     * @return mixed
     */
    protected function setUserAgent()
    {
        $userAgents = Cache::rememberForever('useragents', function () {
            return Setting::getPathsValue('user-agent');
        });
        if ($userAgents) {
            $userAgent = $userAgents->random();
            $this->userAgent = $userAgent->value;
        }
        return $this->userAgent = '';
    }

    /**
     * 获取入口，第一次使用亚马逊指定的页面，后面使用分类页
     */
    protected function getFirstPage()
    {
        return $amazonFirstPage = Cache::rememberForever('amazon-first-page', function () {
            return Setting::getPathValue('amazon-first-page');
        });
    }

    /**
     * 间隔几天抓一次
     */
    protected function setGrabInterval()
    {
        return $this->grabInterval = Cache::remember('amazon-grab-interval', 60, function () {
            return Setting::getPathValue('amazon-grab-interval');
        });
    }

    /**
     * 获取html处理规则
     */
    protected function getHtmlRules($kand = 1, $ruleName = 'url')
    {
        if ($this->debug) Cache::forget('amazon-html-rule-' . $kand . '-' . $ruleName);
        return $amazonHtmlRules = Cache::rememberForever('amazon-html-rule-' . $kand . '-' . $ruleName, function () use ($kand, $ruleName) {
            return AmazonHtmlRules::type($kand)->ruleName($ruleName)->get();
        });
    }

    /**
     * 获取html处理规则
     */
    protected function getAllRules()
    {
        if ($this->debug) Cache::forget('amazon-html-rules');
        return $amazonHtmlRules = Cache::rememberForever('amazon-html-rules', function () {
            return AmazonHtmlRules::all();
        });
    }

    /**
     * 简单美化html
     * @param $string
     * @return mixed
     */
    protected function compress_html($html, $removeScriptAndCss = false)
    {
        $html = str_replace("\r\n", "", $html);
        $html = str_replace("\n", "", $html);
        $html = str_replace("\t", "", $html);
        $html = preg_replace("/>[ ]+</", "> <", $html);
        if ($removeScriptAndCss) {
            //这里只是去掉<script 标签，不去除内容
            $html = preg_replace('#<script(.*?)>(.*?)</script>#is', '$2', $html);
            $html = preg_replace('#<style(.*?)>(.*?)</style>#is', '', $html);
            $html = preg_replace('#<noscript(.*?)>(.*?)</noscript>#is', '', $html);
            $html = preg_replace('#<link(.*?)>#is', '', $html);
            $purifier = new HtmlPurifier();
            // 如果存在<script，会带内容一起去掉，由于有些内容是存在于json中的，所以上面只去标签，保留内容
            $html = $purifier->purify($html);
        }
        return $html;
    }

    /**
     * 根据规则截取
     * @param $html
     * @param $rule
     * @param int $outer
     * @return null|string
     */
    protected function getMatchContent($html, $rule, $outer = 0)
    {
        $match = explode("(*)", trim($rule));
        $p0 = stripos($html, trim($match[0]));
        if ($outer == 1)
            $start = $p0;
        else
            $start = $p0 + strlen($match[0]);
        $p1 = stripos($html, trim($match[1]), $start);
        if ($p0 === false || $p1 === false) {
            return null;
        }
        if ($outer == 1)
            $length = $p1 + strlen($match[1]) - $start;
        else
            $length = $p1 - $start;
        return substr($html, $start, $length);
    }

    /**
     * 规则取值
     * @param $text
     * @param $rule
     * @return bool|null|string
     */
    protected function getMatchContents($text, $rule)
    {
        $text = str_replace(',', '', $text);
        $text = trim($text);
        if ($rule->rule_is_regular && $rule->rule_regular) {
            preg_match_all($rule->rule_regular, $text, $result);
            if ($result) {
                return isset($result[1]) ? $result[1] : $result[0];
            }
        } else if ($rule->rule_regular) {
            return $this->getMatchContent($text, $rule->rule_regular);
        }
        return false;
    }

    /**
     * 根据规则截取标题
     * @param $html
     * @param $rule
     * @return null|string
     */
    protected function getTitleByRule($html, $rule)
    {
        $title = $this->getMatchContent($html, $rule);
        if (!empty($title)) {
            $_title = explode('|', $title, 2);
            $title = $_title[0];
        }
        return $title;
    }

    /**
     * 抓取内容并缓存
     * @param $url
     * @param int $minutes
     * @return mixed
     */
    protected function getContent($url, $minutes = 2880)
    {
        $key = 'amazon-page-' . md5($url);
        // $min = 4320; //存3天
        $content = Cache::remember($key, $minutes, function () use ($url) {
            $html = $this->clientGet($url);
            if (stripos($html, '/captcha/') !== false) {
                $html = $this->getCaptchaImageTry($html, $url);
                if (stripos($html, '/captcha/') !== false) {
                    if ($this->debug) {
                        Log::info('Captcha 401:' . $url);
                    }
                    return '';
                }
            }
            $html = $this->compress_html($html, true);
            return $html;
        });
        if (empty($content)) Cache::forget($key);
        return $content;
    }

    protected function clientGet($url)
    {
        $html = '';
        try {
            /*
           $cookieData =[
               'ogbcbff'=>1,
               'at-main'=>'Atza|IwEBINdIuV5cvw1nd2MyUgiD66WUf-zZoglOWi41fQ3Vm_OR1GaIbGClIJ3vXBo71JKPU83VRm2IUl2uON2w5ZeR7CxhOfuUp97FPvfOjW8qdw_3eyu1lBFW0MP_kxMNULBZF7o6jOvoWPFsEYhnkGw6eBdK24x_ozwBx2J616googdLg1TptglbF8UnkF6WrQXPbMQ6wiz1tQ5ZDfijKt99oywtVGTuvdw3be2p4S29Z_9_8GxeA_PH_iBCLZJAx4xsvH05voG3Y4PmjuqWcT3gQsgMfq0OeR4iOkD8u4l8eV4NWaHnlBfEZM_TxsyRP_Der9zyb9s_zkIetXNuFJzMUcHhOavTWyuZ8_yNE-_1eCIp1qCwgh7knQX-R71eA1dbovQeUSE7pK381QTv5o-77mlK',
              'csm-hit'=>'XVYKV1NTFK2ZA1VB3BA1+s-XVYKV1NTFK2ZA1VB3BA1|1484288034103',
              'lc-main'=>'en_US',
              'ld'=>'AZUSSOA-sell',
              's_fid'=>'59C94F2CEC6540FC-1FA66CC8E9092552',
               's_pers'=>'%20s_fid%3D3052610B1BB39106-2A75FE433C3B5EF9%7C1641432763306%3B%20s_dl%3D1%7C1483668163309%3B%20gpv_page%3DUS%253AAZ%253ASOA-overview-sell%7C1483668163319%3B%20s_ev15%3D%255B%255B%2527AZFSSOA-dT1%2527%252C%25271483585326949%2527%255D%252C%255B%2527AZUSSOA-sell%2527%252C%25271483666363325%2527%255D%255D%7C1641432763325%3B',
               'ubid-main'=>'157-0200322-5178795',
             //  'ubid-main'=>'157-0200322-5175765',
               'x-main'=>'xXlDOb5@@@fzT4uKh0a@NbT2HPtnGCwIedHEzgCDlluc42OrJE7JcALaKdZXckQr',
               'x-wl-uid'=>'1iVVR/9NjDU9tgedMohacjrYVIomyICC7TPUX8kBhki9ljuYRUz2Xm/G9E9jttSR0sU1fl5HMyVH/WKjxCEnV+d9UZS4hwN3TkTF4+mnJj+EEPUNFCqBgJ/V04z/Ym7XZ9KQL1ceoWx4=',
               'x-amz-captcha-2'=>'/O4s2T8w4uDFWqShJUS84w==','x-amz-captcha-1'=>'1484284934681546'
           ];
              $this->cookieJar = cookieJar::fromArray($cookieData,'.amazon.com');
              */
            sleep($this->wait_seconds);
            $this->setUserAgent();
            $response = $this->client->get($url, ['verify' => false, 'allow_redirects' => true, 'referer' => true, 'User-Agent' => $this->userAgent, 'cookies' => $this->cookieJar, 'timeout' => 300]);
            $html = $response->getBody()->getContents();
        } catch (\Exception $e) {
            if ($this->debug) {
                Log::info($e->getMessage());
            }
        }
        return $html;
    }

    /**
     * 尝试解码且重试一次
     * @param $html
     * @param $url
     * @return string
     */
    public function getCaptchaImageTry($html, $url)
    {
        $crawler = new Crawler($html, $this->baseUrl);
        $form = $crawler->filter('.a-button-text')->form();
        $image = $crawler->filter('img')->eq(0)->image();
        if ($image->getUri()) {
            $file = $this->clientGet($image->getUri());
            Storage::delete('captcha.jpg');
            Storage::put('captcha.jpg', $file);
            storage_path('app/captcha.jpg');
            $path = storage_path('app/captcha.jpg');// '../storage/app/captcha.jpg';
            Log::info('Captcha Image Path:' . $path);
            $txt = (new Tesseract($path))->psm(6)->run();
            $txt = str_replace(' ', '', $txt);
            $txt = trim($txt);
            $form['field-keywords'] = $txt;
            Log::info('Captcha Code:' . $txt);
            // submit that form
            $client = new GuzzleHttpClient(['verify' => false, 'allow_redirects' => true, 'referer' => true, 'User-Agent' => $this->userAgent, 'cookies' => $this->cookieJar, 'timeout' => 20]);
            $gClient = new GoutteClient();
            $gClient->setClient($client);
            $crawler = $gClient->submit($form);
            if ($this->debug) Log::info($crawler->text());
            $html = $this->clientGet($url);
            return $html;
        }
        die();
    }

    /**
     * 随便抓，抓到了就加入仓库
     * @param $url
     * @param int $filterType
     * @param string $baseUrl
     * 装配分类分页信息*****
     */
    protected function grabLinksAction($url, $filterKind = 1, $catalog = null)
    {
        if (empty($url)) return false;
        $html = $this->getContent($url);
        if (empty($html)) return false;
        if (stripos($html, '/captcha/') !== false) return false;
        $crawlerLinks = $this->crawlerLinksFilter($html, $filterKind);
        if ($this->debug) Log::info('==links count==' . count($crawlerLinks));
        $this->saveLinks($crawlerLinks);
        if ($catalog) $catalog->update(['links' => count($crawlerLinks)]);
    }

    protected function grabLinks($catalog = null)
    {
        if (!$catalog || empty($catalog->url)) return false;
        if (empty($url)) return false;
        $html = $this->getContent($url);
        if (empty($html)) return false;
        $crawlerLinks = $this->getfilters($html);
        if ($this->debug) Log::info('==links count grabLinks==' . count($crawlerLinks));
        $this->saveLinks($crawlerLinks);
        if ($catalog) $catalog->update(['links' => count($crawlerLinks)]);
    }

    private function isNumber($title)
    {
        $title = str_replace(',', '', $title);
        $title = trim($title);
        return is_numeric($title);
    }

    /**
     * 哪些标识的url可以排除
     * 比如评论的 #customerReviews
     * @param $url
     * @return bool
     */
    private function isVaildUrl($url)
    {
        $result = false;
        #customerReviews
        $rules = $this->getHtmlRules(1, 'invalid_url');
        foreach ($rules as $rule) { //多条规则是分开的或的关系
            for ($i = 1; $i <= 5; $i++) {  //单条规则里的多条query_selector是且的关系
                $rule_n = 'query_selector_' . $i;
                $v = $rule->{$rule_n};
                if ($v) {
                    if (stripos($url, $v) !== false) {
                        $result = true;
                        break 2;
                    }
                }
            }
        }
        return $result;
    }

    /**
     * 获取links，过滤规则
     * @param $html
     * @param int $kind
     * @param string $baseUrl
     * @return array
     */
    protected function crawlerLinksFilter($html, $kind = 1)
    {
        $crawler = new Crawler($html, $this->baseUrl);
        $rules = $this->getHtmlRules($kind, 'url');
        $links = [];
        foreach ($rules as $rule) { //多条规则是分开的或的关系
            $_crawler = clone $crawler;
            for ($i = 1; $i <= 5; $i++) {  //单条规则里的多条query_selector是且的关系
                $rule_n = 'query_selector_' . $i;
                $cssSelector = $rule->{$rule_n};
                if ($cssSelector) {
                    try {
                        Log::info($cssSelector);
                        $_crawler = $_crawler->filter($cssSelector);
                    } catch (\Exception $e) {
                        Log::info($e->getMessage());
                    }
                }
            }
            $_links = $_crawler->links();
            $links = array_merge($links, $_links);
        }
        return $links;
    }

    /**
     * url中 /dp/
     * @param $url
     * @return bool
     */
    protected function getUrlAsin($url)
    {
        if (stripos($url, '/dp/') !== false) {
            $_array = explode('/dp/', $url);
            $ex = explode('/', $_array[1]);
            $ex = explode('?', $ex[0]);
            return $ex[0];
        }
        return false;
    }

    /**
     *
     *  哪些表示是产品
     *  url中 /dp/
     *  #atfResults
     * @param $crawler
     */
    protected function getfilters($crawler)
    {
        $rules = $this->getAllRules();
        $data = [];
        $links = [];
        foreach ($rules as $rule) { //多条规则是分开的或的关系
            if ($rule->kind == 1 && $rule->rule_name == 'invalid_url') continue;
            $_crawler = clone $crawler;
            for ($i = 1; $i <= 5; $i++) {  //单条规则里的多条query_selector是且的关系
                $rule_n = 'query_selector_' . $i;
                $cssSelector = $rule->{$rule_n};
                if ($cssSelector) {
                    try {
                        if ($this->debug) Log::info($cssSelector);
                        $_crawler = $_crawler->filter($cssSelector);
                        if ($this->debug) {
                            $count = count($_crawler);
                            Log::info($count);
                        }
                    } catch (\Exception $e) {
                        if ($this->debug) Log::info($e->getMessage());
                        continue;
                    }
                }
            }
            // 跟卖情况,跟卖数量
            if ($rule->rule_name == 'mbc') {
                $data['mbc'] = count($_crawler);
                continue;
            }

            //处理商品页属性
            if ($rule->kind == 2 && $rule->rule_name == 'rank') {
                $_data = $this->getFilterProductDescriptions($_crawler);
                if ($this->debug) Log::info(print_r($_data, true));
                $this->setMergeData($data, $_data);
                continue;
            }

            //处理其他的链接
            $_links = $_crawler->each(function ($_item) use ($rule, &$data) {

                if ($rule->kind == 2 && $rule->rule_name != 'url') {
                    $text = $_item->text();
                    if (!isset($data[$rule->kind]) && $rule->rule_string) {
                        if (stripos($text, $rule->rule_string) !== false) {
                            if ($rule->rule_name == 'image') {
                                $_data[$rule->rule_name] = $this->getMatchContents($text, $rule);
                                $this->setMergeData($data, $_data);
                            } else {
                                $data[$rule->rule_name] = $this->getMatchContents($text, $rule);
                            }
                        }
                    }
                }
                try {
                    $_links = $_item->links();
                } catch (LogicException $e) {
                    $_links = [];
                }
                return $_links;
            });
            $this->getFilterProductCsv($rule, $_crawler, $data);
            $links = array_merge($links, $_links);
            unset($_crawler);
        }
        return [$links, $data];
    }

    /**
     * 处理商品各项数据合并
     * @param $data
     * @param $append
     */
    protected function setMergeData(&$data, $append)
    {
        if (!empty($append)) {
            $_added = false;
            foreach ($append as $key => $value) {
                if (empty($value)) continue;
                if (!empty($data[$key])) {
                    if (!$_added) {
                        $str = $data[$key];
                        unset($data[$key]);
                        $data[$key][] = $str;
                        $_added = true;
                    }
                    $data[$key][] = $value;
                } else {
                    $data[$key] = $value;
                }
            }
        }
        // return $data;
    }

    /**
     * 过滤html中json里的属性
     * @param $text
     * @param string $flag
     * @param $data
     * @return array
     */
    protected function filterJsonImage($rule, &$data)
    {
        $rule_name = 'images';
        if ($rule->rule_name == $rule_name && isset($data[$rule_name])) {
            $r = $this->getMatchContents($data[$rule_name], $rule);
            // if (!empty($r)) {
            unset($data[$rule_name]);
            $data[$rule_name] = $r;
            //  }
        }
    }

    /**
     * 获取商品描述的的数据
     * @param $crawler
     * @return array
     */
    protected function getFilterProductDescriptions($crawler)
    {
        $product = [];
        //Amazon Best Sellers Rank:
        $needAttributes = ['ASIN' => 'asin', 'Best Sellers Rank' => 'rank'];
        $nas = array_flip($needAttributes);
        // 商品属性
        $nodes = $crawler->each(function ($node) {
            $ranklinks = [];
            $title = trim($node->text());
            try {
                $value = trim($node->nextAll()->eq(0)->text());
                $_ranklinks = $node->nextAll()->eq(0)->filter('a')->links();
            } catch (InvalidArgumentException $e) {
                $value = $title;
                $_ranklinks = $node->filter('a')->links();
            }
            foreach ($_ranklinks as $link) {
                $_link = $this->getLink($link);
                if ($_link) $ranklinks[] = $_link;
            }
            return [$title, $value, $ranklinks];
        });
        if (!empty($nodes)) {
            foreach ($nodes as $name => $node) {
                if (stripos($node[0], $nas['rank']) !== false) {
                    $product['rank'] = $node[0];
                    $product['links'] = $node[2];
                    list($product['interval'], $product['ranks']) = $this->getRanks($node[1]);
                } else
                    if (isset($needAttributes[$node[0]])) {  //过滤必要的属性，放进产品数组里
                        $name = $needAttributes[$node[0]];
                        $product[$name] = $node[1];
                        if ($name == 'rank') {
                            /**
                             * 以 #N 数字来区分rank序号
                             * 以 > 区分排序分类
                             * 存储格式？？？
                             * links 存分类表
                             *  rank + asin + 单个分类名（keywords） 存商品表
                             *  asin 商品rank + 分类id + +跟卖数  + 日期 存商品排序表
                             *  检索方式：
                             *    查亚马逊商品页，重新获取rank及分类links，找本地分类，有就取id，重新生成 存商品排序表数据
                             *    如果规则7天有在某个分类中升rank，跟卖数升，就算ok
                             *  页面变体，规则变更情况，不同分类商品展示不同的情况？
                             */
                            $product['links'] = $node[2];
                            list($product['interval'], $product['ranks']) = $this->getRanks($node[1]);
                        }
                    }
            }
        }
        return $product;
    }

    /**
     * 其他属性，制定css选择器规则，然后取一下内容，一般处理文字，图片待测试
     * @param $name
     * @param $crawler
     * @return mixed
     */
    protected function getFilterProductCsv($rule, $crawler, &$data)
    {
        try {
            $value = trim($crawler->text());
            if (!empty($value)) {
                $data[$rule->rule_name] = $value;
                $this->filterJsonImage($rule, $data);
            }
        } catch (InvalidArgumentException $e) {
            // Log::info('--------------images----------------'.$e->getMessage());
        }

    }

    /**
     * 处理crawler链接
     * @param $crawlerLink
     * @param string $baseUrl
     * @return array|bool
     */
    protected function getLink($crawlerLink)
    {
        $url = $crawlerLink->getUri();
        if (stripos($url, $this->baseUrl) === false || (strlen($url) < strlen($this->baseUrl) + 2)) return false;
        $link_title = $crawlerLink->getNode()->textContent;
        $link_title = trim($link_title);
        if (empty($link_title)) $link_title = 'mmmmmmmm';
        if (strlen($link_title) > 255) return false;
        $link_title = strip_tags($link_title);
        $link_title = str_replace(['  ', "'", '"', '<', '>'], [' '], $link_title);
        return ['title' => $link_title, 'url' => $url];
    }

    /**
     * *******************************************
     * main step 1
     * 抓首页链接
     * 起始从首页进来，筛选分类链接，根据链接关键词排除一些没有用的链接
     * @return mixed
     */
    public function grabFirstPage()
    {
        $uri = $this->getFirstPage();
        $this->grabLinksAction($uri);
        return 1;
    }

    /**
     * *******************************************
     * 抓分类links
     * main step 2;
     */
    public function grabCategories()
    {
        $amazonCategories = Cache::get('amazon-categories-active-grab', function () {
            return $this->amazonCategory->rand()->take($this->catelog_per_num)->get();
        });
        if ($amazonCategories && $amazonCategories->count()) {
            foreach ($amazonCategories as $amazonCategory) {
                $this->grabLinksAction($amazonCategory->url, 1, $amazonCategory);
            }
        }
        if ($amazonCategories->count() == $this->catelog_per_num) {
            sleep(5);
            $this->grabCategories();
        }
        return 1;
    }

    /**
     * *******************************************
     * 抓产品links
     *  分类链接下的分页标识
     *  .pagnLink a
     *  .zg_page a
     */
    public function grabCatalogProductLinks($p = 1)
    {
        $per = 5;
        $start = ($p - 1) * $per;
        $p++;
        $categories = $this->amazonCategory->sortActiveDesc()->skip($start)->take($per)->get();
        foreach ($categories as $category) {
            $product = [];
            $product['reviews'] = $product['asks'] = 0;
            $product['url'] = $category->url;
            $product['asin'] = $this->getUrlAsin($category->url);
            $html = $this->getContent($category->url);
            if (empty($html)) return false;
            $crawler = new Crawler($html, $this->baseUrl);
            list($links, $_products) = $this->getfilters($crawler);
            $product = array_merge($product, $_products);
            $this->saveLinks($links);
            $this->saveProduct($product);
            //如果是产品带分类链接，或者相关链接很少，就删掉不要
            if (isset($product['links']) || count($links) < 5) {
                // $category->delete();
            } else {
                //  $category->increment('step');
            }
        }
        if (count($categories) == $per) $this->grabCatalogProductLinks($p);
    }

    /**
     * *******************************************
     * main step 3
     * 抓产品，并且分析产品
     * 1、从产品原表里找n条记录，放进来执行
     * 2、初步分析完页面结果，进行保存
     */
    public function grabProducts($p = 1)
    {
        $per = 5;
        $start = ($p - 1) * $per;
        $p++;
        $products = $this->amazonProduct->active()->sortActiveDesc()->skip($start)->take($per)->get();
        if ($products) {
            foreach ($products as $itemProduct) {
                $this->processProductPage($itemProduct);
            }
        }
        if (count($products) == $per) $this->grabProducts($p);
    }

    public function testProduct($ids)
    {
        $products = $this->amazonProduct->whereIn('id', $ids)->get();
        if ($products) {
            foreach ($products as $itemProduct) {
                $this->processProductPage($itemProduct);
            }
        }
    }

    /**
     * 处理产品页
     * @param $itemProduct
     * @return array
     */
    protected function processProductPage($itemProduct)
    {
        //if($this->debug){ $this->grabInterval=0; }
        $product = [];
        $itemProduct->step = (int)$itemProduct->step;
        $product['reviews'] = $product['asks'] = 0;
        $product['product_id'] = $itemProduct->id;
        $product['step'] = $itemProduct->step;
        $product['url'] = $itemProduct->url;
        $product['asin'] = $this->getUrlAsin($itemProduct->url);
        if ($itemProduct->update_time) {
            $timeLast = strtotime($itemProduct->update_time);
            $timeToday = time();
            $timeDiff = $timeToday - $timeLast;
            if ($timeDiff >= $this->grabInterval) {  //2天
                $itemProduct->step += 1;
            } else {
                return 0;
            }
        }
        $itemProduct->update_time = $this->update_time;
        $html = $this->getContent($product['url']);
        if (empty($html)) return false;
        $crawler = new Crawler($html, $this->baseUrl);
        list($links, $_products) = $this->getfilters($crawler);
        $product = array_merge($product, $_products);
        $this->saveLinks($links);
        $this->saveProduct($product);
        $itemProduct->save();
        return 0;
    }

    public function saveLinks($links)
    {
        $yesterday = date('Y-m-d H:i:s', strtotime($this->update_time) - 86400);
        foreach ($links as $link) {
            if (is_array($link)) {
                foreach ($link as $_link) {
                    $this->saveLink($_link, $yesterday);
                }
            } else {
                $this->saveLink($link, $yesterday);
            }
        }
    }

    /**
     * 获取链接详情，并做过滤
     * $links @param $linkItems Crawler
     */
    protected function linksFilter($links)
    {
        $_links = [];
        foreach ($links as $link) {
            if (is_array($link)) {
                foreach ($link as $_link) {
                    if ($item = $this->linkFilter($_link)) $_links[] = $item;
                }
            } else {
                if ($item = $this->linkFilter($link)) $_links[] = $item;
            }
        }
        return $_links;
    }

    /**
     * 单个链接对象处理
     * @param $linkItem Crawler
     */
    protected function linkFilter($linkItem)
    {
        $_links = $this->getLink($linkItem);
        if ($this->isVaildUrl($_links['url'])) return false;
        if ($_links && $this->amazonBadWords->compareIn($_links['title'])) return false;
        return $_links;
    }

    /**
     * 自己保存链接
     * @param $linkItem
     * @param $yesterday
     */
    private function saveLink($linkItem, $yesterday)
    {
        $_links = $this->getLink($linkItem);
        if ($this->isVaildUrl($_links['url'])) return;
        if ($_links) {
            if (!$this->amazonBadWords->compareIn($_links['title'])) {
                $asin = $this->getUrlAsin($_links['url']);
                if ($asin) {
                    try {
                        $this->amazonProduct->firstOrCreate([
                            'asin' => $asin,
                        ], [
                                'name' => $_links['title'],
                                'url' => $_links['url'],
                                'update_time' => $yesterday,
                                'is_active' => 1,
                                'step' => 0,
                            ]
                        );
                    } catch (\Exception $e) {
                        if ($this->debug) Log::info($e->getMessage());
                    }
                } else {
                    try {
                        $this->amazonCategory->firstOrCreate(
                            [
                                'url' => $_links['url'],
                            ], [
                                'name' => $_links['title'],
                                'update_time' => $yesterday,
                                'is_active' => 1,
                            ]
                        );
                    } catch (\Exception $e) {
                        if ($this->debug) Log::info($e->getMessage());
                    }
                }
            }
        }
    }


    /**
     * 保存商品数据
     *
     */
    protected function saveProduct($product)
    {
        if ($this->debug) Log::info($product);
        if (!isset($product['product_id'])) {
            if (empty($product['asin'])) return;
            try {
                $_product = $this->amazonProduct->firstOrCreate([
                    'asin' => $product['asin'],
                ], [
                        'name' => $product['asin'],
                        'url' => $product['url'],
                        'update_time' => $this->update_time,
                        'is_active' => 0,
                        'step' => 0,
                    ]
                );
                $product['product_id'] = $_product->id;
                $product['step'] = 0;
            } catch (\Exception $e) {
                if ($this->debug) Log::info($e->getMessage());
            }
        }
        if ($this->debug) Log::info($product);
        if (!empty($product['links'])) {
            array_shift($product['links']);  // 第一条不要
            $rootCatId = 0;
            foreach ($product['links'] as $i => $link) {  //1、保存best seller排序所在的分类
                $catalog = $this->amazonCategory->firstOrCreate(['name' => $link['title']], ['url' => $link['url'], 'is_active' => 1]);
                if (!empty($product['ranks'])) {
                    foreach ($product['ranks'] as &$rank) {  //1.1 加上分类id的关联信息
                        if ($rank['catalog'] == $link['title']) {
                            $rank['catalog_id'] = $catalog->id;
                            break;
                        }
                    }
                }
                if ($i == 0) $rootCatId = $catalog->id;
            }
            //  Log::info(print_r($product,true));
            if (!empty($product['ranks'])) {
                if ($this->debug) Log::info(print_r($product, true));
                if ($product['interval']) {
                    foreach ($product['ranks'] as $i => $rank) {  //2、保存商品在各分类的排序
                        if ($i == 0 && !isset($rank['catalog_id']) && $rootCatId) $rank['catalog_id'] = $rootCatId;
                        if (isset($rank['catalog_id']) && !empty($rank['catalog_id'])) {
                            $this->saveProductRank($product, $rank);
                        }
                    }
                } else {
                    $this->amazonProduct->where('asin', '=', $product['asin'])->delete();
                    $this->amazonProductRank->where('asin', '=', $product['asin'])->delete();
                }
            }
        }
    }

    /**
     * 计算差异
     * @param $product
     * @param $rank
     */
    protected function saveProductRank($product, $rank)
    {
        $productObject = $this->amazonProductRank->where('product_id', '=', $product['product_id'])->where('catalog_id', '=', $rank['catalog_id'])->first();
        if (!$productObject) {
            $productObject = $this->amazonProductRank->firstOrCreate(['product_id' => $product['product_id'], 'catalog_id' => $rank['catalog_id']],
                ['asin' => $product['asin'], 'mbc' => $product['mbc'], 'rank' => $rank['rank'], 'update_time' => $this->update_time,
                    'reviews' => $product['reviews'], 'asks' => $product['asks'], 'step' => $product['step']
                ]
            );
        } else {
            $diff = 0;
            for ($j = 1; $j <= 5; $j++) {
                $ld = $productObject->{"d$j"};
                if ($ld == 0 && $productObject->rank) {
                    $diff = $rank['rank'] - $productObject->rank;
                    $productObject->{"d$j"} = $diff;
                    break;
                }
            }
            $productObject->step++;
            $productObject->update_time = $this->update_time;
            $productObject->mbc = $product['mbc'];
            $productObject->reviews = $product['reviews'];
            $productObject->asks = $product['asks'];
            $productObject->rank = $rank['rank'];
            $productObject->save();
        }
    }

    /**
     * 获取rank 在小分类中的排序
     * @param $str
     * @return array|bool
     */
    protected function getRanks($str)
    {
        if (stripos($str, '#') === false) return false;
        $clearPettn = '/\(.*\)/';
        $str = preg_replace($clearPettn, '', $str);
        $_ranks = explode('#', $str);
        $ranks = [];
        $rankInInterval = false;
        foreach ($_ranks as $i => $_rank) {
            $numberPettn = '/^[1-9]\d*/';
            $_rank = str_replace(',', '', $_rank);
            if (preg_match($numberPettn, $_rank, $result)) {
                $catalog = explode('>', $_rank);
                $catalog = end($catalog);
                $clearPettn = '/^' . $result[0] . ' in /';
                $catalog = preg_replace($clearPettn, '', $catalog);
                $catalog = trim($catalog);
                $ranks[] = ['rank' => $result[0], 'catalog' => $catalog];
                if (!$rankInInterval) $rankInInterval = $this->rankInInterval($result[0]);
            }
            if (++$i > $this->maxRankLevel) break;
        }
        return [$rankInInterval, $ranks];
    }

    /*
     * 取1-30000之间的rank的数据
     */
    protected function rankInInterval($number)
    {
        if (!$this->rank_max) {
            list($this->rank_min, $this->rank_max) = Cache::rememberForever('amazon-product-rank-min-max-config', function () {
                $min = Setting::getPathValue('rank-min');
                $min = max(1, (int)$min);
                $max = Setting::getPathValue('rank-max');
                $max = min(500000, (int)$max);
                return [$min, $max];
            });
        }
        return ($number >= $this->rank_min && $number <= $this->rank_max);
    }

    public function count()
    {
        return $this->amazonCategory->active()->count();
        // return  DB::table('amazon_categoies')->get();
    }

    /**
     * 重置焦点抓取，目标不用台分散
     */
    public function resetFocus()
    {
        $words = AmazonFocusTag::all();
        $this->amazonCategory->resetAllUnActive();
        $this->amazonProduct->resetAllUnActive();
        foreach ($words as $tag) {
            $tag->activeWord($tag->word, 1);
        }
    }

    /**
     * 测试中
     * 产生图片和csv
     */
    public function grabOKProductFromAmazon(){
        //$products = $this->amazonOkProduct->Crawler()->Rand()->take(2)->get();
        set_time_limit(3000);
        $this->amazonOkProduct->update(['is_active'=>0]);
        $products = $this->amazonOkProduct->Rand()->take(2)->get();
        Log::info('--s--' . count($products));
        foreach ($products as $product) {
            Log::info('--s--' . $product->url);
            $_product = $this->grabProduct($product);
            if (is_array($_product)) {
                foreach ($_product as $key => $value) {
                    if (in_array($key, ['asin', 'name', 'image', 'rank', 'price', 'description', 'mbc','keywords'])) {
                        $product->{$key} = "$value";
                    }
                }
                $product->is_active = 1;
                $product->save();
                Log::info('--p--' . $product->url);
            }
            $this->saveCsv($product);
            Log::info('--e--' . $product->url);
        }
    }


    /**
     * 抓单条亚马逊产品
     * 主方法
     */
    public function grabProduct($product)
    {
        $url = $product->url;
        $html = $this->getContent($url);
        if (empty($html)) {
            Log::info('Empty Grab: ' . $url);
            return false;
        }
        // $rules = $this->getHtmlRules(2,'');
        $crawler = new Crawler($html, $this->baseUrl);
        list($links, $_products) = $this->getfilters($crawler);
        if (empty($_products['asin'])) $_products['asin'] = $this->getUrlAsin($url);
        $links = $this->linksFilter($links);
        $links = $this->assoc_unique($links, 'url');
        $this->saveImages($_products,$product);
        // Log::info($_products);
        return $_products;
        //  Log::info($links);
    }



    /**
     * 存储远程图片到本地
     * 存储记录到文件
     * @param $_products
     */
    protected function saveImages($_products,$product)
    {
        if (isset($_products['images'])) {
            $_products['asin'] = isset($_products['asin']) ? $_products['asin'] : 'N' . rand(1, 1000);
            if (is_array($_products['images'])) {
                $directory = storage_path('csv/media/catalog/product');
                $name = $_products['asin'];
              //  $haveImage = false;
                $_products['amazon_images'] = $_products['images'];
                $i = 1;
                foreach ($_products['images'] as &$image) {
                    $filename = pathinfo($image, PATHINFO_FILENAME);
                    $extension = pathinfo($image, PATHINFO_EXTENSION);
                    $filename = str_replace(['.', '%'], '', $filename);
                    $filename = $name . '_' . $filename . '.' . $extension;
                    $arr1 = str_split($filename);
                    array_splice($arr1, 2);
                    $subPath = '';
                    foreach ($arr1 as $_sub) {
                        $subPath .= '/' . $_sub;
                    }
                    $_filename = 'csv/media/catalog/product/' . $subPath . '/' . $filename;
                    $size = 0;
                    try {
                        $_size = storage_path('app/' . $_filename);
                        if (file_exists($_size)) $size = 1;
                    } catch (\RuntimeException $runtimeException) {
                        $size = 0;
                    } catch (\Exception $exception) {
                        $size = 0;
                    }

                    if (!$size) {
                        $file = $this->clientGet($image);
                        if (!empty($file)) {
                            Storage::put($_filename, $file);
                            try {
                                AmazonOkProductImage::create([
                                    'product_id' => $product->id,
                                    'label' => !empty($_products['name'])?$_products['name']:$_products['asin'],
                                    'image' => $filename,
                                ]);
                            }catch (\Exception $exception){
                               // Log::info($exception);
                            }
                        } else {
                            Log::info('-----4---no data--------' . $image);
                        }
                    }
                   // $haveImage = true;
                    if (1 == $i++) $_products['image'] = $image;
                    $image = $filename;
                }
            }
        }
    }

    /**
     * 商品数据写进csv
     * @param $_products
     * //成功抓到图片的数据写进csv
     *  可变方式
     */
    protected function saveCsv($product)
    {
        $_products = $product->toMagento();
        if(empty($_products))return;
        $file = storage_path('app/csv/products.csv');
        $lines = [];
        $exist = false;
        $dataHead = $line = [];

        if (file_exists($file)) {
            //检查是否存在文件存在标题行
            if (($handle = fopen($file, "r")) !== FALSE) {
                $i = 1;
                $col = 0;
                $col_name = 0;
                while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
                    $num = count($data);
                    if (empty($data)) continue;
                    for ($c = 0; $c < $num; $c++) {
                        if ($i === 1) {
                            if (empty($data[$c])) break;
                            $dataHead[] = $data[$c];
                            if ($data[$c] == 'asin') $col = $c;
                            if ($data[$c] == 'name') $col_name = $c;
                        }
                    }
                    if ($col > 0) {
                        if ((isset($data[$col]) && $data[$col] == $_products['asin']) || (isset($data[$col_name]) && $data[$col_name] == $_products['name'])) { //如果存在，就不写了；
                            $exist = true;
                            break;
                        }
                    }
                    $i++;
                }
                fclose($handle);
            }
        }

        if ($exist) return;
        if (empty($dataHead)) { //如果不存在标题行，就加文件标题行
            $dataHead = array_keys($_products);
            $lines[] = $dataHead;// implode(',',$dataHead);
        } else {
            if (in_array('asin', $dataHead))
                $_products = array_merge(array_flip($dataHead), $_products); //重新排序
        }

        //排序过的数据整理成字符串
        foreach ($_products as $key => $product) {
            $line[] = "" . (is_array($product) ? implode(';', array_flatten($product)) : $product);
        }

        $lines[] = $line;
        $file = fopen($file, 'a');
        foreach ($lines as $row) {
            fputcsv($file, $row);
        }
        fclose($file);
    }


    /**
     * 辅助方法
     * 商品链接根据asin号去除重复
     *
     * @param $arr
     * @param $key
     * @return mixed
     */
    private function assoc_unique($arr, $key)
    {
        $tmp_arr = [];
        foreach ($arr as $k => $v) {
            $asin = $this->getUrlAsin($v[$key]);
            if (!$asin) {
                unset($arr[$k]);
                continue;
            }
            if (in_array($asin, $tmp_arr)) { //搜索$v[$key]是否在$tmp_arr数组中存在，若存在返回true
                unset($arr[$k]);
            } else {
                $tmp_arr[] = $asin;
            }
        }
        return $arr;
    }

}