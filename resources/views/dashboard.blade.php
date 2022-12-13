        @include('header')

    <style type="text/css">

            .hide {
                display: none !important;
            }

            .m-container {
                width: 70%;
            }

            .qr-codes {
                background-color: white;
                padding: 10px;
                width: 70%;
            }

            .left-side-bg {
                 background-position: center; 
                 background-size: 80%; 
                 background-color: #453939;
                 background-repeat: no-repeat;
            }

            #submit-btn:hover {
                background-color: #0C0D13;
                border-color: #0C0D13;
            }

            .datepicker {
                width: 100%;
            }

            select.form-control:not([size]):not([multiple]) {
                height: auto;
            }

            @media (max-width: 768px) {
                .left-side-bg {
                     background-position: center; 
                     background-size: 50%; 
                     background-color: #453939;
                     background-repeat: no-repeat;
                     height: 60vw;
                }

                .m-container {
                    width: 100%;
                }

                .qr-code {
                    width: 100%;
                }

                .qr-code-container {
                    text-align: center;
                }
            }

              input[type="date"]:before {
                content: attr(placeholder) !important;
                color: #aaa;
                margin-right: 0.5em;
              }
              input[type="date"]:focus:before,
              input[type="date"]:valid:before {
                content: "";
              }
        </style>
    <!-- end::Body -->
    <body class="m-page--wide m-header--fixed m-header--fixed-mobile m-aside-left--enabled m-aside-left--offcanvas m-footer--push m-aside--offcanvas-default"  >
        <!-- begin:: Page -->
        <div class="m-grid m-grid--hor m-grid--root m-page">
            <!-- begin::Body -->
            <div class="m-grid__item m-grid__item--fluid m-grid m-grid--hor-desktop m-grid--desktop m-body"> 
                <div class="m-grid__item m-grid__item--fluid  m-grid m-grid--ver    m-container m-container--responsive m-container--xxl m-page__container">
                    <div class="m-grid__item m-grid__item--fluid m-wrapper">
                        @if($message = Session::get('success'))
                            <div class="alert alert-success alert-dismissible" role="alert">
                              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">×</span>
                              </button>
                              <strong>Berhasil!</strong> {{ $message }}
                            </div>
                        @endif

                        @if($message = Session::get('fail'))
                            <div class="alert alert-danger alert-dismissible" role="alert">
                              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">×</span>
                              </button>
                              <strong>Maaf.</strong> {{ $message }}
                            </div>
                        @endif
                        <!-- BEGIN: Subheader -->
                        <div class="m-subheader ">
                            <div class="d-flex align-items-center">
                                <div class="mr-auto">
                                    <h3 class="m-subheader__title ">
                                        My Profile
                                    </h3>
                                </div>
                            </div>
                        </div>
                        <!-- END: Subheader -->
                        <div class="m-content">
                            <div class="row">
                                <div class="col-lg-4">
                                    <!-- <div class="m-portlet m-portlet--full-height  "> -->
                                    <div class="m-portlet">
                                        <div class="m-portlet__body">
                                            <div class="m-card-profile">
                                                <div class="m-card-profile__title m--hide">
                                                    Your Profile
                                                </div>
                                                <!-- <div class="m-card-profile__pic">
                                                    <div class="m-card-profile__pic-wrapper">
                                                        <img src="{{asset('img/qrcodes/A1-1614661378.png')}}" alt=""/>
                                                    </div>
                                                </div> -->
                                                <div class="m-card-profile__details">
                                                    <span class="m-card-profile__name">
                                                        {{ $currUser->nama }}
                                                    </span>
                                                    <a href="" class="m-card-profile__email m-link">
                                                        {{ $currUser->email }}
                                                    </a>
                                                </div>
                                            </div>
                                            <ul class="m-nav m-nav--hover-bg m-portlet-fit--sides">
                                                <li class="m-nav__separator m-nav__separator--fit"></li>
                                                <li class="m-nav__section m--hide">
                                                    <span class="m-nav__section-text">
                                                        Section
                                                    </span>
                                                </li>
                                                <li class="m-nav__item">
                                                    <a href="{{ route ('user')}}" class="m-nav__link">
                                                        <i class="m-nav__link-icon flaticon-profile-1"></i>
                                                        <span class="m-nav__link-title">
                                                            <span class="m-nav__link-wrap">
                                                                <span class="m-nav__link-text">
                                                                    Event Details
                                                                </span>
                                                            </span>
                                                        </span>
                                                    </a>
                                                </li>
                                                <li class="m-nav__item">
                                                    <a href="{{ route ('logout_user')}}" class="m-nav__link">
                                                        <i class="m-nav__link-icon flaticon-lifebuoy"></i>
                                                        <span class="m-nav__link-text">
                                                            Log Out
                                                        </span>
                                                    </a>
                                                </li>
                                                <!-- <li class="m-nav__item">
                                                    <a href="header/profile&amp;demo=default.html" class="m-nav__link">
                                                        <i class="m-nav__link-icon flaticon-share"></i>
                                                        <span class="m-nav__link-text">
                                                            Activity
                                                        </span>
                                                    </a>
                                                </li>
                                                <li class="m-nav__item">
                                                    <a href="header/profile&amp;demo=default.html" class="m-nav__link">
                                                        <i class="m-nav__link-icon flaticon-chat-1"></i>
                                                        <span class="m-nav__link-text">
                                                            Messages
                                                        </span>
                                                    </a>
                                                </li>
                                                <li class="m-nav__item">
                                                    <a href="header/profile&amp;demo=default.html" class="m-nav__link">
                                                        <i class="m-nav__link-icon flaticon-graphic-2"></i>
                                                        <span class="m-nav__link-text">
                                                            Sales
                                                        </span>
                                                    </a>
                                                </li>
                                                <li class="m-nav__item">
                                                    <a href="header/profile&amp;demo=default.html" class="m-nav__link">
                                                        <i class="m-nav__link-icon flaticon-time-3"></i>
                                                        <span class="m-nav__link-text">
                                                            Events
                                                        </span>
                                                    </a>
                                                </li>
                                                <li class="m-nav__item">
                                                    <a href="header/profile&amp;demo=default.html" class="m-nav__link">
                                                        <i class="m-nav__link-icon flaticon-lifebuoy"></i>
                                                        <span class="m-nav__link-text">
                                                            Support
                                                        </span>
                                                    </a>
                                                </li> -->
                                            </ul>
                                            <div class="m-portlet__body-separator"></div>
                                            <!-- <div class="m-widget1 m-widget1--paddingless">
                                                <div class="m-widget1__item">
                                                    <div class="row m-row--no-padding align-items-center">
                                                        <div class="col">
                                                            <h3 class="m-widget1__title">
                                                                Member Profit
                                                            </h3>
                                                            <span class="m-widget1__desc">
                                                                Awerage Weekly Profit
                                                            </span>
                                                        </div>
                                                        <div class="col m--align-right">
                                                            <span class="m-widget1__number m--font-brand">
                                                                +$17,800
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="m-widget1__item">
                                                    <div class="row m-row--no-padding align-items-center">
                                                        <div class="col">
                                                            <h3 class="m-widget1__title">
                                                                Orders
                                                            </h3>
                                                            <span class="m-widget1__desc">
                                                                Weekly Customer Orders
                                                            </span>
                                                        </div>
                                                        <div class="col m--align-right">
                                                            <span class="m-widget1__number m--font-danger">
                                                                +1,800
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="m-widget1__item">
                                                    <div class="row m-row--no-padding align-items-center">
                                                        <div class="col">
                                                            <h3 class="m-widget1__title">
                                                                Issue Reports
                                                            </h3>
                                                            <span class="m-widget1__desc">
                                                                System bugs and issues
                                                            </span>
                                                        </div>
                                                        <div class="col m--align-right">
                                                            <span class="m-widget1__number m--font-success">
                                                                -27,49%
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div> -->
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-8">
                                    <div class="m-portlet m-portlet--full-height m-portlet--tabs  ">
                                        <div class="m-portlet__head">
                                            <div class="m-portlet__head-tools">
                                                <ul class="nav nav-tabs m-tabs m-tabs-line   m-tabs-line--left m-tabs-line--primary" role="tablist">
                                                    <?php 
                                                        $i = 1;
                                                        foreach ($user as $key) {
                                                            if ($i == 1) {
                                                                $a = 'nav-link m-tabs__link active';
                                                            } else {
                                                                $a = 'nav-link m-tabs__link';
                                                            }
                                                    ?>
                                                        <li class="nav-item m-tabs__item">
                                                            <a class="{{ $a }}" data-toggle="tab" href="#m_user_profile_tab_{{ $i }}" role="tab">
                                                                <i class="flaticon-share m--hide"></i>
                                                                {{ $key->nama }}
                                                            </a>
                                                        </li>
                                                    <?php
                                                        $i++;
                                                    }?>
                                                </ul>
                                            </div>
                                        </div>
                                        <form method="POST" action="{{route('submit_edit')}}">
                                            <div class="tab-content">
                                                <?php
                                                    $i = 1;
                                                    foreach ($user as $key) {
                                                        if ($i == 1) {
                                                            $active = 'active show';
                                                        } else {
                                                            $active = '';
                                                        }
                                                ?>
                                                        <div class="tab-pane {{$active}} fade" id="m_user_profile_tab_{{$i}}">
                                                            <div class="m-form m-form--fit m-form--label-align-right">
                                                                <div class="m-portlet__body">
                                                                    @csrf
                                                                    <input type="hidden" value="{{$key->id}}" name="user_id[]">
                                                                    <div class="form-group m-form__group m--margin-top-10 m--hide">
                                                                        <div class="alert m-alert m-alert--default" role="alert">
                                                                            The example form below demonstrates common HTML form elements that receive updated styles from Bootstrap with additional classes.
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group m-form__group row">
                                                                        <div class="col-lg-10 ml-auto">
                                                                            <h3 class="m-form__section">
                                                                                1. Data Pribadi
                                                                            </h3>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group m-form__group row">
                                                                        <label for="example-text-input" class="col-lg-2 col-form-label">
                                                                            No. KAJ
                                                                        </label>
                                                                        <div class="col-lg-7">
                                                                            <input class="form-control m-input" type="text" value="{{$key->kaj}}" disabled>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group m-form__group row">
                                                                        <label for="example-text-input" class="col-lg-2 col-form-label">
                                                                            Nama Lengkap
                                                                        </label>
                                                                        <div class="col-lg-7">
                                                                            <input class="form-control m-input" type="text" value="{{$key->nama}}" disabled>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group m-form__group row">
                                                                        <label for="example-text-input" class="col-lg-2 col-form-label">
                                                                            No.HP/WA
                                                                        </label>
                                                                        <div class="col-lg-7">
                                                                            <input class="form-control m-input" type="text" value="{{$key->phone}}" disabled>
                                                                        </div>
                                                                    </div>
                                                                    <div class="m-form__seperator m-form__seperator--dashed m-form__seperator--space-2x"></div>
                                                                    <div class="form-group m-form__group row">
                                                                        <div class="col-lg-10 ml-auto">
                                                                            <h3 class="m-form__section">
                                                                                2. QR Code
                                                                            </h3>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group m-form__group row">
                                                                        <label for="example-text-input" class="col-lg-2 col-form-label">
                                                                        </label>
                                                                        <div class="col-lg-10 qr-code-container">
                                                                            <img class="qr-code" src="{{asset('img/qrcodes/'.$key->qr_code.'.jpg')}}" alt=""/>
                                                                            <div>{{$key->qr_code}}</div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group m-form__group row">
                                                                        <label for="example-text-input" class="col-lg-2 col-form-label">
                                                                            Ibadah
                                                                        </label>
                                                                        <div class="col-lg-7">
                                                                            <select class="form-control" name="ibadah[]">
                                                                                <option value="" disabled>PILIH IBADAH NATAL</option>
                                                                                <?php
                                                                                    foreach ($ibadah as $data) {
                                                                                        if ($data->id == $key->ibadah) {
                                                                                            $selected = 'selected';
                                                                                        } else {
                                                                                            $selected = '';
                                                                                        }
                                                                                ?>
                                                                                        <option value="<?php echo $data->id?>" {{$selected}}><?php echo $data->nama?> ({{$data->ct}}/<?php echo $data->qty ?>)</option>
                                                                                <?php
                                                                                    }
                                                                                ?>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                    
                                                            </div>
                                                        </div>
                                                <?php
                                                        $i++;
                                                    }
                                                ?>
                                            </div>
                                            <div class="m-portlet__foot m-portlet__foot--fit">
                                                <div class="m-form__actions">
                                                    <div class="row" style="padding: 25px 0px;">
                                                        <div class="col-3" ></div>
                                                        <div class="col-7">
                                                            <button type="submit" class="btn btn-accent m-btn m-btn--air m-btn--custom">
                                                                Save changes
                                                            </button>
                                                            &nbsp;&nbsp;
                                                            <button type="reset" class="btn btn-secondary m-btn m-btn--air m-btn--custom">
                                                                Cancel
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end::Body -->
        </div>
        <!-- end:: Page -->
        @include('footer')
    </body>
    <!-- end::Body -->
</html>
            
        