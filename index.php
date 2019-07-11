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
        <div class="container" id="product">
            <h4 class="prize"></h4>
            <h4 class="pname"></h4>

            <div class="row">
                <div class="col-6">
                    <img src="" />
                </div>
                <div class="col-6">
                    <p></p>
                    <h4 class="value"></h4>
                </div>
            </div>

            <button type="button" class="btn btn-danger btn-lg text-white d-none" id="nextBtn">Next Prize</button>
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

        var currentPro = 0;

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

                if (giveNum == null) {
                    var product = [];

                    product.push(record.get('Prize Number'));
                    product.push(record.get('Product Name'));

                    var proImage = record.get('Product Image')
                    product.push(proImage[0]['url']);

                    product.push(record.get('Product Bullets'));
                    product.push(record.get('Price'));

                    products.push(product);
                }
            });

            getProduct(0);

            fetchNextPage();
        });

        $('#nextBtn').click(function() {
            currentPro++;

            getProduct(currentPro);
        });

        function getProduct(num) {
            if (num < products.length) {
                $('#product .prize').text('Current Prize : ' + products[num][0]);
                $('#product .pname').text('Current Prize : ' + products[num][1]);

                $('#product img').attr('src', products[num][2]);

                $('#product p').text(products[num][3]);

                $('#product .value').text('Value : ' . products[num][4]);
            }

            if (num == products.length - 1)
                $('#nextBtn').hide();

            if (num == 0)
                $('#nextBtn').removeClass('d-none');
        }

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
