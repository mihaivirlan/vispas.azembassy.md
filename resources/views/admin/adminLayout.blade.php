<!DOCTYPE html>

<html>

<head>

    <meta charset="utf-8">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>@yield('title')</title>
    <!-- Tell the browser to be responsive to screen width -->

    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

    <!-- Bootstrap 3.3.5 -->

    {!! HTML::style("adminLTE/bootstrap/css/bootstrap.min.css") !!}

    <!-- Font Awesome -->

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">

    <!-- Ionicons -->

    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">

    {!! HTML::style('css/dataTables.bootstrap.css') !!}
    {!! HTML::style('css/select2.min.css') !!}

    {!! HTML::style("adminLTE/dist/css/AdminLTE.min.css") !!}
    {!! HTML::style("packages/barryvdh/elfinder/css/theme.css") !!}
    {!! HTML::style("packages/barryvdh/elfinder/css/colorbox.css") !!}
    {!! HTML::style("packages/barryvdh/elfinder/css/elfinder.full.css") !!}


    <!-- AdminLTE Skins. Choose a skin from the css/skins

         folder instead of downloading all of them to reduce the load. -->

    {!! HTML::style("adminLTE/dist/css/skins/_all-skins.min.css") !!}



    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->

    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->

    <!--[if lt IE 9]>

    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>

    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>

    <![endif]-->

    <script>



    </script>

    @yield("style")
    <style>
        button.slug_default {
            display: none;
        }
        input.slug_default{
            cursor: not-allowed;
            background-color: #eee;
            opacity: 1;
            pointer-events: none;
        }
            *{
                word-break: normal;
            }
            .btn-app{
                float: right;
            }
            #loading_img {
                width: 100%;
                height: 100%;
                position: fixed;
                z-index: 99999;
                top: 0;
                left: 0;
                background: #fff;
                opacity: .5;
                display: none;
            }
            span.active{
                width: 10px;
                height: 10px;
                border-radius: 10px;
                background-color: #248135;
                display: block;
                margin-top: 6px;
            }

            span.no-active{
                width: 10px;
                height: 10px;
                border-radius: 10px;
                background-color: #FA0000;
                display: block;
                margin-top: 6px;
            }
            .image_admin img{
                max-width:100px ;
                max-height: 100px;
            }
            .product_admin_img img{
                width: 200px;
            }

            #img_l{
                width: 100%;
                height: 100%;
                position: fixed;
                z-index: 99999;
                top: 0;
                left: 0;
                background: #fff;
                opacity: .5;
                display: none;
            }
            .image_admin img{
                max-width:170px ;
                max-height: 170px;
                margin-bottom: 20px;
            }
            .ch_label label{
                margin: 0;
                padding: 0;
                cursor: pointer;
            }
            .ch_label input{
                cursor: pointer;
                margin: 0;
                padding: 0;
            }
        .text_right_admin{
            padding-top: 5px;
        }
        </style>


</head>

<body class="hold-transition skin-blue sidebar-mini">

<!-- Site wrapper -->

