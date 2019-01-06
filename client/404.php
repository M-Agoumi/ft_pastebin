<?php
	$title = "loading";
	include "init.php";
	$code = substr($_SERVER['REQUEST_URI'], 1);
	if(checkData("code", "pastes", $code)){
		// fetch data from the database and show them if nothing is wrong
		$query = "SELECT * FROM pastes WHERE code = '$code'";
		$results = $db->query($query);
		$results = $results->fetch_assoc();
		if($results['watched'] > $results['limits'] && $results['limits'] != 0)
		{
			echo "<div class=\"container\"><div class=\"btn btn-danger col-md-12\">content is no longer available</div></div>";
			exit();
		}else{
			$sql = "UPDATE `pastes` SET `watched` = watched + 1 WHERE `pastes`.`code` = '$code';";
                	$db->query($sql);
		}
		$content = $results['content'];
		if ($results['lang'] == 'c'){
			$lang = $results['lang'];
			$content = str_replace_first('`', "<pre><code class='$lang'>1\t|\t", $content);
			$content = str_replace_first('`', "</code></pre>", $content);
			$i = 1;
			$j = 2;
			$n = substr_count($content, "<br>");
			while($i < $n){
				$content = str_replace_first('<br>', "<br/>$j\t|\t", $content);
				$j++;
				$i++;
			}
			echo "<br>" . $content . "<br>";
		}
	}else{
		//include the real 404 page
		echo "404 page not found";
		exit();
	}
?>
<div class="blog-card spring-fever">
	<div class="title-content">
		<h3><a href="#"><?php echo $results['title']?></a></h3>
		<div class="intro"> <a href="#">content</a> </div>
	</div>
	<div class="card-info">
		<?php echo $results['content'] ?>
		<a href="#" data-toggle="modal" data-target="#exampleModalLong">See Full<span class="licon icon-arr icon-black"></span></a>
	</div>
	<div class="utility-info">
		<ul class="utility-list">
			<li><span class="licon icon-like"></span><a><i class="fas fa-eye"></i> <?php echo $results['watched'] ?></a></li>
			<li><span class="licon icon-com"></span><a href="upvote.php?id=<?php echo $code;?>"><i class="fas fa-arrow-up"></i> <?php echo $results['upvote'] ?></a></li>
			<li><span class="licon icon-dat"></span><?php echo $results['date'] ?></li>
			<li><span class="licon icon-tag"></span><a href="#">code:</a> <a href="#" id="code"><?php echo $results['code'] ?></a></li>
			<li><span class="licon icon-tag"></span><span id="copy" style="cursor: pointer">Copy</span></li>
		</ul>
	</div>
	<div class="gradient-overlay"></div>
	<div class="color-overlay"></div>
</div>
<div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLongTitle"><?php echo $results['title']?></h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<?php echo $content ?>
			</div>
			<div class="modal-footer">
				<?php
					if(isset($_SESSION['download']))

?>
				<a href="show.php?id=<?php echo $results['code']?>"><button type="button" class="btn btn-secondary">Brut form</button></a>
				<form action="bruh.php" method="POST">
					<input type="hidden" name="paste" value="<?php echo $results['content'] ?>">
					<input type="hidden" name="name" value="<?php echo $results['title'] ?>">
					<input type="submit" class="btn btn-secondary" value="Download">
				</form>
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>
<script>
	document.title = '<?php echo $results['title']?>';
	function copyToClipboard(element) {
    		var $temp = $("<input>");
    		$("body").append($temp);
    		$temp.val($(element).text()).select();
    		document.execCommand("copy");
    		$temp.remove();
	}
	$('#copy').click(function(){
		copyToClipboard('.modal-body');
		$(this).html("Copied");
	});
	$('#code').click(function(){
                copyToClipboard('#code');
                $(this).html("Copied");
        });
	$(".code").html().replace("int", "newint"); 
</script>
<link rel="stylesheet"
      href="//cdnjs.cloudflare.com/ajax/libs/highlight.js/9.13.1/styles/default.min.css">
<script src="//cdnjs.cloudflare.com/ajax/libs/highlight.js/9.13.1/highlight.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/highlightjs-line-numbers.js@2.6.0/dist/highlightjs-line-numbers.min.js"></script>
<script>
$(document).ready(function() {
  $('pre code').each(function(i, block) {
    hljs.highlightBlock(block);
  });
});
hljs.configure({useBR: true});
hljs.initHighlightingOnLoad();

hljs.initLineNumbersOnLoad();
$(document).ready(function() {
	$('code.hljs').each(function(i, block) {
		hljs.lineNumbersBlock(block);
	});
});
</script>
<script>hljs.initHighlightingOnLoad();</script>
