
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel='stylesheet' href='style.css'>
    <style>
        body{
            background-color: #86cfda;
        }
         label{
             font-size: 18px;
         }


    </style>
    <title>Create a new user</title>
</head>
<body>

<nav class="navbar navbar-expand-sm bg-light navbar-light">
    <ul class="navbar-nav">
        <li class="nav-item ">
            <a class="nav-link" href="<?php echo base_url()?>index.php/welcome/home/">Home</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="<?php echo base_url()?>index.php/welcome/login/">Login</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="<?php echo base_url()?>index.php/welcome/">Table</a>
        </li>
        <li class="nav-item active">
            <a class="nav-link" href="<?php echo base_url()?>index.php/welcome/create_new_user/">Create new user</a>
        </li>
        <?php if (!empty($_SESSION['uname'])){ ?>
            <li class="nav-item">
                <a class="nav-link" name="exit" href="<?php echo base_url()?>index.php/welcome/exit_welcome/">Exit</a>
            </li>
        <?php } ?>
    </ul>
</nav>



<?php echo form_open('form'); ?>

<div class="container">
    <h3 class="text-center">Create a new user</h3>
        <div class="form-group">
            <label for="username">Name:</label>
            <?php echo form_error('username'); ?>

            <input type="text" class="form-control" value="<?php echo set_value('username'); ?>"  name="username" placeholder="Введите имя" required>
        </div>
    <div class="form-group">
        <label for="email">Email:</label>
        <?php echo form_error('email'); ?>

        <input type="text" class="form-control" value="<?php echo set_value('email'); ?>"  name="email" placeholder="Введите email" required>
    </div>
    <div class="form-group">
        <label for="task">Task:</label>
        <?php echo form_error('task'); ?>

        <input type="text" class="form-control" value="<?php echo set_value('task'); ?>"  name="task" placeholder="Введите задачу" required>
    </div>
    <div class="form-group">
        <label for="status">Status:</label>
        <?php echo form_error('status'); ?>

        <input type="text" class="form-control" value="<?php echo set_value('status'); ?>"  name="status" placeholder="Введите статус пользователя" required>
    </div>

         <input type="submit" name="submit" value="Submit" class="btn btn-default">
</div>

</form>

</body>
</html>



