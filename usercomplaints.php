<?php
session_start();
include("db.php");
?>

<!DOCTYPE html>
<html>
<head><link rel='stylesheet' href='assets/styl.css'>
<link href="assets/bootstrap.min.css" rel="stylesheet">
<link rel='stylesheet' href="assets/js/sweetalert2.min.css">
</head>
<style>
.ar{text-align:right;}
</style>
<script type="text/javascript">
function check() {
if(f.t1.value=="") {
window.alert("Cannot Submit... Field is Empty !")
return false
}
return true
}
</script>
<body class="usercomplaints">
<?php
$rs=mysqli_query($conn, "select * from problemreport where status='no'") or die(mysqli_error($conn));
if(!isset($_REQUEST['pid'])&&!isset($_POST['submit'])) {
?>
<div class="card">
<div><a href='techenggh.php' style="background:rgba(175, 76, 11, 0.81);" class='btn btn-lg'>⬅ Back to Dashboard</a> 
</div>
<table border="1" align="center">
	
<tr><th colspan="16">Logged Complaints</th></tr>

<tr><th>Problem Id</th><th>Report Date</th><th>Userid</th><th>System Id</th><th>Problem</th><th>Warranty ?</th><th>Warranty Date</th><th>AMC ?</th><th>AMC Company</th><th>Phone</th><th>AMC From</th><th>AMC To</th><th>Status</th><th>Completed Date</th><th>Reason</th><th>Task</th></tr>


<?php
while($r=mysqli_fetch_row($rs)) {
echo "<tr>";
foreach($r as $rr) {
if($rr=="")
echo "<td align='center'>&nbsp-&nbsp;</td>";
else
echo "<td>$rr</td>";
}
echo "<td><a class='btn' href='usercomplaints.php?pid=$r[0]' style='color: rgba(233, 222, 186, 0.97); background: rgba(182, 143, 14, 0.97); background: rgba(153, 85, 21, 0.89);'>Give Soln.</a></td>";
//echo "<td>$r[0]</td><td>$r[1]</td><td>$r[2]</td><td>$r[3]</td><td>$r[4]</td><td>$r[5]</td><td>$r[6]</td><td>$r[7]</td><td>$r[8]</td><td>$r[9]</td>";
echo "</tr>";
}
?>
</table>
</div>
<?php
} else if(isset($_REQUEST['pid'])&&!isset($_POST['submit'])) {
	$pid=$_REQUEST['pid'];
?>
<form name="f" action="usercomplaints.php" method="post" onsubmit="return check()">
<table align="center">
<tr>
<th colspan="2">COMPLETED REPORT</th>
</tr>
<tr>
<td class="ar">Reason</td>
<td><input type="hidden" name="id" value="<?php echo $pid;?>"><textarea name="t1"></textarea></td>
</tr>
<tr>
<td class="ar">Completed Date</td>
<td>
<select name="d">
<?php
for($i=1; $i<=31; $i++)
echo "<option value=$i>$i</option>";
?>
</select>
<select name="m">
<?php
for($i=1; $i<=12; $i++)
echo "<option value=$i>$i</option>";
?>
</select>
<select name="y">
<?php
for($i=2011; $i<=2040; $i++)
echo "<option value=$i>$i</option>";
?>
</select>
</td>
</tr>
<tr>
<td colspan="2" align="center">
<input type="submit" name="submit" value="Report">
</td>
</tr>
 <a href="usercomplaints.php" style="background:rgba(168, 114, 12, 0.81);" class="btn btn-lg">⬅ Back to Dashboard</a> </center>
</table>
</form>
<?php
} else if(isset($_POST['submit'])) {
	$pid=$_POST['id'];
	$reason=$_POST['t1'];
	$dt=new DateTime($_POST['y']."-".$_POST['m']."-".$_POST['d']);
	$dt=$dt->format('Y-m-d');
	$str="update problemreport set status='yes',reason='$reason',compdate='$dt' where probid=$pid";
	if(mysqli_query($conn, $str)) {
	echo "<h3 align='center'>Record Updated...<br><a href='usercomplaints.php'>Refresh</a></h3>";
	} else {
	echo "<h3 align='center'>".mysqli_error($conn)."<br><a href='usercomplaints.php'>Refresh</a></h3>";
	}
}
?>
</body>
</html>