<?php
	$title = "Latest pastes";
	include "init.php";
	//$sql = "SELECT * FROM `pastes` WHERE `private` LIKE 0 ORDER BY `pastes`.`id` DESC LIMIT 30";
	$sql = "SELECT * FROM `pastes` WHERE `private` LIKE 0 AND ((`limits` = 0) || (`watched` < `limits`)) ORDER BY `pastes`.`id` DESC LIMIT 30";
	if(($rows = $db->query($sql)))
	{
		$rows = $rows->fetch_all();
		echo "<div class=\"container latest\">\n";
			echo '<div class="row">' ."\n";
		foreach($rows as $row){
			if ($row[4] == 0 || ($row[5] < $row[4])){ 
?>
			<div class="col-md-4">
				<a href="/<?php echo $row[11] ?>">
					<div class='col-md-12 text-center title'><?php echo $row[1] ?></div>
				</a>
				<div class="text-center lcontent"><?php echo $row[8] ?></div>
				<i class="fas fa-eye"></i> <?php echo $row[5] ?>
				<i class="fas fa-arrow-up"></i> <?php echo $row[6] ?>
				<span class="float-right">in <?php echo $row[9]?> by <?php echo $row[2]?></span>
			</div>
<?php
			}
		}
			echo "</div>\n";
		echo "</div>\n";
	}
	else{
		//echo $db->error;
		echo "there is an error in our side please try later or contact the adminstation";
	}
?>
