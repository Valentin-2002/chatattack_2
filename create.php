<?php
require_once "config.php";
 
$name = $address = $salary = "";
$name_err = $address_err = $salary_err = "";
 
if($_SERVER["REQUEST_METHOD"] == "POST"){
    $input_name = trim($_POST["name"]);
    if(empty($input_name)){
        $name_err = "Please enter a name.";
    } elseif(!filter_var($input_name, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
        $name_err = "Please enter a valid name.";
    } else{
        $name = $input_name;
    }
    
    $input_address = trim($_POST["address"]);
    if(empty($input_address)){
        $address_err = "Please enter an address.";     
    } else{
        $address = $input_address;
    }
    
    $input_salary = trim($_POST["salary"]);
    if(empty($input_salary)){
        $salary_err = "Please enter the salary amount.";     
    } elseif(!ctype_digit($input_salary)){
        $salary_err = "Please enter a positive integer value.";
    } else{
        $salary = $input_salary;
    }
    
    if(empty($name_err) && empty($address_err) && empty($salary_err)){
        $sql = "INSERT INTO employees (name, address, salary) VALUES (:name, :address, :salary)";
 
        if($stmt = $pdo->prepare($sql)){
            $stmt->bindParam(":name", $param_name);
            $stmt->bindParam(":address", $param_address);
            $stmt->bindParam(":salary", $param_salary);
            
            $param_name = $name;
            $param_address = $address;
            $param_salary = $salary;
            
            if($stmt->execute()){
                header("location: index.php");
                exit();
            } else{
                echo "Something went wrong. Please try again later.";
            }
        }
         
        unset($stmt);
    }
    
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
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div>
                <label>Name</label>
                <input type="text" name="name" class="form-control" value="<?php echo $name; ?>">
                <span class="help-block"><?php echo $name_err;?></span>
            </div>
            <div>
                <label>Address</label>
                <textarea name="address" class="form-control"><?php echo $address; ?></textarea>
                <span class="help-block"><?php echo $address_err;?></span>
            </div>
            <div>
                <label>Salary</label>
                <input type="text" name="salary" class="form-control" value="<?php echo $salary; ?>">
                <span class="help-block"><?php echo $salary_err;?></span>
            </div>
            <input type="submit" class="btn btn-primary" value="Submit">
            <a href="index.php" class="btn btn-default">Cancel</a>
        </form>
    </div>
</body>
</html>