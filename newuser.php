<?php
session_start();
include("db.php");
?>

<!DOCTYPE html>
<html>
<head>
<link rel='stylesheet' href='assets/forms-below.css'>
<link rel='stylesheet' href="assets/js/sweetalert2.min.css">
<link rel="stylesheet" href="assets/bootstrap.min.css">
<script src="assets/js/sweetalert2.all.min.js"></script>
<style>.ab{text-align:right;}</style>
</head>
<body class="forms-below"  style="background: linear-gradient(135deg, #43cea2, #185a9d);">

<?php
// Departments for dropdown
$rs1 = mysqli_query($conn, "select dname from dept") or die(mysqli_error($conn));
// Next UID
$rs2 = mysqli_query($conn, "select ifnull(max(uid),999)+1 from newuser") or die(mysqli_error($conn));
$r2  = mysqli_fetch_row($rs2);
// All users
$rs3 = mysqli_query($conn, "select * from newuser") or die(mysqli_error($conn));
?>

<div class="card" style="background: linear-gradient(135deg, #43cea2, #179fa8ff);">
    <h2 align="center">Registered Users</h2>
    <table border="1" align="center">
        <tr>
            <th>Task</th><th>Emp Id</th><th>Name</th><th>Gender</th><th>Address</th>
            <th>City</th><th>Qual</th><th>Phone No</th><th>Dept</th><th>Type</th>
            <th>UserName</th><th>Password</th><th>Sec Ques</th><th>Sec Ans</th>
        </tr>
        <?php while($r3=mysqli_fetch_row($rs3)) { ?>
        <tr>
            <td><a href="update-user.php?id=<?php echo $r3[0]; ?>">Edit</a></td>
            <?php foreach($r3 as $rr3) echo "<td>$rr3</td>"; ?>
        </tr>
        <?php } ?>
    </table>
</div><br>
<center><a href="adminh.php" class="btn btn-light" style="background:grey;"><b>⬅ Back to Dashboard</b></a></center>
<hr style="color:red;">

<!-- Registration Form -->
<form name="f" action="newuser.php" method="post">
<table align="center">
<tr><th colspan="2">EMPLOYEE MASTER</th></tr>
<tr><td class="ab">Employee Id</td><td><input type="text" name="tt1" value="<?php echo $r2[0];?>" readonly></td></tr>
<tr><td class="ab">Employee Name</td><td><input type="text" name="t1"></td></tr>
<tr><td class="ab">Gender</td>
    <td><input type="radio" name="g" value="male">Male
        <input type="radio" name="g" value="female">Female</td></tr>
<tr><td class="ab">Address</td><td><textarea name="t2"></textarea></td></tr>
<tr><td class="ab">City</td>
    <td><select name="t3">
        <option value="madurai">Madurai</option>
        <option value="chennai">Chennai</option>
        <option value="tuticorin">Tuticorin</option>
        <option value="trichy">Trichy</option>
        <option value="dindigul">Dindigul</option>
        <option value="ramnad">Ramanathapuram</option>
    </select></td></tr>
<tr><td class="ab">Qualification</td>
    <td><select name="t4">
        <option value="hsc">HSC</option>
        <option value="ug">U.G.</option>
        <option value="pg">P.G.</option>
        <option value="iti">I.T.I</option>
        <option value="diploma">Diploma</option>
        <option value="be">B.E</option>
        <option value="btech">B.Tech</option>
    </select></td></tr>
<tr><td class="ab">Contact Mobile</td><td><input type="text" name="t5" maxlength="10"></td></tr>
<tr><td class="ab">Department</td>
    <td><select name="t6">
        <?php while($r1=mysqli_fetch_row($rs1)) echo "<option value=$r1[0]>$r1[0]</option>"; ?>
    </select></td></tr>
<tr><td class="ab">UserType</td>
    <td><select name="t7"><option value="user">User</option><option value="techengg">Tech Engg</option></select></td></tr>
<tr><td class="ab">Username</td><td><input type="text" name="t8"></td></tr>
<tr><td class="ab">Password</td><td><input type="password" name="t9"></td></tr>
<tr><td class="ab">Confirm Password</td><td><input type="password" name="t10"></td></tr>
<tr><td class="ab">Secret Question</td>
    <td><select name="t11">
        <option value="favourite color">Favourite Color</option>
        <option value="pet name">Pet Name</option>
        <option value="favourite food">Favourite Food</option>
    </select></td></tr>
<tr><td class="ab">Secret Answer</td><td><input type="password" name="t12"></td></tr>
<tr><td colspan="2" align="center"><input type="submit" name="submit" value="Register"></td></tr>
</table>
</form>

<?php
// Handle new user creation
if(isset($_POST['submit'])) {
    $uname=$_POST['t1']; $gender=$_POST['g']; $addr=$_POST['t2']; $city=$_POST['t3'];
    $qual=$_POST['t4']; $mobile=$_POST['t5']; $dept=$_POST['t6']; $usertype=$_POST['t7'];
    $username=$_POST['t8']; $password=$_POST['t9']; $secq=$_POST['t11']; $seca=$_POST['t12'];

    mysqli_query($conn, "INSERT INTO newuser (uname,gender,addr,city,qual,mobile,dept,usertype,username,password,secq,seca)
    VALUES ('$uname','$gender','$addr','$city','$qual','$mobile','$dept','$usertype','$username','$password','$secq','$seca')") 
    or die(mysqli_error($conn));
      echo "<script src='assets/js/sweetalert2.all.min.js'></script>";
	  echo "<script>
			Swal.fire({
				icon: 'success',
				title: '🎉 User Created!',
				text: 'A new user has been added successfully.',				
				ConfirmButtonText: 'OK',
				background: '#32d8b4ff',
				color: '#022c23ff'
			}).then(() => {
				// redirect directly to user list section
				window.location.href = 'newuser.php';
			});
		</script>";
    exit;
}

// SweetAlert Popup Handler
if(isset($_SESSION['status']) && $_SESSION['status'] !='success') {
    echo "<script>
    Swal.fire({
        icon: '{$_SESSION['status_code']}',
        title: '{$_SESSION['status']}',
        text: '✏️ User updated successfully.',
        timer: 2000,
        ConfirmButtonText: 'OK',
        				background: '#c4ac42ff',
				color: '#2c2202ff'
    }).then(() => {
        window.location.href = 'newuser.php';
    });
    </script>";
	unset($_SESSION['status']);
    unset($_SESSION['status_code']);
}
	
elseif(isset($_SESSION['status']) && $_SESSION['status'] != 'error') {
      echo "<script>
		Swal.fire({
			icon: '{$_SESSION['status_code']}',
			title: '{$_SESSION['status']}',
			text: 'There was an error updating the user.',
			timer: 2000,
			ConfirmButtonText: 'OK',
                    				background: '#af583dff',
				color: '#2c0502ff'
		}).then(() => {
			window.location.href = 'newuser.php';
		});
		</script>";
	unset($_SESSION['status']);
    unset($_SESSION['status_code']);
}
?>

</body>
</html>
