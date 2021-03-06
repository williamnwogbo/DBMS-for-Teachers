
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Database Management System">
    <meta name="author" content="William Nwogbo">
    <meta name="keyword" content="Database, management, system">
    <link rel="shortcut icon" href="img/favicon.png">

    <title>Dashboard</title>

    <!-- Bootstrap CSS -->
    <link href="{{ url('css/bootstrap.min.css') }}" rel="stylesheet">
    <!-- bootstrap theme -->
    <link href="{{ url('css/bootstrap-theme.css') }}" rel="stylesheet">
    <!--external css-->
    <!-- font icon -->
    <link href="{{ url('css/elegant-icons-style.css') }}" rel="stylesheet" />
    <link href="{{ url('assets/font-awesome/css/font-awesome.css') }}" rel="stylesheet" />
    <!-- full calendar css-->
    <link href="{{ url('assets/fullcalendar/fullcalendar/bootstrap-fullcalendar.css') }}" rel="stylesheet" />
    <!-- owl carousel -->
    <link rel="stylesheet" href="{{ url('css/owl.carousel.css') }}" type="text/css">

    <!-- Custom styles -->
    <link href="{{ url('css/style.css') }}" rel="stylesheet">
    <link href="{{ url('css/style-responsive.css') }}" rel="stylesheet" />
    @yield('style')
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 -->
    <!--[if lt IE 9]>
    <script src="{{ url('js/html5shiv.js') }}"></script>
    <script src="{{ url('js/respond.min.js') }}"></script>
    <script src="{{ url('js/lte-ie7.js') }}"></script>
    <![endif]-->
</head>

<body>
<section id="container" class="">
    <!--header start-->
    <header class="header white-bg">
        <div class="toggle-nav">
            <div class="icon-reorder tooltips" data-original-title="Toggle Navigation" data-placement="bottom"></div>
        </div>

        <!--logo start-->
        <a href="{{ url('/dashboard') }}" class="logo">
            <img src="{{ url('/img/ogun.jpg') }}" class="text-center" style="height: 50px; margin-top: -10px;"/>
            {{ settings()->name}}</a>
        <!--logo end-->


        <div class="top-nav notification-row">
            <!-- notificatoin dropdown start-->
            <ul class="nav pull-right top-menu">
                <li class="dropdown">
                    <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                            <span class="profile-ava">
                                <img alt="" src="{{ url('img/avatar1_small.jpg') }}">
                            </span>
                        <span class="username">{{ Auth::user()->full_name }}</span>
                        <b class="caret"></b>
                    </a>
                    <ul class="dropdown-menu extended logout">
                        <div class="log-arrow-up"></div>

                        <li>
                        <li>
                           <form action="{{ url('/logout') }}" method="POST">
                                  {!! csrf_field() !!}
                                     <button type="submit" class="btn btn-default btn-block no-border">
                                         <i class="icon_key_alt"></i>
                                          Logout
                                        </button>
                                      </form>
                                                            </li>
                        </li>

                    </ul>
                </li>
                <!-- user login dropdown end -->
            </ul>
            <!-- notificatoin dropdown end-->
        </div>
    </header>
    <!--header end-->

    <!--sidebar start-->
    <aside>
        <div id="sidebar"  class="nav-collapse ">
            <!-- sidebar menu start-->
            <ul class="sidebar-menu">
                <li  {{ (Request::is('dashboard') ? 'class=active' : '') }}>
                    <a class="" href="{{ url('/dashboard') }}">
                        <i class="icon_house_alt"></i>
                        <span>Registration</span>
                    </a>
                </li>
                <li {{ (Request::is('search') ? 'class=active' : '') }}>
                    <a href="javascript:;" data-toggle="modal" data-target="#search" class="">
                        <i class="icon_search"></i>
                        <span>Search</span>
                    </a>
                </li>
                <li {{ (Request::is('teachers') ? 'class=active' : '') }}>
                    <a href="{{ url('/teachers') }}" class="">
                        <i class="icon_profile"></i>
                        <span>Teachers</span>
                    </a>
                </li>
                <li  {{ (Request::is('subject') ? 'class=active' : '') }}>
                    <a class="" href="{{ url('/subject') }}">
                        <i class="icon_genius"></i>
                        <span>Subjects</span>
                    </a>
                </li>
                @if(auth()->user()->level == "1")
                <li {{ (Request::is('account') ? 'class=active' : '') }}>
                    <a href="{{ url('/account') }}" class="">
                        <i class="icon_piechart"></i>
                        <span>Accounts</span>
                    </a>
                </li>
                @endif
                <li  {{ (Request::is('backup') ? 'class=active' : '') }}>
                    <a href="#" data-toggle="modal" data-target="#pending" class="">
                        <i class="icon_document_alt"></i>
                        <span>Backup/Restore</span>
                    </a>
                </li>
            </ul>
            <!-- sidebar menu end-->
        </div>
    </aside>
    <!--sidebar end-->

@yield('content')
</section>
<div id="search" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Search Data</h4>
            </div>
            <div class="modal-body">
                @include('errors.showerrors')
                <div class="alert alert-info">
                    Search by Name,File No, Local Government,Sex,Grade Level,School,Religion and Subject Taught/Specialization
                </div>
                <form action="{{ url('/search') }}" method="post">
                    <label>Search</label>
                    <input type="text" name="search" class="form-control" required/><br/>
                    <input type="submit" value="Search" class="btn pull-right btn-primary"/>
                    <br/>
                    <br/>
                </form>
            </div>

        </div>

    </div>
</div>
<div id="pending" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Search Data</h4>
            </div>
            <div class="modal-body">
                @include('errors.showerrors')
                <div class="alert alert-info">
                  Depends on server status
                   </div>

            </div>

        </div>

    </div>
</div>
<!-- container section start -->
<!-- javascripts -->
<script src="{{ url('js/jquery.js') }}"></script>
<script src="{{ url('js/jquery-1.8.3.min.js') }}"></script>
<script type="text/javascript" src="{{ url('js/jquery-ui-1.9.2.custom.min.js') }}"></script>
<!-- bootstrap -->
<script src="{{ url('js/bootstrap.min.js') }}"></script>
<!-- nice scroll -->

<script src="{{ url('js/jquery.scrollTo.min.js') }}"></script>
<script src="{{ url('js/jquery.nicescroll.js') }}" type="text/javascript"></script>
<!-- charts scripts -->
<script src="{{ url('js/jquery.sparkline.js') }}" type="text/javascript"></script>
<script src="{{ url('js/owl.carousel.js') }}" ></script>
<!-- jQuery full calendar -->
<script src="{{ url('assets/fullcalendar/fullcalendar/fullcalendar.min.js') }}"></script>
@yield('script')
<!--script for this page only-->
{{--<script src="{{ url('js/calendar-custom.js') }}"></script>--}}
<!-- custom select -->
<script src="{{ url('js/jquery.customSelect.min.js') }}" ></script>

<!--custome script for all page-->
<script src="{{ url('js/scripts.js') }}"></script>
<!-- custom script for this page-->
<script src="{{ url('js/sparkline-chart.js') }}"></script>

<script>

    function confirmDelete(path){
        if(confirm("Are you sure you want to delete this ?")){
            window.location = path;
        }
    }

    function activateDatetime(class_name){
        $("."+class_name).datepicker();
    }


    //carousel
    $(document).ready(function() {
        $("#owl-slider").owlCarousel({
            navigation : true,
            slideSpeed : 300,
            paginationSpeed : 400,
            singleItem : true

        });
    });

    //custom select box

    $(function(){
        $('select.styled').customSelect();
    });

</script>

</body>
</html>