@extends('layout/master')

@section('title')
    Login
@endsection

@section('content')
    
<div class="mt-4 login-container">
    <form class="login-form" action="{{route('login')}}" method="POST">
        @csrf
        <h3 class="form-check-label card-title">Login</h3>
        <div class="input-form-group">
            <div class="form-group row">
                <div class="form-input">
                    <input type="email" class="form-control" placeholder="Email" name="email" value="{{old('email')}}">
                </div>
            </div>

            <div class="form-group row mb-4">
                <div class="form-input">
                    <input type="password" class="form-control" placeholder="Pasword" name="password" id="inputPassword">
                </div>
            </div>
        </div>
        @if (session('invalid'))
            <div class="error">
                {{session('invalid')}}
            </div>
        @endif
        @if (count($errors) > 0)
            <div class="error">
                {{ $errors->first() }}
            </div>
        @endif
        <div class="btn-login-container">
            <button type="submit" class="btn btn-secondary btn-login">Login</button>
        </div>
        <div class="signup">Don't have an account? <a href="{{route('register')}}">Sign Up</a></div>
    </form>
</div>

@endsection

@push('head')
    <style>
        .login-container{
            height:50%; 
            width:50%;
            min-width: 500px;
            max-width: 750px;
            margin-left: auto;
            margin-right: auto;
            background-color: white;
        }

        .login-form{
            padding: 2%;
        }

        .card-title{
            text-align: center;
            font-size: 2rem;
        }

        .input-form-group{
            margin-top: 15px;
        }

        .form-control{
            margin: 10px auto;
            border-radius: 200px;
            margin-bottom: 15px;
            height: 40px;
            padding-left: 30px;
            max-width: 85%;
        }

        .error{
            width: 100%;
            max-width: 85%;
            margin: 0 auto;
            background-color: bisque;
            margin-bottom: 12px;
            text-align: center;
            padding: 5px;
            border-radius: 5px;
            color: red;
        }

        .btn-login-container{
            margin-top: 20px;
            text-align: center;
        }

        .btn-login{
            width: 100%;
            max-width: 85%;
            border-radius: 200px;
        }

        .signup{
            margin-top: 10px;
            text-align: center;
        }

        .signup a{
            text-decoration: none;
        }

        @media only screen and (max-width: 500px) {
            .login-container {
                width: 100%;
                min-width: 0;
            }
        }
    </style>
@endpush