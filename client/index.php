<?php
	include "includes/header.php";
?>
<div class="container home">
	<div class="row">
		<div class="col-md-12">
			<h1 class="text-center">New Paste</h1>
		</div>
		<div class="row">
			<form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
				<div class="form-groum form-inline">
					<label>Paste Title</label>
					<input type="text" class="form-control" placeholder="Enter Title">
				</div>
				<div class="form-groum form-inline">
					<label>Auteur</label>
					<input type="text" class="form-control" placeholder="Your Name">
				</div>
				<div class="form-groum form-inline">
					<label>Languege used</label>
					<select class="form-control" id="sel1">
                                                <option>C</option>
                                                <option>html</option>
                                        </select>
				</div>
				<div class="form-groum form-inline">
					<label>Access Number</label>
					<input type="number" class="form-control" placeholder="Enter The Limit Time">
				</div>
				<div class="form-groum form-inline">
					<label>Prevacy</label>
					<select class="form-control" id="sel1">
						<option value="0">Public</option>
						<option value="1">Prive</option>
					</select>
				</div>
				<div class="form-group form-inline textarea">
					<label class='align-top'>The Paste content</label>
					<textarea class="form-control" id="exampleFormControlTextarea3" rows="7" value="<h1>test</h1>">
					</textarea>
				</div>
				<div class="form-groum form-inline">
					<label></label>
					<input type="submit" class="form-control" value="Share">
				</div>
			</form>
		</div>
	</div>	
</div>
