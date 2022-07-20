<!DOCTYPE html>
<html lang="en">

    <head>
        {{-- {!! Assets::renderHeader() !!} --}}
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">


        <title>Graceful - Đổi mật khẩu</title>

        <!-- Custom fonts for this template-->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <link href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
        <link
            href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
            rel="stylesheet">

        <!-- Custom styles for this template-->
        <link href="{{ asset('assets/css/sb-admin-2.min.css') }}" rel="stylesheet">
        <link rel="shortcut icon" href="{{ asset('assets/img/logo-web.png') }}" type="image/x-icon">
    </head>

<body class="bg-gradient-primary">
    
    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-5 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">Đổi mật khẩu</h1>
                            </div>

                            @if($errors->any())
                            @endif
                            <form class="user" action="{{ route('post-ChangePassword') }}" method="post">
                                @csrf
                                {{-- mk hien tai --}}
                                <div class="form-group">
                                    <input type="password" class="form-control form-control-user" name="currentPassword" value="{{ old('currentPassword') }}"
                                        id="currentPassword" placeholder="Mật khẩu cũ">
                                    @error('currentPassword')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                {{-- mk moi --}}
                                <div class="form-group">
                                    <input type="password" class="form-control form-control-user" name="newPassword" value="{{ old('newPassword') }}"
                                        id="newPassword" placeholder="Mật khẩu mới">
                                    @error('newPassword')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                {{-- xac nhan mk --}}
                                <div class="form-group">
                                    <input type="password" class="form-control form-control-user" name="re-Password" value="{{ old('re-Password') }}"
                                        id="re-Password" placeholder="Xác nhận mật khẩu">
                                    @error('re-Password')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <button type="submit" class="btn btn-primary btn-user btn-block">
                                    Đổi mật khẩu
                                </button>


                            </form>
                            <hr>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

</body>

</html>
