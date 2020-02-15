<?php include('info_admin.php') ?>
<!DOCTYPE html>
<html>
<head>
  <title>Login Admin</title>
  <link rel="stylesheet" type="text/css" href="style3.css">
</head>
<body>
  <div class="header">
  	<h2>Login</h2>
  </div>
	 
  <form method="post" action="admin_login_form.php">
    <div class = "all">
  	<div class="input-group">
  		<label>Username</label>
  		<input type="text" autocomplete="off" name="username1" value="<?php echo ""; ?>" >
  	</div>
  	<div class="input-group">
  		<label>Password</label>
  		<input type="password" name="password1">
  	</div>
  	<div class="input-group">
  		<button type="submit" class="btn" name="login_admin">Login</button>
  	</div>
  	</div>
  </form>
</body>
</html>