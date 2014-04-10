<!--
 	Author: Rohit Menon
	Matric No. U1222512H
	Lab group: SSP3
-->
<html>

	<head><title>Purchase Invoice</title></head>
	<!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">


	<div class="container">

		<div class="md-offset-3 col-xs-12 col-md-8">
			<div class="header">
		        <ul class="nav nav-pills pull-right">
		          <li class="active"><a href="index.html">Home</a></li>
		        </ul>
		    </div>
			<h3 class="text-center">Invoice</h3>

			<div class="row span12" >
				<hr>
			</div>
			<br />
			<?php
				echo "<h4><strong>Customer Name: </strong> ".$_GET["name"]. "</h4>";
			?>
				<!-- <table border="border"> -->
				<table class="table table-striped table-bordered">
				<br />

					<!-- First row: Column heading -->
					<tr>
						<th>Item</th>
						<th>Qty</th>
						<th>Rate</th>
						<th>Cost</th>
					</tr>

				<tr>
					<td>Apples</td>
					<td> <?php echo $_GET["apples"] ?> </td>
					<td> $0.69 </td>
					<td> <?php echo number_format(($_GET["apples"] * 0.69), 2) ?> </td>
				</tr>

				<tr>
					<td>Oranges</td>
					<td> <?php echo $_GET["oranges"] ?> </td>
					<td> $0.59 </td>
					<td> <?php echo number_format(($_GET["oranges"] * 0.59), 2) ?> </td>
				</tr>

				<tr>
					<td>Bananas</td>
					<td> <?php echo $_GET["bananas"] ?> </td>
					<td> $0.39 </td>
					<td> <?php echo number_format(($_GET["bananas"] * 0.39), 2) ?> </td>
				</tr>

				
				</table>

				<h4><strong>Payment method: </strong><?php echo $_GET["payment"] ?> </h4>
				<br />
				<h4 class="text-right"><strong>Total Cost = </strong><?php echo $_GET["total"] ?> </h5>
		</div>
	</div>

</html>
