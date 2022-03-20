<?php
    $servername = "127.0.0.1";
    $username = "root";
    $password = "";
    $dbname = "blog";

    try {
        $connection = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    catch(PDOException $e)
    {
        echo $e->getMessage();
    }

    function getDataFromServer($sql, $connection, $isFetchAll = true) {
        $statement = $connection->prepare($sql);
        $statement->execute();
        $statement->setFetchMode(PDO::FETCH_ASSOC);
        if ($isFetchAll) {
            return $statement->fetchAll();
        }
        return $statement->fetch();
    }

    function deletePostFromDatabase($id, $author_id, $connection){
        $sql = "DELETE FROM posts WHERE id = {$id} AND author_id = {$author_id};";
        $statement = $connection->prepare($sql);
        $statement->execute();
    }
?>