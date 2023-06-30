<?php
     require_once '../../functions/helpers.php';
     require_once '../../functions/pdo_connection.php';
     require_once '../../functions/auth.php';


        if(!isset($_GET['post_id']))
        {
            redirect('panel/post');
        }

        //check for exist post 
        $query = "SELECT * FROM posts WHERE id = ?;";
        $statement = $pdo->prepare($query);
        $statement->execute([$_GET['post_id']]);
        $post = $statement->fetch();
        if($post === false)
        {
             redirect('panel/post');
        }

        if(isset($_POST['title']) && $_POST['title'] !== ''
         && isset($_POST['cat_id']) && $_POST['cat_id'] !== ''
         && isset($_POST['body']) && $_POST['body'] !== '') 
        {

            $query = "SELECT * FROM categories WHERE id = ?;";
            $statement = $pdo->prepare($query);
            $statement->execute([$_POST['cat_id']]);
            $category = $statement->fetch();


            if(isset($_FILES['image']) && $_FILES['image']['name'] !== '')
            {
                $allowedMimes = ['png', 'jpg', 'gif', 'jpeg'];
                $imageMime = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
                if(!in_array($imageMime, $allowedMimes))
                {
                     redirect('panel/post');
                }
                $basePath = dirname(dirname(__DIR__));
                if(file_exists($basePath . $post->image))
                {
                    unlink($basePath . $post->image);
                }
                $image = '/assets/images/posts/' . date('Y_m_d_H_i_s') . '.' . $imageMime;
                $image_upload = move_uploaded_file($_FILES['image']['tmp_name'], $basePath . $image);
                if($category !== false && $image_upload !== false)
                {
                    $query = "UPDATE posts SET title = ?, cat_id = ?, body = ?, image = ?, updated_at = NOW() WHERE id = ? ;";
                    $statement = $pdo->prepare($query);
                   $statement->execute([$_POST['title'], $_POST['cat_id'], $_POST['body'], $image, $_GET['post_id']]);
                }

            }
            else{

                if($category !== false)
                {
                    $query = "UPDATE posts SET title = ?, cat_id = ?, body = ?, updated_at = NOW() WHERE id = ? ;";
                    $statement = $pdo->prepare($query);
                   $statement->execute([$_POST['title'], $_POST['cat_id'], $_POST['body'], $_GET['post_id']]);
                }

            }

            redirect('panel/post');

        }


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

    <?php require_once '../layouts/top-nav.php'; ?>



        <section class="container-fluid">
            <section class="row">
                <section class="col-md-2 p-0">
                <?php require_once '../layouts/sidebar.php'; ?>

                </section>
                <section class="col-md-10 pt-3">

                    <form action="<?= url('panel/post/edit.php?post_id=') . $_GET['post_id'] ?>" method="post" enctype="multipart/form-data">
                        <section class="form-floating mb-1">
                            <input type="text" class="form-control" name="title" placeholder="Title" id="title" value="<?=  $post->title ?>">
                            <label for="title">Title</label>
                        </section>
                        <section class="form-floating mb-1">
                            <input type="file" class="form-control" name="image" id="image">
                            <label for="image">Image</label>
                            <!-- <img src="<?= asset( $post->image ) ?>" alt="" width="150" height="150"> -->
                        </section>
                        <section class="form-floating">
                        <select class="form-select" id="cat_id" name="cat_id" aria-label="Floating label select example">
    <?php
        $query = "SELECT * FROM categories;";
        $statement = $pdo->prepare($query);
        $statement->execute();
        $categories = $statement->fetchAll();
        foreach ($categories as $category) {
            ?>
            <option value="<?= $category->id ?>" <?php if ($category->id == $post->cat_id) echo 'selected' ?>>
                <?= $category->name ?>
            </option>
            <?php
        }
    ?>
</select>
                        <label for="cat_id">Category</label>
                        </section>
                        <section class="form-group">
                            <label for="body">Body</label>
                            <textarea class="form-control" name="body" id="body" rows="5"><?= $post->body ?></textarea>
                        </section>
                        <section class="form-group">
                            <button type="submit" class="btn btn-primary btn-sm mt-2 mb-2">Update</button>
                        </section>
                    </form>

                </section>
            </section>
        </section>

    </section>

    <script src="<?= asset('assets/js/jquery.min.js') ?>"></script>
    <script src="<?= asset('assets/js/bootstrap.min.js') ?>"></script>
    <script src="<?= asset('assets/ckeditor/ckeditor.js') ?>"></script>
    <script type="text/javascript">
        CKEDITOR.replace('body')
    </script>
</body>

</html>