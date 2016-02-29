<?php
require 'connection.php';

$id = 0;

if (!empty($_GET['id'])):
	$id = $_REQUEST['id'];
endif;

if (!empty($_POST)):
	# keep track post values
	$id = $_POST['id'];
	
	# delete data
	$pdo = Database::connect();
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$sql = "DELETE FROM customers WHERE id = ?";
	$q = $pdo->prepare($sql);
	$q->execute(array($id));
	Database::disconnect();
	header("Location: index.php");
endif;
?>

<!DOCTYPE html>
<html lang="en">
	<head>
	   <meta charset="utf-8">
	   <link   href="css/bootstrap.min.css" rel="stylesheet">
	   <script src="js/bootstrap.min.js"></script>
	</head>
	<body>
		<div class="container">
			<div class="span10 offset1">
				<div class="row">
					<h3>Delete a Customer</h3>
				</div>

				<form class="form-horizontal" action="delete.php" method="post">
					<input type="hidden" name="id" id="id"  value="<?php echo $id; ?>" />
					<p class="alert alert-error">Are you sure to delete?</p>
					<div class="form-actions">
						<button type="submit" class="btn btn-danger">Yes</button>
						<a href="index.php" class="btn">No</a>
					</div>
				</form>
			</div>
		</div>
	</body>
</html>