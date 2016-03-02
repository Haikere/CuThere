<?php
session_start();
//require_once '../model/locationModel.php';
require_once '../model/model.php';
require_once '../lib/basic_funcs.php';

unQuoteMe();
if (isset($_POST['action'])) {  // check get and post
        $action = $_POST['action'];
    } else if (isset($_GET['action'])) {
        $action = $_GET['action'];
    } else {
        include('../view/index.php');  // default action
        exit();
    }
    
    switch ($action){
        case 'Home':
            include '../view/index.php';
            break;
        case 'ListEvents':
            listAllEvents();
            break;
        case 'EventDetails':
            showEventDetails();
            break;
        case 'TestLocation':
            include '../view/eventCheckInTest.php';
            break;
        case 'About':
            include '../view/aboutus2.php';
            break;
        case 'dbTest':
            locationCheck();
            break;
        case 'Shortcodes':
            include '../view/shortcodes.php';
            break;
        case 'AddStory':
            addStory();
            break;
        default:
            include '../view/index.php';
            break;
    } //END SWITCH
      
    function locationCheck(){
       // $array = beckerLocationBreak();
        include '../view/dbTest.php';
    }
    

    function listAllEvents(){
        $result = getEventList();
        include '../view/eventList.php';
    }
    
    function showEventDetails() {
    $EventID = $_GET['EventID'];
    if (!isset($EventID)) {
	$errorMessage = 'You must provide an EventID to display.';
	include '../view/404.php';
    } else {
	$row = getEventDetails($EventID);
        if ($row == FALSE) {
            $errorMessage = 'No event was found.';
            include '../view/404.php';
        } else {
            include '../view/eventDetails.php';
        }
    }
}
    
    function addStory(){
        $mode = "add";
        $storyID = 0;
        $headline = "";
        $section = "";
        $writer = "";
        $story = "";
        $storyImage = "GenericPic.jpg";
        $topStory = "Y";
        $datePublished = "yyyy:mm:dd";

        include '../view/newStory.php';    
    }

  
    function processRegistration(){
        $firstName = $_POST['FirstName'];
	$lastName = $_POST['LastName'];
	$email = $_POST['Email'];
        
        if(empty($firstName)){
            $errorMessage = "<h3> You Must provide a first name to register";
            include '../view/errorMessage.php';
        }
        else if(empty($email)|| !filter_var($email, FILTER_VALIDATE_EMAIL)){
            $errorMessage = "<h3> You Must provide a valid email to register";
            include '../view/errorMessage.php';
        }
        else{
            $msg = "Thanks For Signing Up to Recieve our Emails";
            newUserInfo ($firstName, $lastName, $email);
            $userInfoARRAY = getUserInfo();
            
            include '../view/processRegisterMember.php';
        }
    }
    
    function processAddEdit() {

        //print_r($_POST);
        $storyID = $_POST['storyID'];
        $mode = $_POST['Mode'];
        $headline = $_POST['Headline'];
        $section = $_POST['Section'];        
        $writer = $_POST['Writer'];
        $story = $_POST['Story'];
        $storyImage = $_POST['StoryImage'];
        if (isset($_POST['TopStory'])) {
                $topStory = 'Y';
        } 
        else {
              $topStory = 'N';
        }
        $datePublished = $_POST['DatePublished'];

        // Validation
        $errors = "";
        if (empty($headline) || strlen($headline) > 100) {
                $errors .= "\\n* A Headline is required and can not be longer than 100 Characters.";
        }
        if (empty($section) || strlen($section) > 20) {
                $errors .= "\\n* A Section of the Paper is required and must be no more than 20 characters.";
        }
        if (empty($writer) || strlen($writer) > 100) {
                $errors .= "\\n* A Writers Name is reuqired";
        }
        if (empty($story) || strlen($story) > 65000) {
                $errors .= "\\n* The story must be copied in and can not be more than 65000 characters";
        }
        if (empty($storyImage) || strlen($storyImage) > 75) {
                $errors .= "\\n* Please Enter just the image name and extenstion ie. GenericPic.jpg";
        }
        if (!empty($datePublished) && !strtotime($datePublished)) {
                $errors .= "\\n* Please Enter a Real Date";
        }

        if ($errors != "") {
            include '../view/newStory.php';
        } 
        else {
            if($mode == "add"){
                $storyID = insertStory($headline, $section, $writer, $story, $storyImage, $topStory, $datePublished);
            }
            else{
                $rowsAffected = updateStory($storyID,$headline, $section, $writer, $story, $storyImage, $topStory, $datePublished);
            }
            header("Location:../controller/controller.php?action=DisplayStory&StoryId=$storyID");
        }

    }
    
    
