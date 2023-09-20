<!DOCTYPE html>
<html>
    <head>
        <title></title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <style type="text/css">
        
            @media screen {
                @font-face {
                    font-family: 'Poppins';
                    font-style: normal;
                    font-weight: 400;
                    src: local('Poppins Regular'), local('Poppins-Regular'), url(https://fonts.gstatic.com/s/lato/v11/qIIYRU-oROkIk8vfvxw6QvesZW2xOQ-xsNqO47m55DA.woff) format('woff');
                }
            }

            /* CLIENT-SPECIFIC STYLES */
            body,
            table,
            td,
            a {
                -webkit-text-size-adjust: 50%;
                -ms-text-size-adjust: 50%;
            }

            table,
            td {
                mso-table-lspace: 0pt;
                mso-table-rspace: 0pt;
            }

            img {
                -ms-interpolation-mode: bicubic;
            }

            /* RESET STYLES */
            img {
                border: 0;
                height: auto;
                line-height: 100%;
                outline: none;
                text-decoration: none;
            }

            table {
                border-collapse: collapse !important;
            }

            body {
                height: 100% !important;
                margin: 0 !important;
                padding: 0 !important;
                width: 100% !important;
            }

            /* iOS BLUE LINKS */
            a[x-apple-data-detectors] {
                color: inherit !important;
                text-decoration: none !important;
                font-size: inherit !important;
                font-family: 'Poppins' !important;
                font-weight: inherit !important;
                line-height: inherit !important;
            }

            /* MOBILE STYLES */
            @media screen and (max-width:600px) {
                h1 {
                    font-size: 32px !important;
                    line-height: 32px !important;
                }
            }

            /* ANDROID CENTER FIX */
            div[style*="margin: 16px 0;"] {
                margin: 0 !important;
            }
        </style>
    </head>
    <body style="background-color: #f4f4f4; margin: 0 !important; padding: 0 !important;">
        <!-- HIDDEN PREHEADER TEXT -->
        <div style="display: none; font-size: 1px; color: #fefefe; line-height: 1px; font-family: 'Poppins', Helvetica, Arial, sans-serif; max-height: 0px; max-width: 0px; opacity: 0; overflow: hidden;">Metode Pembayaran</div>
        <table border="0" cellpadding="0" cellspacing="0" width="100%">
            <!-- LOGO -->
            <tr>
                <td bgcolor="#C0C0C0" align="center">
                    <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px;">
                        <tr>
                            <td align="center" valign="top" style="padding: 40px 10px 40px 10px;"> </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td bgcolor="#C0C0C0" align="center" style="padding: 0px 10px 0px 10px;">
                    <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 950px;">
                        <tr>
                            <td bgcolor="#ffffff" align="center" valign="top" style="padding: 40px 20px 20px 20px; border-radius: 4px 4px 0px 0px; color: #111111; font-family: 'Poppins', Helvetica, Arial, sans-serif; font-size: 36px; font-weight: 600; letter-spacing: 4px; line-height: 48px;">
                                <h1 style="font-size: 36px; font-weight: 600; margin: 2;">Metode Pembayaran</h1>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td bgcolor="#f4f4f4" align="center" style="padding: 0px 10px 0px 10px;">
                    <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 950px; margin-bottom:20px;">
                        <tr>
                            <td bgcolor="#ffffff" align="left">
                                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                    <tr>
                                        <td bgcolor="#ffffff" align="left" style="padding: 0px 30px 0px 30px;">
                                            <div class="" style="text-transform:uppercase; padding: 0px 30px 10px 30px; color: #666666; font-family: 'Poppins', Helvetica, Arial, sans-serif; font-size: 18px; font-weight: 400; line-height: 20px;">
                                                Nama Pembayar
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td bgcolor="#ffffff" align="left" style="padding: 0px 30px 10px 30px;">
                                            <div class="" style="text-transform:uppercase; padding: 0px 30px 10px 30px; color: #666666; font-family: 'Poppins', Helvetica, Arial, sans-serif; font-size: 18px; font-weight: 400; line-height: 20px;">
                                                {{$name}}
                                                {{-- {$name} --}}
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td bgcolor="#ffffff" align="left" style="padding: 0px 30px 0px 30px;">
                                            <div class="" style="text-transform:uppercase; padding: 0px 30px 10px 30px; color: #666666; font-family: 'Poppins', Helvetica, Arial, sans-serif; font-size: 18px; font-weight: 400; line-height: 20px;">
                                                Nominal Pembayaran
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td bgcolor="#ffffff" align="left" style="padding: 0px 30px 10px 30px;">
                                            <div class="" style="text-transform:uppercase; padding: 0px 30px 10px 30px; color: #666666; font-family: 'Poppins', Helvetica, Arial, sans-serif; font-size: 18px; font-weight: 400; line-height: 20px;">
                                                {{$payment}}
                                                {{-- {$payment} --}}
                                            </div>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td bgcolor="white" align="center">
                                <table>
                                    <tr>
                                        <td>
                                            <h2 style="font-family: poppins; font-weight:600;">Informasi Rekening</h2>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td bgcolor="#ffffff" align="left" style="padding: 0px 30px 0px 30px;">
                                <div class="" style="text-transform:uppercase; padding: 0px 30px 10px 30px; color: #666666; font-family: 'Poppins', Helvetica, Arial, sans-serif; font-size: 18px; font-weight: 400; line-height: 20px;">
                                    Nama Bank
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td bgcolor="#ffffff" align="left" style="padding: 0px 30px 10px 30px;">
                                <div class="" style="text-transform:uppercase; padding: 0px 30px 10px 30px; color: #666666; font-family: 'Poppins', Helvetica, Arial, sans-serif; font-size: 18px; font-weight: 400; line-height: 20px;">
                                    {{$bank}}
                                    {{-- {bank} --}}
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td bgcolor="#ffffff" align="left" style="padding: 0px 30px 0px 30px;">
                                <div class="" style="text-transform:uppercase; padding: 0px 30px 10px 30px; color: #666666; font-family: 'Poppins', Helvetica, Arial, sans-serif; font-size: 18px; font-weight: 400; line-height: 20px;">
                                    Nama Rekening
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td bgcolor="#ffffff" align="left" style="padding: 0px 30px 10px 30px;">
                                <div class="" style="text-transform:uppercase; padding: 0px 30px 10px 30px; color: #666666; font-family: 'Poppins', Helvetica, Arial, sans-serif; font-size: 18px; font-weight: 400; line-height: 20px;">
                                    {{$namarec}}
                                    {{-- {$namarec} --}}
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td bgcolor="#ffffff" align="left" style="padding: 0px 30px 0px 30px;">
                                <div class="" style="text-transform:uppercase; padding: 0px 30px 10px 30px; color: #666666; font-family: 'Poppins', Helvetica, Arial, sans-serif; font-size: 18px; font-weight: 400; line-height: 20px;">
                                    Nomor Rekening
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td bgcolor="#ffffff" align="left" style="padding: 0px 30px 10px 30px;">
                                <div class="" style="text-transform:uppercase; padding: 0px 30px 10px 30px; color: #666666; font-family: 'Poppins', Helvetica, Arial, sans-serif; font-size: 18px; font-weight: 400; line-height: 20px;">
                                    {{$nomorec}}
                                    {{-- {$nomorec} --}}
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td bgcolor="white" align="center" style="padding: 0px 30px 0px 30px;">
                                <h3 class="" style="font-family: poppins">Pemberitahuan</h3>
                                <div class="" style="font-family: poppins">Informasi rekening diatas digunakan untuk anda melakukan pembayaran menggunakan rekening bank. Silahkan anda melakukan transfer melalui no rekening diatas. Jika anda sudah selesai melakukan tranfer, harap untuk mengambil foto sebagai bukti pembayaran, lalu silahkan untuk menuju link dibawah ini untuk konfirmasi pembayaran.</div>
                            </td>
                        </tr>
                        <tr>
                            <td style="border-bottom: 1px solid #666666; padding: 5px 0px 5px 0px"></td>
                        </tr>
                        <tr>
                            <td bgcolor="#ffffff" align="left">
                                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                    <tr>
                                        <td bgcolor="#ffffff" align="center" style="padding: 10px 30px 30px 30px;">
                                            <div class="" style="font-family: poppins;">Silahkan tekan link berikut untuk Konfirmasi pembayaran</div>                                                
                                            <table border="0" cellspacing="0" cellpadding="0">
                                                <tr>
                                                    <td align="center" style="border-radius: 3px;" bgcolor="#0000FF">
                                                        <a 
                                                        href="{{route('payment.confirm',$token)}}" 
                                                        style="margin:20px; font-size:20px; line-height:50px; text-decoration:none; color:white">
                                                            Konfirmasi Pembayaran
                                                        </a>
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        <!-- COPY -->
                        <tr>
                            <td bgcolor="gray" align="left" style="padding: 0px 30px 40px 30px; border-radius: 0px 0px 4px 4px; color: #666666; font-family: 'Poppins', Helvetica, Arial, sans-serif; font-size: 18px; font-weight: 400; line-height: 25px;">
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
    </body>
</html>