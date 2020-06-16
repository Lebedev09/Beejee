<html lang="en" xmlns="http://www.w3.org/1999/html">
<head>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <meta http-equiv="refresh" content="60">

    <style>
        .pagination {
            display: inline-block;
            margin: 10px auto;
        }

        .pagination a {
            color: black;
            float: left;
            padding: 8px 16px;
            text-decoration: none;
        }

        .pagination a.active {
            background-color: #4CAF50;
            color: white;
            border-radius: 5px;
        }

        .pagination a:hover:not(.active) {
            background-color: #ddd;
            border-radius: 5px;
        }
        .container{
            font-size: 18px;
        }
        table{
            font-size: 18px;
        }
        .text-monospace{
            margin-left: 23px;
        }
        a{
            text-decoration: none !important;
        }

    </style>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">


    <title>Beejee</title>
    <style>
        body {
            background-image: url("https://images5.alphacoders.com/717/717785.jpg");
        }
    </style>


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
        <li class="nav-item active">
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

<?php
if (!empty($_SESSION['uname'])) { ?>
    <?php echo "<p class=\"text-monospace\">WELCOME"." ".$_SESSION['uname']."</p>"; ?>
<?php } ?>


<div class="container">
    <table class="table table-hover table-dark">
        <thead>
              <tr>
              <td scope="col"><?php
                       if (!empty($_GET['order']) && !empty($_GET['sort_by']) && $_GET['sort_by']=="name" && $_GET['order']=="asc" ){
                           $order = "desc";
                       }else{
                           $order = "asc";
                       }
                       if (empty($_GET['page_num'])){
                           $_GET['page_num'] = 0;
                       }


                  ?>
                  <a id="name" href='<?php echo base_url()?>index.php/welcome/?sort_by=name&order=<?php echo $order?>&page_num=<?php echo $_GET['page_num']?>'>Name</a>
              </td>
              <td scope="col">
                  <?php
                  if (!empty($_GET['order']) && !empty($_GET['sort_by']) && $_GET['sort_by']=="email" && $_GET['order']=="asc"){
                      $order = "desc";
                  }else{
                      $order = "asc";
                  }
                  if (empty($_GET['page_num'])){
                      $_GET['page_num'] = 0;
                  }

                  ?>
              <a href='<?php echo base_url()?>index.php/welcome/?sort_by=email&order=<?php echo $order ?>&page_num=<?php echo $_GET['page_num']?>'>Email</a>
              </td>
              <td>
              Task
              </td scope="col">
              <td>
                  <?php if (!empty($_GET['sort_by']) && !empty($_GET['order']) && $_GET['sort_by'] == "status" && $_GET['order'] == "asc"){
                      $order = "desc";
                  }else{
                      $order = "asc";
                  }
                  if (empty($_GET['page_num'])){
                      $_GET['page_num'] = 0;
                  }

                  ?>
              <a href='<?php echo base_url()?>index.php/welcome/?sort_by=status&order=<?php echo $order ?>&page_num=<?php echo $_GET['page_num']?>'>Status</a>
              </td>
                  <td scope="col">
                      Сообщения от администратора
                  </td>
              </tr>
        <thead>
        <tbody>

  <?php  foreach ($query->result() as $row) { ?>
      <tr>
          <td scope="row">
              <?php echo htmlspecialchars($row->name);?>
          </td>
          <td>
              <?php echo htmlspecialchars($row->email);?>
          </td>
          <td scope="row">
              <?php
              if (!empty($_SESSION['uname'])) { ?>
                  <form method="post" action="" class="rostik" >
                 <textarea cols="30" class="text"><?php echo htmlspecialchars($row->task); ?></textarea>
                      <input type="hidden" class="task_id" value="<?php echo $row->id ?>">
                  </form>
             <?php }else{
                  echo htmlspecialchars($row->task);
              } ?>
          </td>
          <td scope="row">
              <?php echo htmlspecialchars($row->status)?>
          </td>
          <td scope="row">
              <?php if (!empty($_SESSION['uname'])) { ?>
              <form method="post" action="">
              Выполнено: <input type = "checkbox"  class = "id"  value = "<?php echo $row->id?>"<?php
              if (!empty($row->completed)){
                  echo 'checked';
              }
              ?>><br>
                  <?php
                  if (!empty($row->edit)){
                  echo $row->edit;
                  }
                  ?>
              </form>
              <?php }else{
                 if  (!empty($row->completed)){
                     echo "Выполнено";
                 } echo "<br>";
                  if (!empty($row->edit)){
                      echo $row->edit;
                  }
              } ?>

          </td>
      </tr>
        </tbody>

   <?php } ?>
</div>
   <?php
    echo $this->pagination->create_links();
    ?>
    <script type="text/javascript">
        $(".id").change(function () {
        var id = $(this).val();
        $.ajax({
            type: "POST",
            url: "<?php echo base_url()?>index.php/admin/ajax/",
            data: {
                "id" : id,
                "pravda" : true,
            },
            success: function(data){
                console.log(data)
            }
        });
        })
    </script>
<script type="text/javascript">

    $(".text").change(function () {
        var text = $(this).val();
        var id = $(this).next().val();
        $.ajax({
            type: "POST",
            url: "<?php echo base_url()?>index.php/admin/task/",
            data:{
                "text" : text,
                "id" : id
            },
            success: function (data) {
                console.log(data)
            }
        });
    })
</script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
</body>
</html>














