<?php
    $title = "Event Details";
    require '../view/headerInclude.php';
?>
    <section id="page-breadcrumb">
        <div class="vertical-center sun">
             <div class="container">
                <div class="row">
                    <div class="action">
                        <div class="col-sm-12">
                            <h1 class="title"><?php echo $title ?></h1>
                        </div>
                    </div>
                </div>
            </div>
        </div>
   </section>
    <!--/#action-->

    <section id="portfolio-information" class="padding-top">
        <div class="container">
            <div class="row">
               <!-- CG: Just Was Printing out for test purposes, feel free to delete whenver -->
                <div id ='gmap' class="col-sm-6" style="background-color: #DDD">Insert map here? Maybe allow a picture to be uploaded? If not, it's cool.</div>
                <div class="col-sm-6">
                    <div class="project-name overflow">
                        <h2 id="eventName" class="bold"><?php echo $row['name'] ?></h2>
                        <ul class="nav navbar-nav navbar-default">
                            <li><a><i class="fa fa-clock-o"></i><span id='eventDate'><?php echo date('l  F jS \, Y', strtotime($row['event_date'])); ?></span></a></li>
                            <li><a><i class="fa fa-bullseye"></i><span  id="eventBuilding"><?php echo $row['building_name'] ?></span>, <span id="eventRoom">Room <?php echo $row['room_number'] ?></span></a></li>
                        </ul>
                    </div>
                    <div class="project-info overflow">
                        <h3>Event Info</h3>
                        <p>Description Here. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed tempus nibh sed elimttis adipiscing. Fusce in hendrerit purus. Suspendisse potenti. Proin quis eros odio, dapibus dictum mauris. Donec nisi libero, adipiscing id pretium eget, consectetur sit amet leo. Nam at eros quis mi egestas fringilla non nec purus.</p>
                        <h3>Time</h3>
                        <ul class="elements">
                            <li><i class="fa fa-angle-right"></i>From <span id='eventStartTime'><?php echo $row['start_time'] ?></span> to <span id='eventEndTime'><?php echo $row['end_time'] ?></span></li>
                        </ul>
                    </div>
                    <div class="skills overflow">
                        <h3>Eligible Classes:</h3>
                        <ul id="classesList" class="nav navbar-nav navbar-default">
                            <li><a><i class="fa fa-check-square"></i>CIS202</a></li>
                            <li><a><i class="fa fa-check-square"></i>CIS206</a></li>
                            <li><a><i class="fa fa-check-square"></i>CIS355</a></li>
                        </ul>
                    </div>
                    <div class="live-preview">
                        <a href="#" role="button" class="btn btn-common uppercase">Check-In</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
     <!--/#event-information-->
        <br />
<?php
    require '../view/footerInclude.php';
?>