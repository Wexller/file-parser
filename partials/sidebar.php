<nav class="col-md-2 d-none d-md-block bg-light sidebar">
  <div class="sidebar-sticky">
    <ul class="nav flex-column">
      <li class="nav-item">
        <a class="nav-link <?= $_SERVER['REQUEST_URI'] === '/'
          ? ' active' : ''?>" href="/">
          <span data-feather="home"></span>
          График операций
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link<?= $_SERVER['REQUEST_URI'] === '/build_chart.php'
          ? ' active' : ''?>" href="/build_chart.php">
          <span data-feather="file"></span>
          Построить график
        </a>
      </li>
    </ul>
  </div>
</nav>