<?php
session_start();
include("db.php");
// Fetch all urgent issues
// Handle actions
if (isset($_GET['action']) && isset($_GET['id'])) {
    $id = intval($_GET['id']);
    if ($_GET['action'] === "resolve") {
        $update = "UPDATE support_requests SET status='Resolved' WHERE id=$id";
        mysqli_query($conn, $update);
    } elseif ($_GET['action'] === "delete") {
        $delete = "DELETE FROM support_requests WHERE id=$id";
        mysqli_query($conn, $delete);
    }
    header("Location: admin_needhelp.php"); // refresh after action
    exit;
}

// Fetch all issues
$sql = "SELECT * FROM support_requests ORDER BY created_at DESC";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin - Support Requests</title>
    <link href="assets/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/styl.css" />
</head>
<body class="admin_needhelp">
    <div class="container py-5">
        <h2 class="mb-4 text-danger">📩 Urgent Support Requests</h2>

        <div class="card shadow-lg rounded-4">
            <div class="card-body table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            
                            <th>Subject</th>
                            <th>Message</th><td>
                            <th>Created At</th></td>
							<th>Actions</th>
							
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (mysqli_num_rows($result) > 0): ?>
                            <?php while ($row = mysqli_fetch_assoc($result)): ?>
                                <tr>
                                    <td><?= $row['id'] ?></td>
                                    <td><?= htmlspecialchars($row['name']) ?></td>
                                    
                                    <td><?= htmlspecialchars($row['subject']) ?></td>
                                    <td><?= nl2br(htmlspecialchars($row['message'])) ?></td>
                                    <td>
                                    <?php if ($row['status'] === "Resolved"): ?>
                                        <span class="badge bg-success">Resolved</span>
                                    <?php else: ?>
                                        <span class="badge bg-warning text-dark">Pending</span>
                                    <?php endif; ?>
                                </td>
                                <td><?= $row['created_at'] ?></td>
                                <td>
                                    <?php if ($row['status'] !== "Resolved"): ?>
                                        <a href="?action=resolve&id=<?= $row['id'] ?>" 
                                           class="btn btn-sm btn-success"
                                           onclick="return confirm('Mark this request as resolved?');">
                                           ✅ Resolve
                                        </a>
                                    <?php endif; ?>
                                    <a href="?action=delete&id=<?= $row['id'] ?>" 
                                       class="btn btn-sm btn-danger"
                                       onclick="return confirm('Are you sure you want to delete this request?');">
                                       🗑 Delete
                                    </a>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="8" class="text-center text-muted">No urgent support requests yet.</td>
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