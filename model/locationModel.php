<?php

/* 
 *All the logic for location compare data will be stored in this file
 * Including
 *              Queries to pull the data from the server
 *              JSON encodes to use on the client side
 *              Breakdown of the array of results into independent variables
 *              Will include the model
 *This file will need to be included on the controller form
 * 
 * Created: 02.23
 * Author: Chris Gillis
 */

require_once '../model/model.php';
header("Content-type: application/json");

    $results = locationCheckBecker();
    foreach ($results as $row){
        $building = $row['building_name'];
        $room = $row['room_number'];
        $corner1_lat = $row['corner1_lat'];
        $corner1_lng = $row['corner1_lng'];
        $corner2_lat = $row['corner2_lat'];
        $corner2_lng = $row['corner2_lng'];
        $corner3_lat = $row['corner3_lat'];
        $corner3_lng = $row['corner3_lng'];
        $corner4_lat = $row['corner4_lat'];
        $corner4_lng = $row['corner4_lng'];
        
  
    
    /* Use AJAX json encode to prep our database data for the client side
     * Going to run the data through the javascript on the client to allow us to check
     *  User Location Vs. Builing/Room they are supposed to be in
     */
       
    
    $array = array($corner1_lat,$corner1_lng,$corner2_lat,$corner2_lng,$corner3_lat,$corner3_lng,$corner4_lat,$corner4_lng);
    
    echo json_encode($array, JSON_NUMERIC_CHECK);
    return $array;
      
  
     
}
