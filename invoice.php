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
		<div class="md-offset-3">
			<h3 class="pull-center">Invoice</h3>

			<?php
				echo "<h4>Customer Name: ".$_GET["name"]. "</h4>";
			?>
				<!-- <table border="border"> -->
				<table class="table table-striped table-bordered">
			<?php
				echo "<thead>";
					echo "<tr>";
						echo "<td colspan=\"2\">Customer Name</td>";
						echo "<td colspan=\"2\">".$_GET["name"]. "</td>";
					echo "</tr>";
				echo "</thead>";

			?>		
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

				<h5>Payment method: <?php echo $_GET["payment"] ?> </h5>
				<h5>Total Cost = <?php echo $_GET["total"] ?> </h5>
		</div>
	</div>

</html>
