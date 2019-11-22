<?php
error_reporting(0);
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "my_project";
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
 
$path=file_get_contents('ship_positions.json'); 
$array=json_decode($path,true);
$status='false';
foreach($array as $row){
    if ($row['rot']==='') {
        $row['rot']='NULL'; 
    }
    $sql='INSERT INTO `vessel` VALUES(NULL,'.$row['mmsi'].','.$row['status'].','.$row['stationId'].',
    '.$row['speed'].','.$row['lon'].','.$row['lat'].','.$row['course'].','.$row['heading'].',
    '.$row['rot'].','.$row['timestamp'].');';
    if ($conn->query($sql) === TRUE) {
        $status='true';
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
        break;
    }
}
echo 'status';
$conn->close();
?>