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
<body class="rectifiedcomplaints">
<?php
$rs=mysqli_query($conn, "select * from problemreport where status='yes'") or die(mysqli_error($conn));
?>
<div class="card">
<table border="1" align="center">
<tr><th colspan="16">Rectified Complaints</th></tr>
<tr><th>Problem Id</th><th>Report Date</th><th>Userid</th><th>System Id</th><th>Problem</th><th>Warranty ?</th><th>Warranty Date</th><th>AMC ?</th><th>AMC Company</th><th>Phone</th><th>AMC From</th><th>AMC To</th><th>Status</th><th>Completed Date</th><th>Reason</th></tr>
<?php
while($r=mysqli_fetch_row($rs)) {
echo "<tr>";
foreach($r as $rr) {
if($rr=="")
echo "<td align='center'>&nbsp-&nbsp;</td>";
else
echo "<td>$rr</td>";
}
//echo "<td>$r[0]</td><td>$r[1]</td><td>$r[2]</td><td>$r[3]</td><td>$r[4]</td><td>$r[5]</td><td>$r[6]</td><td>$r[7]</td><td>$r[8]</td><td>$r[9]</td>";
echo "</tr>";
}
?>
</table>
</div>
</body>
</html>