<?php

class Post extends Eloquent
{
	protected $fillable = [
		'body',
	];

	public function comments()
	{
		$this->hasMany('Comment');
	}
}