<div class="wrapper">



    <header class="main-header">

        <!-- Logo -->

        <a href="{!! URL::route('admin') !!}" class="logo">

            <!-- mini logo for sidebar mini 50x50 pixels -->

            <span class="logo-mini"><b>V</b></span>

            <!-- logo for regular state and mobile devices -->

            <span class="logo-lg"><b>Vispas</b></span>

        </a>

        <!-- Header Navbar: style can be found in header.less -->

        <nav class="navbar navbar-static-top" role="navigation">

            <!-- Sidebar toggle button-->

            <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">

                <span class="sr-only">Toggle navigation</span>

                <span class="icon-bar"></span>

                <span class="icon-bar"></span>

                <span class="icon-bar"></span>

            </a>

            <div class="navbar-custom-menu">

                <ul class="nav navbar-nav">

                    <!-- Messages: style can be found in dropdown.less-->

                        <li @if( Lang::getLocale() == 'ro') class="active" @endif>

                          {{--  <a href="{{ URL::to( $lang_data['ro']) }}">{!! HTML::image('img/ro.png') !!}</a>   --}}
                            <a href="/ro/admin">{!! HTML::image('img/ro.png') !!}</a>

                        </li>

                        <li @if( Lang::getLocale() == 'ru') class="active" @endif>

                           {{-- <a href="{{ URL::to( $lang_data['ru']) }}">{!! HTML::image('img/ru.png') !!}</a>    --}}
                            <a href="/ru/admin">{!! HTML::image('img/ru.png') !!}</a>

                        </li>
                    <li @if( Lang::getLocale() == 'en') class="active" @endif>

                          {{-- <a href="{{ URL::to( $lang_data['en']) }}">{!! HTML::image('img/en.png') !!}</a> --}}
                            <a href="/en/admin">{!! HTML::image('img/en.png') !!}</a>

                    </li>








                    <li class="dropdown messages-menu">

                        <a href="{!! URL::to('admin/logout') !!}">

                            <i class="fa fa-sign-out"></i>

                        </a>

                    </li>

                </ul>

            </div>

        </nav>

    </header>



    <!-- =============================================== -->



    <!-- Left side column. contains the sidebar -->

    <aside class="main-sidebar">

        <!-- sidebar: style can be found in sidebar.less -->

        <section class="sidebar">

            <ul class="sidebar-menu">
                <li class="header">MAIN NAVIGATION</li>



                <li @if(Request::url()==URL::route('admin/news'))  class="active"  @endif>
                    <a href="{!! URL::route('admin/news') !!}">

                        <i class="glyphicon glyphicon-th"></i><span>@lang('trans.news')</span>

                    </a>
                </li>

                <li @if(Request::url()==URL::route('admin/contacts'))  class="active"  @endif>
                    <a href="{!! URL::route('admin/contacts') !!}">

                        <i class="fa  fa-map-o"></i><span>@lang('trans.contacts')</span>

                    </a>
                </li>

                <li @if(Request::url()==URL::route('admin/pages'))  class="active"  @endif>
                    <a href="{!! URL::route('admin/pages') !!}">

                        <i class="fa   fa-file-powerpoint-o"></i><span>@lang('trans.pages')</span>

                    </a>
                </li>




                <li @if(Request()->is('*admin/slider*'))  class="active" @endif>
                    <a href="{!! URL::route('admin/sliders') !!}">
                        <i class="glyphicon glyphicon-blackboard"></i><span>@lang('trans.slider')</span>
                    </a>
                </li>

                <li @if(Request()->is('*admin/hotel_room*'))  class="active" @endif>
                    <a href="{!! URL::route('admin/hotel_rooms') !!}">
                        <i class="glyphicon glyphicon-blackboard"></i><span>@lang('trans.hotel_rooms')</span>
                    </a>
                </li>
                <li @if(Request()->is('*admin/conference_hall*'))  class="active" @endif>
                    <a href="{!! URL::route('admin/conference_halls') !!}">
                        <i class="glyphicon glyphicon-blackboard"></i><span>@lang('trans.conference_halls')</span>
                    </a>
                </li>
                <li @if(Request()->is('*admin/categor*'))  class="active" @endif>
                    <a href="{!! URL::route('admin/categories') !!}">
                        <i class="glyphicon glyphicon-blackboard"></i><span>@lang('trans.categories')</span>
                    </a>
                </li>

                <li @if(Request::url()==URL::route('admin/translation'))  class="active" @endif>
                    <a href="{!! URL::route('admin/translation') !!}">
                        <i class="fa  fa-terminal on fa-square"></i><span>@lang('trans.translation')</span>
                    </a>
                </li>
                <li @if(Request::url()==URL::route('admin/partners'))  class="active" @endif>
                    <a href="{!! URL::route('admin/partners') !!}">
                        <i class="fa  fa-terminal on fa-square"></i><span>@lang('trans.partners')</span>
                    </a>
                </li>

                <li @if(Request::url()==URL::route('admin/gallery'))  class="active" @endif>
                    <a href="{!! URL::route('admin/gallery') !!}">
                        <i class="fa  fa-terminal on fa-square"></i><span>@lang('trans.gallery')</span>
                    </a>
                </li>

                <li @if(Request::url()==URL::route('admin/gallery'))  class="active" @endif>
                    <a href="{!! URL::route('admin/gallery') !!}">
                        <i class="fa  fa-terminal on fa-square"></i><span>@lang('trans.gallery')</span>
                    </a>
                </li>

                <li @if(Request::url()==URL::route('admin/achivements'))  class="active" @endif>
                    <a href="{!! URL::route('admin/achivements') !!}">
                        <i class="fa  fa-terminal on fa-square"></i><span>@lang('trans.achivements')</span>
                    </a>
                </li>
                <li @if(Request::url()==URL::route('admin/room_books'))  class="active" @endif>
                    <a href="{!! URL::route('admin/room_books') !!}">
                        <i class="fa  fa-terminal on fa-square"></i><span>@lang('trans.room_books')</span>
                    </a>
                </li>



            </ul>

        </section>

        <!-- /.sidebar -->

    </aside>



    <!-- =============================================== -->



    <!-- Content Wrapper. Contains page content -->

    <div class="content-wrapper">

        <section class="content">



            @if(isset($errors) && count($errors->all()) > 0)
                <div class="alert alert-danger fade in alert-error" id="alert-message">
                    <a class="close" href="#" data-dismiss="alert">x</a>
                    <ul style="list-style-type: none">
                        @foreach($errors->all('<li>:message</li>') as $message)
                            {!! $message !!}
                        @endforeach
                    </ul>
                </div>
            @endif

            @if(session('success'))
                <div class="alert alert-success fade in " id="alert-message">
                    <a class="close" href="#" data-dismiss="alert">x</a>
                    {!! session('success') !!}
                </div>
             @endif


            <!-- Default box -->

            <div class="box">

                <div class="box-body">
                    <div id="img_l">

                    </div>
                    @yield("content")

                </div><!-- /.box-body -->



            </div><!-- /.box -->



        </section><!-- /.content -->

    </div><!-- /.content-wrapper -->



    <footer class="main-footer">

       @if( Lang::getLocale() == 'en')



        <strong> Copyright © {{ date('Y') }}  All Rights reserved. </strong>



       @elseif( Lang::getLocale() == 'ro')

            <strong> © {{ date('Y') }}  Toate drepturile rezervate </strong>



        @else



            <strong>Разработано © {{ date('Y') }} Все права защищены.</strong>



        @endif

    </footer>



    <!-- Add the sidebar's background. This div must be placed

         immediately after the control sidebar -->

    <div class="control-sidebar-bg"></div>

