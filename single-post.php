<?php
    require_once('db.php'); 
    
?>

<!doctype html>
<html lang="en">
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../../../favicon.ico">

    <title>Vivify Blog</title>

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">

    <!-- Custom styles for this template -->
    <link href="styles/blog.css" rel="stylesheet">
    <link href="styles/styles.css" rel="stylesheet">
</head>

<body>
    
<?php include('header.php') ?>

<main role="main" class="container">

    <div class="row">

        <div class="col-sm-8 blog-main">

            <?php
                if (isset($_GET['post_id'])) {
                    $sql_post = "SELECT p.*, a.firstname, a.lastname, a.gender FROM posts AS p
                                 INNER JOIN author as a ON p.author_id = a.id WHERE p.id = {$_GET['post_id']};";
                    $post = getDataFromServer($sql_post, $connection, false);

                    $sql_comments = "SELECT * FROM comments WHERE comments.post_id = {$_GET['post_id']}";
                    $comments = getDataFromServer($sql_comments, $connection);
            ?>

                <div class="blog-post">
                    <h2 class="blog-post-title"><a href="single-post.php?post_id=<?php echo($post['id']); ?>"><?php echo($post['title']); ?></a></h2>
                    <p class="blog-post-meta"><?php echo DateTime::createFromFormat('Y-m-j', $post['created_at'])->format('M j, Y');?> by <a href="#"><?php echo $post['firstname'] . ' ' . $post['lastname']; ?></a></p>
                    <p><?php echo($post['body']); ?></p>
                </div>

                <h3>Comments</h3>
                <?php
                    if (empty($comments)) {
                        echo '<p>No comments on this post</p>';
                    } else {              
                ?>
                        <ul>
                            <?php
                                foreach ($comments as $comment) {
                            ?>
                                <li class="single-comment">
                                    <p>posted by: <a href="#"><?php echo $comment['author']; ?></a></p> 
                                    <p><?php echo $comment['text']; ?></p>
                                </li>
                                <hr/>
                            <?php
                                }
                            ?>
                        </ul>

            <?php
                    }
                } else {
                    echo 'post_id not passed through URL';
                }
            ?>
        </div>

        <?php include('sidebar.php') ?>

    </div>
</main>

<?php include('footer.php') ?>

</body>
</html>