<?php
if(isset($_GET["id"])){

    require_once "config.php";
    
    $id = $_GET['id'];

    $sql = "SELECT * FROM employees WHERE id = $id";
    
    if($stmt = $pdo->prepare($sql)) {
        
        if($stmt->execute()){

            if($stmt->rowCount() == 1){

                $row = $stmt->fetch(PDO::FETCH_ASSOC);
                
                $name = $row["name"];
                $address = $row["address"];
                $salary = $row["salary"];

            } else{

                header("location: error.php");
                exit();

            }
            
        } else{

            echo "Oops! Something went wrong. Please try again later.";

        }
    }
     
    unset($stmt);
    
    unset($pdo);

} else{

    header("location: error.php");
    exit();

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
            <h1>View Record</h1>
        </div>
        <div>
            <label>Name</label>
            <p><?php echo $row["name"]; ?></p>
        </div>
        <div>
            <label>Address</label>
            <p><?php echo $row["address"]; ?></p>
        </div>
        <div>
            <label>Salary</label>
            <p><?php echo $row["salary"]; ?></p>
        </div>
        <p><a href="index.php">Back</a></p>
    </div>
</body>
</html>