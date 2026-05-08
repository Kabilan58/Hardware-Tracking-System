<?php
session_start();
include("db.php");
$rs=mysqli_query($conn, "select ifnull(max(deptno),0)+1 from dept") or die(mysqli_error($conn));
$r=mysqli_fetch_row($rs);
?>
<html>
	<head>
	<link href="assets/bootstrap.min.css" rel="stylesheet">
	   <link rel='stylesheet' href="assets/js/sweetalert2.min.css">
	<link rel='stylesheet' href='assets/styl.css'>
	</head>
<script type="text/javascript">
function check() {
if(f.t1.value==""||f.t2.value=="") {
window.alert("Field is Empty !")
return false
}
return true
}
</script>
<style>
.ab{text-align:right;}
</style>
<body class="deptcreation">
<form name="f" action="deptcreation.php" method="post" onsubmit="return check()">
<table align="center">
<tr>
<th colspan="2">DEPARTMENT MASTER</th>
</tr>
<tr>
<td class="ab">Dept Id</td>
<td><input type="text" name="t1" value="<?php echo $r[0];?>" readonly></td>
</tr>
<tr>
<td class="ab">Dept Name</td>
<td><input type="text" name="t2"></td>
</tr>
<tr>
<td class="ab">Location</td>
<td>
<select name="t3">
<option value="main building">Main Building</option>
<option value="north block">North Block</option>
<option value="south block">South Block</option>
<option value="east block">East Block</option>
<option value="west block">West Block</option>
</select>
</td>
</tr>
<tr>
<td colspan="2" align="center">
<input type="submit" name="submit" value="submit">
</td>
</tr>
<tr><td> <a href="adminh.php" class="btn btn-secondary mt-3">⬅ Back to Dashboard</a> </td>
</tr>
</table>
</form>
<?php
if(isset($_POST['submit'])) {
	$dname=$_POST['t2'];
	$loc=$_POST['t3'];
	mysqli_query($conn, "insert into dept (dname,loc) values ('$dname','$loc')") or die(mysqli_error($conn));
       echo "<script src='assets/js/sweetalert2.all.min.js'></script>";
        echo "<script>
            Swal.fire({
                icon: 'success',
                title: 'Success!',
                text: 'Department created successfully!',
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