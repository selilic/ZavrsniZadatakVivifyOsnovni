<?php 
    require_once('db.php');

    $sql_allauthors = "SELECT * FROM author";
    $authors = getDataFromServer($sql_allauthors, $connection);
?>

<header>
    <div class="blog-masthead navBackground">
        <div class="container">
            <nav class="nav">
                <a class="nav-link active" href="#">Home</a>
                <a class="nav-link" href="#">New features</a>
                <a class="nav-link" href="#">Press</a>
                <a class="nav-link" href="#">New hires</a>
                <a class="nav-link" href="#">About</a>
            </nav>
        </div>
    </div>

    <div>
        <a href="redirect.php"><button>Create post</button><a/>
    </div>

    <div class="blog-header">
        <div class="container">
            <h1 class="blog-title small">The Bootstrap Blog</h1>
            <p class="lead blog-description small">An example blog template built with Bootstrap.</p>
        </div>
    </div>

</header>