 <?php
    $title = "Database Tests";
    require '../view/headerInclude.php';
    require '../model/model.php';
   
?>
    <section id="page-breadcrumb">
        <div class="vertical-center sun">
             <div class="container">
                <div class="row">
                    <div class="action">
                        <div class="col-sm-12">
                            <h1 class="title">Test Data Pulling From Server </h1>
                            <p>Cuz thats My job</p>
                        </div>
                     </div>
                </div>
         
                 
            </div>
        </div>
   </section>
    <!--/#page-breadcrumb-->


    <section id="services">
        <div class="container">
           
                
                <table>
                    <thead>
                    <th> Class Number </th>
                    <th> Class Section </th>
                    <th> Class Name </th>
                    <th> Semester </th>
                    <th> Instructor ID </th>
                    </thead>
                      <tbody>
                <?php 
                    $results = getClassList();
                    foreach ($results as $row) {  
		?>
                 <tr>
                <td><?php echo $row['class_number'] ?> </td>
                <td><?php echo $row['class_section'] ?> </td>
                <td><?php echo $row['class_name'] ?> </td>
                <td><?php echo $row['semester_offered'] ?> </td>
                <td><?php echo $row['first_name'] ?>  <?php echo $row['last_name'] ?> </td>               
                <td><?php echo $row['email'] ?> </td>
           </tbody>
                    <?php } ?>
                </table>
             <br/>
             <br/>
            <table>
                <thead>
                
                <th>Name</th>
                <th>Start Time</th>
                <th> End Time </th>
                <th> Event Date </th>
                <th> Organizer </th>
                <th> Venue </th>
                </thead>
                       <tbody>
                <?php 
                    $results1 = getEventList();
                    foreach ($results1 as $row) {  
		?>
                 <tr>
           
                <td><?php echo $row['name'] ?> </td>
                <td><?php echo $row['start_time'] ?> </td>
                <td><?php echo $row['end_time'] ?> </td>
                <td><?php echo $row['event_date'] ?> </td>
                <td><?php echo $row['organizer'] ?> </td>
                <td><?php echo $row['building_name'] ?> </td>
                <td><?php echo $row['room_number'] ?> </td>
            </tbody>
                    <?php } ?>
                </table>
                
            </table>
            
            </div>
        </div>
    </section>
    <!--/#services-->

    

<?php
    require '../view/footerInclude.php';
?>