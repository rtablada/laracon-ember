<?php

class Comment extends Eloquent
{
	protected $fillable = [
		'body',
	];

	public function post()
	{
		$this->belongsTo('Post');
	}
}
