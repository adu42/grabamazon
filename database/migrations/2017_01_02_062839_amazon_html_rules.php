<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AmazonHtmlRules extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('amazon_html_rules', function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('kind'); //1=>catalog   2=>profuct
            $table->string('rule_name'); //sku 码
            $table->string('label');
            $table->string('rule_string'); //规则字符串标记
            $table->string('rule_regular'); //规则正则提取表达式
            $table->string('rule_is_regular'); //规则正则提取表达式
            $table->string('query_selector_1'); //css过滤条件一
            $table->string('query_selector_2');
            $table->string('query_selector_3');
            $table->string('query_selector_4');
            $table->string('query_selector_5');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('amazon_html_rules');
    }
}
