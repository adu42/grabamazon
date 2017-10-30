<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/1/3
 * Time: 18:10
 */
$items = $MyNavBar->all();
dd($items);
 ?>
<?php
 //return ;
?>
<div>
 <ul>
   @include(config('vmenus.bootstrap-items'),array('items' => $items))
 </ul>
</div>



