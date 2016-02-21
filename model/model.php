<?php
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
        
        function locationComare() {
            
        }

	function logSQLError($errorInfo) {
		$errorMessage = $errorInfo[2];
                include '../view/404.php';
		die;
        }          
?>