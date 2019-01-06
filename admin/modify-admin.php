<?php
	$title="Modify admin";
include "init.php";
	if (!empty($_POST))
	{
		$uid = $_POST['uid'];
		$name = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
		$email = filter_var($_POST['mail'], FILTER_SANITIZE_EMAIL);
		$password1= $_POST['passwd1'];
		$password2= $_POST['passwd1'];
		if ($password1 != $password2)
			$error = '';
		$password = $password1;
		if(!empty($password1))
		{
			$sql = "UPDATE `users` SET `name` = '$name', `email` = '$email', `password` = '$password' WHERE `users`.`userId` = $uid;";
		}else{
			$sql = "UPDATE `users` SET `name` = '$name', `email` = '$email' WHERE `users`.`userId` = $uid;";
		}
		if(!isset($error)){
			if ($db->query($sql)){
				header("Location:http://10.11.100.228:81/");
				exit();
			}else
				echo "error in our side please try later or contact the adminstation";
		}
	}
	else
	{
		$uid = $_GET['uid'];
		$uid = htmlspecialchars($uid);
		$admin_request = "SELECT * FROM users WHERE userId=$uid";
    		$admin = $db->query($admin_request);
		$row = $admin->fetch_assoc();
?>
	<nav class="navbar navbar-expand-lg navbar-dark bg-dark static-top">
		<div class="container">
			<a class="navbar-brand" href="/">Admin</a>
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
	  			<span class="navbar-toggler-icon"></span>
			</button>
		</div>
    </nav>

    <h2 class="text-center">Admin</h2>

<form method="POST" style="width : 50%; margin : 5px auto;">
	Name:<br>
	<input style ="margin: 2px;" class="form-control" type="text" name="name" value=<?= $row['name']?>><br>
	E-mail:<br>
	<input style ="margin: 2px;" class="form-control" type="email" name="mail" value=<?= $row['email']?>><br>
	Password:<br>
	<input style ="margin: 2px;" class="form-control" type="password" name="passwd1"><br>
	Confirm Password:<br>
	<input style ="margin: 2px;" class="form-control" type="password" name="passwd2"><br>
	<input type="hidden" name="uid" value=<?= $row['userId']?>>
	<input type="submit" />
	<?php
	if(isset($error))
		echo "passwords doesn't match";
?>
</form>
<?php } ?>
<?php
    include "includes/footer.php";
?>
