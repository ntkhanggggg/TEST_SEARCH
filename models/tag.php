<?php
class Tag
{
	private static $table = "tags";

	public function __construct()
	{
	}

	static function add($id, $category_id, $name)
	{
		try {
			$db = DB::getInstance();
			$sql = "INSERT IGNORE INTO " . self::$table . "(id, category_id, name) VALUES (?, ?, ?)";
			$stmt = $db->prepare($sql);
			$stmt->execute([$id, $category_id, $name]);

			return true;
		} catch (PDOException $e) {
			return false;
		}
	}

	static function getByCategory($category_id)
	{
		try {
			$db = DB::getInstance();
			$data = $db->query("SELECT * FROM " . self::$table . " WHERE category_id = '" . $category_id . "'");
			return $data->fetchAll();
		} catch (PDOException $e) {
			return $e->getMessage();
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
