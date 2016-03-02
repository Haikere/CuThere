<?php
    $title = "List of Events";
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
                <table id="eventsTable" class="table table-hover table-bordered">
                    <thead>
                        <tr>
                            <th>Event Name</th>
                            <th>Building</th>
                            <th>Room</th>
                            <th>Date</th>
                            <th>Begin Time</th>
                            <th>End Time</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i=0; foreach ($events as $row){ $i++; ?><tr>
                            <td><a href="../controller/controller.php?action=EventDetails&amp;EventID=<?php echo $row['id'] ?>"><?php echo $row['name'] ?></a></td>
                            <td><?php echo $row['building_name'] ?></td>
                            <td><?php echo $row['room_number'] ?></td>
                            <td><?php echo $row['event_date'] ?></td>
                            <td><?php echo $row['start_time'] ?></td>
                            <td><?php echo $row['end_time'] ?></td>
                        </tr>
                        <?php } ?></tbody>
                </table>
            </div>
        </div>
    </section>
<?php
    require '../view/footerInclude.php';
?>