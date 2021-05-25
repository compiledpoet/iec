<?php

session_start();
 

if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("location: welcome.php");
    exit;
}
 
require_once "config.php";
 

$user_id = $password = "";
$user_id_err = $password_err = "";
 

if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    
    if(empty(trim($_POST["voter_id_number"]))){
        $user_id_err = "Please enter ID Number.";
    } else{
        $user_id = trim($_POST["voter_id_number"]);
    }
    
   
    if(empty(trim($_POST["registration_code"]))){
        $password_err = "Please enter your registration code.";
    } else{
        $password = trim($_POST["registration_code"]);
    }
    
    
    if(empty($user_id_err) && empty($password_err)){
        
        $sql = "SELECT voter_id_number, registration_code FROM voter WHERE voter_id_number = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            
            mysqli_stmt_bind_param($stmt, "s", $param_user_id);
            
            
            $param_user_id = $user_id;
            
            
            if(mysqli_stmt_execute($stmt)){
                
                mysqli_stmt_store_result($stmt);
                
                
                if(mysqli_stmt_num_rows($stmt) == 1){                    
                    
                    mysqli_stmt_bind_result($stmt, $id, $user_id, $hashed_password);
                    if(mysqli_stmt_fetch($stmt)){
                        if(password_verify($password, $hashed_password)){
                            
                            session_start();
                            
                            
                            $_SESSION["loggedin"] = true;
                            $_SESSION["voter_id_number"] = $user_id;
                                                
                            
                            
                            header("location: welcome.php");
                        } else{
                            
                            $password_err = "The code you entered was not valid.";
                        }
                    }
                } else{
                    
                    $user_id_err = "No account found with that ID Number.";
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            
            mysqli_stmt_close($stmt);
        }
    }
    
    
    mysqli_close($link);
}
?>
 
