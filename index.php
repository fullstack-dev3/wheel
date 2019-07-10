<html>
    <head>
        <title>HTML5 Canvas Winning Wheel</title>
        <link rel="stylesheet" type="text/css" href="main.css" />
        <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" />
    </head>
    <body>
        <div class="container text-center">
            <div class="the_wheel">
                <canvas id="canvas" width="420" height="420">
                    <p style="{color: white}" align="center">Sorry, your browser doesn't support canvas. Please try another.</p>
                </canvas>
            </div>

            <div class="power_controls">
                <a class="btn btn-danger btn-lg text-white" onClick="startSpin('');">Spin The Wheel</a>
            </div>

        </div>
        <div id="prize"></div>
        <div class="container text-center">
            
        </div>
    </body>

    <script src="https://code.jquery.com/jquery-1.12.2.min.js"></script>

    <script type="text/javascript" src="Winwheel.js"></script>
    <script type="text/javascript" src="TweenMax.min.js"></script>
    <script src="airtable.browser.js"></script>

    <script>
        var Airtable = require('airtable');

        var base = new Airtable({ apiKey: 'keyUClRNN9po9WMti' }).base('appXfXlSlxIovOjTW');

        var num = [];
        var products = [];

        base('user').select({
            sort: [ {field: 'Name', direction: 'asc'} ]
        }).eachPage(function page(records, fetchNextPage) {
            records.forEach(function(record) {
                num.push(record.get('Giveaway Number'));
            });

            fetchNextPage();
        });

        base('Admin').select({
            sort: [ {field: 'Prize Number', direction: 'asc'} ]
        }).eachPage(function page(records, fetchNextPage) {
            records.forEach(function(record) {
                var giveNum = record.get('Giveaway Number');
                console.log(giveNum);

                if (giveNum == '') {
                    var product = [];

                    product.push(record.get('Prize Number'));
                    product.push(record.get('Product Name'));
                    product.push(record.get('Product Image'));
                    product.push(record.get('Product Bullets'));
                    product.push(record.get('Price'));

                    products.push(product);
                }
            });
        });

        startSpin("init");

        let audio = new Audio('tick.mp3');

        function playSound()
        {
            audio.pause();
            audio.currentTime = 0;

            audio.play();
        }

        function startSpin(val)
        {
            $('#prize').text('');

            let theWheel = new Winwheel({
                'numSegments'       : 9,
                'outerRadius'       : 200,
                'drawMode'          : 'segmentImage',
                'segments'          :
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
                'animation' :
                {
                    'type'     : 'spinToStop',
                    'duration' : 3,
                    'spins'    : 9,
                    'callbackFinished' : alertPrize,
                    'callbackSound'    : playSound
                }
            });

            if (val == "")
                theWheel.startAnimation();
        }

        function alertPrize(indicatedSegment)
        {
            var rand = Math.floor(Math.random() * num.length);

            $('#prize').text(num[rand]);
        }
    </script>
</html>
