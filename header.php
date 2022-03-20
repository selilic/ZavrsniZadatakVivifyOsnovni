<?php 
    require_once('db.php');

    $sql_allauthors = "SELECT * FROM author";
    $authors = getDataFromServer($sql_allauthors, $connection);

    echo '<pre>';
    var_dump($authors[1]);
    echo '</pre>';

    $selectedAuthorId = '';
    $selectedId = '';
?>

<?php 
    var_dump($_POST);
    if (isset($_POST['selectAuthor'])) {
        $sql_postsFromAuthor = "SELECT * FROM posts WHERE author_id = {$_POST['selectedAuthorId']}";
        $postsFromAuthor = getDataFromServer($sql_postsFromAuthor, $connection);
        echo '<br/>';
        var_dump($postsFromAuthor);
        echo '<br/>';

        $selectedAuthorId = $_POST['selectedAuthorId'];
        $selectedId = [];

        foreach($postsFromAuthor as $postFromAuthor) {
            $selectedId[] = $postFromAuthor['id'];
        }

        echo '<br/>';
        var_dump($selectedId);
        echo '<br/>';
    }

    echo '<br/>';
    var_dump($selectedId);
    echo '<br/>';
    var_dump($selectedAuthorId);
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
    <br/><br/>

    <form action="index.php" method="POST">
        <select name="selectedAuthorId" id="editDeletePostOneAuthor" required>
            <option value="0">All authors</option>
            <?php 
                foreach ($authors as $author) { 
            ?>
                <option value="<?php echo $author['id']; ?>"><?php echo "{$author['firstname']} {$author['lastname']}"; ?></option>
            <?php 
                }
            ?>
        </select>
        <button type="submit" name="selectAuthor">Select author</button>
    </form> <br/><br/>

    <div class="blog-header">
        <div class="container">
            <h1 class="blog-title small">The Bootstrap Blog</h1>
            <p class="lead blog-description small">An example blog template built with Bootstrap.</p>
        </div>
    </div>
</header>