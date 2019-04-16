<?php

namespace App\Models;

use App\Core\App;

class Comment
{
	public $id;
	public $content;
	public $timestamp;
	protected $post_id;
	protected $user_id;

	public function user()
	{
		return App::get('database')->table('users')
			->select()
			->where('id', '=', $this->user_id)
			->get('App\\Models\\User');
	}
}