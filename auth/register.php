<?php
     require_once '../functions/helpers.php';
     require_once '../functions/pdo_connection.php';

    $error = '';
     if(isset($_POST['email']) && $_POST['email'] !== ''
         && isset($_POST['first_name']) && $_POST['first_name'] !== ''
         && isset($_POST['last_name']) && $_POST['last_name'] !== ''
         && isset($_POST['password']) && $_POST['password'] !== ''
         && isset($_POST['confirm']) && $_POST['confirm'] !== '') 
         {

            if($_POST['password'] === $_POST['confirm'])
            {
                if(strlen($_POST['password']) > 5)
                {
                    $query = "SELECT * FROM users WHERE email = ?;";
                    $statement = $pdo->prepare($query);
                    $statement->execute([$_POST['email']]);
                    $user = $statement->fetch();
                    if($user === false)
                    {
                        $query = "INSERT INTO users SET email = ?, first_name = ?, last_name = ?, password = ?, created_at = NOW() ;";
                        $statement = $pdo->prepare($query);
                        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
                        $statement->execute([$_POST['email'], $_POST['first_name'], $_POST['last_name'], $password]);
                        redirect('auth/login.php');
                    }
                    else{
                        $error = 'This email already exists';
                    
                    }
                }
                else{
                    $error ='Password must be more than 5 characters';
                }

            }
            else{
                $error = 'Password does not match the certificate';
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
    <title>trv::blog</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="<?= asset('assets/css/style.css') ?>" media="all" type="text/css">
</head>

<body>
    <section id="app">

        <section style="height: 100vh; background-color: #7c2ddb;" class="d-flex justify-content-center align-items-center">
            <section style="width: 20rem;">
                <h1 class="bg-light rounded-top px-3 mb-0 py-3 h5">trv::blog Register</h1>
                <section class="bg-light my-0 px-2">
                    <small class="text-danger"><?php if ($error !== '') echo $error; ?></small>
                </section>
                <form class="p-3 pb-1 px-2 bg-white rounded-bottom" action="<?= url('auth/register.php') ?>" method="post">
                    <p style="margin-bottom: 0;">Registration is disabled</p>
                    <!-- <section class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" name="email" id="email" placeholder="Email Address">
                    </section>
                    <section class="form-group">
                        <label for="first_name">First Name</label>
                        <input type="text" class="form-control" name="first_name" id="first_name" placeholder="First Name">
                    </section>
                    <section class="form-group">
                        <label for="last_name">Last Name</label>
                        <input type="text" class="form-control" name="last_name" id="last_name" placeholder="Last Name">
                    </section>
                    <section class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" name="password" id="password" placeholder="Password">
                    </section>
                    <section class="form-group">
                        <label for="confirm">Confirm</label>
                        <input type="password" class="form-control" name="confirm" id="confirm" placeholder="Confirm Password">
                    </section> -->
                    <section class="d-flex align-items-center justify-content-between">
                        <!-- <input type="submit" class="btn btn-success btn-sm" value="Register"> -->
                        <a class="btn btn-primary btn-block btn-sm" href="<?= url('auth/login.php') ?>">Go to Login</a>
                    </section>
                </form>
            </section>
        </section>

    </section>
    <script src="<?= asset('assets/js/jquery.min.js') ?>"></script>
<script src="<?= asset('assets/js/bootstrap.min.js') ?>"></script>
</body>

</html>