<?php 

require("utils.php");

try {
    $titleErr = $priceErr = "";
    $title = $price = "";

    $conn = require("connect.php");

    $id = $_GET['id'];

    $sql = "SELECT * FROM books where id=:id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(":id", $id);
    $stmt->execute();
    $book = $stmt->fetch();
    // dd($book);
    
    if($_SERVER['REQUEST_METHOD'] == "POST"){
        
        $title = test_input($_POST['title']);
        $price = test_input($_POST['price']);

        // var_dump($title);

        if (empty($_POST["title"])) {
            $titleErr = "title is required";
            
        } else {
            $title = test_input($_POST["title"]);
        }

        if (empty($_POST["price"])) {
            $priceErr = "price is required";
        } else {
            $price = test_input($_POST["price"]);
        }

        


        if(!empty($title) && !empty($price)){

            $sql = "UPDATE books SET title='$title', price='$price' WHERE id = $id;";
            $stmt = $conn->prepare($sql);
            $stmt->execute();

            header("Location: http://localhost:8080/index.php");
        }


    }

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
        <header class="d-flex flex-wrap justify-content-center py-3 mb-4 border-bottom">
            <a href="index.php" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto link-body-emphasis text-decoration-none">
                <svg class="bi me-2" width="40" height="32"><use xlink:href="#bootstrap"/></svg>
                <span class="fs-4">Simple PHP App</span>
            </a>

            <ul class="nav nav-pills">
                <li class="nav-item"><a href="index.php" class="nav-link active" aria-current="page">Home</a></li>
                <li class="nav-item"><a href="#" class="nav-link">Features</a></li>
                <li class="nav-item"><a href="#" class="nav-link">Pricing</a></li>
                <li class="nav-item"><a href="#" class="nav-link">FAQs</a></li>
                <li class="nav-item"><a href="#" class="nav-link">About</a></li>
            </ul>
        </header>
        <div class="container my-5">
            <div class="card mt-5">
                <div class="card-title p-3 d-flex justify-content-between">
                    <h3>Ajouter un Livre</h3>
                </div>
                <div class="card-body">
                    <form action="udpate.php?id=<?= $book['id']?>" method="post">
                    <div class="row mb-3">
                            <label for="title" class="col-sm-2 col-form-label">Title</label>
                            <div class="col-sm-10">
                                <input type="text" 
                                class="form-control <?= !empty($titleErr) ?  'is-invalid': '' ?>"  
                                id="title" 
                                name="title"
                                value="<?= $book["title"] ?>"
                                >
                                <?php if (!empty($titleErr)): ?>
                                    <div class="text-danger">
                                        <?= $titleErr ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="price" class="col-sm-2 col-form-label">Price</label>
                            <div class="col-sm-10">
                                <input 
                                type="number" 
                                class="form-control <?= !empty($priceErr) ?  'is-invalid': '' ?>" 
                                id="price" 
                                name="price"
                                value="<?= $book["price"]  ?>"
                                >
                                
                                <?php if (!empty($priceErr)): ?>
                                    <div class="text-danger">
                                        <?= $priceErr ?>
                                    </div>
                                <?php endif ; ?>
                            </div>
                            
                        </div>
                        <a href="index.php" class="btn mx-2 btn-outline-secondary">cancel</a>
                        <button type="submit" class="btn btn-primary">save</button>
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>