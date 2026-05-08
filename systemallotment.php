<?php
session_start();
include("db.php");
?>

<!DOCTYPE html>
<html>
<head><link rel='stylesheet' href='assets/forms-below.css'>
<link href="assets/bootstrap.min.css" rel="stylesheet">
<link rel='stylesheet' href="assets/js/sweetalert2.min.css">
</head>
<script type="text/javascript">
function call(k,p) {
if(p!="") {
if(window.ActiveXObject)
ob=new ActiveXObject("Microsoft.XMLHTTP")
else
ob=new XMLHttpRequest()
ob.onreadystatechange=function() {
if(ob.readyState==4&&ob.status==200) {
if(k=="uid")
document.getElementById("t2").value=ob.responseText
else if(k=="pid") {
var s=ob.responseText
document.getElementById("t4").value=s.substring(0,s.indexOf("*"))
document.getElementById("t5").value=s.substring(s.indexOf("*")+1)
}
}
}
if(k=="uid")
ob.open("GET","getuser.php?id="+p,true)
else if(k=="pid")
ob.open("GET","getpc.php?id="+p,true)
ob.send()
}
else if(k=="uid")
document.getElementById("t2").value=""
else if(k=="pid") {
document.getElementById("t4").value=""
document.getElementById("t5").value=""
}
}
function check() {
if(f.t1.value==""||f.t2.value==""||f.t3.value==""||f.t4.value==""||f.t5.value=="") {
window.alert("Filed is Empty... Cannot Submit !")
return false
}
return true
}
</script>
<body class="forms-below" style="background: linear-gradient(135deg, #7d37c9ff, #2565d4ff);">

<?php
$rs1=mysqli_query($conn, "select uid from newuser where uid not in (select uid from pcallot)") or die(mysqli_error($conn));
$rs2=mysqli_query($conn, "select pcid from pc where pcid not in (select pcid from pcallot)") or die(mysqli_error($conn));
$rs3=mysqli_query($conn, "select p.uid,uname,pcname,ipaddr,allotdate from pcallot p,newuser n,pc o where p.uid=n.uid and p.pcid=o.pcid") or die(mysqli_error($conn));
if(mysqli_num_rows($rs3)>0) {
echo "<div class=\"card\" style='background: linear-gradient(135deg, #8548c7fb, #31669bff);'>
<table border='1' align='center'><tr><th colspan='5'>Allotted Systems</th></tr>";
echo "<tr><th>User Id</th><th>User Name</th><th>System Name</th><th>IP Address</th><th>Alloted On</th></tr>";
while($r3=mysqli_fetch_row($rs3)) {
echo "<tr>";
foreach($r3 as $rr)
echo "<td>$rr</td>";
echo "</tr>";
}
echo "</table>
</div>";
}
?>
<br>
<hr style="color:red;">
<form name="f" action="systemallotment.php" method="get" onsubmit="return check()">
<table border="1" align="center">
<tr><th colspan="6">System Allocation</th></tr>
<tr><th>User Id</th><th>Name</th><th>PC Id</th><th>PC Name</th><th>IP Address</th><th>Allocate</th></tr>
<tr>
<td>
<select name="t1" id="t1" onchange="call('uid',this.value)">
<option value=""> --Select-- </option>
<?php
while($r1=mysqli_fetch_row($rs1))
echo "<option value=$r1[0]>$r1[0]</option>";
?>
</select>
</td>
<td><input style="color: rgba(238, 189, 227, 0.97);" type="text" name="t2" id="t2" value="" readonly size="15"></td>
<td>
<select name="t3" id="t3" onchange="call('pid',this.value)">
<option value=""> --Select-- </option>
<?php
while($r2=mysqli_fetch_row($rs2))
echo "<option value=$r2[0]>$r2[0]</option>";
?>
</select>
</td>
<td><input style="color: rgba(238, 189, 227, 0.97);" type="text" name="t4" id="t4" value="" readonly size="15"></td>
<td><input style="color: rgba(238, 189, 227, 0.97);" type="text" name="t5" id="t5" value="" readonly size="15"></td>
<td><input style="color: rgba(245, 168, 228, 0.97); background: rgba(88, 8, 71, 0.58); " type="submit" name="submit" value="Allocate"></td>
</tr>

</table>
<center> <a href="adminh.php" class="btn btn-secondary mt-3">⬅ Back to Dashboard</a> </center>
</form>
<?php
if(isset($_GET['submit'])) {
	$uid=$_GET['t1'];
	$pcid=$_GET['t3'];
	$allotdate=date('Y-m-d',mktime(1));
	mysqli_query($conn, "insert into pcallot (uid,pcid,allotdate) values ($uid,$pcid,'$allotdate')") or die(mysqli_error($conn));
       echo "<script src='assets/js/sweetalert2.all.min.js'></script>";
        echo "<script>
            Swal.fire({
                icon: 'success',
                title: 'Success!',
                text: 'System allotted successfully!',
                confirmButtonText: 'OK'
            }).then(() => {
                window.location.href = 'systemallotment.php';
            });
        </script>";
        exit;
}
?>
</body>
</html>