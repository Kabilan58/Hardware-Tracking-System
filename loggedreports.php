<?php
session_start();
include("db.php");
?>

<!DOCTYPE html>
<html>
<head><link rel='stylesheet' href='assets/styl.css'></head>
<style>
.ar{text-align:right;}
</style>
<body class="loggedreports">
<?php
$rs=mysqli_query($conn, "select * from problemreport") or die(mysqli_error($conn));
?>
<div class="card">
<table border="1" align="center">
<tr><th colspan="16">Logged Complaints Status</th></tr>
<tr><th>Problem Id</th><th>Report Date</th><th>Userid</th><th>System Id</th><th>Problem</th><th>Warranty ?</th><th>Warranty Date</th><th>AMC ?</th><th>AMC Company</th><th>Phone</th><th>AMC From</th><th>AMC To</th><th>Completed ?</th><th>Reason</th><th>Completed Date</th></tr>
<?php
while($r=mysqli_fetch_row($rs)) {
$i=0;
echo "<tr>";
foreach($r as $rr) {
if($rr=="")
echo "<td align='center'>&nbsp-&nbsp;</td>";
else if($i==12 && $rr=="no")
echo "<td align='center'><font color='red'><b>$rr</b></font></td>";
else if($i==12 && $rr=="yes")
echo "<td align='center'><font color='green'><b>$rr</b></font></td>";
else
echo "<td>$rr</td>";
$i++;
}

//echo "<td>$r[0]</td><td>$r[1]</td><td>$r[2]</td><td>$r[3]</td><td>$r[4]</td><td>$r[5]</td><td>$r[6]</td><td>$r[7]</td><td>$r[8]</td><td>$r[9]</td><td>$r[10]</td><td>$r[11]</td><td>$r[12]</td><td>$r[13]</td><td>$r[14]</td>";
echo "</tr>";
}
?>
</table>
</div>