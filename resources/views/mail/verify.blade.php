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
            font-family: Poppin !important;
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
<div style="display: none; font-size: 1px; color: #fefefe; line-height: 1px; font-family: 'Poppins', Helvetica, Arial, sans-serif; max-height: 0px; max-width: 0px; opacity: 0; overflow: hidden;">Selamat Datang {{isset($pengirim['name']) ? $pengirim['name']: ''}}</div>
<table border="0" cellpadding="0" cellspacing="0" width="100%">
    <!-- LOGO -->
    <tr>
        <td bgcolor="red" align="center">
            <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px;">
                <tr>
                    <td align="center" valign="top" style="padding: 40px 10px 40px 10px;"> </td>
                </tr>
            </table>
        </td>
    </tr>
    <tr>
        <td bgcolor="red" align="center" style="padding: 0px 10px 0px 10px;">
            <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px;">
                <tr>
                    <td bgcolor="#ffffff" align="center" valign="top" style="padding: 40px 20px 20px 20px; border-radius: 4px 4px 0px 4px; color: #111111; font-family: 'Poppins', Helvetica, Arial, sans-serif; font-size: 48px; font-weight: 400; letter-spacing: 4px; line-height: 48px;">
                        <h1 style="font-size: 48px; font-weight: 400; margin: 2;">Selamat Datang</h1>
                        {{-- <img src="/gambar/icon.ico" width="150" height="150" alt=""> --}}
                        <div class="" style="font-family:-apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;">DIGIJOB-UGIPORT</div>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
    <tr>
        <td bgcolor="#f4f4f4" align="center" style="padding: 0px 10px 0px 10px;">
            <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px;">
                <tr>
                    <td bgcolor="#ffffff" align="left">
                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                            <tr>
                                <td bgcolor="#ffffff" align="center" style="padding: 10px 30px 10px 30px;">
                                    <div class="" style="padding: 0px 30px 10px 30px; color: #666666; font-family: 'Poppins', Helvetica, Arial, sans-serif; font-size: 18px; font-weight: 400; line-height: 25px;">
                                        Halo 
                                    </div>
                                    <div class="" style="padding: 0px 30px 20px 30px; color: black; font-family: 'Poppins', Helvetica, Arial, sans-serif; text-transform:uppercase; font-size: 18px; font-weight: 400; line-height: 25px;">
                                        {{-- (Nama) --}}
                                        {{$nama}}
                                    </div>
                                </td>
                            </tr>
                        </table>
                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                            <tr>
                                <td bgcolor="#ffffff" align="center" style="padding: 10px 30px 10px 30px;">
                                    <div class="" style="padding: 0px 30px 10px 30px; color: #666666; font-family: 'Poppins', Helvetica, Arial, sans-serif; font-size: 18px; font-weight: 400; line-height: 25px;">
                                        Gunakan Kode ini Untuk verifikasi bahwa ini benar-benar anda 
                                    </div>
                                    <div class="" style="padding: 0px 30px 20px 30px; color: black; font-family: 'Poppins', Helvetica, Arial, sans-serif; text-transform:uppercase; font-size: 18px; font-weight: 400; line-height: 25px;">
                                        {{-- (Nama) --}}
                                        {{$text}}
                                    </div>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td bgcolor="#ffffff" align="left">
                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                            <tr>
                                <td bgcolor="#ffffff" align="center" style="padding: 10px 30px 30px 30px;">
                                    <div class="" style="padding: 0px 30px 20px 30px; color: #666666; font-family: 'Poppins', Helvetica, Arial, sans-serif; font-size: 18px; font-weight: 400; line-height: 25px;">
                                        Silahkan tuju link berikut untuk verifikasi Email anda
                                    </div>
									<table border="0" cellspacing="0" cellpadding="0">
                                        <tr>
                                            <td align="center" style="border-radius: 3px;" bgcolor="red">
                                                <a 
                                                href="{{route('users_verification',$token)}}" 
                                                style="margin:20px; font-size:20px; line-height:50px; text-decoration:none; color:white">
                                                    Verifikasi Akun
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
                        <p style="margin: 0;">Follow me on:</p>
                        <div>
                            <a style="padding-right:10px" href=""><img src="https://cdn-icons-png.flaticon.com/512/2111/2111463.png" width="25"></a>
                            <a href=><img src="https://cdn-icons-png.flaticon.com/512/733/733579.png" width="25"></a>
                        </div>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
    {{-- <tr>
        <td bgcolor="#f4f4f4" align="center" style="padding: 30px 10px 0px 10px;">
            <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px;">
                <tr>
                    <td bgcolor="#ff0000" align="center" style="padding: 30px 30px 30px 30px; border-radius: 4px 4px 4px 4px; color: #fff; font-family: 'Poppins', Helvetica, Arial, sans-serif; font-size: 18px; font-weight: 400; line-height: 25px;">
                        <h2 style="font-size: 20px; font-weight: 400; color: #fff; margin: 0;">Need more help?</h2>
                        <p style="margin: 0;"><a href="mailto:portal_app_team@svkm.ac.in" target="_blank" style="color: #fff;">We&rsquo;re here to help you out</a></p>
                    </td>
                </tr>
            </table>
        </td>
    </tr> --}}
    {{-- <tr>
        <td bgcolor="#f4f4f4" align="center" style="padding: 0px 10px 0px 10px;">
            <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px;">
                <tr>
                    <td bgcolor="#f4f4f4" align="left" style="padding: 0px 30px 30px 30px; color: #666666; font-family: 'Poppins', Helvetica, Arial, sans-serif; font-size: 14px; font-weight: 400; line-height: 18px;"> <br>
                        <p style="margin: 0;">If these emails get annoying, please feel free to <a href="#" target="_blank" style="color: #111111; font-weight: 700;">unsubscribe</a>.</p>
                    </td>
                </tr>
            </table>
            
        </td>
    </tr> --}}
</table>
</body>
</html>