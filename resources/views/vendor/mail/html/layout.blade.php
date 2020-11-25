<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <link href="{{request()->getSchemeAndHttpHost().asset('css/mail.css')}}" rel="stylesheet">
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

<table class="wrapper" width="100%" cellpadding="0" cellspacing="0" role="presentation">
    <tr>
        <td align="center">
            <table class="content" align="center" width="100%" cellpadding="0" cellspacing="0" role="presentation">
                <tr>
                    <td width="100%" cellpadding="0" cellspacing="0" align="center">
                        <a href="{{env('APP_URL')}}" class="logo">
                            <img src="{{env('APP_URL').asset('img/logo.png')}}" alt="">
                        </a>
                    </td>
                </tr>
                <!-- Email Body -->
                <tr>
                    <td class="body" width="100%" cellpadding="0" cellspacing="0">
                        <table class="inner-body" align="center" width="570" cellpadding="0" cellspacing="0" role="presentation">
                            <!-- Body content -->
                            <tr>
                                <td class="content-cell">
                                    <h1><?=$data->title?></h1>
                                    <div class="date"><?=$data->letter_date?></div>
                                    <div class="link"><a href="<?=$data->link?>">Ссылка на новость</a></div>
                                    <p><?=$data->text?></p>
                                    <a href="{{env('APP_URL').'unsubscribe/'.$to}}">Отписаться</a> от рассылки
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>

            </table>
        </td>
    </tr>
</table>
</body>
</html>
