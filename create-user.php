<?php

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

require_once "db-connection.php";
 
if($_SERVER["REQUEST_METHOD"] == "POST"){

    $username = $_POST['username'];
    $credential = $_POST['credential'];
    $role = $_POST['role'];

    $sql = "INSERT INTO user (username, credential, role) VALUES (:username, :credential, :role)";

    if($stmt = $pdo->prepare($sql)){
        $stmt->bindParam(":username", $param_username);
        $stmt->bindParam(":credential", $param_credential);
        $stmt->bindParam(":role", $param_role);
        
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
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Create Record</title>
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
                        <h2>Create Record</h2>
                    </div>
                    <p>Please fill this form and submit to add User record to the database.</p>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <div class="form-group">
                            <label>Username</label>
                            <input type="text" name="username" class="form-control">
                        </div>
                        <div class="form-group>">
                            <label>Credential</label>
                            <input type="password" name="credential" class="form-control"></input>
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