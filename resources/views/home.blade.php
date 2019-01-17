@extends('layouts.app')

@section('content')
    <div class="main">
        <div class="container">
            <div class="row">

                <div class="col-sm-4">
                    <nav class="menu">
                        <ul>
                            @foreach($menu->where('main_id',0)->get()->toArray() as $item)
                                <li>
                                    <button class="drop">{{ $item['name'] }}</button>
                                    <div>
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
@endsection

@section('js')
    <script src="{{ asset('js/main.js') }}"></script>
@endsection