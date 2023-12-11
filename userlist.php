<?php
 include('inc/header.php');
 include('db/config.php');
?>

<div class="container">
    <div id="user-list">
        <?php if(isset($_GET['msg'])){ ?>
        <div class="alert alert-warning alert-dismissible fade show mt-3" role="alert">
            <?php echo $_GET['msg'] ?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <?php } ?>
        <table class="table table-striped table-bordered table-hover ">
            <thead>
                <tr>
                    <th scope="col">Serial</th>
                    <th scope="col">F Name</th>
                    <th scope="col">L Name</th>
                    <th scope="col">Username</th>
                    <th scope="col">Email</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php

                    $query = 'SELECT * FROM `users` ORDER BY `id` DESC';
                    $users = mysqli_query( $conect,$query);
                    $count =1;
                    while($item = mysqli_fetch_array($users))
                    {?>
                <tr>
                    <td scope="row"><?php echo $count++ ?></td>
                    <td scope="row"><?php echo $item['firstname'] ?></td>
                    <td scope="row"><?php echo $item['lastname'] ?></td>
                    <td scope="row"><?php echo $item['username'] ?></td>
                    <td scope="row"><?php echo $item['email'] ?></td>
                    <td scope="row"><a onclick="return confirm('are you sure?')" href="functions/deleteUser.php?id=<?php echo $item['id'] ?>"><i class="fa fa-trash btn btn-danger" aria-hidden="true"></i></a></td>
                </tr>
                <?php }?>
            </tbody>
        </table>
        <div class="text-right"><a href="index.php" class="btn btn-dark">Add new user</a></div>
    </div>
</div>

<?php include('inc/footer.php'); ?>