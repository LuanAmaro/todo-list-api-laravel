<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,600&display=swap">

        <title>API</title>
        <style>
            *{
                margin: 0;
                padding: 0;
            }
            html, body {
                height: 100vh;
                font-family: 'Poppins', sans-serif;
                background-color: #232323;
                color: #FFFFFF
            }
            h1 {
                color: white;
                font-size: 60px;
            }
            a {
                text-decoration: none;
                color: #FE9E0E;
            }
            div {
                display: flex;
                flex-direction: column;
                justify-content: center;
                align-items: center;
                height: 100vh;
            }
        </style>
    </head>
    <body>
        <div>
            <h1>Not Found</h1>
            <a href="{{ env('URL_SITE') }}">Acesse esse link para ser redirecionado para site correto</a>
        </div>
    </body>
</html>
