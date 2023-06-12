<!doctype html>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link href="https://fonts.googleapis.com/css?family=Roboto:300,400&display=swap" rel="stylesheet">

        <link rel="stylesheet" href="{{url('login/fonts/icomoon/style.css')}}">

        <link rel="stylesheet" href="{{url('login/css/owl.carousel.min.css')}}">

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="{{url('login/css/bootstrap.min.css')}}">
        
        <!-- Style -->
        <link rel="stylesheet" href="{{url('login/css/style.css')}}">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>

        <title>Pembayaran Wifi</title>
    </head>
    <body>
    <div class="content">
        <div class="container">
        <div class="row">
            <div class="col-md-6">
                {{-- <img src="{{url('login/images/undraw_remotely_2j6y.svg')}}" alt="Image" class="img-fluid"> --}}
                <div id="carouselExampleSlidesOnly" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <a href="https://goo.gl/maps/wrj8pB9yZ7xBpRcQA">
                                <img src="{{asset('dist/img/tentang.png')}}" class="d-block w-100">
                            </a>
                        </div>
                        <div class="carousel-item">
                            <a href="https://goo.gl/maps/wrj8pB9yZ7xBpRcQA">
                                <img src="{{asset('dist/img/cara.png')}}" class="d-block w-100">
                            </a>
                        </div>
                    </div>
                    </div>
            </div>
            <div class="col-md-6 contents">
            <div class="row justify-content-center">
                <div class="col-md-8">
                <div class="mb-4">
                <h3>Masuk</h3>
                
                <p class="mb-4">Akses pembayaran dengan mudah menggunakan Aplikasi Wifi Jepara.</p>
                @error('password')
                  <div class="alert alert-danger" role="alert" >
                    {{$message}}
                </div>
                @enderror
                @if (session('message'))
                    <div class="alert alert-danger" role="alert" >
                        {{session('message')}}
                    </div>
                @endif
                </div>
                <form action="{{url('masuk/proses')}}" method="post">
                    @csrf
                <div class="form-group first">
                    <label for="ktp">ID Pelanggan</label>
                    <input type="text" name="no_langganan" class="form-control" id="no_langganan" required>

                </div>
                <div class="form-group last mb-4">
                    <label for="password">Password</label>
                     <div class="input-group" id="show_hide_password">
                        <input id="pass" class="form-control" type="password" name="password" required>
                        <div class="input-group-addon">
                            <a id="eye"><i class="fa fa-eye-slash" id="eyepass" aria-hidden="true"></i></a>
                        </div>
                     </div>
                    {{-- <input type="password" name="password" class="form-control" id="password" required> --}}
                    
                </div>
                <input type="submit" value="Log In" class="btn btn-block btn-primary">
                {{-- <span class="d-block text-left my-4 text-muted">&mdash; or login with &mdash;</span>
                <div class="social-login">
                    <a href="#" class="facebook">
                    <span class="icon-facebook mr-3"></span> 
                    </a>
                    <a href="#" class="twitter">
                    <span class="icon-twitter mr-3"></span> 
                    </a>
                    <a href="#" class="google">
                    <span class="icon-google mr-3"></span> 
                    </a>
                </div> --}}
                </form>
                </div>
            </div>
            
            </div>
            
        </div>
        </div>
    </div>

    
        <script src="{{url('login/js/jquery-3.3.1.min.js')}}"></script>
        <script src="{{url('login/js/popper.min.js')}}"></script>
        <script src="{{url('login/js/bootstrap.min.js')}}"></script>
        <script src="{{url('login/js/main.js')}}"></script>
        <script>
            var no = 1;
            $('a#eye').click(function (){
            if(no==1){
                $('#eyepass').removeClass( "fa-eye-slash" ).addClass( "fa-eye" );
                $('#pass').prop("type", "text");
                no=2;
            }else{
                $('#eyepass').removeClass( "fa-eye" ).addClass( "fa-eye-slash" );
                $('#pass').prop("type", "password");
                no=1;
            }
           })
        </script>
    </body>
</html>