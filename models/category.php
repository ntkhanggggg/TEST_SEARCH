<?php
class Category
{
	private static $table = "category";

	public function __construct()
	{
	}

	static function add($id, $name)
	{
		try {
			$db = DB::getInstance();
			$sql = "INSERT IGNORE INTO " . self::$table . "(id, name) VALUES (?, ?)";
			$stmt = $db->prepare($sql);
			$stmt->execute([$id, $name]);

			return true;
		} catch (PDOException $e) {
			return false;
		}
	}

	static function getAll()
	{
		try {
			$db = DB::getInstance();
			$data = $db->query("SELECT * FROM " . self::$table);
			return $data->fetchAll();
		} catch (PDOException $e) {
			return false;
		}
	}
}
