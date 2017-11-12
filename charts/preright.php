<?php
include("../dbconnect.php");

//the SQL query to be executed
$query = "SELECT PRE_VA_NO_SPECT_RIGHT, COUNT(*) AS freq FROM EYEPATIENT1 GROUP BY PRE_VA_NO_SPECT_RIGHT asc";

//storing the result of the executed query
$result = $mydatabase->query($query);

//initialize the array to store the processed data
$jsonArray = array();

//check if there is any data returned by the SQL Query
if ($result->num_rows > 0) {
  //Converting the results into an associative array
  while($row = $result->fetch_row()) {
    $jsonArrayItem = array();
    $jsonArrayItem['label'] = $row[0];
    $jsonArrayItem['value'] = $row[1];
    //append the above created object into the main array.
    array_push($jsonArray, $jsonArrayItem);
  }
}

//Closing the connection to DB
$mydatabase->close();

//set the response content type as JSON
header('Content-type: application/json');
//output the return value of json encode using the echo function. 
echo json_encode($jsonArray);
?>
