<?php

$conn = new mysqli($servername, $user_id, $password, $dbname);

if ( !$connection ) {
    die( 'Database Connection Failed' . mysqli_error( $connection ) );
}

$select_db = mysqli_select_db( $connection, 'dbname' ); //replace dbname with your named database 
if ( !$select_db ) {

    die( 'Database Selection Failed' . mysqli_error( $connection ) );
}
$query = 'SELECT * FROM voter';

$result = mysqli_query( $connection, $query );
$stack = array();
while( $row = mysqli_fetch_array( $result, MYSQLI_ASSOC ) ) {
    array_push( $stack, $row );
}

$sql = "DELETE FROM voter WHERE voter_id_number=?";

if ($conn->query($sql) === TRUE) {
  echo "Record deleted successfully";
} else {
  echo "Error deleting record: " . $conn->error;
}

?>