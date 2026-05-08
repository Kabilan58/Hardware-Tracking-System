<?php
session_start();
include("db.php");
?>

<!DOCTYPE html>
<html>
<head>
<link rel='stylesheet' href='assets/forms-below.css'>
<link rel='stylesheet' href='assets/bootstrap.min.css'>
<link rel='stylesheet' href="assets/js/sweetalert2.min.css">
</head>
<style>
.ar{text-align:right;}
</style>
<script type="text/javascript">
function call(p) {
if(p!="") {
if(window.ActiveXObject)
ob=new ActiveXObject("Microsoft.XMLHTTP")
else
ob=new XMLHttpRequest()
ob.onreadystatechange=function() {
if(ob.readyState==4&&ob.status==200) {
var st=ob.responseText
var s1=st.substring(0,st.indexOf('*'))
var s2=st.substring(st.indexOf('*')+1)
document.getElementById("t2").value=s1
document.getElementById("t3").value=s2
}
}
ob.open("GET","getamcentry.php?id="+p,true)
ob.send()
}
else {
document.getElementById("t2").value=""
document.getElementById("t3").value=""
}
}
function check() {
if(f.t1.value=="" || f.t4.value=="" || f.t5.value=="") {
window.alert("Filed is Empty... Can't Submit !");
return false
}
return true
}
</script>
<body class="forms-below" style="background: linear-gradient(135deg, #4facfe, #8e44ad);">

<?php
$cd=date('Y-m-d',time());
$rs=mysqli_query($conn, "select pcid from pc where '$cd' > amccmp is null") or die(mysqli_error($conn));
$rs1=mysqli_query($conn, "select pcname,ipaddr,brand,dop,amccmp,amcph,amcfrom,amtto from pc where amccmp is not null") or die(mysqli_error($conn));
if(mysqli_num_rows($rs1)>0) {
echo "<div class=\"card\" style='background: linear-gradient(135deg, #4facfe, #9b6daf7a);'>
<table border='1' align='center'>";
echo "<tr><th colspan='8'>System AMC Details</th></tr>";
echo "<tr><th>System Name</th><th>IP Address</th><th>Brand</th><th>Purchased On</th><th>AMC Company</th><th>Contact No</th><th>AMC From</th><th>AMC To</th></tr>";
while($r1=mysqli_fetch_row($rs1)) {
echo "<tr>";
foreach($r1 as $rr1)
echo "<td>$rr1</td>";
echo "</tr>";
}
echo "</table>
</div>";
}
if(mysqli_num_rows($rs)>0) {
?>

<br>
	<center><a href="adminh.php" class="btn btn-light" style="background:grey;"><b>⬅ Back to Dashboard</b></a>
</center>
<hr style="color:red;">

<form name="f" action="amcentry.php" method="post" onsubmit="return check()">
<table align="center">
<tr>
<th colspan="2">AMC Entry</th>
</tr>
<tr>
<td class="ar">Select PC Id</td>
<td>
<select name="t1" onchange="call(this.value)">
<option value=""> --Select-- </option>

<?php
while($r=mysqli_fetch_row($rs))
echo "<option value=$r[0]>$r[0]</option>";
?>

</select>
</td>
</tr>
<tr>
<td class="ar">Computer Name</td>
<td><input style="color: rgba(107, 33, 150, 0.77);" type="text" name="t2" id="t2" readonly></td>
</tr>
<tr>
<td class="ar">IP Address</td>
<td><input style="color: rgba(107, 33, 150, 0.77);" type="text" name="t3" id="t3" readonly></td>
</tr>
<tr>
<td class="ar">AMC Company</td>
<td><input style="color: rgba(107, 33, 150, 0.77);" type="text" name="t4"></td>
</tr>
<tr>
<td class="ar">Mobile No</td>
<td><input style="color: rgba(107, 33, 150, 0.77);" type="text" name="t5" maxlength="10"></td>
</tr>
<tr>
<td class="ar">From (Date)</td>
<td><input style="color: rgba(107, 33, 150, 0.77);" type="text" name="t6" value="<?php echo date('Y-m-d',time());?>" readonly></td>
</tr>
<tr>
<td class="ar">No of Years</td>
<td>
<select name="t7">
<option value="1">1</option>
<option value="2">2</option>
</select>
</td>
</tr>
<tr>
<td colspan="2" align="center"><input type="submit" name="submit" value="Register"></td>
</tr>
</table>
</form>

<?php
if(isset($_POST['submit'])) {
	$pcid=$_POST['t1'];
	$amccmp=$_POST['t4'];
	$amcph=$_POST['t5'];
	$amcfrom=$_POST['t6'];
	$amtto=$_POST['t7'];
$dt=new DateTime(date('Y-m-d',time()));
if($amtto=="1")
date_add($dt,new DateInterval("P1Y"));
else if($amtto=="2")
date_add($dt,new DateInterval("P2Y"));
$amtto=$dt->format('Y-m-d');
mysqli_query($conn, "update pc set amccmp='$amccmp',amcph='$amcph',amcfrom='$amcfrom',amtto='$amtto' where pcid=$pcid") or die(mysqli_error($conn));
       echo "<script src='assets/js/sweetalert2.all.min.js'></script>";
        echo "<script>
            Swal.fire({
                icon: 'success',
                title: 'Success!',
                text: 'AMC applied successfully!',
                confirmButtonText: 'OK'
            }).then(() => {
                window.location.href = 'amcentry.php';
            });
        </script>";
        exit;
}
}
else {
echo "<br>
	<center><a href='adminh.php' class='btn btn-light' style='background:grey;'><b>⬅ Back to Dashboard</b></a>
</center>";
echo "<br>";
echo "<h4 align='center'>No system is in out of Warranty Period...</h4>";
}
?>

</form>
</body>
</html>