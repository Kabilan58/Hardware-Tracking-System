<?php
session_start();
include("db.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Login - Hardware Tracking System</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Bootstrap 5 -->
  <link href="assets/bootstrap.min.css" rel="stylesheet">
  
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
      body {
      background: url('images/login/hard.png') no-repeat center center fixed;
      background-size: cover;
    }
    .card {
      background: rgba(66, 103, 172, 0.93); /* semi-transparent card */
      width: 420px; /* wider card */
      max-width: 100%;
    }
    footer {
      text-align: center;
      margin-top: 15px;
      color: white;
      font-size: 0.85rem;
    }
    label{
      color: rgba(183, 223, 255, 1);
    }
     a.btn {
       color: rgba(134, 225, 241, 1);
    }
	a.btn:hover {
	       background-color: rgba(149, 178, 231, 0.88);
	}

  </style>
</head>
<body class="d-flex align-items-center justify-content-center vh-100">

  <div class="container text-center">
    <div class="row justify-content-center">
      <div class="col-md-auto">
        <div class="card shadow-lg border-0 rounded-4">
          <div class="card-body p-4">
            <h3 class="text-center mb-4 fw-bold">Hardware Tracking System</h3>

            <?php if (!empty($error)) : ?>
              <div class="alert alert-danger text-center"><?php echo $error; ?></div>
            <?php endif; ?>

            <form method="post">
              <div class="mb-3">
                <label for="userid" class="form-label">User ID</label>
                <input type="text" class="form-control" id="userid" name="t1" required>
              </div>
              <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="t2" required>
              </div>
              <div class="mb-3">
                <label for="loginas" class="form-label">Login As</label>
                <select class="form-select" id="loginas" name="t3" required>
                  <option value="admin">Administrator</option>
                  <option value="user">User</option>
                </select>
              </div>
              <button type="submit" name="submit" style="background-color: rgba(9, 67, 121, 0.93);" class="btn btn-primary w-100">Login</button>
            </form>

            <!-- Extra options -->
            <div class="text-center mt-3">
              <a href="forgot_password.php" class="btn">Forgot Password?</a> |
              <a href="register.php" class="btn">Create New User</a>
            </div>
			<div class="text-center mt-3">
              <a href="old_screenshots.php" style="color: rgba(112, 178, 233, 0.96);" class="btn">Preview Old-Screens</a> 
              </div>
          </div>
        </div>

        <!-- Footer correctly aligned under card -->
        <footer class="text-center py-2" style="color: rgba(196, 213, 245, 0.96);">
		  &copy; <?php echo date("Y"); ?> Hardware Tracking System
		</footer>

      </div>
    </div>
  </div>
  
<?php
if (isset($_POST['submit'])) {
    $un   = $_POST['t1'];
    $pw   = $_POST['t2'];
    $type = $_POST['t3'];

    if ($type == "admin") {
        if ($un == "admin" && $pw == "admin") {
            $_SESSION['userid'] = $un;
            header("Location: adminh.php");
            exit();
        } else {
            header('Location:/hwtracking/');
        }
    } else if ($type == "user") {
        $rs = mysqli_query($conn, "SELECT * FROM newuser WHERE uid='$un' AND password='$pw'")
              or die(mysqli_error($conn));
        if (mysqli_num_rows($rs) > 0) {
            $r = mysqli_fetch_row($rs);
		if($r[8]=="user") {
		$_SESSION['userid']=$un;
		header('Location:userh.php');
		} else {
		$_SESSION['userid']=$un;
		header('Location:techenggh.php');
		}
		}
	   	else {
		header('Location:/hwtracking/');
        }
    }
}
?>

</body>
</html>
