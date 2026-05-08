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
  <title>Admin · Hardware Tracking System</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;800&family=Poppins:wght@600;800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="assets/styles.css" />
</head>
<body>
<div class="app-shell">
  <aside class="sidebar">
    <div class="brand">
      <div class="logo" style="content: url('images/badges/bots/adminh.ico'); display: flex; align-items: center; justify-content: center;  width: 50px; height: auto;"></div>
      <h1>Hardware Tracker</h1>
    </div>
    <div class="user-badge">Signed in as<br><b><?php echo $user; ?></b> </div>
    <nav class="nav">
      <a class="" href="deptcreation.php"><span class="ico">🏢</span><span>Department Creation</span></a>
      <a class="" href="newuser.php"><span class="ico">👤</span><span>User Creation</span></a>
      <a class="" href="newpc.php"><span class="ico">🖥️</span><span>System Purchase</span></a>
      <a class="" href="systemallotment.php"><span class="ico">📦</span><span>System Allotment</span></a>
      <a class="" href="amcentry.php"><span class="ico">🧾</span><span>AMC</span></a>
      <a class="" href="loggedreports.php"><span class="ico">📊</span><span>Logged Reports</span></a>
	  <a class="" href="admin_needhelp.php"><span class="ico">📩</span><span>Urgent Requests</span></a>
	  <a class="" href="admin_reports.php"><span class="ico">📑</span><span>Stakeholder Reports</span></a>	  
     
    </nav>
  </aside>
  <main class="main">
    <header class="header">
      <div>
        <div class="h-title">Administrator Dashboard</div>
        <div class="h-sub">Welcome back, <?php echo $user; ?>.</div>
      </div>
    </header>

    <section class="hero" style="background: url('images/div/6.jpg'); background-size: cover; justify-content: center;">
      <h2 style="color: rgba(16, 26, 83, 0.75)">Welcome Admin</h2>
      <p style="color: rgba(173, 210, 212, 1)"><b>Use the quick <ts style="color: rgba(16, 26, 83, 0.75)">actions below to</ts> administer departments, users, assets and <ts style="color: rgba(16, 26, 83, 0.75)">reports.</ts></b></p>
    </section>

    <section class="grid">
      <div class="card" style="background:linear-gradient(180deg, rgba(21, 121, 167, 0.83), rgba(112, 34, 11, 0.89));">
  <h3><span class="ico">🚪</span><span> Admin Logout</span></h3>
  <p>Logout' after a process completion,as a Admin.</p>
  <a class="cta" style=" background:linear-gradient(135deg, rgba(146, 27, 19, 0.9), rgba(129, 88, 12, 0.89));" href="logout.php">LogOut</a>
</div>	
	
      <div class="card">
  <h3>Create Departments</h3>
  <p>Define new departments and manage existing ones.</p>
  <a class="cta" href="deptcreation.php">Open</a>
</div>
      <div class="card">
  <h3>Add Users</h3>
  <p>Create users and set permissions.</p>
  <a class="cta" href="newuser.php">Manage</a>
</div>
      <div class="card">
  <h3>Record Purchases</h3>
  <p>Enter new hardware purchases and inventory.</p>
  <a class="cta" href="newpc.php">Add</a>
</div>
      <div class="card">
  <h3>Allot Systems</h3>
  <p>Assign systems to staff with one click.</p>
  <a class="cta" href="systemallotment.php">Allot</a>
</div>
      <div class="card">
  <h3>Manage AMC</h3>
  <p>Log or view annual maintenance contracts.</p>
  <a class="cta" href="amcentry.php">Update</a>
</div>
      <div class="card">
  <h3>View Reports</h3>
  <p>Review logged/rectified complaint analytics.</p>
  <a class="cta" href="loggedreports.php">View</a>
</div>
      <div class="card">
  <h3>Urgent Isuues</h3>
  <p>Response for urgent requests.</p>
  <a class="cta" href="admin_needhelp.php">View</a>
</div>
      <div class="card">
  <h3>For Stakeholders</h3>
  <p>Reports status for Stakeholders.</p>
  <a class="cta" href="admin_reports.php">View</a>
</div>

    </section>

    <div class="footer">© <?php echo date('Y'); ?> Hardware Tracking System</div>
  </main>
</div>
</body>
</html>
