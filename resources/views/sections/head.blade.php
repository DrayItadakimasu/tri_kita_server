<meta charset="utf-8">
<meta name="csrf-token" content="{{ csrf_token() }}">
<title>{{ isset($title) ? $title : 'Юг-Загрузка' }}</title>
<meta name="description"
      content="Сервис для размещения заявок по перевозки сельхоз продукции, и поиска рейсов для зерновозов - ЮГ ЗАГРУЗКА.">

<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<link rel="icon" href="{{ asset('/assets/img/icon_yg.png') }}">
<link rel="stylesheet" href="{{ asset('/assets/fonts/roboto/roboto.css') }}">
<link href="https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/css/select2.min.css" rel="stylesheet"/>
<link rel="stylesheet" href="{{ asset('/assets/css/styles.min.css') }}?v=1.9.1">
<meta name="theme-color" content="#34a5e9">

