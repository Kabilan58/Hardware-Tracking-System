<?php
include("db.php");
	$uid=$_GET['id'];
$rs=mysqli_query($conn, "select uname from newuser where uid=$uid") or die(mysqli_error($conn));
$r=mysqli_fetch_row($rs);
echo $r[0];
?>