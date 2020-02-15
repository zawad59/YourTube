<?php include('info_users.php') ?>
<!DOCTYPE html>
<html>
<head>
  <title>Register for Hellotube</title>
  <link rel="stylesheet" type="text/css" href="style2.css">
</head>
<body>
  <div class="header">
  	<h2>Sign Up</h2>
  </div>
	
  <form method="post" action="signup.php">
    <div class = "all">
  	<div class="input-group">
  	  <label>Username</label>
  	  <input type="text" autocomplete="off" name="username" value="<?php echo ""; ?>">
  	</div>
  	<div class="input-group">
  	  <label>Email</label>
  	  <input type="email" autocomplete="off" name="email" value="<?php echo ""; ?>">
  	</div>
  	<div class="input-group">
  	  <label>Password</label>
  	  <input type="password" name="password_1">
  	</div>
  	<div class="input-group">
  	  <label>Confirm password</label>
  	  <input type="password" name="password_2">
  	</div>
  	<div class="input-group">
  	  <button type="submit" class="btn" name="reg_user">Register</button>
  	</div>

  	<p>
  		Already a member? <a href="login_form.php">Sign in</a>
  	</p>
        </div>
  </form>
</body>
</html>
