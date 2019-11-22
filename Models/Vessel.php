<?php
class Vessel{
 
    // database connection and table name
    private $conn;
    private $table = 'vessel';
 
    // vessel properties
    public $id;
    public $mmsi;
    public $status;
    public $stationId;
    public $speed;
    public $lon;
    public $lat;
    public $course;
    public $heading;
    public $rot;
    public $timestamp;
 
    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }
    //GET vessels
    public function read(){
        $query = 'SELECT 
              v.id,
              v.mmsi,
              v.status,
              v.stationId,
              v.speed,
              v.lon,
              v.lat,
              v.course,
              v.heading,
              v.rot,
              v.timestamp
            FROM 
             ' . $this->table . ' v';
        
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }
}
?>