</div><!-- ./wrapper -->
<div id="loading_img"></div>


<!-- jQuery 2.1.4 -->



{!! HTML::script("adminLTE/plugins/jQuery/jQuery-2.1.4.min.js") !!}

        <!-- Bootstrap 3.3.5 -->



{!! HTML::script("adminLTE/bootstrap/js/bootstrap.min.js") !!}
{!! HTML::script('js/jquery.dataTables.min.js') !!}
{!! HTML::script('js/dataTables.bootstrap.min.js') !!}


<!-- SlimScroll -->



{!! HTML::script("adminLTE/plugins/slimScroll/jquery.slimscroll.min.js") !!}

<!-- FastClick -->

{!! HTML::script("adminLTE/plugins/fastclick/fastclick.min.js") !!}

<!-- AdminLTE App -->

{!! HTML::script("adminLTE/dist/js/app.min.js") !!}

<!-- AdminLTE for demo purposes -->

{!! HTML::script("adminLTE/dist/js/demo.js") !!}
{!! HTML::script("ckeditor/ckeditor.js") !!}

{!! HTML::script("packages/barryvdh/elfinder/js/jquery.colorbox-min.js") !!}
{!! HTML::script("packages/barryvdh/elfinder/js/standalonepopup.min.js") !!}



<script>
    function CKEDITOR_ADD(){
        var editor = CKEDITOR.instances['description_ro'];
        if(!editor) {
            @foreach( $lang_data as $lang =>$value )
                CKEDITOR.replace('description_{{$lang}}', {height: 200});
            @endforeach
        }

    }
    function Save() {
        var children=$('form').find(':invalid').first().parents('.tab-children');

        if($(children).attr('data-id')!==undefined) {
            @foreach( $lang_data as $lang =>$value )
                $('.tab_' + '{{$lang}}').removeClass('active');
            @endforeach
            $('.' + $(children).attr('data-id')).addClass('active');
        }

        //make all tabs inactive

        @foreach( $lang_data as $lang =>$value )
            var eachtab = "a[href='.tab_{{$lang}}']";
            $(eachtab).parent().closest('li').removeClass('active');
        @endforeach

        var tabmod = '.' + $(children).attr('data-id');

        $("a[href='" + tabmod + "']").parent().closest('li').addClass('active');

    }

