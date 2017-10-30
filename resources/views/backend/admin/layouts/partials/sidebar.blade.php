<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 15-3-24
 * Time: 上午9:32
 * 子模块不用再 extents 父模块，否则会进入死循环
 *  sectiond 对应 show stop append overwrite
 *
 */
?>
@section('backend.layouts.partials.sidebar')
<div class="side-menu sidebar-inverse">
       <nav class="navbar navbar-default" role="navigation">
            <div class="side-menu-container">
                <div class="navbar-header">
                    <a href="#" class="navbar-brand">
                        <div class="icon fa fa-paper-plane"></div>
                        <div class="title">{{ config('adminhtml.logo_title') }}</div>
                    </a>
                    <button class="navbar-expand-toggle pull-right visible-xs" type="button">
                        <i class="fa fa-times icon"></i>
                    </button>
                </div>
           {!! $menus !!}
            </div>
       </nav>
</div>
@show

