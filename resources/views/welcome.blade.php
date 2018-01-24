<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

    <script src="{{\Illuminate\Support\Facades\URL::asset('js/jquery-3.2.1.js')}}"></script>
    <!-- Styles -->
    <style>
        html, body {
            background-color: #fff;
            color: #636b6f;
            font-family: 'Raleway', sans-serif;
            font-weight: 100;
            height: 100vh;
            margin: 0;
        }

        .full-height {
            height: 100vh;
        }

        .flex-center {
            align-items: center;
            display: flex;
            justify-content: center;
        }

        .content {
            text-align: center;
        }

        .title {
            font-size: 84px;
        }

        #addUser {
            background: #315bb4;
            margin-top: 20px;
            padding: 10px 6pc;
            color: white;
        }

        input {
            padding: 3px;
        }

    </style>
</head>
<body>
<div class="flex-center position-ref full-height">

    <div class="content">
        <div>
            <label>
                <span>firstname:</span>
                <input type="text" name="firname">
            </label>
            <label>
                <span>lastname:</span>
                <input type="text" name="laname">
            </label>
            <label>
                <span>email:</span>
                <input type="email" name="email">
            </label>
        </div>
        <p>
            <button id="addUser" onclick="addUser()">添加</button>
        </p>
    </div>
</div>

<script>


    function addUser() {
        var firname = $('input[name=firname]').val();
        var laname = $('input[name=laname]').val();
        var email = $('input[name=email]').val();


        if (firname == '' || laname == '' || email == '') return;
        var userinfo = {
            firname: firname,
            laname: laname,
            email: email
        };
        $.post('/Laravel_site/public/index.php/user/addUser',{
            firname: firname,
            laname: laname,
            email: email
        } , function (data) {
            if (data.result) {

//                    location.href = '/Laravel_site/public/index.php/user/info';
            }
        }, 'json');
    }
</script>

</body>
</html>
