<?php 
    require_once('db.php');

    var_dump($_POST);
    
    if (isset($_POST['author']) && $_POST['author'] > 0) {
        $sql_posts = "SELECT p.*, a.firstname, a.lastname, a.gender FROM posts AS p
                      INNER JOIN author as a ON p.author_id = a.id WHERE p.author_id = {$_POST['author']}";
    } else {
        $sql_posts = "SELECT p.*, a.firstname, a.lastname, a.gender FROM posts AS p
                      INNER JOIN author as a ON p.author_id = a.id";
    }

    $posts = getDataFromServer($sql_posts, $connection);

    if (isset($_POST['newestPosts'])) {
        usort($posts, function($first, $second){
            return $first['created_at'] < $second['created_at'];
        });
    }

    if (isset($_POST['oldestPosts'])) {
        usort($posts, function($first, $second){
            return $first['created_at'] > $second['created_at'];
        });
    }

?>

<?php
    foreach ($posts as $post) {
?>
    <div class="blog-post">
        <h2 class="blog-post-title"><a href="single-post.php?post_id=<?php echo $post['id']; ?>"><?php echo $post['title']; ?></a></h2>
        <p class="blog-post-meta"><?php echo DateTime::createFromFormat('Y-m-j', $post['created_at'])->format('M j, Y');?> by <a href="#"><?php echo $post['firstname'] . ' ' . $post['lastname']; ?></a></p>
        <p><?php echo$post['body']; ?></p>
    </div>
<?php 
    }
?>    