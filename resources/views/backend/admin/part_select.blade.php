<?php
/**
 * Email: 114458573@qq.com .
* User: 杜兵
* Date: 15-7-2
* Time: 上午3:08
*/
?>

<div class="row">
                <div class="col-md-12 ">
                    <div class="input-group inline">
                    <div class="controls">
                    <input class="checkbox-inline"  type="checkbox" name="allselected" value="1" id="allselected">
                    </div>
                    </div>
             @foreach($data as $item)
                    <div class="input-group inline">
                    <div class="controls">
                <select name="{!! $item['name'] !!}">
                    @foreach ($item['set'] as $per)
                        <option value="{!! $per->id !!}">{!! $per->name !!}</option>
                    @endforeach
                </select>
                    </div> </div>
                    @endforeach

                        <div class="input-group inline">
                    <div class="controls">
            <button class="btn btn-sm" type="submit">
                <span class="glyphicon glyphicon-submit"></span>{!! trans('submit') !!}
            </button> </div>
                        </div>
        </div>
<script type="text/javascript">
    $(document).ready(function(){
        $('#allselected').on('click',function(){
            if($(this).prop('checked')) {
                $('input[name^="id"]').each(function () {
                    $(this).prop('checked', 'checked');
                });
            }else{
                $('input[name^="id"]').each(function () {
                    $(this).prop('checked', false);
                });
            }
        });
    });
</script>
</div>

