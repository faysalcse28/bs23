<?php
require_once ('../models/Category.php');
require_once ('../models/CategoryRelations.php');

class ShowCategoriesTree{
	
	public function index()
	{
		$catObj = new Category();
		$result = $catObj->showMainCategories();
		
		$crObj = new CategoryRelations();
		
		if ($result->num_rows > 0) {
			while($rows_main = $result->fetch_assoc()) {
				echo "<h4>".$rows_main['Name'] . " - (".$crObj->countTotalItems($rows_main['Id']).")</h4><br>";
				$this->showSubCategories($rows_main['Id']);
			}
		}
	}
	
	public function showSubCategories($mainCatId, $dashes = '')
	{
		$dashes .= '--';
		$catObj = new Category();
		$result = $catObj->showSubCategories($mainCatId);
		
		$crObj = new CategoryRelations();
		
		if ($result->num_rows > 0) {
			while($rows_sub = $result->fetch_assoc()) {
					echo $dashes . $rows_sub['Name'] . "(".$crObj->countTotalItemsByCat($rows_sub['Id']).")<br>";
					$this->showSubCategories($rows_sub['Id'], $dashes);
			}
		}
	}
}

$MCT = new ShowCategoriesTree();

$MCT->index();
