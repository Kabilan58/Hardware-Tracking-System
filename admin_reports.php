<?php
session_start();
include("db.php");

// Fetch all reports
$sql = "SELECT * FROM stakeholder_reports ORDER BY created_at DESC";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin - Stakeholder Reports</title>
    <link href="assets/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" href="assets/styl.css">
</head>
<style>
a.btn {
	background : rgba(3, 27, 70, 0.49);
}

</style>
<body class="admin_reports" style="background: linear-gradient(135deg, #afb497, #143b8f);">
<div class="container py-5">
    <h2 class="mb-4 text-primary">📑 Stakeholder Reports</h2>

    <div class="card shadow-lg rounded-4">
        <div class="card-body table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Title</th>
                        <th>Summary</th>
                        <th>Status</th>
                        <th>Created At</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (mysqli_num_rows($result) > 0): ?>
                        <?php while ($row = mysqli_fetch_assoc($result)): ?>
                            <tr>
                                <td><?= $row['id'] ?></td>
                                <td><?= htmlspecialchars($row['title']) ?></td>
                                <td><?= nl2br(htmlspecialchars($row['summary'])) ?></td>
                                <td>
                                    <?php
                                    $badgeClass = match($row['status']) {
                                        'On Track' => 'success',
                                        'At Risk' => 'warning',
                                        'Delayed' => 'danger',
                                        'Completed' => 'primary',
                                        default => 'secondary'
                                    };
                                    ?>
                                    <span class="badge bg-<?= $badgeClass ?>"><?= $row['status'] ?></span>
                                </td>
                                <td><?= $row['created_at'] ?></td>
                            </tr>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="5" class="text-center text-muted">No reports submitted yet.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

    <a href="adminh.php" class="btn btn-secondary mt-3">⬅ Back to Dashboard</a>
</div>
</body>
</html>