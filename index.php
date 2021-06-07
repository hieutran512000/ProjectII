<!-- Index Page Header -->
<?php
include 'includes/header.php';
?>
<!-- Index Page Header -->

<!-- Index Page Heading -->
<div class="jumbotron jumbotron-fluid text-white">
	<div class="container">
		<h1 class="display-3">Wellcome to My Website</h1>
		<a id="button1" href="post.php" class="btn btn-outline-primary">Post Gallery</a>
		<button id="button2" type="button" class="btn btn-outline-primary ajax">Check Number of Posts</button>
		<div style="background-color: #d2786e; margin-top:100px">
		<p class="num-posts " style="font-size: 30px; "></p>
		</div>
	</div>
</div>

<!-- Index Page Heading -->
<!-- Main Content Wrapper -->
<div class="container">

	<!-- Index Alert -->
	<?php if (isset($_GET['login'])) : ?>
		<div class="alert alert-success" role="alert">
			Welcome! Now you are in my team!
		</div>
	<?php elseif (isset($_GET['logout'])) : ?>
		<div class="alert alert-warning" role="alert">
			Goodbye! My Friend!
		</div>
	<?php endif; ?>
	<!-- Index Alert -->

	<!-- Main Content -->
	<div class="row">
		<section class="showcase">
            <div class="container-fluid p-0">
                <div class="row g-0">
                    <div class="col-lg-6 order-lg-2 text-white showcase-img" style="background-image: url('https://s3-eu-west-1.amazonaws.com/video.gallereplay.com/artistarea/Traditional+Japanese+Temple_6d477a4f-6f33-48f9-bed5-b472e5212725/Cinemagraph_watermark/576x324/cinemagraph.gif')"></div>
                    <div class="col-lg-6 order-lg-1 my-auto showcase-text">
                        <h2>Fully Responsive Design</h2>
                        <p class="lead mb-0">When you use a theme created by Start Bootstrap, you know that the theme will look great on any device, whether it's a phone, tablet, or desktop the page will behave responsively!</p>
                    </div>
                </div>
                <div class="row g-0">
                    <div class="col-lg-6 text-white text-md-right showcase-img" style="background-image: url('https://www.chezdjseb.com/wafx_res/Images/0-82-original.gif')"></div>
                    <div class="col-lg-6 my-auto showcase-text">
                        <h2>Updated For Bootstrap 5</h2>
                        <p class="lead mb-0">Newly improved, and full of great utility classes, Bootstrap 5 is leading the way in mobile responsive web development! All of the themes on Start Bootstrap are now using Bootstrap 5!</p>
                    </div>
                </div>
            </div>
        </section>
	</div>
	<!-- Main Content -->
</div>
<!-- Main Content Wrapper -->

<!-- AJAX Request -->
<script type="text/javascript">
	let ajax = document.querySelector(".ajax");
	ajax.addEventListener("click", function() {
		console.log("ajax request");
		let xhr = new XMLHttpRequest();
		xhr.open("GET", "func/ajax.php", true);
		xhr.onload = function() {
			if (this.status == 200) {
				console.log(this.responseText);
				let numposts = document.querySelector(".num-posts");
				let output = "<ul>";
				let result = JSON.parse(this.responseText);
				console.log(result);
				result.forEach((item, i) => {
					output += `<li>${item['post_title']}</li>`;
				});

				output += "</ul>";
				console.log(output);
				numposts.innerHTML = output;

			}
		}
		xhr.send();
	})
</script>
<!-- AJAX Request -->


<!-- Index Page Footer -->
<?php
include 'includes/footer.php';
?>
<!-- Index Page Footer -->