<?php
include 'includes/header.php';
if (isset($_POST['submit'])) {
	$title = $_POST['title'];
	$body = $_POST['body'];
	if ($body != '' && $title != '') {
		$sql = "INSERT INTO posts (post_title, post_body, post_author) VALUES (?,?,?)";
		$stmt = $conn->prepare($sql);
		$stmt->bind_param("ssi", $title, $body, $_SESSION['user_id']);
		$stmt->execute();
		if ($stmt->affected_rows == 1) {
			$location = "Location: post.php?id=" . $stmt->insert_id . "&created=true";
			header($location);
		}
	} else {
		$errorMsg = "Please fill out all fields!";
	}
}

?>
<div class="container">

	<div class="row">
		<?php if ($_SESSION['loggedin'] == false) : ?>
			<div class="mt-5 col-md-6 offset-md-3 text-center">
				<h2 class="display-5">Please Login to Post!</h2>
				<p>Create an account or login to post to the website.</p>
				<button type="button" class="btn btn-block btn-outline-primary"><a href="login.php"><i class="fas fa-sign-in-alt"></i> Create Account/Login</a> </button>
			</div>
		<?php else : ?>
			<div class="mt-3 col-md-10 offset-md-1">
				<?php if (isset($errorMsg)) : ?>
					<div class="alert alert-danger" role="alert">
						<?php echo $errorMsg; ?>
					</div>
				<?php endif; ?>
				<h2>Create a post~</h2>
				<form class="" action="create.php" method="post">
					<label for="title">Post Title</label>
					<input type="text" name="title" placeholder="Post title..." value="" class="form-control">

					<label for="body">Post Content</label>
					<script>
						tinymce.init({
							selector: '#mytextarea',
							height: 300,
							menubar: false,
							plugins: [
								'advlist autolink lists link image charmap print preview anchor',
								'searchreplace visualblocks code fullscreen',
								'insertdatetime media table paste code help wordcount'
							],
							toolbar: 'undo redo | formatselect | ' +
								'bold italic backcolor | alignleft aligncenter ' +
								'alignright alignjustify | bullist numlist outdent indent | ' +
								'removeformat | help',
							content_style: 'body { font-family:Helvetica,Arial,sans-serif; font-size:14px }'
						});
					</script>
					<textarea id="mytextarea" name="body" class="form-control" rows="8" cols="80"></textarea>

					<button type="submit" name="submit" class="btn btn-outline-dark btn-block"> <i class="fas fa-edit"></i> Create Post</button>
				</form>
			</div>

		<?php endif; ?>
	</div>
</div>


<?php
include 'includes/footer.php';
?>