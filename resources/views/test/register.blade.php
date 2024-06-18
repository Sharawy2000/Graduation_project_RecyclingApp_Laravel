<!--@if($errors->any())-->
<!--{{ implode('', $errors->all('<div>:message</div>')) }}-->
<!--@endif-->
<!DOCTYPE html>
<!-- Coding By CodingNepal - codingnepalweb.com -->
<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Sign Up </title> 
    <link rel="stylesheet" href="style.css">
    <style>
            @import url('https://fonts.googleapis.com/css?family=Poppins:400,500,600,700&display=swap');
    *{
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: 'Poppins', sans-serif;
    }
    body{
    min-height: 100vh;
    display: flex;
    align-items: center;
    justify-content: center;
    background: #4070f4;
    }
    .wrapper{
    position: relative;
    max-width: 430px;
    width: 100%;
    background: #fff;
    padding: 34px;
    border-radius: 6px;
    box-shadow: 0 5px 10px rgba(0,0,0,0.2);
    }
    .wrapper h2{
    position: relative;
    font-size: 22px;
    font-weight: 600;
    color: #333;
    }
    .wrapper h2::before{
    content: '';
    position: absolute;
    left: 0;
    bottom: 0;
    height: 3px;
    width: 28px;
    border-radius: 12px;
    background: #4070f4;
    }
    .wrapper form{
    margin-top: 30px;
    }
    .wrapper form .input-box{
    height: 52px;
    margin: 18px 0;
    }
    form .input-box input{
    height: 100%;
    width: 100%;
    outline: none;
    padding: 0 15px;
    font-size: 17px;
    font-weight: 400;
    color: #333;
    border: 1.5px solid #C7BEBE;
    border-bottom-width: 2.5px;
    border-radius: 6px;
    transition: all 0.3s ease;
    }
    .input-box input:focus,
    .input-box input:valid{
    border-color: #4070f4;
    }
    form .policy{
    display: flex;
    align-items: center;
    margin: 40px 0 50px 0
    }
    form h3{
    color: #707070;
    font-size: 14px;
    font-weight: 500;
    margin-left: 10px;
    }
    .input-box.button input{
    color: #fff;
    letter-spacing: 1px;
    border: none;
    background: #4070f4;
    cursor: pointer;
    }
    .input-box.button input:hover{
    background: #0e4bf1;
    }
    form .text h3{
    color: #333;
    width: 100%;
    text-align: center;
    }
    form .text h3 a{
    color: #4070f4;
    text-decoration: none;
    }
    form .text h3 a:hover{
    text-decoration: underline;
    }
    label{
        margin:0 30px 0 0;
    }
    </style>
   </head>
<body>
  <div class="wrapper">
    <h2>Registration</h2>
    <form action="https://alshaerawy.aait-sa.com/api/auth/user/register" method="post">
      <div class="input-box">
        <input type="text" name="name" placeholder="Enter your name" required>
      </div>
      @error('name')
            {{$message}}
      @enderror
      <div class="input-box">
        <input type="text" name="email" placeholder="Enter your email" required>
      </div>
      @error('email')
            <p>{{$message}}</p>
      @enderror
      <div class="input-box">
        <input type="password" name="password" placeholder="Create password" required>
      </div>
      @error('password')
            <p>{{$message}}</p>
      @enderror
      <div class="input-box">
        <input type="password" name="password_confirmation" placeholder="Confirm password" required>
      </div>
      @error('password_confirmation')
            <p>{{$message}}</p>
      @enderror
      <div class="input-box">
        <input type="text" name="phone_number" placeholder="Phone number"  required>
      </div>
      @error('phone_number')
            <p>{{$message}}</p>
      @enderror
      <!--<div class="input-box">-->
      <!--  <input type="text" name="location" placeholder="Enter your location" required>-->
      <!--</div>-->
      <!--<div class="input-box">-->
      <!--  <input type="file" name="image" required >-->
      <!--</div>-->
      <!--<div style="margin:40px 10px 0 0;" class="input-box">-->
      <!--  <label for="user_type">Choose your activity:</label>-->
      <!--  <select name="user_type" value="Select">-->
      <!--      <option value="seller">Seller</option>-->
      <!--      <option value="customer">Customer</option>-->
      <!--  </select>-->
      <!--</div>-->
      <!--<div style="margin:0 0 20px 0;">-->
      <!--  <label for="gender">Choose your gender:</label>-->
      <!--  <input type="radio" name="gender" value="Male"> Male-->
      <!--  <input style="margin:0 0 0 20px;" type="radio" name="gender" value="Female"> Female-->
      <!--</div>-->
      <div class="policy">
        <input type="checkbox">
        <h3>I accept all terms & condition</h3>
      </div>
      <div class="input-box button">
        <input type="Submit" value="Register Now">
      </div>
      <div class="text">
        <h3>Already have an account? <a href="http://alshaerawy.aait-sa.com/login">Login now</a></h3>
      </div>
    </form>
  </div>
</body>
</html>
