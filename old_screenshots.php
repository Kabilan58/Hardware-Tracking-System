<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Old Project Screenshots - Hardware Tracking System</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="assets/bootstrap.min.css" rel="stylesheet">

  <style>
    body {
      background: url('images/login/hard.png') no-repeat center center fixed;
      background-size: cover;
      font-family: Arial, sans-serif;
      color: white;
      text-align: center;
      padding: 40px;
    }
    .card {
      background: rgba(86, 66, 172, 0.93);
      width: 90%;
      max-width: 950px;
      margin: 0 auto;
      padding: 30px;
      border-radius: 15px;
      box-shadow: 0 4px 10px rgba(0,0,0,0.4);
    }
    h2 {
      color: #cde9ff;
      margin-bottom: 25px;
      font-weight: 600;
    }
    .screenshot-gallery {
      display: flex;
      flex-wrap: wrap;
      justify-content: center;
    }
    .screenshot-item {
      margin: 20px;
      text-align: center;
    }
    .screenshot-item img {
      width: 340px;
      height: auto;
      border-radius: 12px;
      box-shadow: 0 4px 10px rgba(0,0,0,0.4);
      transition: transform 0.3s, box-shadow 0.3s;
      cursor: pointer;
    }
    .screenshot-item img:hover {
      transform: scale(1.07);
      box-shadow: 0 6px 16px rgba(0,0,0,0.6);
    }
    .screenshot-title {
      margin-top: 10px;
      font-size: 1.05rem;
      color: #e2f3ff;
      font-weight: 500;
    }
    a.btn {
      color: rgba(134, 225, 241, 1);
    }
    a.btn:hover {
      background-color: rgba(149, 178, 231, 0.88);
      color: white;
    }
    footer {
      margin-top: 25px;
      color: rgba(183, 223, 255, 1);
    }

    /* Fullscreen Lightbox */
    #lightbox {
      position: fixed;
      top: 0; left: 0;
      width: 100%; height: 100%;
      background: rgba(0,0,0,0.9);
      display: none;
      justify-content: center;
      align-items: center;
      z-index: 9999;
    }
    #lightbox img {
      max-width: 95%;
      max-height: 90%;
      border-radius: 10px;
      box-shadow: 0 0 25px rgba(255,255,255,0.3);
      transition: transform 0.3s;
    }
    #lightbox img:hover {
      transform: scale(1.02);
    }
  </style>
</head>

<body>
  <div class="card">
    <h2>Previous Screens before Updation:</h2>
    <div class="screenshot-gallery">
      <?php
      $screens = [
          ["file" => "images/index_old.png", "title" => "Login Page (index_old)"],
          ["file" => "images/admin_old.png", "title" => "Admin Dashboard (admin_old)"],
          ["file" => "images/user_old.png", "title" => "User Panel (user_old)"]
      ];

      foreach ($screens as $screen) {
          if (file_exists($screen['file'])) {
              echo "<div class='screenshot-item'>";
              echo "<img src='{$screen['file']}' alt='{$screen['title']}' data-title='{$screen['title']}'>";
              echo "<div class='screenshot-title'>{$screen['title']}</div>";
              echo "</div>";
          }
      }
      ?>
    </div>

    <a href="index.php" class="btn btn-outline-light mt-4">Back to Login</a>
  </div>

  <footer>
    &copy; <?php echo date('Y'); ?> Hardware Tracking System
  </footer>

  <!-- Custom Lightbox HTML -->
  <div id="lightbox">
    <img src="" alt="Preview">
  </div>

  <!-- Custom Lightbox Script -->
  <script>
    const lightbox = document.getElementById('lightbox');
    const lightboxImg = lightbox.querySelector('img');

    document.querySelectorAll('.screenshot-item img').forEach(img => {
      img.addEventListener('click', () => {
        lightboxImg.src = img.src;
        lightbox.style.display = 'flex';
      });
    });

    // Close on click outside or Esc
    lightbox.addEventListener('click', (e) => {
      if (e.target !== lightboxImg) {
        lightbox.style.display = 'none';
      }
    });

    document.addEventListener('keydown', (e) => {
      if (e.key === 'Escape') {
        lightbox.style.display = 'none';
      }
    });
  </script>
</body>
</html>
