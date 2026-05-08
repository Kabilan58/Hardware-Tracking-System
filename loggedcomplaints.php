<?php
session_start();
include("db.php");
?>

<!DOCTYPE html>
<html>
<head><link rel='stylesheet' href='assets/styl.css'></head>
<body class="loggedcomplaints">

<?php
$rs=mysqli_query($conn, "select rdate,problem,status,compdate from problemreport where userid=$_SESSION[userid]") or die(mysqli_error($conn));
?>

<table border="1" align="center">

<?php
if(mysqli_num_rows($rs)>0) {
echo "<tr><th>Report Date</th><th>Problem</th><th>Status</th><th>Completed Date</th></tr>";
while($r=mysqli_fetch_row($rs)) {
echo "<tr>";
foreach($r as $rr) {
if($rr=="")
echo "<td align='center'>-</td>";
else
echo "<td>$rr</td>";
}
echo "</tr>";
}
}
else {
echo "<h3 align='center'>You have No complaints Logged...</h3>";
}
?>

</table>
</body>
</html>