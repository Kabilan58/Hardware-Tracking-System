<?php
session_start();
include("db.php");
?>

<!DOCTYPE html>
<html>
<head>
<link rel='stylesheet' href='assets/styl.css'>
<link href="assets/bootstrap.min.css" rel="stylesheet">
<link rel='stylesheet' href="assets/js/sweetalert2.min.css">
</head>
<script type="text/javascript">
function check() {
if(f.t1.value==""||f.t2.value==""||f.t5.value==""||f.t7.value==""||f.t8.value==""||f.t9.value==""||f.t11.value==""||f.t12.value=="") {
window.alert("Field is Empty... Cannot Submit !")
return false
}
}
</script>
<style>
.ab{text-align:right;}
</style>
<body class="newpc">
<?php
$rs=mysqli_query($conn, "select ifnull(max(pcid),0)+1 from pc") or die(mysqli_error($conn));
$r=mysqli_fetch_row($rs);
$rs1=mysqli_query($conn, "select ifnull(max(convert(right(ipaddr,3),unsigned)),99)+1 from pc") or die(mysqli_error($conn));
$r1=mysqli_fetch_row($rs1);
$ip="192.9.200.".$r1[0];
$rs2=mysqli_query($conn, "select ifnull(max(convert(right(pcname,1),unsigned)),0)+1 from pc") or die(mysqli_error($conn));
$r2=mysqli_fetch_row($rs2);
$sysname="System".$r2[0];
?>
<form name="f" action="newpc.php" method="post" onsubmit="return check()">
<table align="center" border="0">
<tr>
<th colspan="2">SYSTEM MASTER</th>
</tr>
<tr>
<td class="ab">PC Id</td>
<td><input style="color: rgba(19, 43, 150, 0.9);" type="text" name="tt1" value="<?php echo $r[0];?>" readonly></td>
</tr>
<tr>
<td class="ab">Computer Name</td>
<td><input style="color: rgba(19, 43, 150, 0.9);" type="text" name="t1" value="<?php echo $sysname;?>" readonly></td>
</tr>
<tr>
<td class="ab">IP Address</td>
<td><input style="color: rgba(19, 43, 150, 0.9);" type="text" name="t2" value="<?php echo $ip;?>" readonly></td>
</tr>
<tr>
<td class="ab">Brand</td>
<td><input style="color: rgba(19, 43, 150, 0.9);" type="text" name="t3"></td>
</tr>
<tr>
<td class="ab">Processor</td>
<td><input style="color: rgba(19, 43, 150, 0.9);" type="text" name="t4"></td>
</tr>
<tr>
<td class="ab">HardDisk</td>
<td><input style="color: rgba(19, 43, 150, 0.9);" type="text" name="t5"></td>
</tr>
<tr>
<td class="ab">RAM</td>
<td><input style="color: rgba(19, 43, 150, 0.9);" type="text" name="t6"></td>
</tr>
<tr>
<td class="ab">SMPS</td>
<td><input style="color: rgba(19, 43, 150, 0.9);" type="text" name="t7"></td>
</tr>
<tr>
<td class="ab">DVD Drive</td>
<td><input style="color: rgba(19, 43, 150, 0.9);" type="text" name="t8"></td>
</tr>
<tr>
<td class="ab">Key Board</td>
<td><input style="color: rgba(19, 43, 150, 0.9);" type="text" name="t9"></td>
</tr>
<tr>
<td class="ab">Monitor</td>
<td><input style="color: rgba(19, 43, 150, 0.9);" type="text" name="t10"></td>
</tr>
<tr>
<td class="ab">Mouse</td>
<td><input style="color: rgba(19, 43, 150, 0.9);" type="text" name="t11"></td>
</tr>
<tr>
<td class="ab">Web Cam</td>
<td><input style="color: rgba(19, 43, 150, 0.9);" type="text" name="t12"></td>
</tr>
<tr>
<td class="ab">Printer</td>
<td><input style="color: rgba(19, 43, 150, 0.9);" type="text" name="t13"></td>
</tr>
<tr>
<td class="ab">Date of Purchase</td>
<td><input style="color: rgba(19, 43, 150, 0.9);" type="text" name="t14" value="<?php echo date('Y-m-d',time());?>"></td>
</tr>
<tr>
<td class="ab">Warranty (in Years)</td>
<td>
<select style="color: rgba(19, 43, 150, 0.9);" name="t15">
<option value="1">1</option>
<option value="2">2</option>
</select>
</td>
</tr>
<tr>
<td colspan="2" align="center">
<input style="color: rgba(19, 43, 150, 0.9);" type="submit" name="submit" value="Register">
</td>
</tr>
<tr><td> <a href="adminh.php" class="btn btn-secondary mt-3">⬅ Back to Dashboard</a> </td>
</tr>
</table>
</form>
<?php
if(isset($_POST['submit'])) {
	$pcname=$_POST['t1'];
	$ipaddr=$_POST['t2'];
	$brand=$_POST['t3'];
	$processor=$_POST['t4'];
	$harddisk=$_POST['t5'];
	$ram=$_POST['t6'];	
	$smps=$_POST['t7'];
	$drive=$_POST['t8'];
	$kboard=$_POST['t9'];
	$monitor=$_POST['t10'];
	$mouse=$_POST['t11'];
	$webcam=$_POST['t12'];
	$printer=$_POST['t13'];
	$dop=$_POST['t14'];
	$wm=$_POST['t15'];
$date=new DateTime(date('Y-m-d',time()));
if($wm=="1")
date_add($date,new DateInterval("P1Y"));
else if($wm=="2")
date_add($date,new DateInterval("P2Y"));
	$warrexp=$date->format('Y-m-d');
	mysqli_query($conn, "insert into pc (pcname,ipaddr,brand,processor,harddisk,ram,smps,drive,kboard,monitor,mouse,webcam,printer,dop,warrexp) values ('$pcname','$ipaddr','$brand','$processor','$harddisk','$ram','$smps','$drive','$kboard','$monitor','$mouse','$webcam','$printer','$dop','$warrexp')") or die(mysqli_error($conn));
       echo "<script src='assets/js/sweetalert2.all.min.js'></script>";
        echo "<script>
            Swal.fire({
                icon: 'success',
                title: 'Success!',
                text: 'System purchased successfully!',
                confirmButtonText: 'OK'
            }).then(() => {
                window.location.href = 'adminh.php';
            });
        </script>";
        exit;
}
?>
</body>
</html>