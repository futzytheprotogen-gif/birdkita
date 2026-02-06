<?php
session_start();
if (!isset($_SESSION['user'])) {
    header('Location: index.php');
    exit;
}
?>
<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>Dashboard - BirdKita</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <div class="site-wrap">

  <header class="site-header top-nav">
    <div class="nav-inner">
      <div class="brand">
        <img src="assets/logo.svg" alt="Logo" class="logo">
        <div class="brand-title">NAVBAR</div>
      </div>

      <div class="search">
        <input type="search" id="search" placeholder="Search...">
      </div>

      <div class="user-actions">
        <a href="logout.php" class="logout">Logout</a>
      </div>
    </div>

    <div class="header-bottom">
      <div class="header-circles">
        <button class="circle-btn">●</button>
        <button class="circle-btn">●</button>
        <button class="circle-btn">●</button>
      </div>
    </div>
  </header>

  <main class="main">

      <div class="welcome" style="margin:6px 0 12px 0;display:flex;justify-content:flex-end;align-items:center;gap:12px;color:#fff">
        <h2 style="margin:0;font-size:16px">Halo, <?=htmlspecialchars($_SESSION['user']['username'])?> 👋</h2>
      </div>

      <div class="dashboard">

        <div class="row">
          <p class="row-title">Koleksi 1</p>
          <div class="carousel" tabindex="0">
            <button class="nav left" aria-label="Previous">‹</button>
            <div class="list">
              <div class="item">
                <img src="assets/parrot.svg" alt="bird">
                <div class="caption">Parrot</div>
                <button class="view-btn">View</button>
              </div>
              <div class="item">
                <img src="assets/parrot.svg" alt="bird">
                <div class="caption">Parrot</div>
                <button class="view-btn">View</button>
              </div>
              <div class="item">
                <img src="assets/parrot.svg" alt="bird">
                <div class="caption">Parrot</div>
                <button class="view-btn">View</button>
              </div>
              <div class="item">
                <img src="assets/parrot.svg" alt="bird">
                <div class="caption">Parrot</div>
                <button class="view-btn">View</button>
              </div>
            </div>
            <button class="nav right" aria-label="Next">›</button>
          </div>
        </div>

        <div class="row">
          <p class="row-title">Koleksi 2</p>
          <div class="carousel" tabindex="0">
            <button class="nav left" aria-label="Previous">‹</button>
            <div class="list">
              <div class="item">
                <img src="assets/lambang.png" alt="bird">
                <div class="caption">Cockatoo</div>
                <button class="view-btn">View</button>
              </div>
              <div class="item">
                <img src="assets/lambang.png" alt="bird">
                <div class="caption">Cockatoo</div>
                <button class="view-btn">View</button>
              </div>
              <div class="item">
                <img src="assets/lambang.png" alt="bird">
                <div class="caption">Cockatoo</div>
                <button class="view-btn">View</button>
              </div>
              <div class="item">
                <img src="assets/lambang.png" alt="bird">
                <div class="caption">Cockatoo</div>
                <button class="view-btn">View</button>
              </div>
            </div>
            <button class="nav right" aria-label="Next">›</button>
          </div>
        </div>

        <div class="row">
          <p class="row-title">Koleksi 3</p>
          <div class="carousel" tabindex="0">
            <button class="nav left" aria-label="Previous">‹</button>
            <div class="list">
              <div class="item">
                <img src="assets/parrot.svg" alt="bird">
                <div class="caption">Bird</div>
                <button class="view-btn">View</button>
              </div>
              <div class="item">
                <img src="assets/parrot.svg" alt="bird">
                <div class="caption">Bird</div>
                <button class="view-btn">View</button>
              </div>
              <div class="item">
                <img src="assets/parrot.svg" alt="bird">
                <div class="caption">Bird</div>
                <button class="view-btn">View</button>
              </div>
              <div class="item">
                <img src="assets/parrot.svg" alt="bird">
                <div class="caption">Bird</div>
                <button class="view-btn">View</button>
              </div>
            </div>
            <button class="nav right" aria-label="Next">›</button>
          </div>
        </div>

      </div>

      <footer class="site-footer">
        <div class="footer-inner">FOOTER</div>
      </footer>
    </main>
  </div>

  <script>
    // Carousel navigation
    document.querySelectorAll('.carousel').forEach(function(carousel){
      var list = carousel.querySelector('.list');
      var left = carousel.querySelector('.nav.left');
      var right = carousel.querySelector('.nav.right');

      function updateArrows(){
        left.classList.toggle('disabled', list.scrollLeft <= 0);
        right.classList.toggle('disabled', Math.ceil(list.scrollLeft + list.clientWidth) >= list.scrollWidth);
      }

      left.addEventListener('click', function(){
        if (!left.classList.contains('disabled')) list.scrollBy({left: -260, behavior: 'smooth'});
        setTimeout(updateArrows, 250);
      });
      right.addEventListener('click', function(){
        if (!right.classList.contains('disabled')) list.scrollBy({left: 260, behavior: 'smooth'});
        setTimeout(updateArrows, 250);
      });

      // update on scroll
      list.addEventListener('scroll', updateArrows);
      window.addEventListener('resize', updateArrows);
      updateArrows();
    });

    // simple search interaction (filter captions)
    document.getElementById('search').addEventListener('input', function(e){
      var q = e.target.value.trim().toLowerCase();
      document.querySelectorAll('.carousel .item').forEach(function(item){
        var txt = (item.querySelector('.caption') || {}).textContent || '';
        item.style.display = (!q || txt.toLowerCase().includes(q)) ? '' : 'none';
      });
    });

    // view button demo
    document.querySelectorAll('.view-btn').forEach(function(b){
      b.addEventListener('click', function(){
        alert('View: ' + (this.parentElement.querySelector('.caption')?.textContent || 'item'));
      });
    });
  </script>
</body>
</html>