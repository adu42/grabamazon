<span id="div_review_images">
<label for="review_image">{{ trans('review.upload_photos') }}</label>
<div class="reviewimagediv" id="reviewimageuploaddiv">
    <SPAN class="btn-5 btn-c">
    <A id="addPhoto">
        UPLOAD A PHOTO
    </A>
     @for($i=1;$i<=$nums;$i++)
            <input type="file" id="file{{$i}}" name="images[]" class="input-text review_image_files" onChange="validField(this)"/>
     @endfor
    </SPAN>
<span class="liar-label"></span>
</div>
<div class="reviewimagediv-description">{{ trans('review.upload_photos_description',['num'=>$nums])  }}</div>
</span>