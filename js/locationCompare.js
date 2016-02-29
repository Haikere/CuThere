/* 
 * Same functionality as the the cuThereMaps.js file
 * Wanted to copy off so when I tear down to insert the php data I dont break exsisiting functionality
 * Hopefully wont break anything major
 * 
 * 
 * Created: 02.22 
 * Last to Edit: Chris
 */

/*
 * The hope is the json_encoded array from the php will come in here
 *  Assign each element to a variable
 *  Thorw the varialbes into the polygon set up we have below
 *  Then be able to compare against the users current location we recieve
 *  
 *  We will then print out a result based on if they hit the polygon or not
 *          Green Scree = Good
 *          Yellow Screen = Try Again
 *          Red Screen = BAD
 *          
 *           $.getJSON("../model/locationModel.php", function(array){
     alert('data loaded' + array);
     array.toString();
     document.getElementById("test").innerHTML = array;
  })
  .error(function() { alert("error"); });
 $.post("../model/locationModel.php?ajax", function(array){
     alert('data loaded(' + JSON.stringify(array)+')');
  })
  .error(function() { alert("error"); });
 */

//----------------------------------------------------------------------------------------------------------------------------------------------
//----------------------------------------------------------------------------------------------------------------------------------------------

// Global Variable that will be used for the polygons
//var corner1_lat;
//var corner1_lng;
//var corner2_lat;
//var corner2_lng;
//var corner3_lat;
//var corner3_lng;
//var corner4_lat;
//var corner4_lng;

/*
 * Function that retrieves the json object from the PHP file
 *  Assigns each element of the array object to the correct variable
 *  Since its always the same data, I just hard coded
 *
 *
 *Becker Hard Code Value:
 *                      Clarion, PA 16214
                        41.205796, -79.379616
 *  
 *   
 */
count = 0;
error = "I messed up";
var watchPosArray = [];
function myFunction() {
 
     $.get("../model/locationModel.php?ajax", function(array){
     
     corner1_lat = array[0];
     corner1_lng = array[1];
     corner2_lat = array[2];
     corner2_lng = array[3];
     corner3_lat = array[4];
     corner3_lng = array[5];
     corner4_lat = array[6];
     corner4_lng = array[7];     
  });   
} //END GET BUILDING FUNC
function locationCheck(){

    myFunction();
	document.getElementById("test").innerHTML =  "corner 1 ( " + corner1_lat + ", " + corner1_lng + ")" + "<br/>" + "corner 2 ( " + corner2_lat + ", " + corner2_lng + ")" + "<br/>" + "corner 3 ( " + corner3_lat + ", " + corner3_lng + ")" + "<br/>" +"corner 4 ( " + corner4_lat + ", " + corner4_lng +  ")" + "<br/>";

if (navigator.geolocation) {
   // watchID = navigator.geolocation.watchPosition( userPositionFill, error, {maximumAge: 30000, timeout: 10000, enableHighAccuracy: true} );
    //document.getElementById("test").innerHTML += watchID;
	navigator.geolocation.getCurrentPosition(function(position) {
    initialLocation = new google.maps.LatLng(position.coords.latitude,position.coords.longitude);
      //initialLocation = new google.maps.LatLng(41.205796, -79.379616);
      document.getElementById("test").innerHTML += "CurrLoc " + initialLocation + "<br/>";
        polyCheck(initialLocation);
    }, function() {
      handleLocationError(true, infoWindow, map.getCenter());
    });
  } else {
    // Browser doesn't support Geolocation
    handleLocationError(false, infoWindow, map.getCenter());
  }
function error() 
    {
	alert("Cannot locate user. Please enable Location (and high accuracy mode) on your phone and try again");
    }
function userPositionFill(position){
     watchPosArray[count]= new google.maps.LatLng(position.coords.latitude,position.coords.longitude);
     count++;
    if(count === 5){
        navigator.geolocation.clearWatch(watchID);
        document.getElementById("test").innerHTML += JSON.stringify(watchPosArray);
    }
        
}


function handleLocationError(browserHasGeolocation, infoWindow, pos) {
  infoWindow.setPosition(pos);
  infoWindow.setContent(browserHasGeolocation ?
                        'Error: The Geolocation service failed.' :
                        'Error: Your browser doesn\'t support geolocation.');
}

    // Define the LatLng coordinates for the polygon's path.
 function polyCheck(pos){
     
     var polyCoords = [
         {lat: corner1_lat, lng: corner1_lng},
         {lat: corner2_lat, lng: corner2_lng},
         {lat: corner3_lat, lng: corner3_lng},
         {lat: corner4_lat, lng: corner4_lng}
    ];
   
    var buildingPoly = new google.maps.Polygon({paths: polyCoords});
    
    var isWithinPolygon = google.maps.geometry.poly.containsLocation(pos, buildingPoly) ?
        true : false;
        
    if(isWithinPolygon === true){
       document.getElementById("test").innerHTML += 'true';
       document.getElementById("body").style.backgroundColor = "#00FF00";
    }
    else{
        document.getElementById("test").innerHTML += 'false';
       document.getElementById("body").style.backgroundColor = "#FF0000";
  
    }
        
    
    
 }
};
