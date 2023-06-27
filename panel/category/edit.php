<?php

require_once '../../functions/helpers.php';
require_once '../../functions/pdo_connection.php';
require_once '../../functions/auth.php';


     if(!isset($_GET['cat_id'])){
          redirect('panel/category');
     }

     //check for exist cat_id
     $query = "SELECT * FROM categories WHERE id = ?;";
     $statement = $pdo->prepare($query);
     $statement->execute([$_GET['cat_id']]);
     $category = $statement->fetch();
     if($category === false)
     {
          redirect('panel/category');
     }

     if(isset($_POST['name']) && $_POST['name'] !== '')
     
     {
          $query = "UPDATE categories SET name = ?, updated_at = NOW() WHERE id = ?";
          $statement = $pdo->prepare($query);
          $statement->execute([$_POST['name'], $_GET['cat_id']]);
          redirect('panel/category');
     }



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

                <form action="edit.php?cat_id=<?= $_GET['cat_id'] ?>" method="post">
                    <section class="form-group">
                        <label for="name">Имя</label>
                        <input type="text" class="form-control" name="name" id="name" value="<?= $category->name ?>">
                    </section>
                    <section class="form-group">
                        <button type="submit" class="btn btn-primary mt-2">Обновить</button>
                    </section>
                </form>

            </section>
        </section>
    </section>

</section>

<script src="<?= asset('assets/js/jquery.min.js') ?>"></script>
<script src="<?= asset('assets/js/bootstrap.min.js') ?>"></script>
</body>
</html>