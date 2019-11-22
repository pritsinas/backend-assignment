<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');

  include_once '../../config/Database.php';
  include_once '../../Models/Vessel.php';

  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate vessel object
  $vessel = new Vessel($db);

  // create query
  $result = $vessel->read();

  // Get row count
  $num = $result->rowCount();

  // Check if any vessels
  if($num > 0) {
    // Vessel array
    $vessels_arr = array();
    $vessels_arr['data'] = array();

    while($row = $result->fetch(PDO::FETCH_ASSOC)) {
      extract($row);

      $vessel_item = array(
        'id' => $id,
        'mmsi' => $mmsi,
        'status' => $status,
        'stationId' => $stationId,
        'speed' => $speed,
        'lon' => $lon,
        'lat' => $lat,
        'course' => $course,
        'heading' => $heading,
        'rot' => $rot,
        'timestamp' => $timestamp
      );

      // Push to "data"
      array_push($vessels_arr['data'], $vessel_item);
    }

    // Turn to JSON & output
    echo json_encode($vessels_arr);

  } else {
    // No Vessels
    echo json_encode(
      array('message' => 'No Vessels Found')
    );
  }
?>