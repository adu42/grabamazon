<?php use Former\Facades\Former; ?>
{!! Former::horizontal_open()->action(route('comment.save'))->id('comment-'.$comment->id)->rules(['comment' => 'required'])->method('POST') !!}
{!! Former::hidden('article_id')->value($comment->article_id)->required() !!}
{!! Former::hidden('quote_id')->value($comment->id)->required() !!}
{!! Former::textarea('comment_content')->rows(2)->required() !!}
{!! Former::actions()->large_primary_submit('Submit')->large_inverse_reset('Cancel') !!}
{!! Former::close() !!}

