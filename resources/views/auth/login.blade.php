<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

    <style>

*{
    margin:0;
    padding:0;
    box-sizing:border-box;
}

body{
    background:#f3f5f9;
    font-family:Arial,Helvetica,sans-serif;
    min-height:100vh;
    display:flex;
    justify-content:center;
    align-items:center;
    margin:0;
}

.login-wrapper{
    width:100%;
    display:flex;
    justify-content:center;
    align-items:center;
    padding:20px;
}

.login-box{
    width:1050px;
    min-height:540px;
    background:#fff;
    border-radius:12px;
    overflow:hidden;
    box-shadow:0 15px 40px rgba(0,0,0,.12);
}


.left-panel{
    padding:35px 45px;
}

.logo{

    width:90px;
    display:block;
    margin:auto;

}

.heading{
    font-size:58px;
    font-weight:700;
    text-align:center;
    width:100%;
    margin:20px 0 45px;
}
.input-group-custom{

    position:relative;
    margin-bottom:18px;

}

.input-group-custom i.left{

    position:absolute;
    top:18px;
    left:15px;
    color:#666;

}

.input-group-custom input{

    width:100%;
    height:45px;
    border:none;
    border-bottom:2px solid #ddd;
    padding-left:45px;
    font-size:16px;
    outline:none;

}

.input-group-custom input:focus{

    border-color:#4d8df7;

}

.eye{

    position:absolute;
    right:15px;
    top:18px;
    cursor:pointer;
    color:#666;

}

.login-btn{

    width:100%;
    height:45px;
    background:#64be4d;
    border:none;
    color:#fff;
    border-radius:7px;
    font-size:18px;
    transition:.3s;

}

.login-btn:hover{

    background:#003772;

}

.forgot{

    margin-top:25px;
    text-align:center;

}

.forgot a{

    text-decoration:none;
    color:#666;

}

.right-panel{

    background:#fff;
    display:flex;
    justify-content:center;
    align-items:center;

}

.right-panel img{

    width:65%;

}

.error{

    color:red;
    font-size:14px;
    margin-top:5px;

}

@media(max-width:991px){

.right-panel{

display:none;

}

.left-panel{

padding:20px;

}

.login-box{

height:auto;

}

}

    </style>

</head>

<body>

<div class="container-fluid login-wrapper">

<div class="login-box">

<div class="row h-100">

<div class="col-lg-5 left-panel">

<img src="{{ asset('https://vivtronevcs.com/wp-content/uploads/2026/05/file_00000000d93c71fa8543361289614009-e1780049716431.png') }}" class="logo">

<div class="heading">

Log In

</div>

<form method="POST" action="{{ route('login') }}">

@csrf

<div class="input-group-custom">

<i class="fa fa-user left"></i>

<input
type="email"
name="email"
placeholder="Login ID"
value="{{ old('email') }}"
required
autofocus>

@error('email')

<div class="error">

{{ $message }}

</div>

@enderror

</div>
<div class="input-group-custom">

    <i class="fa fa-lock left"></i>

    <input
        type="password"
        id="password"
        name="password"
        placeholder="Password"
        required
        autocomplete="current-password">

    <i class="fa fa-eye eye" id="togglePassword"></i>

    @error('password')

        <div class="error">
            {{ $message }}
        </div>

    @enderror

</div>

<div class="d-flex justify-content-between align-items-center mb-4">

    <div class="form-check">

        <input
            class="form-check-input"
            type="checkbox"
            name="remember"
            id="remember">

        <label class="form-check-label" for="remember">

            Remember Me

        </label>

    </div>

    @if (Route::has('password.request'))

    <a href="{{ route('password.request') }}"
       style="text-decoration:none;color:#666;font-size:14px;">

        Forgot Password?

    </a>

    @endif

</div>

<button type="submit" class="login-btn">

    Log In

</button>

</form>

</div>

<div class="col-lg-6 right-panel">

    <img src="{{ asset('https://wellwalifeindia.com/reg/images/signin-image.jpg') }}"
         class="img-fluid"
         alt="Login Illustration">

</div>

</div>

</div>

</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<script>

const togglePassword = document.getElementById('togglePassword');
const password = document.getElementById('password');

togglePassword.addEventListener('click', function () {

    if (password.type === 'password') {

        password.type = 'text';

        this.classList.remove('fa-eye');
        this.classList.add('fa-eye-slash');

    } else {

        password.type = 'password';

        this.classList.remove('fa-eye-slash');
        this.classList.add('fa-eye');

    }

});

</script>

</body>
</html>