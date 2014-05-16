<?php namespace Api;

use Input;

class Comments extends \BaseController
{
	protected $hasKey = true;

	public function __construct(\Comment $comment)
	{
		$this->comment = $comment;
	}

	public function index()
	{
		$ids = Input::get('ids');

		if ($ids) {
			return $this->comment->whereIn('id', $ids)->with('post')->get();
		} else {
			return $this->comment->with('post')->get();
		}
	}

	public function show($id)
	{
		return $this->comment->with('post')->find($id);
	}

	public function store()
	{
		$input = Input::json('comment');
		$attrs = [
			'body' => $input['body'],
			'post_id' => $input['post'],
		];

		$comment = $this->comment->create($attrs);
		$comment->load('post');

		return $comment;
	}

	public function update($id)
	{
		$input = Input::json('comment');
		$attrs = [
			'body' => $input['body'],
			'post_id' => $input['post'],
		];

		$comment = $this->comment->with('post')->findOrFail($id);
		$comment->update($input);

		return $comment;
	}
}
