<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>@yield('title', 'Truy xuất thông tin')</title>
        <link rel="stylesheet" href="{{asset("vendor/bootstrap-4.5.3-dist/css/bootstrap.min.css")}}">
        <link rel="stylesheet" href="{{asset("vendor/fontawesome-free-5.15.1-web/css/all.min.css")}}">
        <link rel="stylesheet" href="{{asset("css/style.css")}}">
    </head>
    <body>
        <div class="container" style="margin-top:20px;">

            <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm pl-0 pr-0">
                <div class="container pl-0 pr-0">
                    
                    
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                        <span class="navbar-toggler-icon"></span>
                    </button>
    
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <!-- Left Side Of Navbar -->
                        <ul class="navbar-nav mr-auto">
    
                        </ul>
    
                        <!-- Right Side Of Navbar -->
                        <ul class="navbar-nav ml-auto">
                            <!-- Authentication Links -->
                            @if(!session()->has("token"))
                                @if (Route::has('login'))
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('login') }}">{{ __('Đăng nhập') }}</a>
                                    </li>
                                @endif
                                
                                @if (Route::has('register'))
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('register') }}">{{ __('Đăng ký') }}</a>
                                    </li>
                                @endif
                            @else
                                <li class="nav-item dropdown">
                                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                        {{session()->get("name")}}
                                    </a>
    
                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                        <a class="dropdown-item" href="{{ route('logout') }}"
                                           onclick="event.preventDefault();
                                                         document.getElementById('logout-form').submit();">
                                            {{ __('Thoát') }}
                                        </a>
    
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                            @csrf
                                        </form>
                                    </div>
                                </li>
                            @endif
                        </ul>
                    </div>
                </div>
            </nav>  
            @php
                $messageClass = request()->session()->has('error') ? "alert-danger": "alert-success";
                $message = request()->session()->has('error') 
                    ? request()->session()->pull('error')
                    : request()->session()->pull('success');
            @endphp
            @if ($message)
            <div class="alert {{$messageClass}} text-center mt-3 mb-3">
                {{$message}}
            </div>
            @endif
            
            <div class="mt-4">
                @yield('content')
            </div>
            
            <!-- Modal -->
            <div class="modal fade" id="modalDeletingConfirmation" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Bạn muốn xóa ?</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-info" data-dismiss="modal">Hủy</button>
                            <form action="" method="POST">
                                @csrf
                                @method("DELETE")
                                <button type="submit" class="btn btn-danger">Xác Nhận</button>
                            </form>
                            
                        </div>
                    </div>
                </div>
            </div>
            <script src="{{asset("vendor/jquery-3.5.1.min.js")}}"></script>
            <script src="{{asset("vendor/popper.min.js")}}"></script>
            <script src="{{asset("vendor/bootstrap-4.5.3-dist/js/bootstrap.min.js")}}"></script>
            <script src="{{asset("js/script.js")}}"></script>
        </div>
    </body>
</html>
