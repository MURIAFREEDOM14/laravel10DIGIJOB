<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Bootstrap demo</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    </head>
    <body>
    
    <div id="captcha-container">
        <img src="/gambar/default_user.png" alt="Captcha Image">
    </div>
    
    <button onclick="verifyCaptcha()">Submit</button>
    {{-- <script>
        function verifyCaptcha() {
            var response = getPuzzleCaptchaResponse(); // Get the user's response to the puzzle captcha

            // Make an AJAX request to the captcha verification endpoint
            axios.post('{{ route('captcha.verify') }}', { response: response })
                .then(function(response) {
                    // Handle the verification response (success or failure)
                    console.log(response.data);
                })
                .catch(function(error) {
                    // Handle any errors
                    console.log(error);
                });
        }

        function getPuzzleCaptchaResponse() {
            // Implement the logic to extract the user's response from the puzzle captcha element
            // For example, if using an input field with ID 'captcha-response':
            // return document.getElementById('captcha-response').value;
        }
    </script> --}}
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
    </body>
</html>