<?php 
    require_once('db.php');

    $sql_allauthors = "SELECT * FROM author";
    $authors = getDataFromServer($sql_allauthors, $connection);
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

<div class='filterAuthorDiv'>
    <form action="index.php" method="POST">
        <select name="author" id="filterAuthor" required>
            <option value="0">All authors</option>
            <?php 
                foreach ($authors as $author) { 
            ?>
                <option value="<?php echo $author['id']; ?>"><?php echo "{$author['firstname']} {$author['lastname']}"; ?></option>
            <?php 
                }
            ?>
        </select> <br/><br/>
        <button type="submit" name="submit">Select author</button>
    </form> <br/><br/>
</div>

<div class='sortPostsDiv'>
    <form class="sortPostsByDate" action="index.php" method="POST">
        <button type="submit" name="newestPosts" id="newestPosts">&uarr;</button>
    </form>
    <form class="sortPostsByDate" action="index.php" method="POST">
        <button type="submit" name="oldestPosts" id="oldestPosts">&darr;</button>
    </form>
</div>

<main role="main" class="container">

    <div class="row">

        <div class="col-sm-8 blog-main">

            <?php include('posts.php') ?>

            <nav class="blog-pagination">
                <a class="btn btn-outline-primary small" href="#">Older</a>
                <a class="btn btn-outline-secondary disabled small" href="#">Newer</a>
            </nav>

        </div><!-- /.blog-main -->

        <?php include('sidebar.php') ?>
        <!-- /.blog-sidebar -->

    </div><!-- /.row -->

</main><!-- /.container -->

<?php include('footer.php') ?>

</body>
</html>