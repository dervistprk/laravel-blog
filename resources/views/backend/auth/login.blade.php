<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="blogger admin girişi">
    <meta name="author" content="blogger">
    <meta name="robots" content="noindex">
    <link rel="icon" type="image/x-icon" href="{{ URL::asset('configs_uploads/blogger-backoffice-favicon.png') }}"/>
    <title>Admin Giriş Ekranı</title>
    <link href="{{URL::asset('back/vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
    <link href="{{URL::asset('back/css/sb-admin-2.min.css')}}" rel="stylesheet">
</head>
<body class="bg-gradient-primary">
<div class="container">
    <div class="row justify-content-center">
        <div class="col-xl-10 col-lg-12 col-md-9">
            <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="card-body p-0">
                    <div class="row">
                        <div class="col-lg-6 d-none d-lg-block"><img src="{{URL::asset('page_images/admin-login.png')}}" alt="admin-login" height="250" width="400" style="margin: 50px 0 50px 50px"></div>
                        <div class="col-lg-6">
                            <div class="p-5">
                                <div class="text-center">
                                    <h1 class="h4 text-gray-900 mb-4">Tekrar Hoşgeldiniz!</h1>
                                </div>
                                @if($errors->any())
                                    <div class="alert alert-danger text-center">
                                        {{$errors->first()}}
                                    </div>
                                @endif
                                <form method="post" action="{{route('admin.login.post')}}" class="user">
                                    @csrf
                                    <div class="form-group">
                                        <input type="text" name="email" class="form-control form-control-user"
                                               id="exampleInputEmail" aria-describedby="emailHelp"
                                               placeholder="E-Posta">
                                    </div>
                                    <div class="form-group">
                                        <input type="password" name="password" class="form-control form-control-user"
                                               id="exampleInputPassword" placeholder="Şifre">
                                    </div>
                                    <button type="submit" class="btn btn-primary btn-user btn-block">
                                        Giriş
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="{{URL::asset('back/vendor/jquery/jquery.min.js')}}"></script>
<script src="{{URL::asset('back/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{URL::asset('back/vendor/jquery-easing/jquery.easing.min.js')}}"></script>
<script src="{{URL::asset('back/js/sb-admin-2.min.js')}}"></script>
</body>
</html>
