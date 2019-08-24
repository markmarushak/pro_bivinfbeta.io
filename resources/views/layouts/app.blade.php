<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/main.css') }}" rel="stylesheet">
</head>
<body>


    @if(Route::name('home'))
        <div id="pre-page">
            <div class="page-body">
                <header>
                    <h1>«ДЕТЕКТИВ ОНЛАЙН»</h1>
                    <span>Решаем любые споры, потому что владеем информацией.</span>
                </header>

                <p>Любые дынные о Человеке или Организации. Поиск Людей, Телефонов, Автомобилей, Обнародование видео и данных по запросу ( на пример для помощи следствию). </p>
                <p>Оказываем помощь в Сборе информации по Лучшей стоимости в кратчайшие сроки.p</p>

                <p>Работаем через все Известные системы гарант в интернете. Не видите нужной Вам услуги, стучите в контакты. Мы поможем.</p>

                <button id="open-page" class="btn btn-warning" > Открыть Детектива</button>
            </div>


        </div>


        <div class="m-image">
            <div class="m-image__bar m-image__bar--animated">
                <div class="m-image__bar-image"></div>
            </div>
            <div class="m-image__bar m-image__bar--animated">
                <div class="m-image__bar-image"></div>
            </div>
            <div class="m-image__bar m-image__bar--animated">
                <div class="m-image__bar-image"></div>
            </div>
            <div class="m-image__bar m-image__bar--animated">
                <div class="m-image__bar-image"></div>
            </div>
            <div class="m-image__bar m-image__bar--animated">
                <div class="m-image__bar-image"></div>
            </div>
            <div class="m-image__bar m-image__bar--animated">
                <div class="m-image__bar-image"></div>
            </div>
            <div class="m-image__bar m-image__bar--animated">
                <div class="m-image__bar-image"></div>
            </div>
            <div class="m-image__bar m-image__bar--animated">
                <div class="m-image__bar-image"></div>
            </div>
        </div>
    @endif

    <div id="app" class="disabled">


        <main class="py-4">
            @yield('content')
        </main>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>


    @yield('js')

</body>
</html>
