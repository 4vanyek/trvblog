<?php
     require_once '../../functions/helpers.php';
     require_once '../../functions/pdo_connection.php';
     ?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>trv::blog Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="<?= asset('assets/css/style.css') ?>" media="all" type="text/css">
    <link href="../dashboard.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
</head>
<body>
<section id="app">
<?php require_once "../layouts/top-nav.php"?>
<section class="container-fluid">
    <section class="row">
        <section class="col-md-2 p-0">

        <?php require_once '../layouts/sidebar.php'; ?>

        </section>
        <section class="col-md-10 pb-3">

            <section style="min-height: 80vh;" class="d-flex justify-content-center align-items-center">
                <section>
                    <h1 class="fs-1 fw-light">About trv::blog Dashboard</h1>
                    <h5 class="fw-light">
                        trv::blog Dashboard is a heavily modified version of 
                        <a target="_blank" href="https://github.com/MobinaJafarian/BitBlog">Bit Blog</a> Panel, 
                        developed by 
                        <a target="_blank" href="https://github.com/4vanyek">therealvanyek</a>. 
                    </h5>
                    <h6 class="fw-light">Well, nobody usually reads this, so why am I writing this?</h6>
                    <br>
                    
                </section>
            </section>
        </section>
    </section>
</section>
</section>
<script src="<?= asset('./assets/js/jquery.min.js') ?>"></script>
<script src="<?= asset('./assets/js/bootstrap.min.js') ?>"></script>
</body>
</html>