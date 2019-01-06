<?php
	$title="Modify paste";
include "init.php";
	if (!empty($_POST))
	{
		$id = $_POST['id'];
		$title = htmlspecialchars($_POST['title']);
		$author = htmlspecialchars($_POST['author']);
		$lang= htmlspecialchars($_POST['lang']);
		$lim = htmlspecialchars($_POST['lim']);
		$view = htmlspecialchars($_POST['view']);
		$vote = htmlspecialchars($_POST['vote']);
		$privacy = htmlspecialchars($_POST['privacy']);
		$date = htmlspecialchars($_POST['date']);
		$ban = htmlspecialchars($_POST['ban']);
		$code = htmlspecialchars($_POST['code']);
		$content = $_POST['content'];
		$update = "UPDATE pastes SET title = '$title', authorname = '$author', lang = '$lang', limits = '$lim', watched = '$view', upvote = '$vote', private = '$privacy', content = '$content' WHERE pastes.id='$id'";
		if ($db->query($update) == true)
			header("Location:http://10.11.100.228:81/");
		else
		echo "Error updating record: " . mysqli_error($db);
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
	Title:<br>
	<input style ="margin: 2px;" class="form-control" type="text" name="title" value=<?= $row['title']?>><br>
	Author:<br>
	<input style ="margin: 2px;" class="form-control" type="text" name="author" value=<?= $row['authorname']?>><br>
	Language:<br>
	<input style ="margin: 2px;" class="form-control" type="text" name="lang" value=<?= $row['lang']?>><br>
	Limits:<br>
	<input style ="margin: 2px;" class="form-control" type="text" name="lim" value=<?= $row['limits']?>><br>
	Watched:<br>
	<input style ="margin: 2px;" class="form-control" type="text" name="view" value=<?= $row['watched']?>><br>
	Upvote:<br>
	<input style ="margin: 2px;" class="form-control" type="text" name="vote" value=<?= $row['upvote']?>><br>
	Private:<br>
	<input style ="margin: 2px;" class="form-control" type="text" name="privacy" value=<?= $row['private']?>><br>
	Date:<br>
	<input style ="margin: 2px;" class="form-control" type="date" name="date" value=<?= $row['date']?>><br>
	Ban:<br>
	<input style ="margin: 2px;" class="form-control" type="text" name="ban" value=<?= $row['ban']?>><br>
	Code:<br>
	<input style ="margin: 2px;" class="form-control" type="text" name="code" value=<?= $row['code']?>><br>
	Content:<br>
	<textarea name="content" class="form-control" style ="height: 400px;"><?= $row['content']?></textarea><br>
	<input type="hidden" name="id" value=<?= $row['id']?>>
	<button class="btn btn-primary" href="modify-paste.php">Update</button>
</form>
<?php } ?>
<?php
    include "includes/footer.php";
?>
