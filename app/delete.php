<?php 

require("utils.php");

try {
    

    $conn = require("connect.php");

    $id = $_GET['id'];

    if($id != null) {
        $sql = "DELETE FROM books where id=:id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        $book = $stmt->fetch();
        header("location: /");
    }
 

} catch (\PDOException $e) {
    echo "error". $e->getMessage() ."";
    die();
}
