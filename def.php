<?php
session_start();
include("db.php");
?>
<html>
<body bgcolor="#C0DFFD">
<?php
$rs=mysqli_query($conn, "select uname from newuser where uid=$_SESSION[userid]") or die(mysqli_error($conn));
$r=mysqli_fetch_row($rs);
echo "<div align='center' style='height:100%;padding-top:100px;'><font style='font-family:arial;color:#99ccff;font-weight:bold;font-size:80px;'>Welcome $r[0]</font></div>";
?>
</body>
</html>