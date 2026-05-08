<?php
include("db.php");
	$pcid=$_GET['id'];
$rs=mysqli_query($conn, "select pcname,ipaddr from pc where pcid=$pcid") or die(mysqli_error($conn));
$r=mysqli_fetch_row($rs);
echo $r[0]."*".$r[1];
?>