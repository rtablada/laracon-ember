<?php

class Comment extends Eloquent
{
	protected $fillable = [
		'body',
		'post_id',
	];

	public function post()
	{
		return $this->belongsTo('Post');
	}
}
