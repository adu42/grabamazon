<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client as HttpClient;
use File;
//use DB;
use DataGrid;
use DataFilter;
use DataSet;
use DataEdit;
use Illuminate\Support\Facades\Auth;
use View;
use Input;
use App\cloudflare_account;
use App\cloudflare_domain;


use App\Http\Requests;

class cloudflareController extends Controller
{
    public $api = 'https://api.cloudflare.com/client/v4/zones?page=1&per_page=200&order=type&direction=asc';
    public $email='aus2pbz@163.com';
    public $api_global_key='b177a21d6c25c295b00dbc4faa5731367d882';
    public $api_ca_key = 'v1.0-6161548980ea1a86217f50cfa7d42cb18cf9a8ecca78fb91b1243e857a588c46-7b395ee58365d52940c97495f21dfac45c1d6995ecd95575e693543665fcac2e81e307b8126299850a140a34c3085c87a284966e02d114e0068841f72958aee8-f329938fa310675b7ec8560056a0c6dbad9ee9651891be07488154b7d32746eb';
    public function index(HttpClient $client){
     //   die();
        $defaults = [
           // 'allow_redirects' => RedirectMiddleware::$defaultSettings,
            'http_errors'     => true,
            'decode_content'  => true,
            'verify'          => false,
            'cookies'         => false
        ];
        $client = new HttpClient($defaults);

        $response = $client->request('GET', $this->api, ['headers'=>[
          //  'X-Auth-User-Service-Key:'.$this->api_ca_key,
            'Content-Type'=>'application/json',
            'X-Auth-Email'=>$this->email,
            'X-Auth-Key'=>$this->api_global_key,]


        ]);

        $body = $response->getBody();

        $body = json_decode ($body);
        $domainZoneId =  $body->result[0]->id;
        $body = $this->getCloudflareDnsRecords($domainZoneId);

dd($body);


    }

    protected function getCloudflareDnsRecords($domainZoneId){
        $this->api = 'https://api.cloudflare.com/client/v4/zones/'.$domainZoneId.'/dns_records?page=1&per_page=200&order=type&direction=asc';
        $body= $this->HttpClientGet();
        return $body;
    }

    protected function HttpClientGet(){
        $defaults = [
            // 'allow_redirects' => RedirectMiddleware::$defaultSettings,
            'http_errors'     => true,
            'decode_content'  => true,
            'verify'          => false,
            'cookies'         => false
        ];
        $client = new HttpClient($defaults);

        try{
        $response = $client->request('GET', $this->api, ['headers'=>[
            //  'X-Auth-User-Service-Key:'.$this->api_ca_key,
            'Content-Type'=>'application/json',
            'X-Auth-Email'=>$this->email,
            'X-Auth-Key'=>$this->api_global_key,]
        ]);
        }catch (\Exception $e){
            return null;
        }
        $body = $response->getBody();
        $body = json_decode ($body);
        return $body;
    }

    public function accounts(){
        $filter = DataFilter::source(cloudflare_account::with('domains'));
        $filter->prepareForm();
        $filter->add('title','Search','text')->scope('Search');
        $filter->submit('search'); //->attributes(array('class'=>'btn-sm'))
        $filter->build();
        $grid = DataGrid::source($filter);
        $filter_bar = '';
        $grid->add('id','ID', true)->style("width:70px");
        $grid->add('name','Name');
        $grid->add('email','Email');
        $grid->add('key','ApiKey');
        $grid->edit(route('cloudflare.account.edit'), 'Edit','modify|delete')->style("width:70px");
        $grid->paginate(20);
        return View::make('cloudflare.common_list', compact('filter', 'grid','filter_bar'));
    }


    public function domains(){
        $filter = DataFilter::source(cloudflare_domain::with('account'));
        $filter->prepareForm();
        $filter->add('title','Search','text')->scope('Search');
        $filter->submit('search'); //->attributes(array('class'=>'btn-sm'))
        $filter->build();
        $grid = DataGrid::source($filter);
        $filter_bar = '';
        $grid->add('id','ID', true)->style("width:70px");
        $grid->add('name','Name');
        $grid->add('account.email','Email');
        $grid->add('ip','ip');
        $grid->add('status','status');
        $grid->add('modified_on','modified_on');
        $grid->add('name_servers','name_servers');
        $grid->add('original_name_servers','original_name_servers');
       // $grid->edit(route('cloudflare.account.edit'), 'Edit','modify|delete')->style("width:70px");
        $grid->paginate(500);
        return View::make('cloudflare.common_list', compact('filter', 'grid','filter_bar'));
    }
    /**
     * 编辑账户资料
     * @return
     */
    public function edit($id=0){
        $id = (Input::get('modify'))?:Input::get('delete');
        $article = cloudflare_account::findOrNew($id);
        if (Input::get('destroy')==1) return  "not the first";
        $returnUrl = route('cloudflare.accounts');
        $edit = DataEdit::source($article);
        $edit->label('Edit Accounts');
        $edit->link($returnUrl,"Accounts", "TR")->back();
        $edit->action(route('cloudflare.account.edit'));
        $edit->add('name','Title', 'text');
        $edit->add('email','Email', 'text')->rule('required|min:3');
        $edit->add('key','ApiKey', 'text');
        return View::make('cloudflare.common_edit', compact('edit'));
    }

    /**
     * 抓取
     * @return mixed
     */
    public function grab(){
        $cloudflare_accounts = cloudflare_account::all();
        $api = $this->api;
        $date = date('Ymd');
        foreach ($cloudflare_accounts as $acount){
            if($acount->modified_on==$date)continue;
            $this->api = $api;
            $this->email = $acount->email;
            $this->api_global_key = $acount->key;
            $this->getDomainsFormCloudflare($acount);
            $acount->modified_on= date('Ymd');
            $acount->save();
        }
        return 'wait.';
    }

    protected function getDomainsFormCloudflare($acount){
        $body = $this->HttpClientGet();
        if($body && $body->success){
            foreach ($body->result as $domain){
                $cloudflare_domain = cloudflare_domain::firstOrNew(['name' =>$domain->name,'account_id'=>$acount->id ]);
                //$cloudflare_domain->ip = $domain->
                $cloudflare_domain->name_servers = implode('|',$domain->name_servers);
                $cloudflare_domain->original_name_servers = implode('|',$domain->original_name_servers);
                $cloudflare_domain->status = $domain->status;
                $cloudflare_domain->modified_on = $domain->modified_on;
               // $cloudflare_domain->account_id = $acount->id;
                $cloudflare_domain =  $this->appendDnsRecords($domain,$cloudflare_domain);
                $cloudflare_domain->save();
            }
        }
    }

    protected function appendDnsRecords($domain,$cloudflare_domain){
        $dns = $this->getCloudflareDnsRecords($domain->id);
        if($dns && $dns->success){
            $records = [];
            foreach ($dns->result as $line){
               $_line = $line->type.' | '.$line->content;
               if(isset($line->ttl))$_line .=' |ttl: '.$line->ttl;
               if(isset($line->priority))$_line .=' |priority: '.$line->priority;
               if($line->locked)$_line .=' |locked:'.$line->locked;
               $records[]=$_line;
                if($line->name == $cloudflare_domain->name && $line->type=='A'){
                    $cloudflare_domain->ip = $line->content;
                    $cloudflare_domain->modified_on=$line->modified_on;
                }
            }
            $cloudflare_domain->dns = implode('<br>',$records);
        }
        return $cloudflare_domain;
    }



}
