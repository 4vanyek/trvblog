<?php
     require_once '../../functions/helpers.php';
     require_once '../../functions/pdo_connection.php';
     require_once '../../functions/auth.php';

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>PHP panel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="<?= asset('assets/css/style.css') ?>" media="all" type="text/css">
    <link href="../dashboard.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
</head>
<body>
<section id="app">
<?php require_once '../layouts/top-nav.php'; ?>


    <section class="container-fluid">
        <section class="row">
            <section class="col-md-2 p-0">
            <?php require_once '../layouts/sidebar.php'; ?>

            </section>
            <section class="col-md-10 pt-3">

                <section class="mb-2 d-flex justify-content-between align-items-center">
                    <h2 class="fw-light">Статьи</h2>
                    <a href="<?= url('panel/post/create.php') ?>" class="btn px-3 btn-success">Создать&nbsp;&nbsp;<i class="fa-solid fa-plus"></i></a>
                </section>

                <section class="table-responsive">
                    <table class="table table-striped table-">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Изображение</th>
                            <th>Имя</th>
                            <th>Категория</th>
                            <th>Тело</th>
                            <th>Статус</th>
                            <th>Настройка</th>
                        </tr>
                        </thead>
                        <tbody>

                        <?php
                        $query = "SELECT posts.*, categories.name AS category_name FROM posts LEFT JOIN categories ON posts.cat_id = categories.id;";
                         $statement = $pdo->prepare($query);
                         $statement->execute();
                         $posts = $statement->fetchAll();
                         foreach ($posts as $key => $post) { ?>
                            <tr>
                                <td><?= $key += 1 ?></td>
                                <td><img class="rounded-2" style="width: 90px;" src="<?= asset( $post->image) ?>"></td>
                                <td class="fw-light"><?= $post->title ?></td>
                                <td class="fw-light"><?= $post->category_name ?></td>
                                <td class="fw-light"><?= substr($post->body, 0, 30)  ?></td>
                                <td>
                                     <?php if($post->status == 10) { ?>
                                     <span class="text-success fw-light">Активный</span>
                                     <?php } else { ?>
                                      <span class="text-danger fw-light">Неактивный</span>
                                      <?php } ?>
                                   </td>
                                <td>
                                    <a href="<?= url('panel/post/change-status.php?post_id=' . $post->id) ?>" class="btn btn-block btn-warning px-2">Изменить статус&nbsp;&nbsp;<i class="fa-solid fa-toggle-on"></i></a>
                                    <a href="<?= url('panel/post/edit.php?post_id=' . $post->id) ?>" class="btn btn-block btn-info px-2">Редактировать&nbsp;&nbsp;<i class="fa-solid fa-pen"></i></a>
                                    <a href="<?= url('panel/post/delete.php?post_id=' . $post->id) ?>" class="btn btn-block btn-danger px-2">Удалить&nbsp;&nbsp;<i class="fa-solid fa-trash"></i></a>
                                </td>
                            </tr>
                            <?php } ?>


                        </tbody>
                    </table>
                </section>


            </section>
        </section>
    </section>





</section>

<script src="<?= asset('assets/js/jquery.min.js') ?>"></script>
<script src="<?= asset('assets/js/bootstrap.min.js') ?>"></script>
</body>
</html>