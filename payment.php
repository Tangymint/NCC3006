<!--
	Author: Rohit Menon
	Matric No. U1222512H
	Lab group: SSP3
 -->
<?php

$apples = $oranges = $bananas = 0;
$name = $payment = "";

// Function to read input from file
function readFromFile(){

	$file = fopen("order.txt", "r+") or exit("Unable to open order.txt file!");
	$total_records = array( "apples" => 0,
						"oranges" => 0,
						"bananas" => 0);

	foreach ($total_records as $fruit => $quantity) {
		$line = fgets($file);
		$quantity = explode(":", $line);
		
		// Assign corresponding value of quantity to the fruit
		$total_records[$fruit] = (int)$quantity[1];
		var_dump($total_records[$fruit]);		
	}
	fclose($file);
	return $total_records;	
}

function writeToFile($total_records){

	// Write the value to file  
	$file = fopen("order.txt", "w+");

	foreach ($total_records as $fruit => $quantity) {
		fwrite($file, "Total number of " .$fruit. " : " .$quantity. "\r\n");
	}

	fclose($file);
}

function addQuantities($apples, $oranges, $bananas){

	// Get values from file
	$temp = readFromFile();

	echo "<br>";
	var_dump($temp);
	$temp["apples"] += $apples;
	$temp["oranges"] += $oranges;
	$temp["bananas"] += $bananas;
	writeToFile($temp);
}



if(isset($_POST['Submit'])) {	//POST is not null
	$name = $_POST['custName'];
	echo "Payment: ";
	print($_POST['payment']);
	if($_POST['payment'] == "visa"){
		$payment = "Visa";
	}

	if($_POST['payment'] == "mastercard"){
		$payment = "Mastercard";
	}

	if($_POST['payment'] == "discover"){
		$payment = "Discover";
	}


	echo "<br>";
	var_dump($name);

	if( (isset($_POST['apples'])) && (isset($_POST['oranges'])) && (isset($_POST['bananas'])) ) {
		$apples = $_POST['apples'];
		$oranges = $_POST['oranges'];
		$bananas = $_POST['bananas'];
		printf("apples: %u, oranges: %u, bananas: %u", $apples, $oranges, $bananas);
		$total = number_format((($apples * 0.69) + ($oranges * 0.59) + ($bananas * 0.39)), 2 );
		printf("\r\n Total Cost = ");
		printf($total);
		
		echo "<br> <br>";
		addQuantities($apples, $oranges, $bananas);

		printf("Payment = %s" ,$payment);

		header("Location: invoice.php?".
				"name=$name&".
				"apples=$apples&".
				"oranges=$oranges&".
				"bananas=$bananas&".
				"payment=$payment&".
				"total=$total");
		exit;

	}

	else{
		
		printf("\r\n apples: ");
		var_dump($_POST['apples']);
		
		printf("\r\n oranges: ");
		var_dump($_POST['oranges']);
		
		printf("\r\n bananas: ");
		var_dump($_POST['bananas']);

		exit;
	}
}
else{
	header("Location: error.html");
	exit;
}



?>
