<?php 
$servername="localhost";
$username="root";
$password="";
$database="66PM56";
$conn = new mysqli($servername,$username,$password,$database);
if ($conn->connect_error){
	die("Lỗi kết nối với CSDL");
}
?>