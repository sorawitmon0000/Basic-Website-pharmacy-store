<?php include('server.php');?>
<!DOCTYPE html>
<html>
<head>
	<title>Registration system PHP and MySQL</title>
	<link rel="stylesheet" href="register-style.css">
</head>

<body>
	<header>
		<div class="header">
			<h2>Register</h2>
		</div>
	</header>

	<section>
		<form action="server.php" method="POST">
			<?php if (isset($_SESSION['error'])) : ?>
            <div class="error">
                <h3>
                    <?php 
                        echo $_SESSION['error'];
                        unset($_SESSION['error']);
                    ?>
                </h3>
            </div>
        	<?php endif ?>
			<div class="input-group">
				<label>Username</label>
				<input type="text" name="username" value="<?php echo $username; ?>" pattern="^[a-zA-Z]+$" placeholder="ตัวอักษรภาษาอังกฤษเท่านั้น">
			</div>
			<div class="input-group">
				<label>Password</label>
				<input type="password" name="password_1" require minlength="3" pattern="[0-9]+" placeholder="รหัสผ่านขั้นต่ำ 3 ตัวอักษร">
			</div>
			<div class="input-group">
				<label>Confirm password</label>
				<input type="password" name="password_2" require minlength="3" pattern="[0-9]+" placeholder="รหัสผ่านขั้นต่ำ 3 ตัวอักษร">
			</div>
			<div class="input-group">
				<label>Name</label>
				<input type="name" name="name" value="<?php echo $name; ?>" require pattern="^[ก-๏\s]+$" placeholder="ชื่อภาษาไทย">
			</div>
			<div class="input-group">
				<label>Address</label>
				<input type="address" name="address" value="<?php echo $address; ?>" require>
			</div>
			<div class="input-group">
				<label>Mobile</label>
				<input type="mobile" name="mobile" value="<?php echo $mobile; ?>" pattern="[0-9]{10}" placeholder="0xxxxxxxx">
			</div>
			<div class="input-group">
				<label>Email</label>
				<input type="email" name="email" value="<?php echo $email; ?>" require placeholder="web01@gmail.com">
			</div>
			<div class="input-group">
				<button type="submit" class="btn" name="reg_user">Register</button>
			</div>
			<p>
				Already a member? <a href="login.php">Sign in</a>
			</p>
		</form>
	</section>
</body>
</html>