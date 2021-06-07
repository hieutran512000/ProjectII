<?php
include 'includes/header.php';
$sql = "SELECT * FROM posts";
$stmt = $conn->prepare($sql);
$stmt->execute();
$results = $stmt->get_result();

?>
<div class="jumbotron jumbotron-fluid text-white">
	<div class="container">
		<h1 class="display-3">Post Section</h1>
		<a id="button3" class="btn btn-outline-primary" href="create.php">
			<i class="fas fa-pen"> Create Post</i>
		</a>
		<p class="num-posts"></p>
	</div>
</div>

<div class="container">
	<div class='row'>
		<?php foreach ($results as $post) { ?>
			<div class="col-lg-4 col-md-6 col-sm-12">
				<div class="card" style="text-align:center;">

					<div class="card-header">
						<h5><?= $post['post_title'] ?></h5>
					</div>
					<img class="card-img-top" style="height: 250px; text-align:center;" src="https://image.freepik.com/free-vector/social-media-post-template-abstract-background_7087-717.jpg" alt="">
					<div class="card-body">
						<p class="card-text"><?= $post['post_body'] ?></p>
						<p class="card-text">Date created : <?= $post['date_created'] ?></p>
					</div>
					<div class="card-footer" style='padding : 0; margin: 0'>
						<a id="button3" href="./post_detail.php?id=<?= $post['ID'] ?>" class="btn btn-outline-primary btn-block">More information</a>
					</div>
				</div>
			</div>
		<?php } ?>

	</div>
</div>

<?php
include 'includes/footer.php';
?>