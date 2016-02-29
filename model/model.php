<?php
/*
 * ME Testing the change log system of git, and did the repo change locations. So One folder fits all
 */
        function getDBConnection() {
		$dataSetName = 'mysql:host=localhost; dbname=cis411_eventregistration';
		$username = 's_cgillis';
		$password = 'Gk$98pbw';

		try {
			$dataBase = new PDO($dataSetName, $username, $password);
		} catch (PDOException $e) {
			$errorMessage = $e->getMessage();
                        echo $errorMessage;
			include '../view/404.php';
			die;
		}
		return $dataBase;
	}
	
        function getClassList() {
		try {
			$dataBase = getDBConnection();
			$query = "SELECT
                                    class.class_number,
                                    class.class_section,
                                    class.class_name,
                                    class.semester_offered,
                                    user.first_name,
                                    user.last_name,
                                    user.email
                                FROM 
                                    class INNER JOIN user ON class.instructor_id = user.id ";
			$statement = $dataBase->prepare($query);
			$statement->execute();
			$results = $statement->fetchAll();
			$statement->closeCursor();
			return $results;           // Assoc Array of Rows
		} catch (PDOException $e) {
			$errorMessage = $e->getMessage();
                        echo $errorMessage;
			include '../view/404.php';
			die;
		}		
	}
        
        function getEventDetails($eventid){
            try{
                $dataBase = getDBConnection();
                $query = "SELECT \n"
                        . "event.name, \n"
                        . "event.start_time, \n"
                        . "event.end_time, \n"
                        . "event.event_date, \n"
                        . "event.description, \n "
                        . "venue.building_name, \n"
                        . "venue.room_number \n"
                        . "FROM \n"
                        . "event INNER JOIN venue ON event.venue_id = venue.id  \n"
                        . "WHERE event.id = :id";
                $statement = $dataBase->prepare($query);
                $statement->bindValue(':id', $eventid);
                $statement->execute();
                $results = $statement->fetchAll();
                $statement->closeCursor();
                return $results;           // Assoc Array of Rows
                
            } catch (PDOException $e) {
			$errorMessage = $e->getMessage();
                        echo $errorMessage;
			include '../view/404.php';
			die;

            }
        }
        
        function getEventList(){
            try{
                $dataBase = getDBConnection();
                $query = "SELECT \n"
    . " event.id, \n"
    . " event.name, \n"
    . " event.start_time, \n"
    . " event.end_time, \n"
    . " event.event_date, \n"
    . " venue.building_name, \n"
    . " venue.room_number \n"
    . "FROM \n"
    . " event \n"
    . " INNER JOIN venue ON event.venue_id = venue.id \n"
    . "WHERE \n"
    . " event.event_date > CURDATE() \n"
    . "ORDER BY \n"
    . " event.event_date";
                $statement = $dataBase->prepare($query);
                $statement->execute();
                $results = $statement->fetchAll();
                $statement->closeCursor();
                return $results;
            } catch (Exception $ex) {
                $errorMessage = $ex->getMessage();
                        echo $errorMessage;
			include '../view/404.php';
			die;

            }
        }
        
        function locationCheckBecker(){
            try{
                    $dataBase = getDBConnection();
                    $sql = "select venue.id,venue.building_name,venue.room_number,venue.corner1_lat,venue.corner1_lng,venue.corner2_lat,venue.corner2_lng,venue.corner3_lat,venue.corner3_lng,"
    .                       "venue.corner4_lat,venue.corner4_lng FROM venue WHERE id = 6";      
                $statement = $dataBase->prepare($sql);
                $statement->execute();
                $results = $statement->fetchAll();
                $statement->closeCursor();
               // print_r($results);
                return $results;
            } catch (Exception $ex) {
                $errorMessage = $ex->getMessage();
                        echo $errorMessage;
			include '../view/404.php';
			die;

            }
        }
        
//         function locationCheckStill(){
//            try{
//                $dataBase = getDBConnection();
//                $sql = "select venue.id,venue.building_name,venue.room_number,venue.corner1_lat,venue.corner1_lng,venue.corner2_lat,venue.corner2_lng,venue.corner3_lat,venue.corner3_lng,"
//    .                       "venue.corner4_lat,venue.corner4_lng FROM venue WHERE id = 1";      
//                $statement = $dataBase->prepare($sql);
//                $statement->execute();
//                $results = $statement->fetchAll();
//                $statement->closeCursor();
//                print_r($results);
//                return $results;
//            } catch (Exception $ex) {
//                $errorMessage = $ex->getMessage();
//                        echo $errorMessage;
//                        include '../view/404.php';
//                        die;
//
//
//
//        }
//        }
        
      

         
	function logSQLError($errorInfo) {
		$errorMessage = $errorInfo[2];
                include '../view/404.php';
		die;
        }          
?>