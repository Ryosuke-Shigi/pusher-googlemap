<!DOCTYPE html>
<html lang="ja">
    <head>
        <title>@yield("title")</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="initial-scale=1.0, user-scalable=no width=device-width">
        @yield("meta")
    </head>
    <body>
        <div id='app'></div>
        @yield("contents")
    </body>
</html>
