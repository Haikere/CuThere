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
        
        // Prepare the map options
        var mapOptions =
        {
            zoom: 18,
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

        document.getElementById("findCurrentLocation").disabled = true;
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
            title: 'New Marker'
	});
			
	markersArr.push(marker);
		
	map.panTo(coords);		
    }
	
    var positionNames = ["Still Hall", "Gemmell MPR", "Becker Hall", "Carlson", "Marwick"];
    //Stored locations to compare to. 0 is Still Hall, 1 is Center of Clarion Campus, 2 is Becker, 3 is Carlson, 4 is Marwick/Boyd    
    var storedPositions = [{lat: 41.21232, lng: -79.3783442}, {lat: 41.207684, lng: -79.3786492}, {lat: 41.2057392, lng: -79.3803037}, {lat : 41.2104301, lng: -79.3807437}, {lat : 41.206907, lng: -79.3805532}];
    //A variable that is changed by user depending on where they want the points in relation to.
    var chosenPosition = 0;
    
    //TODO: Figure out why the hell 5 doesn't work comparatively.... So Marwick can't be used to Test right now.
    function changeComparativeLocation()
    {
        if(++chosenPosition === 5)
            chosenPosition = 0;
        document.getElementById('camparativeLocation').innerHTML = positionNames[chosenPosition];
        document.getElementById('compareLocation').innerHTML = positionNames[chosenPosition];
    }
    
    function writeLocationDetails(position)
    {
        ++watchMarkerCount;
        //Populate the first tab with locations as they come in
        document.getElementById('tab1-item1').innerHTML += "<div class=\"\">Test Num "+watchMarkerCount+"<div class=\"page-header\">Latitude: <span id=\"userLat"+watchMarkerCount+"\">" + position.coords.latitude + "</span></div>";
        document.getElementById('tab1-item1').innerHTML += "<div class=\"page-header\">Longitude: <span id=\"userLong"+watchMarkerCount+"\">" + position.coords.longitude + "</span></div></div>";
    
        calculateDistance(position);
    }
    
    function calculateDistance(position)
    {
        var distance = google.maps.geometry.spherical.computeDistanceBetween(new google.maps.LatLng(storedPositions[chosenPosition].lat, storedPositions[chosenPosition].lng), new google.maps.LatLng(position.coords.latitude, position.coords.longitude));
        
        document.getElementById('tab1-item2').innerHTML += "<div class=\"page-header\">TEST"+watchMarkerCount+" Distance From " + positionNames[chosenPosition] + ": <span id=\"userDistance"+watchMarkerCount+"\">" + distance + "m</span></div>";
        if(distance > 25)
            document.getElementById("userDistance"+watchMarkerCount).style.backgroundColor="red";
        else
            document.getElementById("userDistance"+watchMarkerCount).style.backgroundColor="green";
    }
    
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
    }

    function resetMap()
    {
	map = null;
	document.getElementById("recordCurrentLocation").disabled = true;
    }