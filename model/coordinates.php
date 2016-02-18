<?php

/*
 * Details for the functionality for the Coordinates
 *          Want to make it into a class, becuase there is going to be a lot going on
 *          Keep our code a little bit cleaner
 */

/**
 * Description of coordinates
 *
 * @author Chris
 */
class coordinates {
    // These are the variables where the coords will be stored.
    // They are available to everything within the {}'s after 
    // "class Coordinate"  and can be accessed with
    // $this->_<varname>.
    protected $_lat;
    protected $_long;

    // This is a special function automatically called when 
    // you call "new Coordinate"
    public function __construct($lat, $long)
    {
        // Here, whatever was passed into "new Coordinate" is
        // now stored in our variables above.
        $this->_lat  = $lat;
        $this->_long = $long;
    }

    // This takes the values are stored in our variables,
    // and simply displays them.
    public function display()
    {
        echo $this->_lat;
        echo $this->_long;
    }
    
    public function getLatitude()  { return $this->_lat; }
    public function getLongitude() { return $this->_long; }
}

// This creates a new Coordinate "object". 25 and 5 have been stored inside.
$coordinate = new Coordinate(25, 5); // 25 and 5 are now stored in $coordinate.
$coordinate->display(); // Since $coordinate already "knows" about 25 and 5
                        // it can display them.

// It's important to note, that each time you run "new Coordinate",
// you're creating an new "object" that isn't linked to the other objects.
$coord2 = new Coordinate(99, 1);
$coord2->display(); // This will print 99 and 1, not 25 and 5.

// $coordinate is still around though, and still knows about 25 and 5.
$coordinate->display(); // Will still print 25 and 5.

