<?php

namespace App\Models;

use App\Core\App;

class Post
{
	public $id;
	public $content;
	public $timestamp;
	protected $user_id;

	public function user()
	{
		return App::get('database')->table('users')
			->select()
			->where('id', '=', $this->user_id)
			->get('App\\Models\\User');
	}

	public function comments()
	{
		return App::get('database')->table('comments')
			->select()
			->where('post_id', '=', $this->id)
			->orderBy('timestamp', 'asc')
			->getAll('App\\Models\\Comment');
	}
}