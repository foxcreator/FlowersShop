<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Email Template</title>
    <style>
        /* Общие стили */
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
        }
        /* Контейнер */
        .container {
            width: 100%;
            max-width: 600px;
            margin: 0 auto;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        /* Хедер */
        .header {
            background-color: #415D4C;
            color: #fff;
            padding: 20px;
            border-top-left-radius: 10px;
            border-top-right-radius: 10px;
        }
        .icon {
            width: 24px;
            height: 24px;
            fill: #415D4C;
        }

        .icon-lotus-logo {
            fill: #fffffc;
            width: 120px;
            height: 120px;
        }



        .button {
            width: 100%;
        }

        .button p a {
            display: block;
            width: 70%;
            padding: 20px;
            text-align: center;
            font-size: 20px;
            border-radius: 10px;
            text-decoration: none;
            color: #fffffc;
            border: 1px #0e5b44 solid;
            background-color: #648371;
            margin: 0 auto;
        }

        /* Контент */
        .content {
            padding: 20px;
        }
        /* Футер */
        .footer {
            background-color: #f8f9fa;
            padding: 20px;
            text-align: center;
            border-bottom-left-radius: 10px;
            border-bottom-right-radius: 10px;
        }
    </style>
</head>
<body>

<table class="container">
    <tr>
        <td>
            <!-- Хедер -->
            <table class="header" width="100%" >
                <tr>
                    <td align="center">
                        <a href="{{ env('APP_URL') }}"><img src="{{ asset('front/images/Logo-mail.png') }}" alt="Telegram"></a>
                    </td>
                </tr>
            </table>
            <!-- Контент -->
            @yield('content')
            <!-- Футер -->
            <table class="footer" width="100%" cellpadding="0" cellspacing="0">

                <tr style="width: 100%">
                    <td>
                        <p style="font-size: 20px; font-weight: bold; color: #98A88F; text-align: left">З любов'ю, {{ config('app.name') }}</p>
                    </td>
                    <td>
                        <a style="margin-left: 10px" href="#"><img src="{{ asset('front/images/instagram-logo.png') }}" alt="Instagram"></a>
                        <a style="margin-left: 10px" href="#"><img src="{{ asset('front/images/facebook-logo.png') }}" alt="Facebook"></a>
                        <a style="margin-left: 10px" href="#"><img src="{{ asset('front/images/telegram-logo.png') }}" alt="Telegram"></a>

                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>
</body>
</html>
