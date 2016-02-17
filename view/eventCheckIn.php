 <?php
    $title = "Event Check-In";
    require '../view/headerInclude.php';
?>

    <section id="page-breadcrumb">
        <div class="vertical-center sun">
             <div class="container">
                <div class="row">
                    <div class="action">
                        <div class="col-sm-12">
                            <h1 class="title">Event Check-In</h1>
                        </div>                        
                    </div>
                </div>
            </div>
        </div>
   </section>
    <!--/#action-->

    <section id="map-section">
        <div class="container">
            <div id="gmap"></div>
            <div class="page-header">Current Latitude: <span id="userLat"></span></div><div class="page-header">Current Longitude: <span id="userLong"></span></div>
            <div id="buttons-container">
                <div class="bs-example">
                    <button id="findCurrentLocation" onclick="findLocation()" class="btn btn-default">Watch Location</button>
                    <button id="recordCurrentLocation" onclick="recordLocation()" class="btn btn-default" disabled>Get Position (Inaccurate)</button>
                    <button id="stopRecording" onclick="stopWatchingLocation()" class="btn btn-default">Stop Recording Location</button>
                    <button id="removePoints" onclick="removeMarkers()" class="btn btn-default" disabled>Remove All Markers</button>
                    <button id="compareLocation" onClick="changeComparativeLocation()" class="btn btn-default" disabled>Desired Location</button>
                    <button id="clearTabs" onClick="clearLocationTabs()" class="btn btn-default">Clear Tabs</button>
                </div>
            </div>
        
            <div id="tab-container">
                <div class="row">
                    <div class="col-md-12">
                        <ul id="tab1" class="nav nav-pills">
                            <li class="active"><a href="#tab1-item1" data-toggle="tab">Location Data</a></li>
                            <li><a href="#tab1-item2" data-toggle="tab">Distance from Blue Marker at <span id="camparativeLocation">Still Hall</span></a></li>
                            <li><a href="#tab1-item3" data-toggle="tab">Within Polygon?</a></li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane fade active in" id="tab1-item1">

                            </div>
                            <div class="tab-pane fade" id="tab1-item2">

                            </div>
                            <div class="tab-pane fade" id="tab1-item3">
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section> <!--/#map-section-->    
    </div>
</div>
    <?php
        require '../view/footerInclude.php';
    ?>