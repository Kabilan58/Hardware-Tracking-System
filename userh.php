<?php
session_start();
include("db.php");
if(!isset($_SESSION['userid'])){ header("Location: index.php"); exit; }
/* role gate intentionally relaxed on shell pages; sub-pages do server checks */
$user = htmlspecialchars($_SESSION['userid']);
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>User · Hardware Tracking System</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;800&family=Poppins:wght@600;800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="assets/styles.css" />
</head>
<body>
<div class="app-shell">
  <aside class="sidebar">
    <div class="brand">
      <div class="logo" style="content: url('images/badges/bots/userh.ico'); display: flex; align-items: center; justify-content: center;  width: 50px; height: auto;"></div>
      <h1>Hardware Tracker</h1>
    </div>
    <div class="user-badge">Signed in as<br> User : <b><?php echo $user; ?></b> </div>
    <nav class="nav">
      <a class="" href="reportingproblem.php"><span class="ico">📝</span><span>Report a Problem</span></a>
      <a class="" href="loggedcomplaints.php"><span class="ico">📄</span><span>My Complaints</span></a>
	  <a class="" href="needhelp.php"><span class="ico">📩</span><span>Contact Admin</span></a>
	  
      <a class="logout" href="logout.php"><span class="ico">🚪</span><span>LogOut</span></a>
    </nav>
  </aside>
  <main class="main">
    <header class="header">
      <div>
        <div class="h-title">User Workspace</div>
        <div class="h-sub">Welcome back, <?php echo $user; ?>.</div>
      </div>
    </header>

    <section class="hero" style="background: url('images/div/bac.jpg') no-repeat center center; background-size: cover; justify-content: center;">
      <h2 style="color: rgba(16, 26, 83, 0.75)">Welcome</h2>
      <p style="color: rgba(173, 210, 212, 1)"><ts style="color: rgba(16, 26, 83, 0.75)"><b>Submit complaints</ts> and track their <ts style="color: rgba(16, 26, 83, 0.75)">resolution</ts> here.</b></p>
    </section>

    <section class="grid">
      <div class="card">
  <h3>Log a Complaint</h3>
  <p>Facing an issue with your system? Create a ticket.</p>
  <a class="cta" href="reportingproblem.php">Report</a>
</div>
      <div class="card">
  <h3>Track Status</h3>
  <p>See progress on your requests in real-time.</p>
  <a class="cta" href="loggedcomplaints.php">View</a>
</div>
      <div class="card">
  <h3>Need Help?</h3>
  <p>Contact the support team for urgent issues.</p>
  <a class="cta" href="needhelp.php">Contact</a>
</div>
    </section>

    <div class="footer">© <?php echo date('Y'); ?> Hardware Tracking System</div>
  </main>
</div>
</body>
</html>
