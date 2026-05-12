@extends('layouts.authentication.master')

@section('title', 'NAMA APLIKASI - RSUD Kota Bogor')

@section('content')

<style>

    html,
    body{
        width:100%;
        height:100%;
        margin:0;
        padding:0;
        overflow:hidden;
        font-family:'Poppins',sans-serif;
    }

    *{
        box-sizing:border-box;
    }

    /* =========================
       BACKGROUND ANIMATION
    ========================== */

    .animated-bg{
        width:100%;
        min-height:100vh;

        display:flex;
        justify-content:center;
        align-items:center;

        position:relative;
        overflow:hidden;

        padding:20px;

        background:linear-gradient(
            -45deg,
            #020617,
            #1e1b4b,
            #7c3aed,
            #ec4899,
            #06b6d4,
            #2563eb
        );

        background-size:400% 400%;

        animation:bgAnimation 15s ease infinite;
    }

    @keyframes bgAnimation{

        0%{
            background-position:0% 50%;
        }

        25%{
            background-position:50% 100%;
        }

        50%{
            background-position:100% 50%;
        }

        75%{
            background-position:50% 0%;
        }

        100%{
            background-position:0% 50%;
        }

    }

    /* =========================
       GLOW EFFECT
    ========================== */

    .animated-bg::before{
        content:'';

        position:absolute;

        width:700px;
        height:700px;

        background:#8b5cf6;

        border-radius:50%;

        top:-250px;
        left:-150px;

        opacity:0.35;

        filter:blur(120px);

        animation:floating1 10s ease-in-out infinite;
    }

    .animated-bg::after{
        content:'';

        position:absolute;

        width:600px;
        height:600px;

        background:#06b6d4;

        border-radius:50%;

        bottom:-250px;
        right:-150px;

        opacity:0.35;

        filter:blur(120px);

        animation:floating2 12s ease-in-out infinite;
    }

    @keyframes floating1{

        0%{
            transform:translateY(0px);
        }

        50%{
            transform:translateY(50px);
        }

        100%{
            transform:translateY(0px);
        }

    }

    @keyframes floating2{

        0%{
            transform:translateY(0px);
        }

        50%{
            transform:translateY(-50px);
        }

        100%{
            transform:translateY(0px);
        }

    }

    /* =========================
       LOGIN CARD
    ========================== */

    .login-box{

        position:relative;
        z-index:10;

        width:100%;
        max-width:430px;

        padding:40px 35px;

        border-radius:28px;

        background:rgba(255,255,255,0.12);

        backdrop-filter:blur(18px);

        border:1px solid rgba(255,255,255,0.2);

        box-shadow:
            0 8px 32px rgba(0,0,0,0.25);

        animation:fadeIn 1s ease;
    }

    @keyframes fadeIn{

        from{
            opacity:0;
            transform:translateY(20px);
        }

        to{
            opacity:1;
            transform:translateY(0);
        }

    }

    /* =========================
       LOGO AREA
    ========================== */

    .logo-area{
        text-align:center;
        margin-bottom:30px;
    }

    .logo-area img{
        width:90px;
        margin-bottom:15px;
    }

    .logo-area h2{
        margin:0;
        color:white;
        font-size:30px;
        font-weight:700;
        letter-spacing:1px;
    }

    .logo-area p{
        margin-top:5px;
        color:rgba(255,255,255,0.8);
        font-size:14px;
    }

    /* =========================
       TITLE
    ========================== */

    .login-title{
        text-align:center;
        margin-bottom:25px;

        color:white;

        font-size:28px;
        font-weight:700;
    }

    /* =========================
       FORM
    ========================== */

    .form-group{
        margin-bottom:20px;
    }

    .form-group label{
        display:block;
        margin-bottom:8px;

        color:white;

        font-weight:600;
        font-size:14px;
    }

    .form-control{

        width:100%;
        height:54px;

        border:none;
        border-radius:14px;

        padding:0 18px;

        background:rgba(255,255,255,0.15);

        color:white;

        font-size:15px;

        transition:0.3s;
    }

    .form-control::placeholder{
        color:rgba(255,255,255,0.7);
    }

    .form-control:focus{

        outline:none;

        background:rgba(255,255,255,0.22);

        box-shadow:
            0 0 0 3px rgba(255,255,255,0.12);
    }

    /* =========================
       BUTTON
    ========================== */

    .btn-login{

        width:100%;
        height:55px;

        border:none;
        border-radius:14px;

        margin-top:10px;

        color:white;

        font-size:16px;
        font-weight:700;

        cursor:pointer;

        background:linear-gradient(
            135deg,
            #3b82f6,
            #8b5cf6,
            #ec4899
        );

        background-size:300% 300%;

        animation:buttonGradient 5s ease infinite;

        transition:0.3s;
    }

    @keyframes buttonGradient{

        0%{
            background-position:0% 50%;
        }

        50%{
            background-position:100% 50%;
        }

        100%{
            background-position:0% 50%;
        }

    }

    .btn-login:hover{

        transform:translateY(-2px);

        box-shadow:
            0 10px 25px rgba(0,0,0,0.25);
    }

    /* =========================
       ALERT
    ========================== */

    .alert-success-custom{

        background:rgba(34,197,94,0.15);

        color:#dcfce7;

        padding:12px;

        border-radius:12px;

        margin-bottom:15px;

        border:1px solid rgba(255,255,255,0.1);
    }

    .alert-danger-custom{

        background:rgba(239,68,68,0.15);

        color:#fee2e2;

        padding:12px;

        border-radius:12px;

        margin-bottom:15px;

        border:1px solid rgba(255,255,255,0.1);
    }

    .alert-danger-custom ul{
        margin:0;
        padding-left:18px;
    }

    /* =========================
       MOBILE
    ========================== */

    @media(max-width:576px){

        .login-box{
            padding:30px 22px;
            border-radius:22px;
        }

        .logo-area h2{
            font-size:24px;
        }

        .login-title{
            font-size:22px;
        }

    }

</style>

<div class="animated-bg">

    <div class="login-box">

        <div class="logo-area">

            <img
                src="{{ asset('assets/images/logo/logo-rsud.png') }}"
                alt="logorsud"
            >

            <h2>NAMA APLIKASI</h2>

            <p>RSUD KOTA BOGOR</p>

        </div>

        <form
            class="theme-form"
            action="{{ route('login.store') }}"
            method="POST"
        >

            @csrf

            <h4 class="login-title">
                Masuk ke Sistem
            </h4>

            @if (session('status'))
                <div class="alert-success-custom">
                    {{ session('status') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="alert-danger-custom">
                    <ul>
                        @foreach ($errors->all() as $e)
                            <li>{{ $e }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="form-group">

                <label>
                    Username
                </label>

                <input
                    type="text"
                    name="email"
                    class="form-control"
                    placeholder="Masukkan username"
                    required
                >

            </div>

            <div class="form-group">

                <label>
                    Password
                </label>

                <input
                    type="password"
                    name="password"
                    class="form-control"
                    placeholder="Masukkan password"
                    required
                >

            </div>

            <button type="submit" class="btn-login">
                Masuk
            </button>

        </form>

    </div>

</div>

@endsection
