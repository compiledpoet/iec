<?php

require_once "config.php";
 

$user_id = $password = $confirm_password = "";
$user_id_err = $password_err = $confirm_password_err = "";
$first_name = $password = $confirm_password = "";
$first_name_err = $password_err = $confirm_password_err = "";
$last_name = $password = $confirm_password = "";
$last_name_err = $password_err = $confirm_password_err = "";
$physical_address = $password = $confirm_password = "";
$physical_address_err = $password_err = $confirm_password_err = "";
$ward_id = $password = $confirm_password = "";
$ward_id_err = $password_err = $confirm_password_err = "";


if($_SERVER["REQUEST_METHOD"] == "POST"){
 
   
    if(empty(trim($_POST["voter_id_number"]))){
        $user_id_err = "Please enter a voter id number.";
    } else{
       
        $sql = "SELECT voter_id_number FROM voter WHERE voter_id_number = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            
            mysqli_stmt_bind_param($stmt, "s", $param_user_id);
            
            
            $param_user_id = trim($_POST["voter_id_number"]);
            
            
            if(mysqli_stmt_execute($stmt)){
                
                mysqli_stmt_store_result($stmt);
                
                if(mysqli_stmt_num_rows($stmt) == 1){
                    $user_id_err = "This id number is already taken.";
                } else{
                    $user_id = trim($_POST["voter_id_number"]);
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            
            mysqli_stmt_close($stmt);
        }
    }

    if(empty(trim($_POST["first_name"]))){
        $first_name_err = "Please Enter Voter First Name";
    } else{
       
        $sql = "SELECT first_name FROM voter WHERE first_name = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            
            mysqli_stmt_bind_param($stmt, "s", $param_first_name);
            
            
            $param_first_name = trim($_POST["first_name"]);
            
            
            if(mysqli_stmt_execute($stmt)){
                
                mysqli_stmt_store_result($stmt);
                
                if(mysqli_stmt_num_rows($stmt) == 1){
                    $first_name_err = "This name is already taken.";
                } else{
                    $first_name = trim($_POST["first_name"]);
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            
            mysqli_stmt_close($stmt);
        }
    }

    if(empty(trim($_POST["last_name"]))){
        $first_name_err = "Please Enter Voter Last Name";
    } else{
       
        $sql = "SELECT last_name FROM voter WHERE last_name = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            
            mysqli_stmt_bind_param($stmt, "s", $param_last_name);
            
            
            $param_last_name = trim($_POST["last_name"]);
            
            
            if(mysqli_stmt_execute($stmt)){
                
                mysqli_stmt_store_result($stmt);
                
                if(mysqli_stmt_num_rows($stmt) == 1){
                    $last_name_err = "This name is already taken.";
                } else{
                    $last_name = trim($_POST["last_name"]);
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            
            mysqli_stmt_close($stmt);
        }
    }
    
     if(empty(trim($_POST["physical_address"]))){
        $first_name_err = "Please Enter Voter Physical Address";
    } else{
       
        $sql = "SELECT physical_address FROM voter WHERE physical_address = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            
            mysqli_stmt_bind_param($stmt, "s", $param_physical_address);
            
            
            $param_last_name = trim($_POST["physical_address"]);
            
            
            if(mysqli_stmt_execute($stmt)){
                
                mysqli_stmt_store_result($stmt);
                
               
                $last_name = trim($_POST["physical_address"]);
            
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            
            mysqli_stmt_close($stmt);
        }
    }

    if(empty(trim($_POST["ward_id"]))){
        $ward_id_err = "Please enter ward id number.";
    } else{
       
        $sql = "SELECT ward_id FROM voter WHERE ward_id = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            
            mysqli_stmt_bind_param($stmt, "s", $ward_id);
            
            
            $param_ward_id = trim($_POST["ward_id"]);
            
            
            if(mysqli_stmt_execute($stmt)){
                
                mysqli_stmt_store_result($stmt);
                
                
                $ward_id = trim($_POST["ward_id"]);
                
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            
            mysqli_stmt_close($stmt);
        }
    }
    
    if(empty(trim($_POST["registration_code"]))){
        $password_err = "Please enter a code.";     
    } elseif(strlen(trim($_POST["registration_code"])) < 6){
        $password_err = "Code must have atleast 6 characters.";
    } else{
        $password = trim($_POST["registration_code"]);
    }
    
    /
    if(empty(trim($_POST["confirm_password"]))){
        $confirm_password_err = "Please confirm code.";     
    } else{
        $confirm_password = trim($_POST["confirm_registration_code"]);
        if(empty($password_err) && ($password != $confirm_password)){
            $confirm_password_err = "Code did not match.";
        }
    }
    
    
    if(empty($user_id_err) && empty($password_err) && empty($confirm_password_err) && empty($first_name_err) && empty($last_name_err) &&empty ($physical_address_err) && empty($ward_id_err)){
        
       
        $sql = "INSERT INTO voter (voter_id_number, registration_code, first_name, last_name, physical_address, ward_id) VALUES (?, ?, ?, ?, ?, ?)";
         
        if($stmt = mysqli_prepare($link, $sql)){
            
            mysqli_stmt_bind_param($stmt, "ss", $param_user_id, $param_password);
            
           
            $param_user_id = $user_id;
            $param_password = password_hash($password, PASSWORD_DEFAULT); 
            
            if(mysqli_stmt_execute($stmt)){
                
                header("location: login.php");
            } else{
                echo "Something went wrong. Please try again later.";
            }

            
            mysqli_stmt_close($stmt);
        }
    }
    
    
    mysqli_close($link);
}
?>
 
