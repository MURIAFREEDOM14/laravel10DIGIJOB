<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <title>Atlantis Lite - Bootstrap 4 Admin Dashboard</title>
        <meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
        <link rel="icon" href="Atlantis/examples/assets/img/icon.ico" type="image/x-icon"/>
    
        <!-- Fonts and icons -->
        <script src="Atlantis/examples/assets/js/plugin/webfont/webfont.min.js"></script>
        <script>
            WebFont.load({
                google: {"families":["Lato:300,400,700,900"]},
                custom: {"families":["Flaticon", "Font Awesome 5 Solid", "Font Awesome 5 Regular", "Font Awesome 5 Brands", "simple-line-icons"], urls: ['Atlantis/examples/assets/css/fonts.min.css']},
                active: function() {
                    sessionStorage.fonts = true;
                }
            });
        </script>
    
        <!-- CSS Files -->
        <link rel="stylesheet" href="Atlantis/examples/assets/css/bootstrap.min.css">
        <link rel="stylesheet" href="Atlantis/examples/assets/css/atlantis.min.css">
    
        <!-- CSS Just for demo purpose, don't include it in your project -->
        <link rel="stylesheet" href="Atlantis/examples/assets/css/demo.css">
    </head>
    <body>
        <div class="container">
            <div class="row mt-5">
                <div class="col-md-4"></div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="">Kode Referral</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-append">
                                        <input type="text" name="referral_code" disabled value="{{$referral_code}}" class="form-control">
                                        @if (auth()->user() !== null)
                                            <a href="/" class="btn btn-primary">Masuk</a>
                                        @else
                                            <a disabled class="btn btn-primary">Masuk</a>
                                        @endif
                                    </div>
                                </div>                                  
                            </div>
                            <div class="mt-3">Belum punya kode referral? Klik  <a href="/register">Register</a></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4"></div>
            </div>
        </div>
    </body>
</html>