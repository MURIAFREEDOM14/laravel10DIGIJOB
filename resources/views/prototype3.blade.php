<!doctype html>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- Bootstrap CSS -->
        @livewireStyles
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
        <link rel="stylesheet" href="/path/to/fontawesome/css/all.css">
        <link href="slidercaptcha.min.css" rel="stylesheet" />
        <script src="longbow.slidercaptcha.min.js"></script>
    </head>
    <body>
        <div class="slidercaptcha card">
            <div class="card-header">
              <span>Drag To Verify</span>
            </div>
            <div class="card-body">
              <div id="captcha"></div>
            </div>
        </div>
        <script>
            var captcha = sliderCaptcha({
                id: 'captcha',
                onSuccess: function () {
                // do something
                },
                onFail: function () {
                // ...
                },
                onRefresh: function () {
                // ...      
                },
                setSrc: function () {
                return 'http://imgs.blazor.zone/images/Pic' + Math.round(Math.random() * 136) + '.jpg';
                },
                // or use local images instead
                localImages: function () {
                return 'images/Pic' + Math.round(Math.random() * 4) + '.jpg';
                },
                width: 280,
                height: 155,
                PI: Math.PI,
                sliderL: 42,
                sliderR: 9,
                offset: 5, 
                loadingText: 'Loading...',
                failedText: 'Try It Again',
                barText: 'Slide the Puzzle',
                repeatIcon: 'fa fa-repeat',
                maxLoadCount: 3
                // captcha.reset();
                verify: function (arr, url) {
                var ret = false;
                fetch(url, {
                    method: 'post',
                    headers: {
                        'Accept': 'application/json',
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify(arr)
                }).then(function (result) {
                    ret = result;
                });
                return ret;
                },
                remoteUrl: "api/Captcha"
            });
        </script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    </body>
</html>