<?php
session_start();
include("db.php");

if (isset($_POST['submit'])) {
    $userid = $_POST['userid'];
    $newpw  = $_POST['newpw'];

    $check = mysqli_query($conn, "SELECT * FROM newuser WHERE uid='$userid'");
    if (mysqli_num_rows($check) > 0) {
        $sql = "UPDATE newuser SET password='$newpw' WHERE uid='$userid'";
        if (mysqli_query($conn, $sql)) {
            $success = "Password reset successful! You can now login.";
        } else {
            $error = "Error updating password: " . mysqli_error($conn);
        }
    } else {
        $error = "No user found with that ID!";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Forgot Password</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light d-flex align-items-center justify-content-center vh-100">

<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-5">
      <div class="card shadow-lg border-0 rounded-4">
        <div class="card-body p-4">
          <h3 class="text-center mb-4">Forgot Password</h3>

          <?php if (!empty($error)) : ?>
            <div class="alert alert-danger"><?php echo $error; ?></div>
          <?php endif; ?>
          <?php if (!empty($success)) : ?>
            <div class="alert alert-success"><?php echo $success; ?></div>
          <?php endif; ?>

          <form method="post">
            <div class="mb-3">
              <label class="form-label">User ID</label>
              <input type="text" class="form-control" name="userid" required>
            </div>
            <div class="mb-3">
              <label class="form-label">New Password</label>
              <input type="password" class="form-control" name="newpw" required>
            </div>
            <button type="submit" name="submit" class="btn btn-primary w-100">Reset Password</button>
          </form>

          <div class="text-center mt-3">
            <a href="index.php">Back to Login</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

</body>
</html>
