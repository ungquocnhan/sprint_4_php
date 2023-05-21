<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Học LARAVEL</title>
</head>
<body>
<header>
    <h1>Header Laravel</h1>
{{--    <h2><?php echo $title; ?></h2>--}}
    <h2>{{$title}}</h2>
</header>
<main>
    <h1>Nội dung demo</h1>
{{--    <h2><?php echo $content; ?></h2>--}}

    <h2 style="color: rebeccapurple">{{$content}}</h2>
</main>
<footer>
    <h1>Footer</h1>
</footer>
</body>
</html>
