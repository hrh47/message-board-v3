<?php

namespace App\Core;


class Session
{
	protected $id;
	protected $data = [];
	protected $expiry;
	protected $isNew;
	protected $flashedMessages = [];

	public static function load()
	{
		$session = null;
		if (isset($_COOKIE['message-board-v3-session-id'])) {
			$session = App::get('database')->table('sessions')
				->select()
				->where('id', '=', $_COOKIE['message-board-v3-session-id'])
				->andWhere('expiry', '>', date('Y-m-d H:i:s'))
				->get('App\\Core\\Session');			
		}
		if (is_null($session)) {
			$session = new static;
			$session->create();
			$session->isNew = TRUE;
		} else {
			$session->isNew = FALSE;
		}
		return $session;
	}

	public function create()
	{
		$this->id = session_create_id();
		$this->data = [];
		$this->expiry = time() + 60 * 60 * 24;
		
		setcookie('message-board-v3-session-id', $this->id, 0, NULL, NULL, NULL, TRUE);
	}

	public function get($key)
	{
		if (! is_array($this->data)) {
			$this->data = unserialize($this->data);
		}

		if (array_key_exists($key, $this->data)) {
			return $this->data[$key];
		}

		return null;
	}

	public function set($key, $value)
	{
		if (! is_array($this->data)) {
			$this->data = unserialize($this->data);
		}

		$this->data[$key] = $value;
	}

	public function store()
	{
		if (count($this->flashedMessages) > 0) {
			$this->set('flashed_messages', $this->flashedMessages);
			$this->flashedMessages = [];
		}
		if ($this->isNew) {
			App::get('database')->table('sessions')
				->insert([
					'id' => $this->id,
					'data' => serialize($this->data),
					'expiry' => date('Y-m-d H:i:s', $this->expiry)
				]);
		} else {
			App::get('database')->table('sessions')
				->where('id', '=', $this->id)
				->update([
					'data' => serialize($this->data)
				]);
		}		
	}

	public function unset($key)
	{
		if (! is_array($this->data)) {
			$this->data = unserialize($this->data);
		}

		if (array_key_exists($key, $this->data)) {
			unset($this->data[$key]);
		}
	}

	public function addMessage($message, $type) 
	{
		array_push($this->flashedMessages, [
			'content' => $message,
			'type' => $type
		]);
	}

	public function id()
	{
		return $this->id;
	}

	public function rememberMe()
	{
		$this->expiry = time() + 60 * 60 * 24 * 30;
		App::get('database')->table('sessions')
				->where('id', '=', $this->id)
				->update([
					'expiry' => date('Y-m-d H:i:s', $this->expiry)
				]);
		setcookie('message-board-v3-session-id', $this->id, $this->expiry, NULL, NULL, NULL, TRUE);
	}
}