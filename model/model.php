<?php
/*
 * ME Testing the change log system of git, and did the repo change locations. So One folder fits all
 * 
 * 
 * NEVER TOUCH THIS FILE!!!!!! Always send changes to the model to Chris, things will get broken if you change the wrong things
 * NEVER TOUCH ME!!!!
 * NEVER TOUCH ME!!!!
 * NEVER TOUCH ME!!!!
 * NEVER TOUCH ME!!!!
 * NEVER TOUCH ME!!!!
 * 
 */
        function getDBConnection() {
		$dataSetName = 'mysql:host=localhost; dbname=cis411_EventRegistration';
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
                $results = $statement->fetch();
                $statement->closeCursor();
                return $results;           // Assoc Array of Rows
                
            } catch (PDOException $e) {
			$errorMessage = $e->getMessage();
                        echo $errorMessage;
			include '../view/404.php';
			die;

            }
        }
<<<<<<< HEAD
=======
        
>>>>>>> master
        function getEventList(){
            try{
                $dataBase = getDBConnection();
                $query = "SELECT \n"
<<<<<<< HEAD
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
=======
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
>>>>>>> master
                $statement = $dataBase->prepare($query);
                $statement->execute();
                $result = $statement->fetchAll();  // Should be 0 or 1 row
                $statement->closeCursor();
                return $result;			 // False if 0 rows
            } catch (PDOException $ex) {
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
                . "venue.corner4_lat,venue.corner4_lng FROM venue WHERE id = 6";      
                $statement = $dataBase->prepare($sql);
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
        
<<<<<<< HEAD

=======
        
>>>>>>> master
        
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