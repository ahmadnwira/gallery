<?php namespace Models;
	use \PDO;
	use \PDOException;

	class Database
	{
		public function __construct()
		{
			$options = [ PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION ];

			try{
				$this->pdo = new PDO('mysql:host=localhost;dbname=mymedialibrary', 'root', '', $options);
			}
			catch(PDOException $e){
				die('Error');
			}
		}

		public function all($table)
		{
			$stmt = $this->pdo->prepare('SELECT * FROM ' . $table);
		
			$stmt->execute();

			return $stmt->fetchAll(PDO::FETCH_ASSOC);
		}

		public function get($table, $match_by)
		{
			$query = sprintf(
				"SELECT * FROM %s WHERE $match_by",
				$table, $match_by
			);
			$stmt = $this->pdo->prepare($query);
		
			$stmt->execute();

			return $stmt->fetchAll(PDO::FETCH_ASSOC);
		}

		public function find($table, $id)
		{
			$query = sprintf(
				"SELECT * FROM %s WHERE id=%s",
				$table, $id
			);
			$stmt = $this->pdo->prepare($query);
		
			$stmt->execute();

			return $stmt->fetch(PDO::FETCH_ASSOC);
		}


		public function insert($table, $paramters)
		{

			$query = sprintf(
				"INSERT INTO %s (%s) values (%s)",
				$table,
				implode(array_keys($paramters), ', '),
				':'.implode(array_keys($paramters), ', :')
			);
			
			$stmt = $this->pdo->prepare($query);
			
			try{
				$stmt->execute($paramters);
			}
			catch(Exception $e){
				return false;
			}

			return true;
		}

		public function delete($table, $id){
			
			$query = sprintf('DELETE FROM %s WHERE id=%s', $table, $id);

			$stmt = $this->pdo->prepare($query);
			
			try{
				$stmt->execute();
			}
			catch(Exception $e){
				return false;
			}

			return true;
		}

	}