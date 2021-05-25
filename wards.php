<?php

$conn = new mysqli($servername, $user_id, $password, $dbname);

if ( !$connection ) {
    die( 'Database Connection Failed' . mysqli_error( $connection ) );
}

$select_db = mysqli_select_db( $connection, 'dbname' ); //replace dbname with your named database 
if ( !$select_db ) {

    die( 'Database Selection Failed' . mysqli_error( $connection ) );
}
$query = 'SELECT * FROM ward';

$result = mysqli_query( $connection, $query );
$stack = array();
while( $row = mysqli_fetch_array( $result, MYSQLI_ASSOC ) ) {
    array_push( $stack, $row );
}



?>