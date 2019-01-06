<?php
	$title="See paste";
	include "init.php";
	$id = $_GET['id'];
	$id = htmlspecialchars($id);
	$paste_request = "SELECT * FROM pastes WHERE id=$id";
    	$paste = $db->query($paste_request);
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

    <table class="table table-hover table-responsive{-sm|-md|-lg|-xl}">
<?php
	echo "<thead>";
		echo "<th>Title</th>";
		echo "<th>Author</th>";
		echo "<th>Language</th>";
		echo "<th>Limits</th>";
		echo "<th>Watched</th>";
		echo "<th>Upvote</th>";
		echo "<th>Private</th>";
		echo "<th>Ban</th>";
		echo "<th>Code</th>";
	echo "</thead>";
	    	if ($row = $paste->fetch_assoc())
	    	{
	    		echo "<tr>";
				echo "<td>".$row['title']."</td>";  		
				echo "<td>".$row['authorname']."</td>";  		
				echo "<td>".$row['lang']."</td>";  		
				echo "<td>".$row['limits']."</td>";  		
				echo "<td>".$row['watched']."</td>";  		
				echo "<td>".$row['upvote']."</td>";  		
				echo "<td>".$row['private']."</td>";
				echo "<td>".$row['ban']."</td>";
				echo "<td>".$row['code']."</td>";
	    		echo "</tr>";
			echo "</table>";
			echo "<div class='border border-dark text-monospace m20'>".nl2br($row['content'])."</div>";
	    	}
	   
?>
<?php
    include "includes/footer.php";
?>
