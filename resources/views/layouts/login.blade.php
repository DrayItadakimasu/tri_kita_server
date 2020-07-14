<!DOCTYPE html>
<html lang="ru">

<head>

    @extends("sections.head")

</head>

<body>


@yield('content')


<style>
    body {
        background-image: url(/assets/img/enter.png);
        background-size: cover;
        background-position: top 15px center;
    }
</style>

@include ("sections.js")


</body>

</html>
