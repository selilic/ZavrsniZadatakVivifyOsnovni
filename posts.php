<?php 
    require_once('db.php');

    $sortType = 'Not sorted';

    if (isset($_POST['author']) && $_POST['author'] > 0) {
        $sql_posts = "SELECT p.*, a.firstname, a.lastname, a.gender FROM posts AS p
                      INNER JOIN author as a ON p.author_id = a.id WHERE p.author_id = {$_POST['author']}";
    } else {
        $sql_posts = "SELECT p.*, a.firstname, a.lastname, a.gender FROM posts AS p
                      INNER JOIN author as a ON p.author_id = a.id";
    }

    $posts = getDataFromServer($sql_posts, $connection);

    if (isset($_POST['ascBtn'])) {
        usort($posts, function($first, $second){
            return $first['created_at'] > $second['created_at'];
        });

        $sortType = 'ASC';
    }

    if (isset($_POST['descBtn'])) {
        usort($posts, function($first, $second){
            return $first['created_at'] < $second['created_at'];
        });

        $sortType = 'DESC';
    }

    if (isset($_GET['post_id']) && isset($_GET['author_id'])) {  
        $id = $_GET['post_id'];
        $author_id = $_GET['author_id'];
        $sql_deleteRow = "DELETE FROM posts WHERE id = '$id' AND author_id = '$author_id'";
        $statement = $connection->prepare($sql_deleteRow);
        $statement->execute();
        header('Location: index.php');
   } 
?>

<?php
    foreach ($posts as $post) {
?>
    <div class="blog-post">
        <h2 class="blog-post-title"><a href="single-post.php?post_id=<?php echo $post['id']; ?>"><?php echo $post['title']; ?></a></h2>
        <p class="blog-post-meta"><?php echo DateTime::createFromFormat('Y-m-j', $post['created_at'])->format('M j, Y');?> by <a href="#"><?php echo $post['firstname'] . ' ' . $post['lastname']; ?></a></p>
        <p><?php echo$post['body']; ?></p>
        
        <button class="edit <?php echo $post['id']; ?> <?php echo $post['author_id']; ?>" <?php if($post['author_id'] === $selectedAuthorId) {echo 'style="visibility:visible;"';} else {echo 'style="visibility:hidden;"';} ?> >Edit</button>

        <a class="delete" <?php if($post['author_id'] === $selectedAuthorId) {echo 'style="visibility:visible;"';} else {echo 'style="visibility:hidden;"';} ?> href="index.php?post_id=<?php echo $post['id']; ?>&author_id=<?php echo $post['author_id']; ?>">Delete</a>
    </div>
<?php 
    }
?>