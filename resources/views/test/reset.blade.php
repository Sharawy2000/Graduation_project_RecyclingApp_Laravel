<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Forget password page</title>
    <style>
        input,a{
            margin-bottom: 10px;
        }
        form{
            margin: 10px auto
        }
    </style>
</head>
<body>
    <div>
    <form action="https://alshaerawy.aait-sa.com/api/password/email" method="post">
        @csrf
        <input type="text" name="email" placeholder="E-mail"><br>
        <input type="submit" value="Send a reset code">
    
    </form>
    
    </div>
    
</body>
</html>
