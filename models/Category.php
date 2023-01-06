<?php
require_once ('../config/DBConnection.php');

class Category{
	
	private $table = 'category';
	private $conn;
	
	public function __construct()
	{
		$this->conn = new DBConnection();
		$this->conn = $this->conn->getConnection();
	}
	
	public function showMainCategories()
	{
		$rsMain = "SELECT c.Name, c.Id FROM " . $this->table . " c WHERE c.Id NOT IN (SELECT categoryId FROM catetory_relations)";
		$result = $this->conn->query($rsMain);
		
		return $result;
	}
	
	public function showSubCategories($cat_id)
	{
		$rsSub = "SELECT c.Name, c.Id FROM " . $this->table . " c WHERE c.Id IN (SELECT categoryId FROM catetory_relations WHERE ParentcategoryId = " . $cat_id .")";
		$result = $this->conn->query($rsSub);
		
		return $result;
		
		/*if ($sresult->num_rows > 0) {
		$itemTotal = countTotalItems($cat_id, $conn);
		while($rows_sub = $sresult->fetch_assoc()) {
				echo $dashes . $rows_sub['Name'] . "(".countTotalItemsByCat($rows_sub['Id'], $conn).")<br>";
				showSubCategories($rows_sub['Id'], $conn, $dashes);
			}
		}*/
	}
	
}