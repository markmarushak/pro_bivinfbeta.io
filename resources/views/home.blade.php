@extends('layouts.app')

@section('content')
    <div class="content">
        <div class="content__container">
            <p class="content__container__text">
                ПРИВЕТСТВУЮ
            </p>

            <ul class="content__container__list">
                <li class="content__container__list__item">ЛИЧНОСТЬ</li>
                <li class="content__container__list__item">ВСЕМОГУЩЕСТВЕННЫЙ</li>
                <li class="content__container__list__item">ЧЕЛОВЕК</li>
                <li class="content__container__list__item">ВСЕЗНАЮЩИЙ</li>
            </ul>
        </div>
    </div>
    <div class="main">
        <div class="container">
            <div class="row">

                <div class="col-sm-4">
                    <nav class="menu">
                        <button class="menu-button-mobi" id="bars"><i class="fas fa-bars"></i></button>
                        <ul>
                            @foreach($menu->where('main_id',0)->get()->toArray() as $item)
                                <li>
                                    <button class="drop">{{ $item['name'] }}</button>
                                    <div>
                                        <button class="drop-button-mobi"><i class="fas fa-times"></i></button>
                                        <ul>
                                            @foreach($menu->getParent($item['id']) as $parent)
                                                <li><a href="#" data-id="{{ $parent->id }}">{{$parent->name}}</a></li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </nav>
                </div>

                <div class="col-sm-4">
                    <div id="content" class="text-center">
                        <div class="name"></div>
                        <div class="price"></div>
                        <div class="time"></div>
                        <div class="region"></div>
                        <div class="text"></div>
                    </div>
                </div>

                <div class="col-sm-4">
                    <div class="attention">

                        <section id="1">
                            <p></p>
                        </section>

                        <section id="2">
                            <p></p>
                        </section>

                        <section id="3">
                            <p></p>
                        </section>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <div class="block-hide" id="popover_time_info">
        Уважаемые заказчики! <br>
        <b>Мы стараемся максимально быстро закрывать сделки. </b> <br>
        Указаны максимально возжные  сроки сделки,  <br>
        после которых снимается резерв средств в согласованном (Нами и Вами) ГАРАНТ СЕРВИСЕ. <br>

        <b>На практике выходит быстрее максимально указанного срока выполнения. Или предупреждаем. И предлагаем иные пути решения каждого вопроса. </b>
    </div>
    
    <div id="certificate">
        <a href="https://drive.google.com/file/d/1JTXFMZ_bI-b07GvGqvdQQm7ZF5PGiftq/view?usp=sharing" target="_blank">ПОЛИТИКА КОНФИДЕЦИАЛЬНОСТИ ДАННЫХ И
            ПОЛЬЗОВАТЕЛЬСКОЕ СОГЛАШЕНИЕ</a>
    </div>

@endsection

@section('js')
    <script src="{{ asset('js/main.js') }}"></script>
@endsection