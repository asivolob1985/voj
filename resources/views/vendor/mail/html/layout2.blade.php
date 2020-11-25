<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

</head>
<body>
<style>
    @media only screen and (max-width: 600px) {
        .inner-body {
            width: 100% !important;
        }

        .footer {
            width: 100% !important;
        }
    }

    @media only screen and (max-width: 500px) {
        .button {
            width: 100% !important;
        }
    }

</style>
<div class="wrapper">
    <div class="content">
        <!-- шапка сайта-->
        <header class="header">
            <div class="top-line">
                <div class="container flex">
                    <a href="tel:<?=helper::sanitize_tel(setting('kontakty.tel'))?>" class="phone">{{setting('kontakty.tel')}}</a>
                    {{menu('top_menu', 'menu.top')}}
                </div>
            </div>
            <div class="bottom-line">
                <div class="container flex">
                    <a href="<?=route('main_page')?>" class="logo">
                        <img src="{{request()->getSchemeAndHttpHost().asset('img/logo.svg')}}" alt="">
                    </a>
                    {{menu('main_menu', 'menu.main')}}
                </div>
            </div>
        </header>
        <!-- конец шапки сайта-->
    <!-- контент пост -->
        <section class="article-page">
            <div class="container flex">
                <div class="r-section">
                    <h1><?=$post->title?></h1>
                    <div class="date-sharing">
                        <div class="date"><?=$post->post_date?></div>
                    </div>
                    <div class="text">
						<?=$post->body?>
                    </div>
                </div>
            </div>
        </section>
        <!--конец контент поста -->
    </div>
    <!-- footer-->
    <footer class="footer">
        <div class="top-line">
            <div class="container">
                <div class="l-section">
                    <p class="address">{!! setting('kontakty.address')!!}</p>
                    <a href="tel:<?=helper::sanitize_tel(setting('kontakty.tel'))?>" class="phone">{{setting('kontakty.tel')}}</a>
                    <a href="mailto:{{setting('kontakty.email')}}" class="mail">{{setting('kontakty.email')}}</a>
                </div>
                <div class="r-section">
                    <a href="#" class="up-btn">
                        <span>{{__("elements.top_button")}}</span>
                        <div class="circle">
                            <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M8.99968 3.828V16H6.99968V3.828L1.63568 9.192L0.22168 7.778L7.99968 0L15.7777 7.778L14.3637 9.192L8.99968 3.828Z" fill="white"/>
                            </svg>
                        </div>
                    </a>
                    @include('elements.socials')
                </div>
            </div>
        </div>
        <div class="bottom-line">
            <div class="container">
                <p class="copy">&copy;{{date('Y')}} {{setting('site.copyright')}}</p>
                <p>{{__("elements.maked")}} <a href="http://wattdev.ru" target="_blank">WATT</a></p>
            </div>
        </div>

    </footer>
    <!-- конец footer-->
</div>
<div class="bg_black"></div>
</body>
</html>