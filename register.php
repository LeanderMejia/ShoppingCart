<?php
	session_start();
	require 'include/database.php';
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8 (Without BOM)">
	<title>Shopping Cart</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
	<!-- Fonts -->
	<link href="https://fonts.googleapis.com/css?family=Roboto+Condensed:300&display=swap" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Oswald:600|PT+Serif&display=swap" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Abel&family=Anton&display=swap" rel="stylesheet">
	<!-- Font Awesome Icon -->
	<script src="https://kit.fontawesome.com/8395324130.js" crossorigin="anonymous"></script>
	<style>
		<?php include 'css/style.css'; ?>
	</style>
</head>
<body>
<div class="container mt-4 mb-4">
	<i class="fas fa-store fa-2x"></i>
	<h3 class="d-inline"><b>Learn IT Easy Online Shop</b></h3>	
</div>
<?php if (isset($_SESSION['message'])) : ?>
	<?php foreach ($_SESSION['message'] as $errorMessage) : ?>
		<div class="w-50 mx-auto text-center alert alert-<?php echo $_SESSION['messageType']?> alert-dismissible fade show" role="alert">
		  	<?php echo $errorMessage; ?>
		  	<button type="button" class="close" data-dismiss="alert" aria-label="Close">
		    <span aria-hidden="true">&times;</span>
		  	</button>
		</div>
	<?php endforeach ?>
	<?php unset($_SESSION['message']); unset($_SESSION['messageType']); ?>
<?php endif ?>	
<div class="d-flex align-items-center my-5">
    <div class="card mx-auto shadow-lg" style="width: 700px; border-radius: 10px;">
        <div class="card-header">
            <nav class="navbar navbar-expand-lg navbar-light mb-4 p-0">
                <a class="navbar-brand" href="index.php">
                    HOME
                </a>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item">
                            <a class="nav-link" id="current" href="login.php">Sign In</a>
                        </li>
                        <li class="nav-item active">
                            <a class="nav-link" href="register.php"><span class="list">Sign Up</span></a>
                        </li>
                    </ul>
                </div>
            </nav>
            <h3 class="text-center">Sign Up</h3>
            <p class="mb-4 text-center">Create a new account</p>
            <form method="post" action="include/register-inc.php">
            	<!-- Name -->
				<div class="form-group">
					<label>TELL US YOUR NAME <span class="text-danger">*</span></label>
					<div class="form-row">
						<div class="col">
							<input type="text" name="firstName" class="form-control" placeholder="First name" required>
						</div>
						<div class="col">
							<input type="text" name="lastName" class="form-control" placeholder="Last name" required>
						</div>
					</div>
				</div>
				<!-- Email -->
				<div class="form-group">
					<label>ENTER YOUR EMAIL <span class="text-danger">*</span></label>
					<input type="email" name="email" class="form-control" placeholder="Eg.example@email.com" required>
				</div>
				<!-- Password -->
				<div class="form-group">
					<label>ENTER YOUR PASSWORD <span class="text-danger">*</span></label>
					<input type="password" name="password" class="form-control" placeholder="Eg.encyclopedia_01293" required>
				</div>
				<!-- Birthday -->
				<div class="form-group">
					<label for="birthday">ENTER YOUR BIRTHDAY <span class="text-danger">*</span></label>
					<input type="date" id="birthday" name="birthday" class="form-control" required>
				</div>				
				<!-- SEX -->
				<div class="form-group">
					<label>ENTER YOUR SEX</label>
					<select class="form-control" name="sex" required>
						<option disabled selected>Choose your Sex <span class="text-danger">*</span></option>
						<option>Male</option>
						<option>Female</option>
					</select>
				</div>
				<!-- Address -->
				<div class="form-group">
					<label>ENTER YOUR LOCATION <span class="text-danger">*</span></label>
					<input type="text" name="address" class="form-control" placeholder="Your Location" required>
				</div>
				<!-- Phone Number -->
				<div class="form-group">
					<label>ENTER YOUR PHONE NUMBER <span class="text-danger">*</span></label>
					<input type="tel" pattern="[0-9]{4}[0-9]{3}[0-9]{4}" name="mobileNumber" class="form-control" placeholder="Eg. 09192349991" required>
				</div>
				<button type="submit" name="submit" class="btn btn-dark" style="float: right;">SUBMIT</button>
            </form>
        </div>
    </div>
</div>
<?php require 'include/footer.php'; ?>