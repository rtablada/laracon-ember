<?php namespace Api;

use Input;

class Posts extends \BaseController
{
	protected $hasKey = true;

	public function __construct(\Post $post)
	{
		$this->post = $post;
	}

	public function index()
	{
		return $this->post->all();
	}

	public function show($id)
	{
		return $this->post->find($id);
	}

	public function store()
	{
		$input = Input::json('post');

		return $this->post->create($input);
	}
}
