        @include('header')
            
    <body class="m--skin- m-header--fixed m-header--fixed-mobile m-aside-left--enabled m-aside-left--skin-dark m-aside-left--offcanvas m-footer--push m-aside--offcanvas-default"  >
        <!-- begin:: Page -->
        <style type="text/css">
            .m-login.m-login--5 .m-login__wrapper-2 {
                padding-top: 3%;
            }

            .m-login.m-login--5 .m-login__wrapper-2 .m-login__contanier .m-login__head .m-login__title {
                color: #453939;
            }

            .resubmit-btn {
                background-color: #F36E23; 
                border-color: #F36E23;
                font-family: "Barlow" !important;
            }

            .resubmit-btn:hover {
                background-color: #453939;
                border-color: #453939;
            }

        </style>

        <style type="text/css">
            .left-side-bg {
                 background-position: center; 
                 background-size: 80%; 
                 background-color: #453939;
                 background-repeat: no-repeat;
            }

            .font-header2{
                font-size: 2rem;
            }

            .font-text{
                font-size: 1.5rem;
            }

            .font-header{
                font-size: 2.2rem;
            }

            @media (max-width: 768px) {
                .left-side-bg {
                     background-position: center; 
                     background-size: 50%; 
                     background-color: #453939;
                     background-repeat: no-repeat;
                     height: 60vw;
                }
            }
        </style>

        <div class="m-grid m-grid--hor m-grid--root m-page">
            <div class="m-login m-login--singin  m-login--5" id="m_login" >
                <!-- <div class="m-login__wrapper-1 m-portlet-full-height left-side-bg" style="background-image: url({{asset('app/media/img//bg/base-img.png')}});">
                </div> -->
                <div class="m-login__wrapper-2 m-portlet-full-height">
                    <div class="m-login__contanier">
                        <div class="m-login__signin">
                            <div class="m-login__head">
                                <div class="m-login__title">
                                    <span style="font-weight: 600; color: #F36E23" class="font-header">TERIMA KASIH.</span>
                                    <br>
                                    <div class="font-text">
                                    <?php if (isset($code)) {?>
                                        Screenshot QR Code Registrasi ke dalam perangkat anda. QR code akan digunakan pada saat <span style="font-weight: 700">daftar ulang</span> di hari H.
                                        <br><br>
                                        <div style="background-color: white; padding: 10px">
                                            <img src="<?php echo asset('img/qrcodes/'.$code.'.jpg'); ?>" width="35%"></img>
                                            <div>{{$name}}</div>
                                            <div>{{$code}}</div>
                                            <br>
                                            <?php
                                                    $tempArr = explode(" ", $data->nama);
                                            ?>
                                            <div style="font-weight: 700">Tempat Ibadah: GBI Sukawarna cabang {{$tempArr[0]}}</div>
                                            <div style="font-weight: 700">Jam Ibadah: {{$tempArr[1]}} </div>
                                        </div>
                                    <?php } ?>
                                        <!-- <br>
                                        Untuk informasi lebih lanjut, anda dapat menghubungi kontak di bawah ini:
                                        <br>
                                        <a href="https://wa.me/6282121678880" target="_blank" style="font-weight: 700; color: #F36E23"><i class="fa fa-whatsapp" style="font-size: 1.7rem"></i> +6282121678880</a>
                                        <br>
                                        <a href="https://wa.me/6289670190055" target="_blank" style="font-weight: 700; color: #F36E23"><i class="fa fa-whatsapp" style="font-size: 1.7rem"></i> +6289670190055</a>
                                        <br> -->
                                    </div>
                                    <br>
                                    <span style="font-weight: 500; font-size: 2rem" class="font-header2">Tuhan Yesus memberkati!</span>

                                    <br><br>
                                    <div style="padding-bottom: 5%">
                                        <a href="{{ route('index') }}">
                                            <button type="button" class="resubmit-btn btn btn-primary btn-lg m-btn m-btn--custom" style="">
                                                DAFTAR LAGI
                                            </button>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end:: Page -->
        @include('footer')
    </body>
</html>
            
