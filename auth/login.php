<?php
session_start();
     require_once '../functions/helpers.php';
     require_once '../functions/pdo_connection.php';

     $error = '';
     if(isset($_POST['email']) && $_POST['email'] !== ''
         && isset($_POST['password']) && $_POST['password'] !== '') 
         {

            $query = "SELECT * FROM users WHERE email = ?;";
            $statement = $pdo->prepare($query);
            $statement->execute([$_POST['email']]);
            $user = $statement->fetch();
            if($user !== false)
            {
                    if(password_verify($_POST['password'], $user->password))
                    {
                            $_SESSION['user'] =  $user->email;
                            redirect('panel');
                    }
                    else{
                        $error = 'Password is wrong';
                    }
            }
            else{
                $error = 'Email is wrong';
            }

         }
         else{
            if(!empty($_POST))
            $error = 'All fields are required';
        }

     ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>trv::blog Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="<?= asset('assets/css/style.css') ?>" media="all" type="text/css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
</head>

<body>
    <section id="app">

        <section style="height: 100vh; background-color: #7c2ddb;" class="d-flex justify-content-center align-items-center">
            <section style="width: 20rem;">
                <h2 class="text-center text-white m-4">Welcome back!</h2>
                <h1 class="bg-light rounded-top px-3 mb-0 py-3 h5">trv::blog Login</h1>
                <section class="bg-light my-0 px-2">
                <small class="text-danger"><?php if ($error !== '') echo $error; ?></small>

                </section>
                <form class="pb-1 p-1 px-2 bg-white rounded-bottom" action="<?= url('auth/login.php') ?>" method="post">
                    <section class="form-floating mb-1">
                        <input type="email" class="form-control" name="email" id="email" placeholder="Email Address">
                        <label for="email">Email address</label>
                    </section>
                    <section class="form-floating">
                        <input type="password" class="form-control" name="password" id="password" placeholder="Password">
                        <label for="password">Password</label>
                    </section>
                    <section class="d-grid gap-2">
                        <button type="submit" class="btn btn-primary mt-2 mb-1 btn-lg">Login&nbsp;<i class="fa-solid fa-right-to-bracket"></i></button>
                        <!-- <a class="" href="<?= url('auth/register.php') ?>">Register</a> -->
                    </section>
                </form>
            </section>
        </section>

    </section>
    <script src="<?= asset('assets/js/jquery.min.js') ?>"></script>
<script src="<?= asset('assets/js/bootstrap.min.js') ?>"></script>
</body>

</html>