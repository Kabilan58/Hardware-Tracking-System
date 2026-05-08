<?php
session_start();
include("db.php");
?>
<html><head> 
   <link href="assets/bootstrap.min.css" rel="stylesheet">
   <link rel='stylesheet' href='assets/js/sweetalert2.min.css'>
	<link rel="stylesheet" href="assets/styl.css">
	
	<style>
	.ar{text-align:right;}
	</style>
	
	<script type="text/javascript">
	function check() {
	if(f.t1.value=="" || f.t8.value=="") {
	window.alert("Cannot Submit... Field is Empty !")
	return false
	}
	return true
	}
</script>
</head>
<body class="reportingproblem">
<?php
$rs=mysqli_query($conn, "select n.uid,uname,p.pcid,pcname,ipaddr from newuser n,pcallot p,pc o where n.uid=p.uid and p.pcid=o.pcid and n.uid=$_SESSION[userid]") or die(mysqli_error($conn));
$r=mysqli_fetch_row($rs);
$rs1=mysqli_query($conn, "select ifnull(max(probid),0)+1 from problemreport") or die(mysqli_error($conn));
$r1=mysqli_fetch_row($rs1);
?>
<form name="f" action="reportingproblem.php" method="post" onsubmit="return check()">
<table align="center">
<tr>
<th colspan="2">Error Reporting</th>
</tr>
<tr>
<td class="ar">Report Id</td>
<td><input type="text" name="t1" value="<?php echo $r1[0];?>" required></td>
</tr>
<tr>
<td class="ar">Report Date</td>
<td><input type="text" name="t2" value="<?php echo date('Y-m-d',time());?>" readonly></td>
</tr>
<tr>
<td class="ar">User Id</td>
<td><input type="text" name="t3" value="<?php echo $r[0] ?? 'Not Assigned';?>" readonly></td>
</tr>
<tr>
<td class="ar">User Name</td>
<td><input type="text" name="t4" value="<?php echo $r[1] ?? 'Unknown User';?>" readonly></td>
</tr>
<tr>
<td class="ar">System Id</td>
<td><input type="text" name="t5" value="<?php echo $r[2] ?? 'Not Assigned';?>" readonly></td>
</tr>
<tr>
<td class="ar">System Name</td>
<td><input type="text" name="t6" value="<?php echo $r[3] ?? 'Unknown System';?>" readonly></td>
</tr>
<tr>
<td class="ar">IP Address</td>
<td><input type="text" name="t7" value="<?php echo $r[4] ?? 'Unknown IP-ADDR';?>" readonly></td>
</tr>
<tr>
<td class="ar">Problem</td>
<td><textarea name="t8" cols="25" rows="5"></textarea></td>
</tr>
<tr>
<td colspan="2" align="center">
<input type="submit" name="submit" value="Register">
</td>
</tr>
</table>
</form>

<?php
if(isset($_POST['submit'])) {
    $rdate=$_POST['t2'];
    $userid=$_POST['t3'];
    $sysid=$_POST['t5'];
    $problem=$_POST['t8'];
    $flag=false;

    $cd=date('Y-m-d',time());
    $rs=mysqli_query($conn, "SELECT pcid,warrexp FROM pc WHERE pcid=$sysid and warrexp>=$cd") or die(mysqli_error($conn));
    if(mysqli_num_rows($rs)>0) {
        $r=mysqli_fetch_row($rs);
        $iswarr="yes";
        $warrdate=$r[1];
        $str="INSERT INTO problemreport (rdate,userid,sysid,problem,iswarr,warrdate) VALUES ('$rdate',$userid,$sysid,'$problem','$iswarr','$warrdate')";
        $flag=true;
    } else {
        $rs1=mysqli_query($conn, "SELECT amccmp,amcph,amcfrom,amcto FROM pc WHERE pcid=$sysid") or die(mysqli_error($conn));
        if(mysqli_num_rows($rs1)>0) {
            $r1=mysqli_fetch_row($rs1);
            $isamc="yes";
            $amccmp=$r1[0];
            $amcph=$r1[1];
            $amcfrom=$r1[2];
            $amcto=$r1[3];
            $str="INSERT INTO problemreport (rdate,userid,sysid,problem,isamc,amccmp,amcph,amcfrom,amcto) VALUES ('$rdate',$userid,$sysid,'$problem','$isamc','$amccmp','$amcph','$amcfrom','$amcto')";
            $flag=true;
        } else {
            echo "<h3 align='center'>Sorry! The system is out of Warranty and AMC... You can't Register Your Problem</h3>";
            echo "<h3 align='center'>Contact Your System Administrator</h3>";
        }
    }

    if($flag==true) {
        mysqli_query($conn, $str) or die(mysqli_error($conn));
        echo "<script src='assets/js/sweetalert2.all.min.js'></script>";
        echo "<script>
            Swal.fire({
                icon: 'success',
                title: 'Success!',
                text: 'Problem registered successfully!',
                confirmButtonText: 'OK'
            }).then(() => {
                window.location.href = 'userh.php';
            });
        </script>";
        exit;
    }
}
?>
</body>
</html>
