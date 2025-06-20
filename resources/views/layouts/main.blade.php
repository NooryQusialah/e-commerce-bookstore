<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{csrf_token()}}"/>
    <title>مكتبتي</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
    <link href="{{asset('css/app.css')}}" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200..1000&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>

        body {
                    font-family: "Cairo", sans-serif;
                    font-optical-sizing: auto;
                    /*font-weight: <weight>;*/
                    font-style: normal;
                    font-variation-settings:
                        "slnt" 0;
        }
        li {
            margin-left: 3px;
        }
        .score{
            display: block;
            font-size: 16px;
            position: relative;
            overflow: hidden;
        }
        .score-wrap{
            display: inline-block;
            position: relative;
            height: 19px;
        }

        .score .stars-active{
            color: #FFCA00;
            position: relative;
            z-index: 10;
            display: block;
            overflow: hidden;
            white-space: nowrap;
        }
        .score .stars-inactive{
            color: lightgrey;
            position: absolute;
            top: 0;
            left: 0;
        }
        .rating{
            overflow: hidden;
            display: inline-block;
            position: relative;
            font-size: 20px;

        }
        .rating-star{
            padding: 0 5px;
            margin: 0;
            cursor: pointer;
            display: block;
            float: left;
        }
        .rating-star:after{
            position: relative;
            font-family: "font Awesome 5 Free";
            content: '\f005';
            color: lightgrey;
        }
        .rating-star.checked ~ .rating-star:after,
        .rating-star.checked:after{
            content: '\f005';
            color: #FFCA00;
        }
        .rating:hover .rating-star:after{
            content: '\f005';
            color: lightgrey;
        }
        .rating-star:hover ~ .rating-star:after,
         .rating .rating-star:hover:after{
            content: '\f005';
            color: #FFCA00;
        }
    </style>

</head>
<body dir="rtl" style="text-align: right">

<div>
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{route('books.index')}}">مكتبة زاد</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mx-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('categories.index')}}">
                            التصنيفات
                            <i class="fas fa-list"></i>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('publishers.index')}}">
                            الناشرون
                            <i class="fas fa-table"></i>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('authors.index')}}">
                            المؤلفون
                            <i class="fas fa-pen"></i>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            مشترياتي
                            <i class="fas fa-basket-shopping"></i>
                        </a>
                    </li>
                </ul>
                <ul class="navbar-nav mr-auto">
                    @guest
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('login')}}">
                                {{__('تسجيل الدخول')}}
                            </a>
                        </li>
                            @if(Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{route('register')}}">
                                        {{__('انشاء حساب ')}}
                                    </a>
                                </li>
                            @endif
                        @else

                            <li class="nav-item dropdown justify-content-left">

                                    <a id="navbardropdown" class="nav-link" href="#" data-bs-toggle="dropdown">
                                        <img src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" class="rounded-circle border" width="40" height="40">
                                    </a>
                                <nav class="bg-white border-bottom border-2 mb-3">
                                    <div class="dropdown text-end me-4 mt-2">
                                        <ul class="dropdown-menu text-end mt-2" aria-labelledby="userDropdown" style="min-width: 200px;">
                                            <li>
                                                <a class="dropdown-item" href="{{ route('profile.show') }}">
                                                    {{ __('الملف الشخصي') }}
                                                </a>
                                            </li>

                                            @if (Laravel\Jetstream\Jetstream::hasApiFeatures())
                                                <li>
                                                    <a class="dropdown-item" href="{{ route('api-tokens.index') }}">
                                                        {{ __('API Tokens') }}
                                                    </a>
                                                </li>
                                            @endif

                                            <li><hr class="dropdown-divider"></li>
                                            <li>
                                                <form method="POST" action="{{ route('logout') }}">
                                                    @csrf
                                                    <button type="submit" class="dropdown-item text-danger">
                                                        {{ __('تسجيل الخروج') }}
                                                    </button>
                                                </form>
                                            </li>
                                        </ul>
                                    </div>
                                </nav>
                            </li>
                        @endguest
                    </ul>

                </div>
            </div>
        </nav>
    </div>

<main>
    {{$slot}}
</main>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.min.js" integrity="sha384-RuyvpeZCxMJCqVUGFI0Do1mQrods/hhxYlcVfGPOfQtPJh0JCw12tUAZ/Mv10S7D" crossorigin="anonymous"></script>
@stack('scripts')
</body>
</html>
