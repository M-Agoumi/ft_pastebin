<?php
	$title="Modify admin";
include "init.php";
	if (!empty($_POST))
	{
		$id = $_POST['uid'];
		$name = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
		$email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
		$password1= $_POST['passwd1'];
		$password2= $_POST['passwd1'];
		if ($password1 != $password2)
			header("Location:http://10.11.100.228:81/modify-admin?uid=$id");
		$date = filter_var($_POST['date'], FILTER_SANITIZE_STRING);
		$level = filter_var($_POST['level'], FILTER_SANITIZE_STRING);
		$password = password_hash($password1);
		$update = "UPDATE users SET name = '$name', email = '$email', password = '$password', date='$date', level = '$level' WHERE users.userId='$uid'";
		if ($db->query($update) == true)
			header("Location:http://10.11.100.228:81/");
	}
	else
	{
		$id = $_GET['id'];
		$id = htmlspecialchars($id);
		$paste_request = "SELECT * FROM pastes WHERE id=$id";
    		$paste = $db->query($paste_request);
		$row = $paste->fetch_assoc();
?>
	<nav class="navbar navbar-expand-lg navbar-dark bg-dark static-top">
		<div class="container">
			<a class="navbar-brand" href="/">Admin</a>
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
	  			<span class="navbar-toggler-icon"></span>
			</button>
		</div>
    </nav>

    <h2 class="text-center">Paste</h2>

<form method="POST" action="modify-paste.php" style="width : 50%; margin : 5px auto;">
	Name:<br>
	<input style ="margin: 2px;" class="form-control" type="text" name="name" value=<?= $row['name']?>><br>
	E-mail:<br>
	<input style ="margin: 2px;" class="form-control" type="email" name="mail" value=<?= $row['email']?>><br>
	Password:<br>
	<input style ="margin: 2px;" class="form-control" type="password" name="passwd1"><br>
	Confirm Password:<br>
	<input style ="margin: 2px;" class="form-control" type="password" name="passwd2"><br>
	Date:<br>
	<input style ="margin: 2px;" class="form-control" type="date" name="date" value=<?= $row['date']?>><br>
	Level:<br>
	<input style ="margin: 2px;" class="form-control" type="text" name="level" value=<?= $row['level']?>><br>
	<input type="hidden" name="id" value=<?= $row['id']?>>
	<button class="btn btn-primary" href="modify-paste.php">Update</button>
</form>
<?php } ?>
<?php
    include "includes/footer.php";
?>
