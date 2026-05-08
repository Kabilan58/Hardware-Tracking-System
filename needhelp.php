<?php
session_start();
include("db.php");

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
	$id = mysqli_real_escape_string($conn, $_POST['id']);
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $subject = mysqli_real_escape_string($conn, $_POST['subject']);
    $message = mysqli_real_escape_string($conn, $_POST['message']);

    // Insert into DB
    $sql = "INSERT INTO support_requests (id, name, subject, message, created_at) 
            VALUES ('$id', '$name', '$subject', '$message', NOW())";

    if (mysqli_query($conn, $sql)) {
        $success = "Your request has been sent successfully. Our support team will contact you soon.";
    } else {
        $error = "Error: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Need Help - Contact Support</title>
    <link href="assets/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/styl.css" />
</head>
<body class="needhelp">

    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-18">
		<center>	 <a href="userh.php" style="background:rgba(73, 5, 5, 0.63);" class="btn btn-danger btn-lg">⬅ Back to Dashboard</a> </center>

                <div class="card shadow-lg rounded-4">
                    <div style="background:rgba(226, 36, 36, 0.81);" class="card-header text-white text-center">
                        <h4>🚨 Need Help? Contact Support Team</h4>
                    </div>
                    <div class="card-body">
					
                    <?php if (!empty($success)) : ?>
                        <div class="alert alert-success"><?= $success ?></div>
                    <?php endif; ?>

                    <?php if (!empty($error)) : ?>
                        <div class="alert alert-danger"><?= $error ?></div>
                    <?php endif; ?>


                        <form method="POST" action="">
                            <div class="mb-3">
                                <label class="form-label">Your ID</label>
                                <input type="text" name="id" class="form-control" required>
                            </div>
							
                            <div class="mb-3">
                                <label class="form-label">Your Name</label>
                                <input type="text" name="name" class="form-control" required>
                            </div>

      

                            <div class="mb-3">
                                <label class="form-label">Subject</label>
                                <input type="text" name="subject" class="form-control" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Message</label>
                                <textarea name="message" rows="4" class="form-control" required></textarea>
                            </div>

                            <div class="d-grid">
                                <button type="submit" class="btn btn-danger btn-lg">Send Request</button>
                            </div>
                        </form>
                    </div>
                    <div class="card-footer text-center text-muted">
                        We respond within 24 hours.
                    </div>
                </div>

            </div>
        </div>
    </div>
	
</body>
</html>