<?php

class Post extends Eloquent
{
	protected $fillable = [
		'body',
	];

	public function comments()
	{
		return $this->hasMany('Comment');
	}
}
