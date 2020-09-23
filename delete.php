<?php
if(isset($_POST["id"])){

    require_once "config.php";
    
    $sql = "DELETE FROM employees WHERE id = :id";
    
    if($stmt = $pdo->prepare($sql)){

        $stmt->bindParam(":id", $param_id);
        
        $param_id = trim($_POST["id"]);
        
        if($stmt->execute()){

            header("location: index.php");
            exit();

        } else{

            echo "Oops! Something went wrong. Please try again later.";

        }

    }
     
    unset($stmt);
    
    unset($pdo);

} else{

    if(empty(trim($_GET["id"]))){

        header("location: error.php");
        exit();

    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>View Record</title>
</head>
<body>
    <div>
        <div>
            <h1>Delete Record</h1>
        </div>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div>
                <input type="hidden" name="id" value="<?php echo trim($_GET["id"]); ?>"/>
                <p>Are you sure you want to delete this record?</p><br>
                <p>
                    <input type="submit" value="Yes">
                    <a href="index.php">No</a>
                </p>
            </div>
        </form>
    </div>
</body>
</html>