@extends('layouts.lk')

@section('content')



                <section id="unloading">
                    <div class="container request">

                        <div class="row request-row justify-content-between">
                        <div class="reg-txt"> <a class="text-white" href="{{ route('forum') }}">Форумы</a> <a class="text-white" href="{{ route('forum.section', $section->id) }}"> - {{ $section->name }}</a> - Список тем </div>
                        <div class="bucket-cont d-flex">
                            
                        <a class="trash-but text-white" href="{{route('forum.topic.create', $section->id )}}">Добавить тему</a>
                        </div>
                        </div>
                    </div>
                    <div class="container mt-3">

                        <div class="row">
                            @if (session()->has('success_main'))
                            <div class="d-inline-flex" id="popup_notification">
                                <strong>{{ session('success_main') }} </strong>
                            </div>
                            @endif

                            @if (session()->has('fail_main'))
                            <div class="d-inline-flex" id="popup_notification">
                                <strong>{{ session('fail_main') }} </strong>
                            </div>
                            @endif


                        </div>

                        
                        <div class="row">
                            @foreach($topics as $topic)
                            <div class="col-12 item section_item">
                            
                                <div class="date">
                                    {{$topic->created_at->format('H:i d.m.Y')}}
                                </div>
                                    <div class="name">
                                        <a href="{{ route('forum.topic', [ 'section' => $section->id, 'topic' => $topic->id ]) }}"><h2>{{$topic->name}}</h2></a>
                                    </div>

                                    <div class="user">
                                        Автор: <span> <a href="{{ route('profile', $topic->user_id) }}"> {{$topic->user->fio}} </a></h2>
                                    </div>
                                    <div class="count_messages">
                                        Сообщений: <span> {{$topic->messages->count()}} </span>
                                    </div>

                                
                                @if(Auth::user()->group->name == 'admin')
                                <div class="del"> 
                                    <form method="post" action="{{ route('forum.topic.delete', [ 'section' => $section->id, 'topic' => $topic->id ]) }}">
                                        @csrf
                                        <input class="blue-link" type="submit" value="Удалить">
                                        
                                    </form>
                                </div>
                                @endif

                            </div>
                            @endforeach

                        </div>
                            

                </section>







@endsection