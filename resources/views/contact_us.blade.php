<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Bootstrap demo</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    </head>
    <body>
        <div class="container mt-5">
            <div class="container-fluid">
                <div class="card">
                    <div class="card-header">
                        Contact Us
                    </div>
                    <div class="card-body">
                        <form action="/contact_us" method="POST">
                            @csrf       
                            <div class="row mb-3">
                                <div class="col-6">
                                    <h6 class="bold">Hai, Apa yang bisa kami bantu?</h6>
                                    <div class="row">
                                        <div class="col-4">
                                            <label for="">Nama Pengirim</label>
                                        </div>
                                        <div class="col-8">
                                            <input type="text" placeholder="Masukkan nama anda" class="form-control" name="dari" id="">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="mb-2">
                                        <div class="mx-auto">Jelaskan apa kendalamu</div>
                                        <textarea required name="isi" class="form-control" id=""></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="text-center">
                                    <a class="btn btn-danger" href="/kandidat">Kembali</a>
                                    <button type="submit" class="btn btn-primary">Kirim</button>        
                                </div>
                            </div>    
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
    </body>
</html>