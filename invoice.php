<?php


// Function to read input from file
function readFromFile(){

	$file = fopen("order.txt", "r+") or exit("Unable to open order.txt file!");

	$total_records = array( "apples" => "",
						"oranges" => "",
						"bananas" => "");

	foreach ($total_records as $fruit => $quantity) {
		$line = fgets($file);
		$quantity = explode(":", $line);
		// var_dump($line);
		echo "<br>";
		var_dump($quantity[1]);
		// printf($fruit. " : " .$line);
		echo "<br>";
	}	
}


readFromFile();






?>