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
  <title>Tech Engineer · Hardware Tracking System</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;800&family=Poppins:wght@600;800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="assets/styles.css" />
</head>
<body>
<div class="app-shell">
  <aside class="sidebar">
    <div class="brand">
      <div class="logo" style="content: url('images/badges/bots/techenggh.ico'); display: flex; align-items: center; justify-content: center;  width: 50px; height: auto;"></div>
      <h1>Hardware Tracker</h1>
    </div>
    <div class="user-badge">Signed in as<br> Engineer : <b><?php echo $user; ?></b> </div>
    <nav class="nav">
      <a class="" href="usercomplaints.php"><span class="ico">📥</span><span>Logged Complaints</span></a>
          
	  <a class="" href="rectifiedcomplaints.php"><span class="ico">📤</span><span>Rectified Complaints</span></a>
       <a class="" href="quickreport.php"><span class="ico">📑</span><span>Stakeholder Reports</span></a>
	  <a class="logout" href="logout.php"><span class="ico">🚪</span><span>LogOut</span></a>
    </nav>
  </aside>
  <main class="main">
    <header class="header">
      <div>
        <div class="h-title">Tech Engineer Console</div>
        <div class="h-sub">Welcome back, <?php echo $user; ?>.</div>
      </div>
    </header>

    <section class="hero" style="background: url('images/div/7.jpg') no-repeat center center; background-size: cover; justify-content: center;">
      <h2>Welcome</h2>
      <p style="color: rgba(9, 34, 36, 1)"><b>Review <ts style="color: rgba(173, 210, 212, 1)">assigned tickets</ts> and update resolutions.</b></p>
    </section>

    <section class="grid">
      <div class="card">
  <h3>Open Queue</h3>
  <p>Work on newly logged complaints.</p>
  <a class="cta" href="usercomplaints.php">Open</a>
</div>
      <div class="card">
  <h3>Rectified Items</h3>
  <p>Close out and document fixes.</p>
  <a class="cta" href="rectifiedcomplaints.php">Review</a>
</div>
      <div class="card">
  <h3>Quick Report</h3>
  <p>Create a status update for stakeholders.</p>
  <a class="cta" href="quickreport.php">Update</a>
</div>
    </section>

    <div class="footer">© <?php echo date('Y'); ?> Hardware Tracking System</div>
  </main>
</div>
</body>
</html>
