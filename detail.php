<?php
     require_once 'functions/helpers.php';
     require_once 'functions/pdo_connection.php';

     ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>trv::blog</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="<?= asset('assets/css/style.css') ?>" media="all" type="text/css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
</head>
<body>
<section id="app">
<?php require_once "layouts/top-nav.php"?>

    <section class="container my-5">
        <!-- Example row of columns -->
        <section class="row">
            <section class="col-md-12">

            <?php 

             //check for exist post 
        $query = "SELECT posts.*, categories.name AS category_name FROM posts JOIN categories ON posts.cat_id = categories.id WHERE posts.id = ? AND posts.status = 10 ;";
        $statement = $pdo->prepare($query);
        $statement->execute([$_GET['post_id']]);
        $post = $statement->fetch();
        if ($post !== false) {
            ?>

                <h1><?= $post->title ?></h1>
                <h5 class="d-flex justify-content-between align-items-center">
                    <a href="<?= url('category.php?cat_id=') . $post->cat_id ?>"><?= $post->category_name ?></a>
                    <span class="date-time"><?= $post->created_at ?></span>
                </h5>
                <article class="bg-article p-3 rounded-2"><img class="float-end mb-2 ml-2 rounded-2" style="width: 18rem;" src="<?= asset($post->image) ?>" alt=""><?= $post->body ?></article>
                <?php
        } else{ ?>
            
                    <section>Пост не найден!</section>
                    <?php } ?>
             
            </section>
        </section>
    </section>

</section>
<script src="<?= asset('assets/js/jquery.min.js') ?>"></script>
<script src="<?= asset('assets/js/bootstrap.min.js') ?>"></script>
</body>
</html>