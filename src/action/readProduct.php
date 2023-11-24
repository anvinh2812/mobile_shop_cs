<?php 
	require("connect.php");
	$keyword = $_REQUEST["keyword"];
	$sql = "select * from product where pname like '%".$keyword."%'";
	$result = $conn->query($sql) or die($conn->error);
?>
<style>
	.sugg_list {
    border-radius: 8px;
	background-color: #c32b2b;
	color: #fff;
}
</style>
<html>
	<head>
		<meta charset="utf-8">
	</head>
	<body>
			<ul id="country-list" class="sugg_list">
			<?php 
			while ($row = $result->fetch_assoc()) {
				echo '<li onClick="selectCountry(\'' . $row["pname"] . '\');" >';
				echo $row["pname"];
				echo '</li>';
			}
			$conn->close();
			?>
			</ul>
	</body>
</html>