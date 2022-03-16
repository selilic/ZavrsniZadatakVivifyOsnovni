<?php 
    require_once('db.php'); 
    $sql_posts = "SELECT p.*, a.firstname, a.lastname, a.gender FROM posts AS p
                  INNER JOIN author as a ON p.author_id = a.id ORDER BY created_at DESC";
    // $sql_posts = "SELECT * FROM posts ORDER BY created_at DESC";
    $posts = getDataFromServer($sql_posts, $connection);
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