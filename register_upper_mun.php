<?php

require_once "config.php";
 

$upper_muni_id = "";
$upper_muni_id_err = "";
$name = "";
$name_err = "";
$ward_id = "";
$ward_id_err = ""; 
$candidate_id="";
$candidate_id_err=""; 



if($_SERVER["REQUEST_METHOD"] == "POST"){
 
   
    if(empty(trim($_POST["upper_muni_id"]))){
        $candidate_id_err = "Please enter Upper Municipality ID.";
    } else{
       
        $sql = "SELECT upper_muni_id FROM upper_municipality WHERE upper_muni_id = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            
            mysqli_stmt_bind_param($stmt, "s", $candidate_id);
            
            
            $param_upper_muni_id = trim($_POST["upper_muni_id"]);
            
            
            if(mysqli_stmt_execute($stmt)){
                
                mysqli_stmt_store_result($stmt);
                
                if(mysqli_stmt_num_rows($stmt) == 1){
                    $upper_muni_id_err = "This id number is already taken.";
                } else{
                    $upper_muni_id = trim($_POST["upper_muni_id"]);
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            
            mysqli_stmt_close($stmt);
        }
    }

    if(empty(trim($_POST["name"]))){
        $candidate_name_err = "Please Enter Upper Municipality Name";
    } else{
       
        $sql = "SELECT name FROM upper_municipality WHERE name = ?";
        
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


    //Enum Choice Radio Button Input 

    @$a=$_POST['name'];  
    @$b=$_POST['type'];  
    if(@$_POST['submit'])  
        {  
            echo $s="INSERT INTO upper_municipality(name,type) VALUES ('$a','$b')";  
            echo "Your Data Inserted";  
            mysql_query($s);  
        }  

    
    
    if(empty($upper_muni_id_err) && empty($name_err)){
        
       
        $sql = "INSERT INTO upper_municipality (upper_muni_id, name) VALUES (?,?)";
         
        if($stmt = mysqli_prepare($link, $sql)){
            
            mysqli_stmt_bind_param($stmt, "ss", $param_upper_muni_id);
            
           
            $param_upper_muni_id = $upper_muni_id;
           
            
            if(mysqli_stmt_execute($stmt)){

                //can change redirect location to your landing page 
                
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
 
