<?php
	$title="Dashboard";
	$skip = '';
	include "init.php";
	if(isset($_SESSION['logged'])){
    	$pastes_request = "SELECT * FROM pastes ORDER BY id DESC";
   	$admins_request = "SELECT * FROM users ORDER BY userId DESC";
   	$pastes = $db->query($pastes_request);
	$admins = $db->query($admins_request);
?>
	<nav class="navbar navbar-expand-lg navbar-dark bg-dark static-top">
		<div class="container">
			<a class="navbar-brand" href="/">Admin Dashboard</a>
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
	  			<span class="navbar-toggler-icon"></span>
			</button>
		</div>
    </nav>

    <h2 class="text-center">Manage Pastes</h2>

    <table class="table table-hover table-responsive{-sm|-md|-lg|-xl}">
    	<?php
	    	while ($row = $pastes->fetch_assoc())
	    	{
	    		echo "<tr>";
				echo "<td>".$row['title']."</td>";  		
				echo "<td>".$row['authorname']."</td>";  		
				echo "<td>".$row['lang']."</td>";  		
				echo "<td>".$row['limits']."</td>";  		
				echo "<td>".$row['watched']."</td>";  		
				echo "<td>".$row['upvote']."</td>";  		
				echo "<td>".$row['private']."</td>";
				echo "<td>".substr($row['content'], 0, 20)." ...</td>";
				echo "<td>".$row['ban']."</td>";
				echo "<td>".$row['code']."</td>";
				echo "<td><a href = 'http://10.11.100.228/".$row['code']."' class='btn btn-primary'>See Paste</a></td>";
				echo "<td><a href = 'modify-paste.php?id=".$row['id']."' class='btn btn-info'>Modify</a></td>";
				echo "<td><a href = 'delete-paste.php?id=".$row['id']."' class='btn btn-danger confirmation'>Delete</a></td>";
	    		echo "</tr>";
	    	}
	    ?>
	</table>
	<hr>
	<h2 class="text-center">Manage Admin Accounts</h2>
    	<table class="table table-hover table-responsive{-sm|-md|-lg|-xl}">
    	<?php
	    	while ($row = $admins->fetch_assoc())
	    	{
	    		echo "<tr>";
				echo "<td>".$row['name']."</td>";  		
				echo "<td>".$row['email']."</td>";  		
				echo "<td>".$row['password']."</td>";  		
				echo "<td>".$row['date']."</td>";  		
				echo "<td>".$row['level']."</td>";  		
				echo "<td><a href = 'modify-admin.php?uid=".$row['userId']."' class='btn btn-info'>Modify</a></td>";
				echo "<td><a href = 'delete-admin.php?uid=".$row['userId']."' class='btn btn-danger confirmation'>Delete</a></td>";
	    		echo "</tr>";
	    	}
	    ?>
	</table>
	<script>
		$('.confirmation').click(function(){
       			 return confirm('Are You Sure?');
    		});
	</script>
<?php
		include "includes/footer.php";
	}else{
?>
	<form action="login.php" method="POST" style="margin:10px auto;width: 406px;">
		<input type="email" name="mail" placeholder="enter your email">
		<input type="password" name="password">
		<input type="submit" value="login"> 
	</form>
<?php	
		if(isset($_SESSION['error'])){
			echo "wrong password or username";
			unset($_SESSION['error']);
		}
	}
?>
