@extends('layouts.lk')

@section('content')
    <div class="col middle block">
        <div class="row">
            <div class="col-xl-9">
                <div class="row">
                    @foreach($topics as $topic)

                        <div class="col-xl-4 p-3">
                            <div class="message-card">
                                <img src="/img/forum-img-example.png" width="100%" alt="">
                                <div class="message-body p-3">
                                    <small>{{$topic->created_at->format('d.m.yy')}}</small>
                                    <h2>
                                        Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do
                                    </h2>
                                    <p>
                                        Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor
                                        incididunt ut labore et dolore magna aliqua. Ut
                                    </p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="col-xl-3 ml-auto">
                <div class="filter pb-4">
                    <p>
                        <img src="/img/menu.png" alt="">
                        Категории</p>
                    <div class="list-group">
                        <a href="/forum/1">
                            <div tabindex="1" class="list-news list-group-item list-group-item-action @if($_SERVER["REQUEST_URI"] == '/forum/1') active @endif">
                                Новости
                            </div>
                        </a>
                        <a href="/forum/2">
                            <div tabindex="1" class="list-offer list-group-item list-group-item-action @if($_SERVER["REQUEST_URI"] == '/forum/2') active @endif">Ваши предложения</div>
                        </a>
                        <a href="/forum/3">
                            <div tabindex="1" class="list-help list-group-item list-group-item-action @if($_SERVER["REQUEST_URI"] == '/forum/3') active @endif">Помощь</div>
                        </a>
                    </div>
                </div>
                <div class="form-group mt-2 float-right">
                    <button type="submit" class="send-form p-3">
                        @if($_SERVER["REQUEST_URI"] == '/forum/1') Добавить новость @endif
                        @if($_SERVER["REQUEST_URI"] == '/forum/2') Добавить предложение @endif
                        @if($_SERVER["REQUEST_URI"] == '/forum/3') Добавить вопрос @endif
                    </button>
                </div>
            </div>
        </div>
    </div>
@endsection
