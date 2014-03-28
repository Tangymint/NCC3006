<?php

$apples = $oranges = $bananas = 4;


if(isset($_POST['Submit'])) {	//POST is not null
	// var_dump($_POST['Submit']);

	if( (isset($_POST['apples'])) && (isset($_POST['oranges'])) && (isset($_POST['bananas'])) ) {
		$apples = $_POST['apples'];
		$oranges = $_POST['oranges'];
		$bananas = $_POST['bananas'];
		printf("apples: %u, oranges: %u, bananas: %u", $apples, $oranges, $bananas);
		$total = ($apples * 0.69) + ($oranges * 0.59) + ($bananas * 0.39);
	// header("Location: invoice.html");
		printf("\r\n Total Cost = ");
		printf($total);
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

	// if(isset($_POST['oranges'])){
	// 	$oranges = $_POST['oranges'];
	// }

	// if(isset($_POST['bananas'])){
	// 	$bananas = $_POST['bananas'];
	// 	// printf("bananas: %u", $bananas);
	// 	var_dump($_POST['bananas']);
	// }


	// $oranges = $_POST['oranges'];
	// $bananas = $_POST['bananas'];
	// printf("apples: %u, oranges: %u, bananas: %u", $apples, $oranges, $bananas);

	// $total = ($apples * 0.69) + ($oranges * 0.59) + ($bananas * 0.39);
	// // header("Location: invoice.html");
	// printf("\n\n Total Cost = ", $total);
	// exit;
}
else{
	// header("Location: error.html");
	exit;
}



?>
