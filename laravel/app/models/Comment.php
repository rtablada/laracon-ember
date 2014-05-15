<?php

class Comment extends Eloquent
{
	protected $fillable = [
		'body',
	];

	public function post()
	{
		return $this->belongsTo('Post');
	}
}
