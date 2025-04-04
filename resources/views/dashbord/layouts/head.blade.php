<!--begin::Head-->
<title>@yield('title')</title>
<link rel="canonical" href="https://preview.keenthemes.com/keen"/>
{{--<link rel="shortcut icon" href="{{asset('assets/media/logos/favicon.ico')}}"/>--}}
<link rel="shortcut icon" href="{{asset('assets/media/logos/favicon.ico')}}"/>
<!--begin::Fonts(mandatory for all pages)-->
{{--<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700"/>--}}

<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;300;400;500;600;700;800;900&amp;family=Roboto:wght@300;400;500;700;900&amp;display=swap" rel="stylesheet">

<link href="{{asset('assets/plugins/custom/fullcalendar/fullcalendar.bundle.css')}}" rel="stylesheet" type="text/css"/>
<link href="{{asset('assets/plugins/custom/datatables/datatables.bundle.css')}}" rel="stylesheet" type="text/css"/>
<link href="{{asset('assets/plugins/global/plugins.bundle.css')}}" rel="stylesheet" type="text/css"/>
<link href="{{asset('assets/css/custome/fonts.css')}}" rel="stylesheet" type="text/css"/>
<link href="{{asset('assets/plugins/custom/jstree/jstree.bundle.css')}}" rel="stylesheet" type="text/css"/>
@if(app()->getLocale() =='ar')
{{--    <link href="{{asset('assets/plugins/custom/prismjs/prismjs.bundle.rtl.css')}}" rel="stylesheet" type="text/css" />--}}
{{--<link href="{{asset('assets/css/style.bundle.css')}}" rel="stylesheet" type="text/css"/>--}}

{{--    <link href="{{asset('assets/plugins/global/plugins.bundle.rtl.css')}}" rel="stylesheet" type="text/css"/>--}}
    <link href="{{asset('assets/css/style.bundle.rtl.css')}}" rel="stylesheet" type="text/css"/>
@else
{{--    <link href="{{asset('assets/plugins/global/plugins.bundle.css')}}" rel="stylesheet" type="text/css"/>--}}
    <link href="{{asset('assets/css/style.bundle.css')}}" rel="stylesheet" type="text/css"/>


@endif
<link href="https://fonts.googleapis.com/css2?family=Cairo:wght@600&family=Tajawal:wght@500;700&display=swap" rel="stylesheet">
<style>
    h1 , h2 , h3 , h4 , h5 , h6 , p , div , ul , li a , input , button, label, span,option,th,tr,i {
        font-family: 'Cairo', sans-serif !important;
        line-height: 1.7;
    }
</style>
<style>
    .t_container{
        padding: 30px;
        padding-top: 0px !important;
    }
    .container-xxl{
        max-width: 100% !important;

    }
</style>
<style>
    /* Custom hover submenu styles */
    .hover-submenu {
        position: relative;
    }

    .hover-menu-submenu {
        position: absolute;
        left: 100%;
        top: 0;
        width: 200px;
        background-color: #ffffff;
        box-shadow: 0px 0px 50px 0px rgba(82, 63, 105, 0.15);
        border-radius: 0.475rem;
        padding: 1rem 0;
        display: none;
        z-index: 98;
    }

    .hover-submenu:hover .hover-menu-submenu {
        display: block;
    }

    /* Ensure the submenu stays visible when hovered */
    .hover-menu-submenu:hover {
        display: block;
    }

    /* Add a small delay for better user experience */
    .hover-submenu .hover-menu-submenu {
        transition-delay: 0.1s;
    }
</style>
@yield('css')
