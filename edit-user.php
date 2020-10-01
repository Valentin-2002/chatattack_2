<?php
require_once "db-connection.php";

session_start();

if(!isset($_SESSION['id']))
{
	header("location:login.php");
}

if(isset($_SESSION['role'])) {
	if($_SESSION['role'] == 1) {
		readfile("adminnavigation.html");
	} else {
		readfile("defaultnavigation.html");
	}
}

if(isset($_POST["id"]) && !empty($_POST["id"])){
    $id = $_POST["id"];
    echo('ID: ' . $id);
    $username = $_POST['username'];
    $credential = $_POST['credential'];
    $role = $_POST['role'];
    
    $sql = "UPDATE user SET username=:username, credential=:credential, role=:role WHERE id=:id";

    if($stmt = $pdo->prepare($sql)){
        $stmt->bindParam(":id", $param_id);
        $stmt->bindParam(":username", $param_username);
        $stmt->bindParam(":credential", $param_credential);
        $stmt->bindParam(":role", $param_role);
        
        $param_id = $id;
        $param_username = $username;
        $param_credential = $credential;
        $param_role = $role;
        
        if($stmt->execute()){
            header("location: admin-menu.php");
            exit();
        } else{
            echo "Something went wrong. Please try again later.";
        }
    }
        
    unset($stmt);
    
    unset($pdo);
} else{
    if(isset($_GET["id"]) && !empty(trim($_GET["id"]))){
        $id =  trim($_GET["id"]);
        $sql = "SELECT * FROM user WHERE id = :id";
        if($stmt = $pdo->prepare($sql)){
            $stmt->bindParam(":id", $param_id);
            
            $param_id = $id;
            
            if($stmt->execute()){
                if($stmt->rowCount() == 1){
                    $row = $stmt->fetch(PDO::FETCH_ASSOC);
                    
                    $username = $row["username"];
                    $credential = $row["credential"];
                    $role = $row["role"];
                } else{
                    exit();
                }
                
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
        }
        
        unset($stmt);
        
        unset($pdo);
    }  else{
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
                        <input hidden name="id" value="<?= $id ?>"></input>
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
                        <a href="admin-menu.php" class="btn btn-default">Cancel</a>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>