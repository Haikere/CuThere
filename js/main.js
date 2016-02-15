jQuery(function($) {'use strict';

	//Responsive Nav
	$('li.dropdown').find('.fa-angle-down').each(function(){
		$(this).on('click', function(){
			if( $(window).width() < 768 ) {
				$(this).parent().next().slideToggle();
			}
			return false;
		});
	});

	//Fit Vids
	if( $('#video-container').length ) {
		$("#video-container").fitVids();
	}

	//Initiat WOW JS
	new WOW().init();

	// portfolio filter
	$(window).load(function(){

		$('.main-slider').addClass('animate-in');
		$('.preloader').remove();
		//End Preloader

		if( $('.masonery_area').length ) {
			$('.masonery_area').masonry();//Masonry
		}

		var $portfolio_selectors = $('.portfolio-filter >li>a');
		
		if($portfolio_selectors.length) {
			
			var $portfolio = $('.portfolio-items');
			$portfolio.isotope({
				itemSelector : '.portfolio-item',
				layoutMode : 'fitRows'
			});
			
			$portfolio_selectors.on('click', function(){
				$portfolio_selectors.removeClass('active');
				$(this).addClass('active');
				var selector = $(this).attr('data-filter');
				$portfolio.isotope({ filter: selector });
				return false;
			});
		}

	});


	$('.timer').each(count);
	function count(options) {
		var $this = $(this);
		options = $.extend({}, options || {}, $this.data('countToOptions') || {});
		$this.countTo(options);
	}
		
	// Search
	$('.fa-search').on('click', function() {
		$('.field-toggle').fadeToggle(200);
	});

	// Contact form
	var form = $('#main-contact-form');
	form.submit(function(event){
		event.preventDefault();
		var form_status = $('<div class="form_status"></div>');
		$.ajax({
			url: $(this).attr('action'),
			beforeSend: function(){
				form.prepend( form_status.html('<p><i class="fa fa-spinner fa-spin"></i> Email is sending...</p>').fadeIn() );
			}
		}).done(function(data){
			form_status.html('<p class="text-success">Thank you for contact us. As early as possible  we will contact you</p>').delay(3000).fadeOut();
		});
	});

	// Progress Bar
	$.each($('div.progress-bar'),function(){
		$(this).css('width', $(this).attr('data-transition')+'%');
	});

	if( $('#gmap').length ) {
		var map;

		map = new GMaps({
			el: '#gmap',
			lat: 41.2083454,
			lng: -79.3788198,
			scrollwheel:false,
			zoom: 16,
			zoomControl : false,
			panControl : false,
			streetViewControl : false,
			mapTypeControl: false,
			overviewMapControl: false,
			clickable: false
		});

		var marker = new google.maps.Marker({
			lat: 41.2083454,
			lng: -79.3788198,
			title: 'Clarion University Campus',
			map: map,
			animation: google.maps.Animation.DROP
		});
	}

});

