<?php
require_once "config.php";
 
 
if($_SERVER["REQUEST_METHOD"] == "POST"){

        $id = $_POST['id'];
        $name = $_POST['name'];
        $address= $_POST['address'];
        $salary = $_POST['salary']; 
        $sql = "UPDATE employees SET name=$name, address=$address, salary=$salary WHERE id=$id";
 
        if($stmt = $pdo->prepare($sql)){

            if($stmt->execute()){

                header("location: index.php");
                exit();

            } else{

                echo "Something went wrong. Please try again later.";

            }
        }
         
        unset($stmt);
        unset($pdo);
    }
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Create Record</title>
</head>
<body>
    <div>
        <div>
            <h2>Create Record</h2>
        </div>
        <p>Please fill this form and submit to add employee record to the database.</p>
        <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post">
            <div>
                <label>Name</label>
                <input type="text" name="name" value="<?php echo $name; ?>">
            </div>
            <div>
                <label>Address</label>
                <textarea name="address"><?php echo $address; ?></textarea>
            </div>
            <div>
                <label>Salary</label>
                <input type="text" name="salary" value="<?php echo $salary; ?>">
            </div>
            <input type="submit" value="Submit">
            <a href="index.php">Cancel</a>
        </form>
    </div>
</body>
</html>