<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>

    </style>
</head>
<body>
<div class="wrapper" style="max-width: 600px; width: 100%; border-radius: 5px; box-sizing: border-box; padding: 15px">
    <div class="message" style="background-color: #FFFFFF; color: #23272b">
        <h1 style="text-align: center">Здравствуйте, {{$data['name']}} !</h1>
        <p>Для Вас была создана учетная запись в системе <a href="https://it20auth.pp.ua/login">{{$data['app_name']}}</a></p>
        <p>Ваш логин для входа в систему: <b style="color: #1a202c; font-weight: 600">{{$data['email']}}</b></p>
        <p>При необходимости, Вы сможете изменить его в разделе «Настройки безопасности» после авторизации в
            системе.</p>
        <p>Ваш пароль: <b style="color: #1a202c; font-weight: 600; font-size: 18px;">{{ $data['password'] }}</b></p>
    </div>
</div>
</body>
</html>