//----------------------------------------------------------------------------------------------------------------------------------------------
//----------------------------------------------------------------------------------------------------------------------------------------------

    //Maps stuff for eventsCheckIn
    function findLocation()
    {
        if (navigator.geolocation) 
        {
            document.getElementById("findCurrentLocation").disabled = true;
            document.getElementById("compareLocation").disabled = false;
            watchID = navigator.geolocation.watchPosition( updateMap, error, {maximumAge: 30000, timeout: 10000, enableHighAccuracy: true} );
        }
        else
        {
            alert("Sorry, but it looks like your browser does not support geolocation.");
        }
    }
			
    //Create a new map variable	
    var map = null;
    //a markers global array to keep track of them
    var markersArr = [];
    
    //Need a geoLoc reference since we're using watchPosition
    var watchID = null;
    var watchMarkerCount = 0;

    function updateMap(position)
    {
        // Define the coordinates as a Google Maps LatLng Object
        var coords = new google.maps.LatLng(position.coords.latitude, position.coords.longitude);
        var dispLoc = document.getElementById("userLat");
        dispLoc.innerHTML = position.coords.latitude;
        dispLoc = document.getElementById("userLong");
        dispLoc.innerHTML = position.coords.longitude;

        //Writes out where you are, and how far you are from desired point
        writeLocationDetails(position);
        if(currentPoly != null)
            withinPoly(coords, currentPoly);
        
        // Prepare the map options
        var mapOptions =
        {
            zoom: 16,
            center: coords,
            mapTypeControl: false,
            navigationControlOptions: {style: google.maps.NavigationControlStyle.SMALL},
            mapTypeId: google.maps.MapTypeId.ROADMAP
        };
        // Create the map, and place it in the gmap div
        if(map === null)
            map = new google.maps.Map(document.getElementById("gmap"), mapOptions);
        //Place the initial marker
        var marker = new google.maps.Marker({
            position: coords,
            map: map,
            animation: google.maps.Animation.DROP,
            title: "Your location",
            draggable: true
        });

        markersArr.push(marker);

        map.panTo(coords);

        document.getElementById("recordCurrentLocation").disabled = false;
        document.getElementById("removePoints").disabled = false;
    }
		
    function recordLocation()
    {
        if (navigator.geolocation) 
        {
            navigator.geolocation.getCurrentPosition( addMarker, error, {maximumAge: 30000, timeout: 10000, enableHighAccuracy: true} );
        }
        else
        {
            alert("Sorry, but it looks like your browser does not support geolocation.");
        }
    }
		
    //Takes geolocation position            
    function addMarker(position)
    {
	var coords = new google.maps.LatLng(position.coords.latitude, position.coords.longitude);
	var dispLoc = document.getElementById("userLat");
	dispLoc.innerHTML = position.coords.latitude;
	dispLoc = document.getElementById("userLong");
	dispLoc.innerHTML = position.coords.longitude;
			
	var marker = new google.maps.Marker({
            position: coords,
            map: map,
            animation: google.maps.Animation.DROP,
            title: 'Your location'
	});
			
	markersArr.push(marker);		
    }
	
    var positionNames = ["Still Hall", "Gemmell MPR", 
        "Becker Hall", "Carlson", 
        "Marwick", "Hart Chapel", 
        "Founders Hall", "Roughly Tippin Gym", 
        "Still 112"];
    //Stored locations to compare to. 0 is Still Hall, 1 is Gemmell MPR, 2 is Becker, 
    //3 is Carlson, 4 is Marwick/Boyd, etc   
    var storedPositions = [{lat: 41.212313, lng: -79.377928}, {lat: 41.207658, lng: -79.378057}, 
        {lat: 41.205880, lng: -79.379451}, {lat : 41.210443, lng: -79.380173}, 
        {lat : 41.207156, lng: -79.380039}, {lat : 41.211397, lng: -79.380182}, 
        {lat : 41.211192, lng: -79.379781}, {lat : 41.207921, lng: -79.379883}, 
        {lat : 41.212350, lng: -79.378076}];
    //A variable that is changed by user depending on where they want the points in relation to.
    var chosenPosition = 0;
    
    var currentPoly = null;
    var markerImage = { url:"../images/mapsImages/bluePin.png", size:new google.maps.Size(32, 32),origin: new google.maps.Point(0, 0),anchor: new google.maps.Point(16, 31)};
    var compareMarker = null;
    function changeComparativeLocation()
    {
        if(++chosenPosition === 9)
            chosenPosition = 0;
        document.getElementById('camparativeLocation').innerHTML = positionNames[chosenPosition];
        document.getElementById('compareLocation').innerHTML = positionNames[chosenPosition];
        
        var buildingCoords  = [
            buildingPolygons[chosenPosition].topLeft,
            buildingPolygons[chosenPosition].topRight,
            buildingPolygons[chosenPosition].btmRight,
            buildingPolygons[chosenPosition].btmLeft
        ];
        
        if(map != null){
            if(currentPoly != null)
                currentPoly.setMap(null);

            currentPoly = new google.maps.Polygon({
                paths: buildingCoords,
                strokeColor: '#ffffb3',
                strokeOpacity: 0.6,
                strokeWeight: 3,
                fillColor: '#ffffb3',
                fillOpacity: 0.3
                });

            currentPoly.setMap(map);

            map.panTo(storedPositions[chosenPosition]);
        }
        
        if(compareMarker !== null)
            compareMarker.setMap(null);
        
        compareMarker = new google.maps.Marker({
            position: storedPositions[chosenPosition],
            map: map,
            title: positionNames[chosenPosition],
            icon: markerImage
	});
    }
    
    //takes geolocation position
    function writeLocationDetails(position)
    {
        ++watchMarkerCount;
        //Populate the first tab with locations as they come in
        document.getElementById('tab1-item1').innerHTML += "<div class=\"page-header\">Test Num "+watchMarkerCount+"<div>Latitude: <span id=\"userLat"+watchMarkerCount+"\">" + position.coords.latitude + "</span></div>" +
            "<div>Longitude: <span id=\"userLong"+watchMarkerCount+"\">" + position.coords.longitude + "</span></div></div>";
    
        calculateDistance(position);
    }
    
    //Takes a geolocation position
    function calculateDistance(position)
    {
        var distance = google.maps.geometry.spherical.computeDistanceBetween(new google.maps.LatLng(storedPositions[chosenPosition].lat, storedPositions[chosenPosition].lng), new google.maps.LatLng(position.coords.latitude, position.coords.longitude));
        
        document.getElementById('tab1-item2').innerHTML += "<div class=\"page-header\">TEST"+watchMarkerCount+" Distance From " + positionNames[chosenPosition] + ": <span id=\"userDistance"+watchMarkerCount+"\">" + distance + "m</span></div>";
        if(distance > 25)
            document.getElementById("userDistance"+watchMarkerCount).style.backgroundColor="red";
        else
            document.getElementById("userDistance"+watchMarkerCount).style.backgroundColor="green";
    }
    
    //takes a google latLng object and a google Polygon
    function withinPoly(location, polygon)
    {
        document.getElementById('tab1-item3').innerHTML += "<div class=\"page-header\">TEST"+watchMarkerCount+" <span id=\"userContainedTest"+watchMarkerCount+"\"></span></div>";
        if(google.maps.geometry.poly.containsLocation(location, polygon))
                document.getElementById("userContainedTest"+watchMarkerCount).innerHTML = "You're in the polygon!"; 
            else
                document.getElementById("userContainedTest"+watchMarkerCount).innerHTML = "You're not in the polygon...";
    }
    
    //takes geolocation position
    function updateLatLong(position)
    {
	var dispLoc = document.getElementById("userLat");
	dispLoc.innerHTML = position.coords.latitude;
	dispLoc = document.getElementById("userLong");
	dispLoc.innerHTML = position.coords.longitude;
    }
			
    function error() 
    {
	alert("Cannot locate user. Please enable Location (and high accuracy mode) on your phone and try again");
    }
	
    function stopWatchingLocation()
    {
        navigator.geolocation.clearWatch(watchID);
        document.getElementById("findCurrentLocation").disabled = false;
        watchMarkerCount = 0;
    }
    
    function removeMarkers()
    {
	for(var i=0; i<markersArr.length; i++)
            markersArr[i].setMap(null);
	markersArr = [];
        
	var dispLoc = document.getElementById("userLat");
	dispLoc.innerHTML = "";
	dispLoc = document.getElementById("userLong");
	dispLoc.innerHTML = "";
    }
	
    function clearLocationTabs()
    {
        document.getElementById('tab1-item1').innerHTML = "";
        document.getElementById('tab1-item2').innerHTML = "";
        document.getElementById('tab1-item3').innerHTML = "";
    }

    function resetMap()
    {
	map = null;
	document.getElementById("recordCurrentLocation").disabled = true;
    }
    
    var buildingPolygons = [{topLeft: {lat: 41.212491, lng: -79.377898}, topRight: {lat: 41.212374, lng: -79.377571}, btmLeft: {lat: 41.212289, lng: -79.378006}, btmRight: {lat: 41.212176, lng: -79.377692}},
        {topLeft: {lat: 41.207808, lng: -79.378231}, topRight: {lat: 41.207775, lng: -79.377770}, btmLeft: {lat: 41.207582, lng: -79.378223}, btmRight: {lat: 41.207537, lng: -79.377815}},
        {topLeft: {lat: 41.205915, lng: -79.379961}, topRight: {lat: 41.205916, lng: -79.379366}, btmLeft: {lat: 41.205550, lng: -79.379950}, btmRight: {lat: 41.205550, lng: -79.379366}},
        {topLeft: {lat: 41.210637, lng: -79.380232}, topRight: {lat: 41.210493, lng: -79.379891}, btmLeft: {lat: 41.210366, lng: -79.380425}, btmRight: {lat: 41.210251, lng: -79.380066}},
        {topLeft: {lat: 41.207148, lng: -79.380353}, topRight: {lat: 41.207226, lng: -79.379229}, btmLeft: {lat: 41.206984, lng: -79.380288}, btmRight: {lat: 41.207031, lng: -79.379245}},
        {topLeft: {lat: 41.211543, lng: -79.380265}, topRight: {lat: 41.211440, lng: -79.379960}, btmLeft: {lat: 41.211372, lng: -79.380369}, btmRight: {lat: 41.211269, lng: -79.380063}},
        {topLeft: {lat: 41.211400, lng: -79.379819}, topRight: {lat: 41.211266, lng: -79.379486}, btmLeft: {lat: 41.211199, lng: -79.379971}, btmRight: {lat: 41.211069, lng: -79.379623}},
        {topLeft: {lat: 41.208159, lng: -79.380227}, topRight: {lat: 41.208252, lng: -79.379636}, btmLeft: {lat: 41.207569, lng: -79.380060}, btmRight: {lat: 41.207670, lng: -79.379465}},
        {topLeft: {lat: 41.212436, lng: -79.378116}, topRight: {lat: 41.212398, lng: -79.377986}, btmLeft: {lat: 41.212322, lng: -79.378186}, btmRight: {lat: 41.212261, lng: -79.378034}}];