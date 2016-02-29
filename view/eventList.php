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
                <?php print_r($results) ?> <!-- CG: Just Was Printing out for test purposes, feel free to delete whenver -->
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
                        <tr>
                            <td><a href="../controller/controller.php?action=EventDetails&amp;EventID=0">Carter Auditorium Test</a></td>
                            <td>Still Hall</td>
                            <td>112</td>
                            <td>3/3/16</td>
                            <td>2pm</td>
                            <td>2:15pm</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </section>
<?php
    require '../view/footerInclude.php';
?>