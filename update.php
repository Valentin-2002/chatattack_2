<?php
// Include config file
require_once "config.php";
 

 
// Processing form data when form is submitted
if(isset($_POST["id"]) && !empty($_POST["id"])){
    // Get hidden input value
    $id = $_POST["id"];
    $username = $_POST['username'];
    $credential = $_POST['credential'];
    $role = $_POST['role'];
    
    // Prepare an update statement
    $sql = "UPDATE user SET username=:username, credential=:credential, role=:role WHERE id=:id";

    if($stmt = $pdo->prepare($sql)){
        // Bind variables to the prepared statement as parameters
        $stmt->bindParam(":username", $param_username);
        $stmt->bindParam(":credential", $param_credential);
        $stmt->bindParam(":role", $param_role);
        
        // Set parameters
        $param_username = $username;
        $param_credential = $credential;
        $param_role = $role;
        
        // Attempt to execute the prepared statement
        if($stmt->execute()){
            // Records created successfully. Redirect to landing page
            header("location: index.php");
            exit();
        } else{
            echo "Something went wrong. Please try again later.";
        }
    }
        
    // Close statement
    unset($stmt);
    
    // Close connection
    unset($pdo);
} else{
    // Check existence of id parameter before processing further
    if(isset($_GET["id"]) && !empty(trim($_GET["id"]))){
        // Get URL parameter
        $id =  trim($_GET["id"]);
        
        // Prepare a select statement
        $sql = "SELECT * FROM user WHERE id = :id";
        if($stmt = $pdo->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bindParam(":id", $param_id);
            
            // Set parameters
            $param_id = $id;
            
            // Attempt to execute the prepared statement
            if($stmt->execute()){
                if($stmt->rowCount() == 1){
                    /* Fetch result row as an associative array. Since the result set contains only one row, we don't need to use while loop */
                    $row = $stmt->fetch(PDO::FETCH_ASSOC);
                    
                    // Retrieve individual field value
                    $username = $row["username"];
                    $credential = $row["credential"];
                    $role = $row["role"];
                } else{
                    // URL doesn't contain valid id. Redirect to error page
                    header("location: error1.php");
                    exit();
                }
                
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
        }
        
        // Close statement
        unset($stmt);
        
        // Close connection
        unset($pdo);
    }  else{
        // URL doesn't contain id parameter. Redirect to error page
        header("location: error2.php");
        exit();
    }
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Update Record</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        .wrapper{
            width: 500px;
            margin: 0 auto;
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-header">
                        <h2>Edit Record</h2>
                    </div>
                    <p>Please fill this form and submit to add User record to the database.</p>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <div class="form-group">
                            <label>Username</label>
                            <input type="text" name="username" class="form-control" value="<?= $username ?>">
                        </div>
                        <div class="form-group>">
                            <label>Credential</label>
                            <input type="password" name="credential" class="form-control" value="<?= $credential ?>"></input>
                        </div>
                        <div class="form-group">
                        <label for="cars">Role</label>
                        <select name="role">
                        <option value="1">Administrator</option>
                        <option value="0">Default</option>
                        </select>
                        </div>
                        <input type="submit" class="btn btn-primary" value="Submit">
                        <a href="index.php" class="btn btn-default">Cancel</a>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>