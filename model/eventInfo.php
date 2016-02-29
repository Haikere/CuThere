<?php

/* 
 * Created: 02.29.16
 * Author: Chris Gillis
 * 
 * Purpose: Hold the logical queries we will run against the database to pull information in order to populate
 *           the eventDetails page
 *           the eventList page
 *  Will also help us to be able to properly run the locationCompareModel file 
 *  Will be able to pass the ID across to the other files in order to JSON_ENCODE THE correct location for the polygon
 */

require_once '../model/model.php';
