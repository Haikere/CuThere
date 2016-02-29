 <?php
    $title = "Database Tests";
    require '../view/headerInclude.php';
    
    
   
?>
<div id="body">
<script src="../js/locationCompare.js"></script>
<script type='text/javascript' src='http://ajax.googleapis.com/ajax/libs/jquery/1.6.1/jquery.min.js'></script>
    <section id="page-breadcrumb">
        <div class="vertical-center sun">
             <div class="container">
                <div class="row">
                    <div class="action">
                        <div class="col-sm-12">
                            <h1 class="title">Test Case 1 </h1>
                            <p>Please check in and record your result based on the color of the screen</p>
                        </div>
                        Green : Success, you were able to successfully check in based on your geolocation
                        <br/>
                  
                        Yellow: Try again, you may have been outside the bounds, or your location services may be not be enabled.
                        <br/>
                       
                        Red: Unsuccessful
                     </div>
                </div>
         
                 
            </div>
        </div>
   </section>
    <section id="services">
            <div>

                <p id="test"></p>
             <!-- <button onclick="myFunction()">Try it</button> -->
              <button onclick="locationCheck()">Get Location</button>
              

            </div>
        </section>
    
</div>
    <!--/#services-->

    

<?php
    require '../view/footerInclude.php';
?>