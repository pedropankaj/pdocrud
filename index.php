<?php 
include 'connection.php';
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <link   href="css/bootstrap.min.css" rel="stylesheet">
    <script src="js/bootstrap.min.js"></script>
    <title>BASIC CRUD(Create, Read, Update and Delete)</title>
  </head>
  <body>
    <div class="container">
       <div class="row">
          <h3>PDO CRUD(Create, Read, Update and Delete) Grid</h3>
      </div>
      <div class="row">
        <p><a href="create.php" class="btn btn-success">Create</a></p>
        <table class="table table-striped table-bordered">
          <thead>
            <tr>
              <th><center>Name</center></th>
              <th><center>Email Address</center></th>
              <th><center>Mobile Number</center></th>
              <th><center>Actions</center></th>
            </tr>
          </thead>
          <tbody>
            <?php
              $pdo = Database::connect();
              $sql = 'SELECT * FROM customers ORDER BY id DESC';
            ?>
            <?php foreach($pdo->query($sql) as $row) { ?>
              <tr>
                <td><center><?php echo $row['name']?></center></td>
                <td><center><?php echo $row['email']?></center></td>
                <td><center><?php echo $row['mobile']?></center></td>
                <td>
                  <center>
                    <a class="btn" href="read.php?id=<?php echo $row['id']; ?>">Read</a>
                    <a class="btn btn-success" href="update.php?id=<?php echo $row['id']; ?>">Update</a>
                    <a class="btn btn-danger"  href="delete.php?id=<?php echo $row['id']; ?>">Delete</a>
                  </center>
                </td>
              </tr>
            <?php } Database:: disconnect(); ?>
          </tbody>
        </table>
      </div>
    </div>
  </body>
</html>