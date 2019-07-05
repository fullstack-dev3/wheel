<!--
    Winhweel.js one image per segment wheel example by Douglas McKechie @ www.dougtesting.net
    See website for tutorials and other documentation.

    The MIT License (MIT)

    Copyright (c) 2016 Douglas McKechie

    Permission is hereby granted, free of charge, to any person obtaining a copy
    of this software and associated documentation files (the "Software"), to deal
    in the Software without restriction, including without limitation the rights
    to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
    copies of the Software, and to permit persons to whom the Software is
    furnished to do so, subject to the following conditions:

    The above copyright notice and this permission notice shall be included in all
    copies or substantial portions of the Software.

    THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
    IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
    FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
    AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
    LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
    OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
    SOFTWARE.
-->
<html>
    <head>
        <title>HTML5 Canvas Winning Wheel</title>
        <link rel="stylesheet" href="main.css" type="text/css" />
        <script type="text/javascript" src="Winwheel.js"></script>
        <script type="text/javascript" src="TweenMax.min.js"></script>
    </head>
    <body>
        <div align="center">
            <table cellpadding="0" cellspacing="0" border="0">
                <tr>
                    <td>
                        <div class="power_controls">
                            <img id="spin_button" src="spin.png" alt="Spin" onClick="startSpin('');" />
                        </div>
                    </td>
                    <td width="421" height="564" class="the_wheel" align="center" valign="center">
                        <canvas id="canvas" width="420" height="420">
                            <p style="{color: white}" align="center">Sorry, your browser doesn't support canvas. Please try another.</p>
                        </canvas>
                    </td>
                </tr>
            </table>
        </div>
        <script>
            startSpin("init");

            let audio = new Audio('tick.mp3');

            function playSound()
            {
                // Stop and rewind the sound if it already happens to be playing.
                audio.pause();
                audio.currentTime = 0;

                // Play the sound.
                audio.play();
            }

            // -------------------------------------------------------
            // Click handler for spin button.
            // -------------------------------------------------------
            function startSpin(val)
            {
                // Create new wheel object specifying the parameters at creation time.
                let theWheel = new Winwheel({
                    'numSegments'       : 9,                 // Specify number of segments.
                    'outerRadius'       : 200,               // Set outer radius so wheel fits inside the background.
                    'drawMode'          : 'segmentImage',    // Must be segmentImage to draw wheel using one image per segemnt.
                    'segments'          :                    // Define segments including image and text.
                    [
                        {'image' : 'red.png'},
                        {'image' : 'orange.png'},
                        {'image' : 'yellow.png'},
                        {'image' : 'green.png'},
                        {'image' : 'blue.png'},
                        {'image' : 'navy.png'},
                        {'image' : 'purple.png'},
                        {'image' : 'gray.png'},
                        {'image' : 'white.png'}
                    ],
                    'animation' :           // Specify the animation to use.
                    {
                        'type'     : 'spinToStop',
                        'duration' : 3,     // Duration in seconds.
                        'spins'    : 9,     // Number of complete spins.
                        'callbackFinished' : alertPrize,
                        'callbackSound'    : playSound
                    }
                });

                // Begin the spin animation by calling startAnimation on the wheel object.
                if (val == "")
                    theWheel.startAnimation();
            }

            // -------------------------------------------------------
            // Called when the spin animation has finished by the callback feature of the wheel because I specified callback in the parameters.
            // note the indicated segment is passed in as a parmeter as 99% of the time you will want to know this to inform the user of their prize.
            // -------------------------------------------------------
            function alertPrize(indicatedSegment)
            {
                // Do basic alert of the segment text. You would probably want to do something more interesting with this information.
                //alert(indicatedSegment.text + ' says Hi');
            }
        </script>
    </body>
</html>
