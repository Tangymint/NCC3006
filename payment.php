<?php

if(isset($_POST['Submit'])) {	//POST is not null
	$apples = $_POST['apples'];
	$oranges = $_POST['oranges'];
	$bananas = $_POST['bananas'];
	printf("apples: %u, oranges: %u, bananas: %u", $apples, $oranges, $bananas);

	$total = ($apples * 0.69) + ($oranges * 0.59) + ($bananas * 0.39);
	// header("Location: invoice.html");
	exit;
}
else{
	// header("Location: error.html");
	exit;
}



?>
