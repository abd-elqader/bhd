<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <title>{{ env('APP_NAME') }} - Offer</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <meta content="text/html; charset=utf-8" http-equiv="Content-Type">
        <meta content="telephone=no" name="format-detection">
        <meta content= "width=device-width; initial-scale=1.0; maximum-scale=1.0; user-scalable=no;" name="viewport">
    </head>
    <body style="margin:0; padding:10px 0 0 0;" bgcolor="#FFFFFF" onclick="window.href.location='{{ env('APP_URL') }}'">
        <center>
            <h2>
                {{ $Email->title }}
            </h2>
            {!! $Email->desc !!}
            @if($Email->image)
            <img src="{{ asset($Email->image) }}" alt="Offer" style="max-width: 100%;">
            @endif
        </center>
    </body>
</html>
