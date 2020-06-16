
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv='content-type' content='text/html;charset=utf-8' />
    <title>Login</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel='stylesheet' href='style.css'>
    <style>
        body{
            background-color: #86cfda;
        }
        h3{
            font-size: 25px;
        }
        label{
            font-size: 18px;
        }
    </style>
</head>
<body>
<nav class="navbar navbar-expand-sm bg-light navbar-light">
    <ul class="navbar-nav">
        <li class="nav-item ">
            <a class="nav-link" href="<?php echo base_url()?>index.php/welcome/home/">Home</a>
        </li>
        <li class="nav-item active">
            <a class="nav-link" href="<?php echo base_url()?>index.php/welcome/login/">Login</a>
        </li>
        <li class="nav-item ">
            <a class="nav-link" href="<?php echo base_url()?>index.php/welcome/">Table</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="<?php echo base_url()?>index.php/welcome/create_new_user/">Create new user</a>
        </li>
        <?php if (!empty($_SESSION['uname'])){ ?>
            <li class="nav-item">
                <a class="nav-link" name="exit" href="<?php echo base_url()?>index.php/welcome/exit_welcome/">Exit</a>
            </li>
        <?php } ?>
    </ul>
</nav>

<div class="container">
    <h3 class="text-center">Login</h3>
    <?php if(!empty($error)){ echo $error;}?>
    <form action="" method="post">
        <div class="form-group">
            <label for="username">Login:</label>
            <input type="text" class="form-control" id="username" name="username" placeholder="Введите логин" required>
        </div>
        <div class="form-group">
            <label for="pwd">Password:</label>
            <input type="password" class="form-control" id="pwd" name="password" placeholder="Введите пароль" required>
        </div>
        <div><input type="submit" name="submit" value="Submit" class="btn btn-default"></div>
    </form>
</div>

</body>
</html>


