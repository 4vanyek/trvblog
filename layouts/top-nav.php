<?php
session_start();
?>
<nav class="navbar navbar-expand-lg bg-dark border-bottom border-bottom-dark sticky-top" data-bs-theme="dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="<?= url('panel') ?>">trv::blog</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarText">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link" href="<?= url('index.php') ?>">Главная <span class="sr-only ">(current)</span></a>
                </li>

                <?php 
                $query = "SELECT * FROM categories;";
                $statement = $pdo->prepare($query);
                $statement->execute();
                $categories = $statement->fetchAll();
                
                foreach ($categories as $category) { ?>
                <li class="nav-item ">
                    <a class="nav-link " href="<?= url('category.php?cat_id=') . $category->id ?>"><?= $category->name ?></a>
                </li>
            </ul>
            <?php } ?>

            <?php 
            if (!isset($_SESSION['user'])) {
                    ?>
            <!-- <a class="text-decoration-none px-2 " href="<?= url('auth/register.php') ?>">Register</a> -->
            <div class="dropdown">
  <button type="button" class="btn btn-secondary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false" data-bs-auto-close="outside">
    Вход
  </button>
  <form class="dropdown-menu dropdown-menu-end p-4" style="width: 20vw !important;" action="<?= url('auth/login.php') ?>" method="post">
    <div class="mb-3">
      <label for="email" class="form-label">Email address</label>
      <input type="email" class="form-control" name="email" id="email" placeholder="email@example.com">
    </div>
    <div class="mb-3">
      <label for="password" class="form-label">Password</label>
      <input type="password" class="form-control" name="password" id="password" placeholder="Password">
    </div>
    <button type="submit" class="btn btn-primary px-3">Sign in</button>
  </form>
</div>
            <!-- <a class="btn btn-outline-secondary text-decoration-none px-3" href="<?= url('auth/login.php') ?>" role="button">Вход администратора&nbsp;&nbsp;<i class="fa-solid fa-right-to-bracket"></i></a> -->
            <?php
                   } else { ?>

            <a class="btn btn-secondary text-decoration-none px-3" href="<?= url('auth/logout.php') ?>" role="button">Выйти&nbsp;&nbsp;<i class="fa-solid fa-right-from-bracket"></i></a>

            <?php } ?>
        </div>
    </div>
</nav>