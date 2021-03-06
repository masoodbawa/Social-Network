<?php 

	session_start(); 
	include ( "includes/connection.php" );
	include ( "functions/functions.php" );

	if ( !isset( $_SESSION['user_email'] ) ) {
		header( "location: index.php" );
	}else {

		include ( "header.php" );
		include ( "user_sidebar.php" );
?>

		
		<div class="col-sm-9">
			<form action="home.php?id=<?php echo $user_id; ?>" method="post" class="form-horizontal">
				<h2>What's your question today? let's discuss!</h2>
				<div class="form-group">
					<div class="col-sm-12">
						<input type="text" name="title" class="form-control" placeholder="Write a Title" required>
					</div>
				</div>
				<div class="form-group">
					<div class="col-sm-12">
						<textarea name="content" class="form-control" cols="30" rows="10" placeholder="Write description..." required></textarea>
					</div>
				</div>
				<div class="form-group">
					<div class="col-sm-12">
						<select name="topic" class="form-control">
							<option value="">Select a topic</option>
							<?php getTopics(); ?>
						</select>
					</div>
				</div>
				<div class="form-group">
					<div class="col-sm-12">
						<input type="submit" name="sub" class="btn btn-success pull-right" value="Post to Timeline">
					</div>
				</div>
			</form>
			<?php insertPost(); ?>
			<div id="posts">
				<h3>Most recent discussions.</h3>
				<?php get_posts(); ?>
			</div>
		</div>


<?php 

	include( "footer.php" );

} ?>