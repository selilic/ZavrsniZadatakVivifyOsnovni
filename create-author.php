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
    if (isset($_POST['submit'])) {
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $gender = $_POST['gender'];

        $sql_newauthor = "INSERT INTO author (firstname, lastname, gender) 
                          VALUES ('$firstname', '$lastname', '$gender');";

        $statement = $connection->prepare($sql_newauthor);
        $statement->execute();
    }
?>

<?php include('header.php') ?>

<main role="main" class="container">

    <div class="row">

        <div class="col-sm-8 blog-main">

            <div class="blog-post">
                <form action="create-author.php" method="POST" id="createAuthorForm">
                    <label for="firstname">First name of the Author</label><br/>
                    <input type="text" name="firstname" placeholder="First name" id="firstnameAuthor" required/><br/><br/>            
                    <label for="lastname">Last name of the Author</label><br/>
                    <input type="text" name="lastname" placeholder ="Last name" id="lastnameAuthor" required/><br/><br/>
                    <label>Gender of the Author</label><br/>
                    <input type="radio" id="male" name="gender" value="M" required>
                    <label for="male">Male</label>
                    <input type="radio" id="female" name="gender" value="F">
                    <label for="female">Female</label><br/><br/>

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