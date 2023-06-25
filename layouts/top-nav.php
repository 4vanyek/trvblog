<?php
session_start();
?>
<nav class="navbar navbar-expand-lg sticky-top navbar-light bg-light bg-gradient">

    <a class="navbar-brand " href="<?= url('panel') ?>">trv::blog</a>
    <button class="navbar-toggler " type="button " data-toggle="collapse " data-target="#navbarSupportedContent " aria-controls="navbarSupportedContent " aria-expanded="false " aria-label="Toggle navigation ">
        <span class="navbar-toggler-icon "></span>
    </button>

    <div class="collapse navbar-collapse " id="navbarSupportedContent ">
        <ul class="navbar-nav mr-auto ">
            <li class="nav-item active ">
                <a class="nav-link " href="<?= url('index.php') ?>">Главная <span class="sr-only ">(current)</span></a>
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

            <?php } ?>

        </ul>
    </div>

    <section class="d-inline ">

                <?php 
                if (!isset($_SESSION['user'])) {
                    ?>
        <!-- <a class="text-decoration-none px-2 " href="<?= url('auth/register.php') ?>">Register</a> -->
        <a class="btn btn-outline-primary text-decoration-none px-3" href="<?= url('auth/login.php') ?>" role="button">Вход администратора&nbsp;&nbsp;<i class="fa-solid fa-right-to-bracket"></i></a>
        <?php
                } else { ?>

        <a class="btn btn-outline-primary text-decoration-none px-3" href="<?= url('auth/logout.php') ?>" role="button">Выйти&nbsp;&nbsp;<i class="fa-solid fa-right-from-bracket"></i></a>

        <?php } ?>

    </section>
</nav>