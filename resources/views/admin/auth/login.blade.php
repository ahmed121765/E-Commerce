<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Admin Login</title>

    <style>
        body {
            margin: 0;
            color: #6a6f8c;
            background: #c8c8c8;
            font: 600 16px/18px 'Open Sans', sans-serif;
        }

        *,
        :after,
        :before {
            box-sizing: border-box;
        }

        .clearfix:after,
        .clearfix:before {
            content: '';
            display: table;
        }

        .clearfix:after {
            clear: both;
            display: block;
        }

        a {
            color: inherit;
            text-decoration: none;
        }

        .login-wrap {
            width: 100%;
            margin: 40px auto;
            max-width: 525px;
            min-height: 670px;
            position: relative;
            background: url('https://raw.githubusercontent.com/khadkamhn/day-01-login-form/master/img/bg.jpg') no-repeat center;
            background-size: cover;
            box-shadow:
                0 12px 15px 0 rgba(0, 0, 0, .24),
                0 17px 50px 0 rgba(0, 0, 0, .19);
        }

        .login-html {
            width: 100%;
            height: 100%;
            position: absolute;
            padding: 90px 70px 50px 70px;
            background: rgba(40, 57, 101, .9);
        }

        .login-html .sign-in-htm {
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            position: absolute;
        }

        .login-form {
            min-height: 345px;
            position: relative;
        }

        .login-form .group {
            margin-bottom: 15px;
        }

        .login-form .group .label,
        .login-form .group .input,
        .login-form .group .button {
            width: 100%;
            color: #fff;
            display: block;
        }

        .login-form .group .input,
        .login-form .group .button {
            border: none;
            padding: 15px 20px;
            border-radius: 25px;
            background: rgba(255, 255, 255, .1);
        }

        .login-form .group input[data-type="password"] {
            text-security: circle;
            -webkit-text-security: circle;
        }

        .login-form .group .label {
            color: #aaa;
            font-size: 12px;
            margin-bottom: 8px;
            text-transform: uppercase;
        }

        .login-form .group .button {
            background: #1161ee;
            cursor: pointer;
        }

        .login-form .group .button:hover {
            background: #0d52d5;
        }

        .login-form .group .check {
            display: none;
        }

        .login-form .group label .icon {
            width: 15px;
            height: 15px;
            border-radius: 2px;
            position: relative;
            display: inline-block;
            background: rgba(255, 255, 255, .1);
        }

        .login-form .group label .icon:before,
        .login-form .group label .icon:after {
            content: '';
            width: 10px;
            height: 2px;
            background: #fff;
            position: absolute;
            transition: all .2s ease-in-out 0s;
        }

        .login-form .group label .icon:before {
            left: 3px;
            width: 5px;
            bottom: 6px;
            transform: scale(0) rotate(0);
        }

        .login-form .group label .icon:after {
            top: 6px;
            right: 0;
            transform: scale(0) rotate(0);
        }

        .login-form .group .check:checked+label {
            color: #fff;
        }

        .login-form .group .check:checked+label .icon {
            background: #1161ee;
        }

        .login-form .group .check:checked+label .icon:before {
            transform: scale(1) rotate(45deg);
        }

        .login-form .group .check:checked+label .icon:after {
            transform: scale(1) rotate(-45deg);
        }

        .hr {
            height: 2px;
            margin: 60px 0 50px 0;
            background: rgba(255, 255, 255, .2);
        }

        .foot-lnk {
            text-align: center;
        }

        .foot-lnk a {
            color: #aaa;
        }

        .foot-lnk a:hover {
            color: #fff;
        }

        .error {
            color: #ff7777;
            font-size: 12px;
            margin-top: 5px;
        }
    </style>

</head>

<body>

    <div class="login-wrap">

        <div class="login-html">

            <div class="login-form">

                {{-- Admin Login --}}
                <div class="sign-in-htm">

                    <form method="POST" action="{{ route('login.admin.store') }}">

                        @csrf

                        {{-- Email --}}
                        <div class="group">

                            <label for="email" class="label">
                                Email
                            </label>

                            <input id="email" type="email" name="email" class="input" value="{{ old('email') }}"
                                autocomplete="email" required>

                            @error('email')
                                <div class="error">
                                    {{ $message }}
                                </div>
                            @enderror

                        </div>


                        {{-- Password --}}
                        <div class="group">

                            <label for="password" class="label">
                                Password
                            </label>

                            <input id="password" type="password" name="password" class="input" data-type="password"
                                autocomplete="current-password" required>

                            @error('password')
                                <div class="error">
                                    {{ $message }}
                                </div>
                            @enderror

                        </div>


                        {{-- Remember Me --}}
                        <div class="group">

                            <input id="check" type="checkbox" name="remember" value="1" class="check">

                            <label for="check">

                                <span class="icon"></span>

                                Keep me Signed in

                            </label>

                        </div>


                        {{-- Login --}}
                        <div class="group">

                            <input type="submit" class="button" value="Sign In">

                        </div>

                    </form>


                    <div class="hr"></div>


                    <div class="foot-lnk">

                        <a href="#">
                            Forgot Password?
                        </a>

                    </div>

                </div>

            </div>

        </div>

    </div>

</body>

</html>