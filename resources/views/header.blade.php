<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>GBI Sukawarna Christmas 2022 Registration</title>

    <!-- Scripts -->
    <!-- <script src="{{ asset('js/app.js') }}" defer></script> -->

    <!-- Datepicker plugin -->
    <link rel="stylesheet" href="{{asset('css/bootstrap-datetimepicker.min.css')}}">

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <script src="https://ajax.googleapis.com/ajax/libs/webfont/1.6.16/webfont.js"></script>
    <script>
      WebFont.load({
        google: {"families":["Poppins:300,400,500,600,700","Roboto:300,400,500,600,700"]},
        active: function() {
            sessionStorage.fonts = true;
        }
      });
    </script>

    <script type="text/javascript">
      var base_url = "{{ URL::to('/') }}";
    </script>

    <!--end::Web font -->
    <!--begin::Base Styles -->
    <!-- <link href="../../../assets/vendors/base/vendors.bundle.css" rel="stylesheet" type="text/css" /> -->
    <link href="https://fonts.googleapis.com/css?family=Barlow:400,500,600,700,800&display=swap" rel="stylesheet">
    <link href="{{asset('css/vendors/base/vendors.bundle.css')}}" rel="stylesheet" type="text/css" />
    
    <!-- <link href="../../../assets/demo/default/base/style.bundle.css" rel="stylesheet" type="text/css" /> -->
    <link href="{{asset('css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('css/default/base/style.bundle.css')}}" rel="stylesheet" type="text/css" />
    <!--end::Base Styles -->
    <!-- <link rel="shortcut icon" href="../../../assets/demo/default/media/img/logo/favicon.ico" /> -->
    <!-- Styles -->
    <!-- <link href="{{ asset('css/app.css') }}" rel="stylesheet"> -->


    <style type="text/css">
        body, .form-control {
            font-family: "Barlow", Times, serif !important;
        }

        .bootstrap-datetimepicker-widget {
            position: relative;
        }

        .m-login.m-login--5 .m-login__wrapper-2 {
            padding-top: 0%;
        }

        .m-login__title {
            font-size: 2rem !important;
        }

        .m-login.m-login--5 .m-login__wrapper-2 .m-login__contanier {
            width: 600px;
        }

        @media (max-width: 768px){
            .m-login.m-login--5 .m-login__wrapper-2 .m-login__contanier {
                width: 100%;
                margin: 0 auto;
            }
        }

        #submit-btn {
            background-color: #07121E;
            border-color: #07121E;
            font-family: "Barlow";
            font-weight: 600;
            padding: 0.7rem 2rem;
            border-radius: 0.7rem;
            font-size: 1.5rem;
        }

        #check-btn {
            background-color: #560100;
            border-color: #560100;
            font-family: "Barlow";
            font-weight: 600;
            padding: 0.7rem 2rem;
            border-radius: 0.7rem;
            font-size: 1.5rem;
        }

        .m-login.m-login--5 .m-login__wrapper-2 .m-login__contanier .m-login__form .m-form__group .form-control {
            border-bottom: 2px solid #453939;
            padding: 1.5rem 0rem;
            font-size: 1.2rem;
        }

        .form-control:focus {
            border-color: #07121E !important;
        }

        .m-login__form .form-control:focus::-webkit-input-placeholder {
            color: #07121E !important;
        }

        .m-login__form .form-control:focus:-moz-placeholder {
            color: #07121E !important;
        }

        /* Firefox > 19 */
        .m-login__form .form-control:focus::-moz-placeholder {
            color: #07121E !important;
        }

        /* Internet Explorer 10 */
        .m-login__form .form-control:focus:-ms-input-placeholder {
            color: #07121E !important;
        }

        ::placeholder {
            text-transform: uppercase;
        };

        .date {
            position: relative;
            width: 150px; height: 20px;
            color: white;
        }

        .date:before {
            position: absolute;
            top: 3px; left: 3px;
            content: attr(data-date);
            display: inline-block;
            color: black;
        }

        .date::-webkit-datetime-edit, input::-webkit-inner-spin-button, input::-webkit-clear-button {
            display: none;
        }

        .date::-webkit-calendar-picker-indicator {
            position: absolute;
            top: 3px;
            right: 0;
            color: black;
            opacity: 1;
        }
    </style>
</head>
<body>
    <!-- Modal -->
    <div class="modal fade" id="login-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Login</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
            <form class="m-login__form m-form" action="{{ route('login_user') }}" method="POST">
                <div class="modal-body">
                    @csrf

                    <input type="hidden" name="existed_id">

                    <div class="form-group">
                        <input class="form-control" type="email" placeholder="Email" name="email" required>
                    </div>

                    <div class="form-group">
                        <input class="form-control" type="password" placeholder="Tanggal Lahir (DD-MM-YYYY)" name="password" required>
                        <span class="m-form__help">
                            * CONTOH: 06-10-1994
                        </span>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
      </div>
    </div>


    <div>
        <div class="col-sm-10 pt-4">
            <?php 
                if (session('currUser')) {
                    $currUser = session('currUser');
            ?>
                    <a href="{{ route ('user')}}" class = "float-right btn btn-focus m-btn m-btn--pill m-btn--custom m-btn--air" style="font-weight: 400" href="#">Hi, {{ $currUser->nama }}!</a>
                    <a href="{{ route ('index')}}" class = "float-right btn btn-primary m-btn m-btn--pill m-btn--custom m-btn--air" style="font-weight: 400; margin-right: 10px;" href="#">HOME</a>
            <?php } else { ?>
                    <a class="float-right btn btn-focus m-btn m-btn--pill m-btn--custom m-btn--air" style="font-weight: 400" href="#" data-toggle="modal" data-target="#login-modal">LOGIN</a>
            <?php } ?>
        </div>
    </div>
</body>