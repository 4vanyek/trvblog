<?php
     require_once '../functions/helpers.php';
     require_once '../functions/auth.php';
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>trv::blog Dashboard</title>
    <link href="sidebars.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="<?= asset('assets/css/style.css') ?>" media="all" type="text/css">
    <link href="dashboard.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
</head>
<body>
<section id="app">

     <?php require_once 'layouts/top-nav.php'; ?>

    <section class="container-fluid">
        <section class="row">
            <section class="col-md-2 p-0">

            <?php require_once 'layouts/sidebar.php'; ?>

            </section>
            <section class="col-md-10 pb-3">

                <section style="min-height: 80vh;" class="d-flex justify-content-center align-items-center">
                    <section>
                        <h1 class="fs-1 fw-light">trv::blog</h1>
                        <h5 class="fw-light">Welcome to trv::blog Dashboard! You can find some useful links down here, to help you manage trv::blog:</h5>
                        <br>
                        <h2 class="fw-light">Useful Links:</h2>
                        <div class="accordion" id="accordionExample">
  <div class="accordion-item">
    <h2 class="accordion-header">
      <button class="accordion-button fw-light collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
        General
      </button>
    </h2>
    <div id="collapseOne" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
      <div class="accordion-body">
        <a class="btn btn-primary" href="<?= url('/') ?>" role="button"><i class="fa-solid fa-house"></i>&nbsp;&nbsp;Go to Homepage</a>
      </div>
    </div>
  </div>
  <div class="accordion-item">
    <h2 class="accordion-header">
      <button class="accordion-button fw-light collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
        Posts
      </button>
    </h2>
    <div id="collapseTwo" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
      <div class="accordion-body">
      <div class="btn-group">
                        <a class="btn btn-primary" href="<?= url('panel/post/create.php') ?>" role="button">
                            <i class="fa-solid fa-plus"></i>&nbsp;&nbsp;Create a post
                        </a>
                        <a class="btn btn-outline-primary" href="<?= url('panel/post/') ?>" role="button">
                        <i class="fa-solid fa-table-list"></i>&nbsp;&nbsp;View all posts
                        </a>
                        </div>
      </div>
    </div>
  </div>
  <div class="accordion-item">
    <h2 class="accordion-header">
      <button class="accordion-button fw-light collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
        Categories
      </button>
    </h2>
    <div id="collapseThree" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
      <div class="accordion-body">
      <div class="btn-group">
      <a class="btn btn-primary" href="<?= url('panel/category/create.php') ?>" role="button">
        <i class="fa-solid fa-folder-plus"></i>&nbsp;&nbsp;Create a category</a>
      <a class="btn btn-outline-primary" href="<?= url('panel/category/') ?>" role="button">
        <i class="fa-solid fa-tags"></i>&nbsp;&nbsp;View all categories</a>
      </div>
    </div>
    </div>
  </div>
  <div class="accordion-item">
    <h2 class="accordion-header">
      <button class="accordion-button fw-light collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseThree">
        Server
      </button>
    </h2>
    <div id="collapseFour" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
      <div class="accordion-body">
        <a class="btn btn-primary" href="<?= url('../phpmyadmin') ?>" role="button">
            <i class="fa-brands fa-php"></i>&nbsp;&nbsp;Go to phpMyAdmin
            </a>
      </div>
    </div>
  </div>
  <div class="accordion-item">
    <h2 class="accordion-header">
      <button class="accordion-button fw-light collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFive" aria-expanded="false" aria-controls="collapseThree">
        Account
      </button>
    </h2>
    <div id="collapseFive" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
      <div class="accordion-body">
        <a class="btn btn-primary" href="<?= url('auth/logout.php') ?>" role="button">
            <i class="fa-solid fa-right-from-bracket"></i>&nbsp;&nbsp;Sign out
            </a>
      </div>
    </div>
  </div>
</div>
                    </section>
                </section>

            </section>
        </section>
    </section>


</section>

<script src="<?= asset('assets/js/jquery.min.js') ?>"></script>
<script src="<?= asset('assets/js/bootstrap.min.js') ?>"></script>
</body>
</html>