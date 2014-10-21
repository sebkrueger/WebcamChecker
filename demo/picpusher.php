<?php
/*------------------------------------------------------------------------------

   Project  : WebcamChecker
   Filename : demo/picpusher.php
   Author   : (c) Sebastian Krüger <krueger@secra.de>
   Date     : 22.10.2014

   For the full copyright and license information, please view the LICENSE
   file that was distributed with this source code.

   Description: simulate the upload of a fresh webcam pic by copy pictures
                from resource folder in rotation in the webcam folder

  ----------------------------------------------------------------------------*/

// Where should the pic land at the end
$destination = "webcam/current.jpg";

// The savefile for last pic value
$savefile = "webcam/save.txt";

// Check if there's a file with a number on the server
if(!$number=file_get_contents($savefile))
{
    // There is no file on the server yet
    $number = 1;
}

// Roll around, if number is 5
if($number==5)
{
    $number = 1;
} else {
    $number++;
}

// Save the new number on disk
file_put_contents($savefile, $number);

// What pic will we use as input
$source = "resources/demo_pic".$number.".jpg";

//  copy the pic
copy($source, $destination);