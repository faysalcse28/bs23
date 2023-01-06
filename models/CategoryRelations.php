<?php
require_once ('../config/DBConnection.php');

class CategoryRelations{
	
	protected $table = 'catetory_relations';
	private $conn;
	
	public function __construct()
	{
		$this->conn = new DBConnection();
		$this->conn = $this->conn->getConnection();
	}
	
	public function countTotalItemsByCat($cat_id){
		$rsT = "SELECT COUNT(id) AS total FROM " . $this->table . " WHERE categoryId IN 
		(SELECT categoryId FROM " . $this->table . " WHERE ParentcategoryId=" . $cat_id . " OR categoryId =".$cat_id.")";
		$tresult = $this->conn->query($rsT);
		if ($tresult->num_rows > 0) {
			$total = $tresult->fetch_assoc();
			return $total['total'];
		}
	}
	
	public function countTotalItems($cat_id){
		$rsT = "SELECT 
		COUNT(id) AS total 
		FROM 
		item_category_relations
		WHERE 
		categoryId IN (
		SELECT 
		categoryId 
		FROM 
		catetory_relations 
		WHERE 
		ParentcategoryId=".$cat_id." 
		OR
		ParentcategoryId IN (
		SELECT 
		categoryId 
		FROM 
		catetory_relations 
		WHERE 
		ParentcategoryId=".$cat_id."))";
		$tresult = $this->conn->query($rsT);
		if ($tresult->num_rows > 0) {
			$total = $tresult->fetch_assoc();
			return $total['total'];
		}		
	}
}