<?php

namespace App\Controllers;

use App\Core\App;
use App\Models\User;

class PostsController
{
	public function index()
	{
		if (! User::isAuthenticated()) {
			return redirect('login');
		}

		$user = User::get(App::get('session')->get('user_id'));

		$page = 1;
		if (array_key_exists('page', $_GET) && is_numeric($_GET['page'])) {
			$page = intval($_GET['page']) > 0 ? intval($_GET['page']) : 1;
		}

		$title = '首頁';
		$totalPost = 	intval(
			App::get('database')->table('posts')
				->select('count(*) as count')
				->get()->count
		);
		
		$posts = App::get('database')->table('posts')
			->select()
			->orderBy('timestamp', 'desc')
			->limit(
				App::get('config')['POSTS_PER_PAGE'], 
				($page - 1) * App::get('config')['POSTS_PER_PAGE']
			)
			->getAll('App\\Models\\Post');

		$prevUrl = null; $nextUrl = null; 
		if ($page > 1) {
			$prevUrl = sprintf("/?page=%d", $page - 1);
		}
		if ($totalPost > App::get('config')['POSTS_PER_PAGE'] * $page) {
			$nextUrl = sprintf("/?page=%d", $page + 1);
		} 

		return view('index', compact('user', 'title', 'posts', 'prevUrl', 'nextUrl', 'totalPost'));
	}

	public function addPost()
	{
		if (! User::isAuthenticated()) {
			return http_response_code(401);
		}
			if (! isset($_POST['csrf_token']) 
				|| App::get('session')->get('csrf_token') !== $_POST['csrf_token']) {
			return http_response_code(403);
		}
		try {
			$user = User::get(App::get('session')->get('user_id'));
			$id = App::get('database')->table('posts')
			->insert([
				'user_id' => $user->id,
				'content' => $_POST['post']
			]);
			$post = App::get('database')->table('posts')
				->select()
				->where('id', '=', $id)
				->get('App\\Models\\Post');
			require('app/views/partials/post.php');
		} catch (\Exception $e) {
			return http_response_code(500);
		}
	}

	public function addComment()
	{
		if (! User::isAuthenticated()) {
			return http_response_code(401);
		}
		try {
			$user = User::get(App::get('session')->get('user_id'));
			$id = App::get('database')->table('comments')
			->insert([
				'user_id' => $user->id,
				'content' => $_POST['comment'],
				'post_id' => $_POST['post_id']
			]);
			$comment = App::get('database')->table('comments')
				->select()
				->where('id', '=', $id)
				->get('App\\Models\\Comment');
			require('app/views/partials/comment.php');
		} catch (\Exception $e) {
			return http_response_code(500);
		}
		
	}
}