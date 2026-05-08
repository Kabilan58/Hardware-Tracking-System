<?php
session_start();
include("db.php");

// Fetch user by ID for editing
if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $result = mysqli_query($conn, "SELECT * FROM newuser WHERE uid=$id") or die(mysqli_error($conn));
    $user = mysqli_fetch_assoc($result);
}

// Handle update
if (isset($_POST['update'])) {
    $uid = $_POST['uu'];
    $uname = $_POST['u1']; $gender = $_POST['u2']; $addr = $_POST['u3']; $city = $_POST['u4'];
    $qual = $_POST['u5']; $mobile = $_POST['u6']; $dept = $_POST['u7']; $usertype = $_POST['u8'];
    $username = $_POST['u9']; $password = $_POST['u10']; $secq = $_POST['u11']; $seca = $_POST['u12'];

    $sql="UPDATE newuser SET uname=?,gender=?,addr=?,city=?,
    qual=?,mobile=?,dept=?,usertype=?,username=?,password=?,
    secq=?,seca=? WHERE uid=?";
    $stmt=mysqli_prepare($conn,$sql);
    mysqli_stmt_bind_param($stmt, "ssssssssssssi",$uname,
        $gender,$addr,$city,$qual,$mobile,$dept,$usertype,$username,
        $password,$secq,$seca,$uid);

    if(mysqli_stmt_execute($stmt)) {
        $_SESSION['status']="User updated successfully!";
        $_SESSION['status_code']="success";
    } else {
        $_SESSION['status']="Update failed: ".mysqli_error($conn);
        $_SESSION['status_code']="error";
    }
    mysqli_stmt_close($stmt);

    header('Location:newuser.php');
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
<link href="assets/bootstrap.min.css" rel="stylesheet">
<link rel='stylesheet' href='assets/js/sweetalert2.min.css'>
<link rel='stylesheet' href='assets/forms-below.css'>
</head>
<body class="forms-below">

<div class="card" style="background: linear-gradient(135deg, #43cea2, #254fc2b6);">
    <h2 class="text-center">Update User</h2>
    <form name="f" action="update-user.php" method="post">
        <input type="hidden" name="uu" value="<?php echo $user['uid']; ?>">

        <div class="form-group"><label>Employee Name</label>
            <input type="text" class="form-control" name="u1" value="<?php echo $user['uname']; ?>"></div>
        <div class="form-group"><label>Gender</label>
            <input type="text" class="form-control" name="u2" value="<?php echo $user['gender']; ?>"></div>
        <div class="form-group"><label>Address</label>
            <textarea class="form-control" name="u3"><?php echo $user['addr']; ?></textarea></div>
        <div class="form-group"><label>City</label>
            <input type="text" class="form-control" name="u4" value="<?php echo $user['city']; ?>"></div>
        <div class="form-group"><label>Qualification</label>
            <input type="text" class="form-control" name="u5" value="<?php echo $user['qual']; ?>"></div>
        <div class="form-group"><label>Mobile</label>
            <input type="text" class="form-control" name="u6" value="<?php echo $user['mobile']; ?>"></div>
        <div class="form-group"><label>Department</label>
            <input type="text" class="form-control" name="u7" value="<?php echo $user['dept']; ?>"></div>
        <div class="form-group"><label>User Type</label>
            <select name="u8" class="form-control">
                <option value="user" <?php if($user['usertype']=="user") echo "selected"; ?>>User</option>
                <option value="techengg" <?php if($user['usertype']=="techengg") echo "selected"; ?>>Tech Engg</option>
            </select></div>
        <div class="form-group"><label>Username</label>
            <input type="text" class="form-control" name="u9" value="<?php echo $user['username']; ?>"></div>
        <div class="form-group"><label>Password</label>
            <input type="text" class="form-control" name="u10" value="<?php echo $user['password']; ?>"></div>
        <div class="form-group"><label>Secret Question</label>
            <input type="text" class="form-control" name="u11" value="<?php echo $user['secq']; ?>"></div>
        <div class="form-group"><label>Secret Answer</label>
            <input type="text" class="form-control" name="u12" value="<?php echo $user['seca']; ?>"></div><br>
<center>
        <input type="submit" name="update" value="Update" class="btn btn-primary">
        <a href="newuser.php" class="btn btn-light">Back</a></center>
    </form>
</div>
  
</body>
</html>
