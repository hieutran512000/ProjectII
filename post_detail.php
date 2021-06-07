<!-- Index Page Header -->
<?php
include 'includes/header.php';
$sql = "SELECT * FROM posts WHERE ID = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $_GET['id']);
$stmt->execute();
$post = $stmt->get_result()->fetch_assoc();

$sql = "SELECT * FROM users WHERE ID = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $post['post_author']);
$stmt->execute();
$user = $stmt->get_result()->fetch_assoc();

$sql = "SELECT * FROM comments WHERE post_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $post['ID']);
$stmt->execute();
$comments = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);

?>
<!-- Index Page Header -->

<head>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css">
    <link href="css/star-rating.css" media="all" rel="stylesheet" type="text/css" />
    <link href="js/themes/krajee-fas/theme.css" media="all" rel="stylesheet" type="text/css" />
    <link href="js/themes/krajee-svg/theme.css" media="all" rel="stylesheet" type="text/css" />
    <!--suppress JSUnresolvedLibraryURL -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="js/star-rating.js" type="text/javascript"></script>
    <script src="js/themes/krajee-fas/theme.js" type="text/javascript"></script>
    <script src="js/themes/krajee-svg/theme.js" type="text/javascript"></script>
</head>

<!-- Page content-->
<div class="container mt-5">
    <div class="row">
        <div class="col-lg-8">
            <!-- Post content-->
            <article>
                <!-- Post header-->
                <header class="mb-4">
                    <!-- Post title-->
                    <h1 class="fw-bolder mb-1"><?= $post['post_title'] ?></h1>
                    <!-- Post meta content-->
                    <div class="text-muted fst-italic mb-2">Posted on <?= $post['date_created'] ?> by <?= $user['user_name'] ?></div>
                    <!-- Post categories-->
                </header>
                <!-- Preview image figure-->
                <figure class="mb-4"><img class="img-fluid rounded" id="img" style="width:100%" src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSPUhcVUm8PuFd3oxvkcmb3nlTSsofxEvcauA&usqp=CAU" alt="..." /></figure>
                <!-- Post content-->
                <section class="mb-5">
                    <p class="fs-5 mb-4" id="body"><?= $post['post_body'] ?></p>
                    <h2 class="fw-bolder mb-4 mt-5">I have odd cosmic thoughts every day</h2>
                    <p class="fs-5 mb-4">For me, the most fascinating interface is Twitter. I have odd cosmic thoughts every day and I realized I could hold them to myself or share them with people who might be interested.</p>
                    <p class="fs-5 mb-4">Venus has a runaway greenhouse effect. I kind of want to know what happened there because we're twirling knobs here on Earth without knowing the consequences of it. Mars once had running water. It's bone dry today. Something bad happened there as well.</p>
                </section>
            </article>

            <hr />
            <form action="func/rating.php" method="post" id="rating_form">
                <div class='row'>
                    <div class='col-6'>
                        <input type="hidden" name="post_id" value="<?= $post["ID"] ?>">
                        <input id="kartik" class="rating" data-stars="5" name="rating" data-step="0.5" value="<?= isset($post['rating']) ? $post['rating'] : 0 ?>" />
                    </div>
                    <div class='col-3 mt-2'>
                        <button type="submit" class='btn btn-outline-primary btn-block'>Rating</button>
                    </div>
                    <div class='col-3 mt-2'>
                        <button type="reset" class="btn btn-outline-secondary btn-block">Reset</button>
                    </div>
                </div>
            </form>
            <hr />
            <!-- Comments section-->
            <section class="mb-5">
                <div class="card bg-light">
                    <div class="card-body">
                        <!-- Comment form-->
                        <form class="mb-4" action="func/comment.php" method="post">
                            <input type="hidden" name="post_id" value="<?= $post["ID"] ?>">
                            <textarea id='comment_content' name='comment_content' class="form-control" rows="3" placeholder="Join the discussion and leave a comment!" required=required></textarea>
                            <button class='btn btn-outline-primary btn-block' id="comment_submit" type="submit" name="comment">Comment</button>
                        </form>

                        <div id='comment-holder'>

                            <?php 
                                foreach($comments as $comment) {
                                    $sql = "SELECT * FROM users WHERE ID = ?";
                                    $stmt = $conn->prepare($sql);
                                    $stmt->bind_param("i", $comment['user_id']);
                                    $stmt->execute();
                                    $commenter = $stmt->get_result()->fetch_assoc();
                                ?>
                                <!-- Single comment-->
                                <div class="d-flex">
                                    <div class="flex-shrink-0 mr-2"><img class="rounded-circle" src="https://dummyimage.com/50x50/ced4da/6c757d.jpg" alt="..." /></div>
                                    <div class="ms-3">
                                        <div class="fw-bold"><?= $commenter['user_name'] ?></div>
                                        <p><?= $comment['content'] ?></p>
                                    </div>
                                </div>

                                <hr/>
                            <?php } ?>
                        </div>

                    </div>
                </div>
            </section>
        </div>
        <!-- Side widgets-->
        <div class="col-lg-4">
            <!-- Search widget-->
            <div class="card mb-4">
                <div class="card-header">Search</div>
                <div class="card-body">
                    <div class="input-group">
                        <input class="form-control" type="text" placeholder="Enter search term..." aria-label="Enter search term..." aria-describedby="button-search" />
                        <button class="btn btn-primary" id="button-search" type="button">Go!</button>
                    </div>
                </div>
            </div>
            <!-- Categories widget-->
            <div class="card mb-4">
                <div class="card-header">Categories</div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-6">
                            <ul class="list-unstyled mb-0">
                                <li><a href="#!">Web Design</a></li>
                                <li><a href="#!">HTML</a></li>
                                <li><a href="#!">Freebies</a></li>
                            </ul>
                        </div>
                        <div class="col-sm-6">
                            <ul class="list-unstyled mb-0">
                                <li><a href="#!">JavaScript</a></li>
                                <li><a href="#!">CSS</a></li>
                                <li><a href="#!">Tutorials</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Side widget-->
            <div class="card mb-4">
                <div class="card-header">Side Widget</div>
                <div class="card-body">You can put anything you want inside of these side widgets. They are easy to use, and feature the Bootstrap 5 card component!</div>
            </div>
        </div>
    </div>
</div>
<!-- Page content -->

<?php
include 'includes/footer.php';
?>