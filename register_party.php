<?php

require_once "config.php";
 

$party_id = "";
$party_id_err = "";
$name = "";
$name_err = "";



if($_SERVER["REQUEST_METHOD"] == "POST"){
 
   
    if(empty(trim($_POST["party_id"]))){
        $user_id_err = "Please enter a party id number.";
    } else{
       
        $sql = "SELECT party_id FROM party WHERE party_id = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            
            mysqli_stmt_bind_param($stmt, "s", $param_party_id);
            
            
            $param_user_id = trim($_POST["party_id"]);
            
            
            if(mysqli_stmt_execute($stmt)){
                
                mysqli_stmt_store_result($stmt);
                
                if(mysqli_stmt_num_rows($stmt) == 1){
                    $party_id_err = "This id number is already taken.";
                } else{
                    $party_id = trim($_POST["party_id"]);
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            
            mysqli_stmt_close($stmt);
        }
    }

    if(empty(trim($_POST["name"]))){
        $first_name_err = "Please Enter Party Name";
    } else{
       
        $sql = "SELECT name FROM party WHERE name = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            
            mysqli_stmt_bind_param($stmt, "s", $param_name);
            
            
            $param_name = trim($_POST["name"]);
            
            
            if(mysqli_stmt_execute($stmt)){
                
                mysqli_stmt_store_result($stmt);
                
                if(mysqli_stmt_num_rows($stmt) == 1){
                    $name_err = "This name is already taken.";
                } else{
                    $name = trim($_POST["name"]);
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            
            mysqli_stmt_close($stmt);
        }
    }

    
    
    if(empty($party_id_err) && empty($name_err)){
        
       
        $sql = "INSERT INTO party (party_id, name) VALUES (?, ?)";
         
        if($stmt = mysqli_prepare($link, $sql)){
            
            mysqli_stmt_bind_param($stmt, "ss", $param_party_id);
            
           
            $param_party_id = $party_id;
           
            
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
 
