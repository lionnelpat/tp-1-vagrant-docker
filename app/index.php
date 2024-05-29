<?php 

try {

    $conn = require("connect.php");

    $sql = "SELECT * FROM books";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $books = $stmt->fetchAll(PDO::FETCH_ASSOC);

} catch (\PDOException $e) {
    echo "error". $e->getMessage() ."";
    die();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>

    <div class="container my-5">
        <div class="card mt-5">
            <div class="card-title p-3">
                <h3>Liste des Livres</h3>
            </div>
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                        <th scope="col">#</th>
                        <th scope="col">Titre</th>
                        <th scope="col">Price</th>
                        <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($books as $key => $book): ?>
                        <tr>
                            <th scope="row"><?=$key + 1?></th>
                            <td><?= $book["title"] ?></td>
                            <td><?= $book["price"] ?></td>
                            <td>
                                <a href="" class="btn btn-sm btn-warning">edit</a>
                                <a href="" class="btn btn-sm btn-danger">delete</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>