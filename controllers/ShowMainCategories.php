<?php
require_once ('../models/Category.php');
require_once ('../models/CategoryRelations.php');

class ShowMainCategories{
	
	public function index()
	{
		$catObj = new Category();
		$result = $catObj->showMainCategories();
		
		$crObj = new CategoryRelations();
		
		if ($result->num_rows > 0) {
			echo "<table border='1' width='500'><tr><th>Category Name</th><th>Total Item</th></tr>";
			while($rows_main = $result->fetch_assoc()) {
				echo "<tr><td>";
				echo $rows_main['Name'];
				echo "</td><td>";
				echo $crObj->countTotalItems($rows_main['Id']);
				echo "</td></tr>";
			}
			echo "</table>";
		}
	}
}

$MCC = new ShowMainCategories();
$MCC->index();
