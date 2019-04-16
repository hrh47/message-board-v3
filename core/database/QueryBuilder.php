<?php

namespace App\Core\Database;
use \PDO;

class QueryBuilder
{
	protected $pdo;
	protected $sql;
	protected $bind;

	public function __construct(PDO $pdo)
	{
		$this->pdo = $pdo;
		$this->select = null;
		$this->table = null;
		$this->where = null;
		$this->andWhere = [];
		$this->orWhere = [];
		$this->orderBy = null;
		$this->limit = null;
		$this->offset = null;
		$this->bind = [];
	}

	public function table($table)
	{
		$this->table = $table;

		return $this;
	}

	public function select($fields = '*')
	{
		$select = (is_array($fields) ? implode(', ', $fields) : $fields);
		$this->select = $this->select == null ? $select : $this->select . ", " . $select;

		return $this;
	}

	public function where($field, $op, $value)
	{
		$this->where = "{$field} {$op} :where_{$field}";
		$this->bind[":where_{$field}"] = $value;
		return $this;
	}

	public function andWhere($field, $op, $value)
	{
		array_push($this->andWhere, "{$field} {$op} :where_{$field}");
		$this->bind[":where_{$field}"] = $value;
		return $this;
	}

	public function orWhere($field, $op, $value)
	{
		array_push($this->orWhere, "{$field} {$op} :where_{$field}");
		$this->bind[":where_{$field}"] = $value;
		return $this;
	}

	public function orderBy($field, $order = 'asc')
	{
		$order = strtoupper($order);
		$this->orderBy = "{$field} {$order}";

		return $this;
	}

	public function limit($count, $offset = null)
	{
		$this->limit = $count;
		$this->offset = $offset;

		return $this;
	}

	public function getAll($bindClass = null)
	{
		$sql = $this->generateSql();

		$statement = $this->pdo->prepare($sql);
		$statement->execute($this->bind);
		if (! is_null($bindClass)) {
			$result = $statement->fetchAll(PDO::FETCH_CLASS, $bindClass);
		} else {
			$result = $statement->fetchAll(PDO::FETCH_OBJ);
		}		
		$this->reset();
		return $result;
	}

	public function get($bindClass = null)
	{
		$sql = $this->generateSql();

		$statement = $this->pdo->prepare($sql);
		$statement->execute($this->bind);
		if (! is_null($bindClass)) {
			$statement->setFetchMode(PDO::FETCH_CLASS, $bindClass);
		} else {
			$result = $statement->setFetchMode(PDO::FETCH_OBJ);
		}
		$result = $statement->fetch();
		$this->reset();
		return $result ? $result : null;
	}

	protected function generateSql()
	{
		$sql = 'SELECT ' . $this->select . ' FROM ' . $this->table;

		$sql = $this->generateWhereClause($sql);		

		if (! is_null($this->orderBy)) {
			$sql .= ' ORDER BY ' . $this->orderBy;
		}

		if (! is_null($this->limit)) {
			$sql .= ' LIMIT ' . $this->limit;
			if (! is_null($this->offset)) {
				$sql .= ' OFFSET ' . $this->offset;
			}
		}

		return $sql;
	}

	protected function generateWhereClause($sql)
	{
		if (! is_null($this->where)) {
			$sql .= ' WHERE ' . $this->where;
		}

		if (! empty($this->andWhere)) {
			$sql .= ' AND ' . implode(' AND ', $this->andWhere);
		}

		if (! empty($this->orWhere)) {
			$sql .= ' OR ' . implode(' OR ', $this->orWhere);
		}

		return $sql;
	}

	protected function reset()
	{
		$this->select = null;
		$this->table = null;
		$this->where = null;
		$this->andWhere = [];
		$this->orWhere = [];
		$this->orderBy = null;
		$this->limit = null;
		$this->offset = null;
		$this->bind = [];
	}

	public function insert(array $data)
	{
		$sql = sprintf(
			"INSERT INTO %s (%s) VALUES (%s)",
			$this->table,
			implode(', ', array_keys($data)),
			':' . implode(', :', array_keys($data))
		);
		$this->reset();
		try {
			$statement = $this->pdo->prepare($sql);
			$statement->execute($data);
			$id = $this->pdo->lastInsertId();
			return $id;
		} catch (PDOException $e) {
			$this->pdo->rollback();
			die('An unexpected error has occurred');
		}
	}

	public function update(array $data)
	{
		$sql = 'UPDATE ' . $this->table . ' SET ';
		foreach ($data as $key => $value) {
			$sql .= "{$key} = :{$key}, ";
			$this->bind[$key] = $value;
		}
		$sql = rtrim($sql, ', ');
		$sql = $this->generateWhereClause($sql);
		try {
			$statement = $this->pdo->prepare($sql);
			$statement->execute($this->bind);
		} catch (PDOException $e) {
			$this->pdo->rollback();
			die('An unexpected error has occurred');
		}
		$this->reset();
	}
}