
<?php
require 'connection.php';

if (!empty($_POST)) {
	################################
	# KEEP TRACK VALIDATION ERRORS #
	################################
	$nameError   = null;
	$emailError  = null;
	$mobileError = null;

	##########################
	# KEEP TRACK POST VALUES #
	##########################
	$name   = $_POST['name'];
	$email  = $_POST['email'];
	$mobile = $_POST['mobile'];

	##################
	# VALIDATE INPUT #
	##################
	$valid = true;
	if (empty($name)):
		$nameError = 'Please enter your name!';
		$valid = false;
	endif;

	if (empty($email)):
		$emailError = 'Please enter Email Address!';
		$valid  = false;
	elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)):
		$emailError = 'Please enter a valid Email Address!';
		$valid = false;
	endif;

	if (empty($mobile)):
		$mobileError = 'Please enter a Mobile Number!';
		$valid = false;
	endif;

	###############
	# insert data #
	###############
	if ($valid):
		$pdo = Database::connect();
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "INSERT INTO customers(name, email, mobile) VALUES(?, ?, ?)";
		$q = $pdo->prepare($sql);
		$q->execute(array($name, $email, $mobile));
		Database::disconnect();
		header("Location: index.php");
	endif;
}
?>

<!DOCTYPE html>
<html lang="en">
	<head>
	   <meta charset="utf-8">
	   <link   href="css/bootstrap.min.css" rel="stylesheet">
	   <script src="js/bootstrap.min.js"></script>
	    <title>BASIC CRUD(Create, Read, Update and Delete) | Create</title>
	</head>
	<body>
		<div class="container">
			<div class="span10 offset1">
				<?php # === header ==== ?>
				<div class="row">
					<h3>Create a Customer</h3>
				</div>
				<?php # === create form === ?>
				<form class="form-horizontal" action="create.php" method="post">
					<!-- .control-group -->
					<div class="control-group <?php echo !empty($nameError) ? 'error' : ''; ?>">
						<label class="control-label">Name</label>
						<div class="controls">
							<input name="name" id="name" type="text" placeholder="Name" value="<?php echo !empty($name) ? $name : ''; ?>">
							<?php if(!empty($nameError)): ?>
								<span class="help-inline"><?php echo $nameError; ?></span>
							<?php endif; ?>
						</div>
					</div>
					<!-- .control-group -->
					<div class="control-group <?php echo !empty($emailError) ? 'error' : ''; ?>">
						<label class="control-label">Email Address</label>
						<div class="controls">
							<input name="email" id="email" type="text" placeholder="Email Address" value="<?php echo !empty($email) ? $email : ''; ?>">
							<?php if(!empty($emailError)): ?>
								<span class="help-inline"><?php echo $emailError; ?></span>
							<?php endif; ?>
						</div>
					</div>
					<!-- .control-group -->
					<div class="control-group <?php echo !empty($mobileError) ? 'error' : ''; ?>">
						<label class="control-label">Mobile Number</label>
						<div class="controls">
							<input name="mobile" id="mobile" type="text" placeholder="Mobile Number" value="<?php echo !empty($mobile) ? $mobile : '';?>">
							<?php if(!empty($mobileError)): ?>
								<span class="help-inline"><?php echo $mobileError; ?></span>
							<?php endif; ?>
						</div>
					</div>
					<!-- .form-actions -->
					<div class="form-actions">
						<button type="submit" class="btn btn-success">Create</button>
						<a class="btn" href="index.php">Back</a>
					</div>
				</form>

			</div>
		</div>
	</body>
</html>