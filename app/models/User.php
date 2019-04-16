<?php

namespace App\Models;

use App\Core\App;

class User
{
	public $id;
	public $username;
	public $nickname;
	public $email;
	protected $password;

	public static function get($id)
	{
		return App::get('database')->table('users')
			->select()
			->where('id', '=', $id)
			->get('App\\Models\\User');
	}

	public static function isAuthenticated()
	{
		return ! is_null(App::get('session')->get('user_id'));
	}

	public function checkPassword($password)
	{
		return password_verify($password, $this->password);
		// return $password == $this->password;
	}

	public function setPassword($password)
	{
		$this->password = password_hash($password, PASSWORD_DEFAULT);
	}

	public function save()
	{
		App::get('database')->table('users')
			->insert([
				'username' => $this->username,
				'nickname' => $this->nickname,
				'email' => $this->email,
				'password' => $this->password
			]);
	}

	public static function validateUsername($username)
	{
		$user = App::get('database')->table('users')
			->select()
			->where('username', '=', $username)
			->get();
		if ($user) {
			flash('請使用另一個帳號名稱');
			return FALSE;
		}
		return TRUE;
	}

	public static function validateEmail($email)
	{
		$user = App::get('database')->table('users')
			->select()
			->where('email', '=', $email)
			->get();
		if ($user) {
			flash('請使用另一個電子郵件地址');
			return FALSE;
		}
		return TRUE;
	}
}