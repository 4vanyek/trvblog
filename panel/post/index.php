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
    <title>trv::blog Dashboard</title>
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
                    <h2 class="fw-light">Posts</h2>
                    <a href="<?= url('panel/post/create.php') ?>" class="btn px-3 btn-success">Create a post&nbsp;&nbsp;<i class="fa-solid fa-plus"></i></a>
                </section>

                <section class="table-responsive">
                    <form method="post" action="">
                        <button type="submit" name="reverse_sort" class="btn btn-primary">Reverse Sort</button>
                    </form>
                    <table class="table table-striped table-">
                        <thead>
                        <tr>
                            <th>№</th>
                            <th>Image</th>
                            <th>Title</th>
                            <th>Category</th>
                            <th>Status</th>
                            <th>Setting</th>
                        </tr>
                        </thead>
                        <tbody>
<?php 

if(isset($_POST['reverse_sort'])) {
    if(isset($_SESSION['sort_order']) && $_SESSION['sort_order'] == 'DESC') {
        $_SESSION['sort_order'] = 'ASC';
    } else {
        $_SESSION['sort_order'] = 'DESC';
    }
}

if(isset($_SESSION['sort_order']) && $_SESSION['sort_order'] == 'DESC') {
    $query = "SELECT posts.*, categories.name AS category_name FROM posts LEFT JOIN categories ON posts.cat_id = categories.id ORDER BY posts.id DESC;";
} else {
    $query = "SELECT posts.*, categories.name AS category_name FROM posts LEFT JOIN categories ON posts.cat_id = categories.id;";
}

$statement = $pdo->prepare($query);
$statement->execute();
$posts = $statement->fetchAll();

$posts_count = count($posts); // Count the total posts for reverse numbering

foreach ($posts as $key => $post) {
    // Table rows
    ?>
    <tr>
        <td><?= $posts_count - $key ?></td> <!-- Reverse numbering -->
        <td><img class="rounded-2" style="width: 90px;" src="<?= asset( $post->image) ?>"></td>
        <td class="fw-light"><?= $post->title ?></td>
        <td class="fw-light"><?= isset($post->category_name) ? $post->category_name : '' ?></td>
        <td>
            <?php if($post->status == 10) { ?>
                <span class="text-success fw-light">Active</span>
            <?php } else { ?>
                <span class="text-danger fw-light">Inactive</span>
            <?php } ?>
        </td>
        <td>
            <div class="btn-group">
                <a href="<?= url('panel/post/change-status.php?post_id=' . $post->id) ?>" class="btn btn-block btn-warning px-2">Change status&nbsp;&nbsp;<i class="fa-solid fa-toggle-on"></i></a>
                <a href="<?= url('panel/post/edit.php?post_id=' . $post->id) ?>" class="btn btn-block btn-info px-2">Edit&nbsp;&nbsp;<i class="fa-solid fa-pen"></i></a>
                <a href="<?= url('panel/post/delete.php?post_id=' . $post->id) ?>" class="btn btn-block btn-danger px-2">Delete&nbsp;&nbsp;<i class="fa-solid fa-trash"></i></a>
            </div>
        </td>
    </tr>
    <?php }
 ?>

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