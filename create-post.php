<?php include_once('db.php'); ?>

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

<?php 
    $sql_allauthors = "SELECT * FROM author";
    $authors = getDataFromServer($sql_allauthors, $connection); 
?>

<?php
    if (isset($_POST['submit'])) {
        $title = $_POST['title'];
        $body = $_POST['body'];
        $currentDate = date("Y-m-d h:i");
        $author_id = $_POST['author_id'];

        $sql_newpost = "INSERT INTO posts (title, body, author_id, created_at) 
                        VALUES ('$title', '$body', '$author_id', '$currentDate');";

        $statement = $connection->prepare($sql_newpost);
        $statement->execute();
    }
?>

<?php include('header.php') ?>

<main role="main" class="container">

    <div class="row">

        <div class="col-sm-8 blog-main">

            <div class="blog-post">
                <form action="create-post.php" method="POST" id="createPostForm">
                    <label for="title">Title</label><br/>
                    <input type="text" name="title" placeholder="Title of the Post" id="titlePost" required>  <br/><br/>            
                    <label for="body">Body</label><br/>
                    <textarea name="body" placeholder ="Post" rows = "10" id="bodyPost" required></textarea><br/><br/>
                    <label>Select one Author</label><br/>
                    <select name="author_id" id="selectedAuthorId">
                        <option selected disabled>Select one Author</option>
                        <?php 
                            foreach ($authors as $author) {
                                $genderClass = $author['gender'] === 'M' ? 'author-male' : 'author-female';
                        ?>     
                            <option class="<?php echo $genderClass; ?>" value="<?php echo $author['id']; ?>"><?php echo $author['firstname'] . ' ' . $author['lastname']; ?></option>
                        <?php
                            }
                        ?>
                    </select>
                    <br><br>

                    <button type="submit" name="submit">Submit</button>
                </form>
            </div>

        </div>

        <?php include('sidebar.php') ?>

    </div>
</main>

<?php include('footer.php') ?>

</body>
</html>