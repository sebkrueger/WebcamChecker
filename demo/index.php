<?php
/*------------------------------------------------------------------------------

   Project  : WebcamChecker
   Filename : demo/index.php
   Author   : (c) Sebastian Krüger <krueger@secra.de>
   Date     : 11.10.2014

   For the full copyright and license information, please view the LICENSE
   file that was distributed with this source code.

   Description: demoversion for webcam checker

  ----------------------------------------------------------------------------*/

// require_once("../vendor/autoload.php");

?>
<!DOCTYPE HTML>
<html>
<head>
    <title>WebcamChecker Demo Page</title>
    <meta charset="utf-8">
    <script type="text/javascript">
        // The basic onLoad handler
        window.addEventListener("load", initDemoSetup, false);

        // Setup the Click handler
        function initDemoSetup()
        {
            document.getElementById("uploadnewpic").addEventListener("click", simulatePicUpload);
        }

        // The target for the click handler
        function simulatePicUpload()
        {
            request = new HttpGetRequest();
            request.get('http://localhost:8090/demo/picpusher.php', function(answer) {
                // maybe answer later
            });
        }

        // Send a Get Request
        var HttpGetRequest = function ()
        {
            this.get = function(url, callback)
            {
                httpRequest = new XMLHttpRequest();
                httpRequest.onreadystatechange = function()
                {
                    if (httpRequest.readyState == 4 && httpRequest.status == 200)
                    {
                        callback(httpRequest.responseText);
                    }
                };

                httpRequest.open( "GET", url, true );
                httpRequest.send( null );
            }
        }

    </script>
</head>
<body>
<p>WebcamChecker Demopage</p>
<img src="webcam/current.jpg" width="400" height="300" webcam pic" />

<p>Pressing the button simulate an upload of new current picture from the webcam to <strong>/webcam/current.jpg</strong>.</p>
<button id="uploadnewpic">Simulate new Upload</button>
</body>
</html>