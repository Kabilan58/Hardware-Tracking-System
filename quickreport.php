<?php
session_start();
include("db.php");

// Handle form submit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $summary = mysqli_real_escape_string($conn, $_POST['summary']);
    $status = mysqli_real_escape_string($conn, $_POST['status']);

    $sql = "INSERT INTO stakeholder_reports (title, summary, status, created_at) 
            VALUES ('$title', '$summary', '$status', NOW())";

    if (mysqli_query($conn, $sql)) {
        $success = "Report has been submitted successfully.";
    } else {
        $error = "Error: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Quick Report</title>
    <link href="assets/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" href="assets/styl.css">
	
</head>
<body class="quickreport" style="background: linear-gradient(135deg, #878a78, #5bee74);">
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-18">
		<center>	 <a href="techenggh.php" style="background:rgba(5, 17, 73, 0.42);" class="btn btn-lg">⬅ Back to Dashboard</a> </center>

                   <div class="card shadow-lg rounded-4">
                <div class="card-header bg-primary text-white text-center">
                    <h4>📊 Create Status Update for Stakeholders</h4>
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
                            <label class="form-label">Report Title</label>
                            <input type="text" name="title" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Summary</label>
                            <textarea name="summary" rows="4" class="form-control" required></textarea>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Status</label>
                            <select name="status" class="form-select" required>
                                <option value="On Track">On Track</option>
                                <option value="At Risk">At Risk</option>
                                <option value="Delayed">Delayed</option>
                                <option value="Completed">Completed</option>
                            </select>
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary btn-lg">Submit Report</button>
                        </div>
                    </form>
                </div>
                <div class="card-footer text-center text-muted">
                    Stakeholders latest updates here.
                </div>
            </div>

        </div>
    </div>
</div>
</body>
</html>