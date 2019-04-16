<?php

namespace App\Controllers;

use App\Core\{App, Session};
use App\Models\User;

class UsersController
{
	public function login()
	{
		if (User::isAuthenticated()) {
			return redirect('');
		}

		$title = '登入';

		return view('login', compact('title'));
	}

	public function loginUser()
	{
		$user = App::get('database')->table('users')
			->select()
			->where('username', '=', $_POST['username'])
			->get('App\\Models\\User');

		if (isset($_POST['remember_me']) && $_POST['remember_me'] == 'true') {
			App::get('session')->rememberMe();
		}

		if ($user && $user->checkPassword($_POST['password'])) {
			App::get('session')->set('user_id', $user->id);
			App::get('session')->set('csrf_token', generateCsrfToken());

			return redirect('');
		} else {
			flash('帳號或密碼錯誤');

			return redirect('login');
		}
	}

	public function register()
	{
		$title = '註冊';

		return view('register', compact('title'));
	}

	public function registerUser()
	{
		if (User::isAuthenticated()) {
			return redirect('');
		}

		try {
			$username = htmlspecialchars($_POST['username']);
			$email = htmlspecialchars($_POST['email']);

			if (! User::validateUsername($username) || ! User::validateEmail($email)) {
				return redirect('register');
			}

			$user = new User;
			$user->username = $username;
			$user->email = $email;
			$user->nickname = htmlspecialchars($_POST['nickname']);
			$user->setPassword($_POST['password']);
			$user->save();
			flash('註冊成功！', 'success');

			redirect('login');
		} catch (\Exception $e) {
			http_response_code(500);
		}		
	}

	public function logout()
	{
		if (! User::isAuthenticated()) {
			return redirect('login');
		}

		App::get('session')->unset('user_id');
		App::get('session')->unset('csrf_token');

		setcookie('message-board-v3-session-id', '');

		return redirect('login');
	}
}