<nav role="navigation" class="navbar navbar-expand-lg navbar-dark bg-dark md-3">
  <div class="container">
  
    <a class="navbar-brand font" href="<?php echo APP_PATH ?>"></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
      <div class="collapse navbar-collapse" id="navbarNavDropdown">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link font" href="<?php echo ROOT ?>" > Home <span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item">
            <a class="nav-link font" href="<?php ROOT ?>/pages/about">About Me</a>
          </li>
        </ul>

        <ul class="navbar-nav ml-auto">
          <?php if(isset($_SESSION['user_id'])) : ?>
            <li class="nav-item">
              <a class="nav-link font" href="<?php echo ROOT ?>/users/logout">Logout<span class="sr-only">(current)</span></a>
            </li>
          <?php else: ?>
            <li class="nav-item">
              <a class="nav-link" href="<?php echo ROOT ?>/users/register">Register<span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="<?php echo ROOT ?>/users/login">Login</a>
            </li>
          <?php endif; ?>
        </ul>

      </div>
    
    </div>
</nav>