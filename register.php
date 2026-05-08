<?php
session_start();
include("db.php");

if (isset($_POST['submit'])) {
    $userid   = $_POST['userid'];
    $password = $_POST['password'];
    $usertype     = "user"; // default role

    // check if user already exists
    $check = mysqli_query($conn, "SELECT * FROM newuser WHERE uid='$userid'");
    if (mysqli_num_rows($check) > 0) {
        $error = "User ID already exists!";
    } else {
        $sql = "INSERT INTO newuser(uid, password, usertype) VALUES('$userid', '$password', '$usertype')";
        if (mysqli_query($conn, $sql)) {
            $success = "Account created successfully! You can now login.";
        } else {
            $error = "Error: " . mysqli_error($conn);
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Create New User</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light d-flex align-items-center justify-content-center vh-100">

<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-5">
      <div class="card shadow-lg border-0 rounded-4">
        <div class="card-body p-4">
          <h3 class="text-center mb-4">Create New User</h3>

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
              <label class="form-label">Password</label>
              <input type="password" class="form-control" name="password" required>
            </div>
            <button type="submit" name="submit" class="btn btn-primary w-100">Register</button>
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