</script>
@yield("script")

<script>
    var current_slug=[];
    function SlugChange(th,lang){
        current_slug[lang]=$('input[name=slug_'+lang+']').val();
        $('input[name=slug_'+lang+']').removeClass('slug_default');
        $('.btn_slug_'+lang).removeClass('slug_default');
        $(th).addClass('slug_default');
    }

    function Slug_Close(th,lang){
        $('input[name=slug_'+lang+']').val(current_slug[lang]);
        $('input[name=slug_'+lang+']').addClass('slug_default');
        $('.btn_slug_'+lang).addClass('slug_default');
        $('.btn_slug_change_'+lang).removeClass('slug_default');
    }

    function Slug_Save(th,lang){
        $('input[name=slug_'+lang+']').addClass('slug_default');
        $('.btn_slug_'+lang).addClass('slug_default');
        $('.btn_slug_change_'+lang).removeClass('slug_default');

    }


    $('.input_slug').change(function(){
        var lang=$(this).attr("data-lang");
        var text=$(this).val();
        if($('input[name=slug_'+lang+']').val().length==0) {

            $('input[name=slug_' + lang + ']').val(url_slug(text));
        }
    });


    $('.slug_input').change(function(){
        var lang=$(this).attr("data-lang");
        var text=$(this).val();
        var obj={ru:true};
        $(this).val(url_slug(text,obj));
    });

    function url_slug(s, opt) {
        s = String(s);
        opt = Object(opt);
        var defaults = {
            'delimiter': '-',
            'limit': 255,
            'lowercase': true,
            'replacements': {},
            'transliterate': (typeof(XRegExp) === 'undefined') ? true : false
        };

        // Merge options
        for (var k in defaults) {
            if (!opt.hasOwnProperty(k)) {
                opt[k] = defaults[k];
            }
        }
        if(opt['ru']==true){
            var char_map = {
                // Latin
                'À': 'A', 'Á': 'A', 'Â': 'A', 'Ã': 'A', 'Ä': 'A', 'Å': 'A', 'Æ': 'AE', 'Ç': 'C',
                'È': 'E', 'É': 'E', 'Ê': 'E', 'Ë': 'E', 'Ì': 'I', 'Í': 'I', 'Î': 'I', 'Ï': 'I',
                'Ð': 'D', 'Ñ': 'N', 'Ò': 'O', 'Ó': 'O', 'Ô': 'O', 'Õ': 'O', 'Ö': 'O', 'Ő': 'O',
                'Ø': 'O', 'Ù': 'U', 'Ú': 'U', 'Û': 'U', 'Ü': 'U', 'Ű': 'U', 'Ý': 'Y', 'Þ': 'TH',
                'ß': 'ss',
                'à': 'a', 'á': 'a', 'â': 'a', 'ã': 'a', 'ä': 'a', 'å': 'a', 'æ': 'ae', 'ç': 'c',
                'è': 'e', 'é': 'e', 'ê': 'e', 'ë': 'e', 'ì': 'i', 'í': 'i', 'î': 'i', 'ï': 'i',
                'ð': 'd', 'ñ': 'n', 'ò': 'o', 'ó': 'o', 'ô': 'o', 'õ': 'o', 'ö': 'o', 'ő': 'o',
                'ø': 'o', 'ù': 'u', 'ú': 'u', 'û': 'u', 'ü': 'u', 'ű': 'u', 'ý': 'y', 'þ': 'th',
                'ÿ': 'y',

                // Latin symbols
                '©': '(c)',

                // Greek
                'Α': 'A', 'Β': 'B', 'Γ': 'G', 'Δ': 'D', 'Ε': 'E', 'Ζ': 'Z', 'Η': 'H', 'Θ': '8',
                'Ι': 'I', 'Κ': 'K', 'Λ': 'L', 'Μ': 'M', 'Ν': 'N', 'Ξ': '3', 'Ο': 'O', 'Π': 'P',
                'Ρ': 'R', 'Σ': 'S', 'Τ': 'T', 'Υ': 'Y', 'Φ': 'F', 'Χ': 'X', 'Ψ': 'PS', 'Ω': 'W',
                'Ά': 'A', 'Έ': 'E', 'Ί': 'I', 'Ό': 'O', 'Ύ': 'Y', 'Ή': 'H', 'Ώ': 'W', 'Ϊ': 'I',
                'Ϋ': 'Y',
                'α': 'a', 'β': 'b', 'γ': 'g', 'δ': 'd', 'ε': 'e', 'ζ': 'z', 'η': 'h', 'θ': '8',
                'ι': 'i', 'κ': 'k', 'λ': 'l', 'μ': 'm', 'ν': 'n', 'ξ': '3', 'ο': 'o', 'π': 'p',
                'ρ': 'r', 'σ': 's', 'τ': 't', 'υ': 'y', 'φ': 'f', 'χ': 'x', 'ψ': 'ps', 'ω': 'w',
                'ά': 'a', 'έ': 'e', 'ί': 'i', 'ό': 'o', 'ύ': 'y', 'ή': 'h', 'ώ': 'w', 'ς': 's',
                'ϊ': 'i', 'ΰ': 'y', 'ϋ': 'y', 'ΐ': 'i',

                // Turkish
                'Ş': 'S', 'İ': 'I', 'Ç': 'C', 'Ü': 'U', 'Ö': 'O', 'Ğ': 'G',
                'ş': 's', 'ı': 'i', 'ç': 'c', 'ü': 'u', 'ö': 'o', 'ğ': 'g',



                // Russian
                'А': 'А', 'Б': 'Б', 'В': 'В', 'Г': 'Г', 'Д': 'Д', 'Е': 'Е', 'Ё': 'Е', 'Ж': 'Ж',
                'З': 'З', 'И': 'И', 'И': 'И', 'К': 'К', 'Л': 'Л', 'М': 'М', 'Н': 'Н', 'О': 'О',
                'П': 'П', 'Р': 'Р', 'С': 'С', 'Т': 'Т', 'У': 'У', 'Ф': 'Ф', 'Х': 'Х', 'Ц': 'Ц',
                'Ч': 'Ч', 'Ш': 'Ш', 'Щ': 'Щ', 'Ъ': '', 'Ы': 'Ы', 'Ь': '', 'Э': 'Э', 'Ю': 'Ю',
                'Я': 'Я',
                'а': 'а', 'б': 'б', 'в': 'в', 'г': 'г', 'д': 'д', 'е': 'е', 'ё': 'е', 'ж': 'ж',
                'з': 'з', 'и': 'и', 'й': 'и', 'к': 'к', 'л': 'л', 'м': 'м', 'н': 'н', 'о': 'о',
                'п': 'п', 'р': 'р', 'с': 'с', 'т': 'т', 'у': 'у', 'ф': 'ф', 'х': 'х', 'ц': 'ц',
                'ч': 'ч', 'ш': 'ш', 'щ': 'щ', 'ъ': '', 'ы': 'ы', 'ь': '', 'э': 'э', 'ю': 'ю',
                'я': 'я',
                // Ukrainian
                'Є': 'Ye', 'І': 'I', 'Ї': 'Yi', 'Ґ': 'G',
                'є': 'ye', 'і': 'i', 'ї': 'yi', 'ґ': 'g',



                // Czech
                'Č': 'C', 'Ď': 'D', 'Ě': 'E', 'Ň': 'N', 'Ř': 'R', 'Š': 'S', 'Ť': 'T', 'Ů': 'U',
                'Ž': 'Z',
                'č': 'c', 'ď': 'd', 'ě': 'e', 'ň': 'n', 'ř': 'r', 'š': 's', 'ť': 't', 'ů': 'u',
                'ž': 'z',

                // Polish
                'Ą': 'A', 'Ć': 'C', 'Ę': 'e', 'Ł': 'L', 'Ń': 'N', 'Ó': 'o', 'Ś': 'S', 'Ź': 'Z',
                'Ż': 'Z',
                'ą': 'a', 'ć': 'c', 'ę': 'e', 'ł': 'l', 'ń': 'n', 'ó': 'o', 'ś': 's', 'ź': 'z',
                'ż': 'z',

                // Latvian
                'Ā': 'A', 'Č': 'C', 'Ē': 'E', 'Ģ': 'G', 'Ī': 'i', 'Ķ': 'k', 'Ļ': 'L', 'Ņ': 'N',
                'Š': 'S', 'Ū': 'u', 'Ž': 'Z',
                'ā': 'a', 'č': 'c', 'ē': 'e', 'ģ': 'g', 'ī': 'i', 'ķ': 'k', 'ļ': 'l', 'ņ': 'n',
                'š': 's', 'ū': 'u', 'ž': 'z',

                //ROMANIAM

                'Ă':'A','Î':'I','Ș':'S','Ț':'T','Â':'A','ă':'a','î':'i','ș':'s','ț':'t','â':'a',
            };
        }else{
            var char_map = {
                // Latin
                'À': 'A', 'Á': 'A', 'Â': 'A', 'Ã': 'A', 'Ä': 'A', 'Å': 'A', 'Æ': 'AE', 'Ç': 'C',
                'È': 'E', 'É': 'E', 'Ê': 'E', 'Ë': 'E', 'Ì': 'I', 'Í': 'I', 'Î': 'I', 'Ï': 'I',
                'Ð': 'D', 'Ñ': 'N', 'Ò': 'O', 'Ó': 'O', 'Ô': 'O', 'Õ': 'O', 'Ö': 'O', 'Ő': 'O',
                'Ø': 'O', 'Ù': 'U', 'Ú': 'U', 'Û': 'U', 'Ü': 'U', 'Ű': 'U', 'Ý': 'Y', 'Þ': 'TH',
                'ß': 'ss',
                'à': 'a', 'á': 'a', 'â': 'a', 'ã': 'a', 'ä': 'a', 'å': 'a', 'æ': 'ae', 'ç': 'c',
                'è': 'e', 'é': 'e', 'ê': 'e', 'ë': 'e', 'ì': 'i', 'í': 'i', 'î': 'i', 'ï': 'i',
                'ð': 'd', 'ñ': 'n', 'ò': 'o', 'ó': 'o', 'ô': 'o', 'õ': 'o', 'ö': 'o', 'ő': 'o',
                'ø': 'o', 'ù': 'u', 'ú': 'u', 'û': 'u', 'ü': 'u', 'ű': 'u', 'ý': 'y', 'þ': 'th',
                'ÿ': 'y',

                // Latin symbols
                '©': '(c)',

                // Greek
                'Α': 'A', 'Β': 'B', 'Γ': 'G', 'Δ': 'D', 'Ε': 'E', 'Ζ': 'Z', 'Η': 'H', 'Θ': '8',
                'Ι': 'I', 'Κ': 'K', 'Λ': 'L', 'Μ': 'M', 'Ν': 'N', 'Ξ': '3', 'Ο': 'O', 'Π': 'P',
                'Ρ': 'R', 'Σ': 'S', 'Τ': 'T', 'Υ': 'Y', 'Φ': 'F', 'Χ': 'X', 'Ψ': 'PS', 'Ω': 'W',
                'Ά': 'A', 'Έ': 'E', 'Ί': 'I', 'Ό': 'O', 'Ύ': 'Y', 'Ή': 'H', 'Ώ': 'W', 'Ϊ': 'I',
                'Ϋ': 'Y',
                'α': 'a', 'β': 'b', 'γ': 'g', 'δ': 'd', 'ε': 'e', 'ζ': 'z', 'η': 'h', 'θ': '8',
                'ι': 'i', 'κ': 'k', 'λ': 'l', 'μ': 'm', 'ν': 'n', 'ξ': '3', 'ο': 'o', 'π': 'p',
                'ρ': 'r', 'σ': 's', 'τ': 't', 'υ': 'y', 'φ': 'f', 'χ': 'x', 'ψ': 'ps', 'ω': 'w',
                'ά': 'a', 'έ': 'e', 'ί': 'i', 'ό': 'o', 'ύ': 'y', 'ή': 'h', 'ώ': 'w', 'ς': 's',
                'ϊ': 'i', 'ΰ': 'y', 'ϋ': 'y', 'ΐ': 'i',

                // Turkish
                'Ş': 'S', 'İ': 'I', 'Ç': 'C', 'Ü': 'U', 'Ö': 'O', 'Ğ': 'G',
                'ş': 's', 'ı': 'i', 'ç': 'c', 'ü': 'u', 'ö': 'o', 'ğ': 'g',

                // Russian
                'А': 'A', 'Б': 'B', 'В': 'V', 'Г': 'G', 'Д': 'D', 'Е': 'E', 'Ё': 'Yo', 'Ж': 'Zh',
                'З': 'Z', 'И': 'I', 'Й': 'J', 'К': 'K', 'Л': 'L', 'М': 'M', 'Н': 'N', 'О': 'O',
                'П': 'P', 'Р': 'R', 'С': 'S', 'Т': 'T', 'У': 'U', 'Ф': 'F', 'Х': 'H', 'Ц': 'C',
                'Ч': 'Ch', 'Ш': 'Sh', 'Щ': 'Sh', 'Ъ': '', 'Ы': 'Y', 'Ь': '', 'Э': 'E', 'Ю': 'Yu',
                'Я': 'Ya',
                'а': 'a', 'б': 'b', 'в': 'v', 'г': 'g', 'д': 'd', 'е': 'e', 'ё': 'yo', 'ж': 'zh',
                'з': 'z', 'и': 'i', 'й': 'j', 'к': 'k', 'л': 'l', 'м': 'm', 'н': 'n', 'о': 'o',
                'п': 'p', 'р': 'r', 'с': 's', 'т': 't', 'у': 'u', 'ф': 'f', 'х': 'h', 'ц': 'c',
                'ч': 'ch', 'ш': 'sh', 'щ': 'sh', 'ъ': '', 'ы': 'y', 'ь': '', 'э': 'e', 'ю': 'yu',
                'я': 'ya',


                // Ukrainian
                'Є': 'Ye', 'І': 'I', 'Ї': 'Yi', 'Ґ': 'G',
                'є': 'ye', 'і': 'i', 'ї': 'yi', 'ґ': 'g',



                // Czech
                'Č': 'C', 'Ď': 'D', 'Ě': 'E', 'Ň': 'N', 'Ř': 'R', 'Š': 'S', 'Ť': 'T', 'Ů': 'U',
                'Ž': 'Z',
                'č': 'c', 'ď': 'd', 'ě': 'e', 'ň': 'n', 'ř': 'r', 'š': 's', 'ť': 't', 'ů': 'u',
                'ž': 'z',

                // Polish
                'Ą': 'A', 'Ć': 'C', 'Ę': 'e', 'Ł': 'L', 'Ń': 'N', 'Ó': 'o', 'Ś': 'S', 'Ź': 'Z',
                'Ż': 'Z',
                'ą': 'a', 'ć': 'c', 'ę': 'e', 'ł': 'l', 'ń': 'n', 'ó': 'o', 'ś': 's', 'ź': 'z',
                'ż': 'z',

                // Latvian
                'Ā': 'A', 'Č': 'C', 'Ē': 'E', 'Ģ': 'G', 'Ī': 'i', 'Ķ': 'k', 'Ļ': 'L', 'Ņ': 'N',
                'Š': 'S', 'Ū': 'u', 'Ž': 'Z',
                'ā': 'a', 'č': 'c', 'ē': 'e', 'ģ': 'g', 'ī': 'i', 'ķ': 'k', 'ļ': 'l', 'ņ': 'n',
                'š': 's', 'ū': 'u', 'ž': 'z',

                //ROMANIAM

                'Ă':'A','Î':'I','Ș':'S','Ț':'T','Â':'A','ă':'a','î':'i','ș':'s','ț':'t','â':'a',
            };
        }

        // Make custom replacements
        for (var k in opt.replacements) {
            s = s.replace(RegExp(k, 'g'), opt.replacements[k]);
        }

        // Transliterate characters to ASCII
        if (opt.transliterate) {
            for (var k in char_map) {
                s = s.replace(RegExp(k, 'g'), char_map[k]);
            }
        }

        // Replace non-alphanumeric characters with our delimiter
        var alnum = (typeof(XRegExp) === 'undefined') ? RegExp('[^a-zа-я0-9]+', 'ig') : XRegExp('[^\\p{L}\\p{N}]+', 'ig');
        s = s.replace(alnum, opt.delimiter);

        // Remove duplicate delimiters
        s = s.replace(RegExp('[' + opt.delimiter + ']{2,}', 'g'), opt.delimiter);

        // Truncate slug to max. characters
        s = s.substring(0, opt.limit);

        // Remove delimiter from ends
        s = s.replace(RegExp('(^' + opt.delimiter + '|' + opt.delimiter + '$)', 'g'), '');

        return opt.lowercase ? s.toLowerCase() : s;
    }
    $( function(){
        $.fn.modal.Constructor.prototype.enforceFocus = function () {
            var $modalElement = this.$element;
            $(document).on('focusin.modal', function (e) {
                var $parent = $(e.target.parentNode);
                if ($modalElement[0] !== e.target && !$modalElement.has(e.target).length
                        // add whatever conditions you need here:
                        &&
                        !$parent.hasClass('cke_dialog_ui_input_select') && !$parent.hasClass('cke_dialog_ui_input_text')) {
                    $modalElement.focus()
                }
            })
        };

        $('.modal').removeAttr('tabindex');

        $('.phone').keypress(function(e){
            if(event.which != 8 && isNaN(String.fromCharCode(event.which))){
                event.preventDefault();
            }
        });
    });

    // #MV changed name from Save to Save7777 because function is redundant
    function Save7777() {
        var children=$('form').find(':invalid').first().parents('.tab-children');

        if($(children).attr('data-id')!==undefined) {
            @foreach( $lang_data as $lang =>$value )
                $('.tab_' + '{{$lang}}').removeClass('active');
            @endforeach
            console.log(children);
            $('.' + $(children).attr('data-id')).addClass('active');
        }

    }

    $( function(){

    $('form').submit(function(){
        if((typeof(ver) != "undefined" && ver !== null) && !ver){
            $('#img_l').show();
        }
    });

    });
</script>


</body>

</html>

