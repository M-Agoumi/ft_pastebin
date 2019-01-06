<?php
	$title = "home";
	include "init.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST'){
	$formError;
	// check if the title is  valid
	if (isset($_POST['title']) && !empty($_POST['title'])) {
		$ftitle = filter_var($_POST['title'], FILTER_SANITIZE_STRING);
		if (strlen($ftitle) < 4) {
			$formError[] = "Title Can't Be Less Than 4";
		}
		if (strlen($ftitle) > 254) {
			$formError[] = "Title Can't Be More Than 254";
		}
	}else {
		$formError[] = "Title Can't Be Empty";
	}
	// check if the author is valid
	if (isset($_POST['author']) && !empty($_POST['author'])) {
		$author = filter_var($_POST['author'], FILTER_SANITIZE_STRING);
		if(!preg_match("/^[a-zA-Z' -]+$/",$author)) {
			$formError[] = "Name must be only letters";
		}else{
			if (strlen($author) < 4) {
				$formError[] = "Author Can't Be Less Than 4";
			}
			if (strlen($title) > 254) {
				$formError[] = "Author Can't Be More Than 254";
			}
		}
	}else {
		$formError[] = "Author Can't Be Empty";
	}
	// check if the language is valid
	if (isset($_POST['lang']) && !empty($_POST['lang'])) {
		$lang = filter_var($_POST['lang'], FILTER_SANITIZE_STRING);
		if (strlen($lang) > 254) {
			$formError[] = "Lang Can't Be More Than 254";
		}

	}
	// check access times
	if (isset($_POST['limits']) && !empty($_POST['limits'])){
		if(is_numeric($_POST['limits'])){
			$limits = $_POST['limits'];
		}else{
			$formError[] = "Not valid limits access time";
		}
	}else{
		$limits = 0;
	}
	// validate the private status
	$privacy = isset($_POST['privacy']) && !empty($_POST['privacy']) ? $_POST['privacy'] : 0;
	if ($privacy != 1 && $privacy != 0){
		$formError[] = "Not Valid Privacy Value";
	}
	//validate the paste content
	if (isset($_POST['content']) && !empty($_POST['content'])){
		$content = filter_var($_POST['content'],FILTER_SANITIZE_STRING);
	}else{
		$formError[] = "The paste Content Can't be Empty";
	}
	if(empty($formError)){
		$code = generateRandomString();
		$query="INSERT INTO `pastes` 
			(`id`, `title`, `authorname`, `lang`, `limits`, `watched`, `upvote`, `private`, `content`, `date`, `ban`,`code`) 
			VALUES (NULL, '$ftitle', '$author', '$lang', '$limits', '0', '0', '$privacy', '$content', CURRENT_TIME(), '0','$code');";
		if($db->query($query)){
			$success = "";
			$ftitle = "";
			$author = "";
			$lang = "";
			$limits = "";
		       	$privacy = "";
			$content = "";
			$_SESSION['code'] = $code;
			header('Location: /clear.php');
			exit();
		}else{
			$formError = "Sorry we have a problem in our side please try later or contact us";
		}
	}
}
?>
<div class="container home">
	<div class="row">
		<div class="col-md-12">
			<h1 class="text-center">New Paste</h1>
		</div>
		<?php
			if(isset($_SESSION['code'])){
				echo "<div class='col-md-12 btn btn-success'>";
				echo "link: <a href=". $_SESSION['code'] . ">localhost/". $_SESSION['code'] . "</a>";
				echo "</div>";
				unset($_SESSION['code']);
			}		
		?>
		<div class="row">
			<form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
				<div class="form-groum form-inline">
					<label>Paste Title</label>
					<input type="text" class="form-control" name="title"  placeholder="Enter Title" <?php if(isset($ftitle)) echo "value=\"$ftitle\""?>>
				</div>
				<div class="form-groum form-inline">
					<label>Auteur</label>
					<input type="text" class="form-control" name="author"  placeholder="Your Name" <?php if(isset($author))echo "value=\"$author\"";?>>
				</div>
				<div class="form-groum form-inline">
					<label>Language used</label>
					<select class="form-control" id="sel1" name="lang">
						<option value="c" <?php if(isset($lang) && $lang == "c") echo "selected"; ?>>C</option>
						<option value="html" <?php if(isset($lang) && $lang == "html") echo "selected"; ?>>html</option>
					</select>
				</div>
				<div class="form-groum form-inline">
					<label>Access Number</label>
					<input type="number" class="form-control" name="limits" placeholder="Enter The Limit Time" <?php if(isset($limits))echo "value=\"$limits\"";?>>
				</div>
				<div class="form-groum form-inline">
					<label>Privacy</label>
					<select class="form-control" name="privacy">
						<option value="0" <?php if(isset($privacy) && $privacy == 0) echo "selected"; ?>>Public</option>
						<option value="1" <?php if(isset($privacy) && $privacy == 1) echo "selected"; ?>>Private</option>
					</select>
				</div>
				<div class="form-group form-inline textarea">
					<label class='align-top'>The Paste content</label>
					<textarea class="form-control" name="content" rows="7"></textarea>
				</div>
				<div class="form-groum form-inline">
					<label></label>
					<input type="submit" class="form-control" value="Share">
				</div>
				<?php
					if(isset($formError) && !empty($formError)){
						foreach($formError as $error){
							echo "<div class='form-inline'><label></label><span class='btn btn-danger'>";
							echo $error;
							echo "</span></div>";
						}
					} 
				?>
			</form>
		</div>
	</div>	
</div>
