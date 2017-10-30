<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use GuzzleHttp\Client;
use GuzzleHttp\Pool;
use GuzzleHttp\Cookie\CookieJar;
use GuzzleHttp\Psr7\Request as GuzzleRequest;
use GuzzleHttp\Exception\ClientException;
use App\Models\Amazons\AmazonGrab;
use App\Models\Amazons\AmazonOkProduct;
use Illuminate\Support\Facades\Log;
class AmazonMultithreadingRequest extends Command
{
    private $totalPageCount;
    private $counter        = 1;
    private $concurrency    = 7;  //
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'amazon:grab';


    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'amazon grab product and catalogs';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle(AmazonGrab $amazonGrab, AmazonOkProduct $amazonOkProducts)
    {

        $amazonGrab->grabOKProductFromAmazon();

        //  $amazonGrab->grabProduct('https://www.amazon.com/gp/product/B017B19UL0/ref=s9u_simh_gw_i1?ie=UTF8&fpl=fresh&pd_rd_i=B017B19UL0&pd_rd_r=1SM216WV1B9FRF8ES420&pd_rd_w=Z0Umu&pd_rd_wg=bD4Kv&pf_rd_m=ATVPDKIKX0DER&pf_rd_s=&pf_rd_r=V6SM63VH079ASK60PKGW&pf_rd_t=36701&pf_rd_p=1cf9d009-399c-49e1-901a-7b8786e59436&pf_rd_i=desktop');
        //  $amazonGrab->grabProduct('https://www.amazon.com/dp/B0725QQMRG?psc=1');
        //  $amazonGrab->grabProduct('https://www.amazon.com/Intex-River-Lounge-Inflatable-Diameter/dp/B000PEOMC8/ref=sr_1_1?s=toys-and-games&ie=UTF8&qid=1504430266&sr=1-1&refinements=p_n_age_range%3A5442387011');
        //$amazonGrab->grabProduct('https://www.amazon.com/dp/B0722LDB7C?psc=1');
        //   $amazonGrab->grabProduct('https://www.amazon.com/Tiana-Womens-Scallop-Sheath-Dress/dp/B07357K4XV/ref=lp_17051271011_1_2?s=apparel&ie=UTF8&qid=1505004923&sr=1-2&nodeID=17051271011&psd=1');
        return;
        $amazonGrab->grabCategories();  //抓分类页
        //$amazonGrab->grabFirstPage();//抓首页
        return;

        $this->argument('user');




        /**
         * 并发任务 测试
         */


        $client = new Client();
        $this->totalPageCount = 11;

        $requests = function ($total) use ($client) {
            for($i=1;$i<=$total;$i++) {
                $uri = 'http://www.baidu.com/';
                yield function() use ($client, $uri) {
                    return $client->getAsync($uri,['verify'=>false,'allow_redirects' => false,'referer'=> true ]);
                };
            }
        };

        $pool = new Pool($client, $requests($this->totalPageCount), [
            'concurrency' => $this->concurrency,
            'fulfilled'   => function ($response, $index){
                $res = $response->getBody()->getContents();
                if($res)
                    file_put_contents(storage_path().'/logs/'.$index.'.txt',$res);
                $this->info("requests $index No:" . $index .'');
                $this->countedAndCheckEnded();
            },
            'rejected' => function ($reason, $index){
                $this->error("rejected".$index );
                $this->error("rejected reason: " . $reason );
                $this->countedAndCheckEnded();
            },
        ]);

        // 开始发送请求
        $promise = $pool->promise();
        $promise->wait();
    }

    public function countedAndCheckEnded()
    {
        if ($this->counter < $this->totalPageCount){
            $this->counter++;
            return;
        }
        $this->info("���������");
    }
}
