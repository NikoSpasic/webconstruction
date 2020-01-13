<nav class="navbar navbar-expand-lg navbar-dark bg-secondary mb-3">
  <div class="container">
    <a href="<?= URLROOT ?>" class="navbar-brand"><img src="<?= URLROOT ?>/images/logo1.png" width="80" height="80"></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarsExampleDefault">

        <ul class="navbar-nav mr-auto">
          <li class="nav-item">
            <a class="nav-link" href="<?= URLROOT ?>">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?= URLROOT ?>/pages/about">About</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?= URLROOT ?>/pages/contact">Contact</a>
          </li>

          <?php if(isset($_SESSION['user_id'])) : ?>
            
            <li class="nav-item">
              <a class="nav-link" href="<?= URLROOT ?>/todos">MyToDoList</a>
            </li>

            <li class="nav-item">
              <a class="nav-link" href="<?= URLROOT ?>/users/logout">LogOut</a>
            </li>

          <?php endif ?>

        </ul>

        <ul class="navbar-nav ml-auto">

        <?php if(isset($_SESSION['user_id'])) : ?>
          
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
               <i class="fa fa-user"></i> <?= $_SESSION['user_first_name'] ?>
            </a>
            <div class="dropdown-menu" aria-labelledby="dropdown01">
              <a class="dropdown-item" href="<?= URLROOT ?>/todos">MyToDo</a>
              <a class="dropdown-item" href="<?= URLROOT ?>/users/logout">Logout</a>
            </div>
          </li>

        <?php else : ?>
          <li class="nav-item">
            <a class="nav-link" href="<?= URLROOT ?>/users/register">Register</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?= URLROOT ?>/users/login">Login</a>
          </li>
        <?php endif; ?>

        </ul>

    </div>
  </div>
</nav>