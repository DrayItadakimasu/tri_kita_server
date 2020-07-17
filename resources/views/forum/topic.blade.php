@extends('layouts.lk')

@section('content')



                <section id="unloading">
                    <div class="container request">

                        <div class="row request-row justify-content-between">
                        <div class="reg-txt"> <a class="text-white" href="{{ route('forum') }}">Форумы</a> - <a class="text-white" href="{{ route('forum.section', $section->id) }}">{{$section->name}}</a> - <a class="text-white" href="{{ route('forum.topic', ['topic' => $topic, 'section' => $section]) }}">{{$topic->name}}</a> </div>
                        <div class="bucket-cont d-flex">
                            @if(Auth::user()->group->name == 'admin')
                            <div class="del"> 
                                <form method="post" action="{{ route('forum.topic.delete', ['section'=> $section->id,'topic'=> $topic->id,]) }}">
                                    @csrf
                                    <input class="blue-link" type="submit" value="Удалить">
                                    
                                </form>
                            </div>
                            @endif
                            
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

                            <div class="col-12 item section_item">
                            
                                <div class="date">
                                   Опубликовано: {{$topic->created_at->format('H:i d.m.Y')}}
                                </div>

                                    <div class="user">
                                        Автор темы: <span> <a href="{{ route('profile', $topic->user_id) }}"> {{$topic->user->fio}} </a></h2>
                                    </div>
                                    <hr>
                                    <div class="content">
                                        {{$topic->content}}
                                    </div>



                            </div>

                            @foreach($topic->messages as $message)
                            
                            <div class="col-12 item section_item">
                            
                                    <div class="info">
                                        <span class="id">#{{$message->id}}</span> <b>Автор:  <a href="{{ route('profile', $message->user_id) }}"> {{$message->user->fio}} </a>  <span class="time">{{$message->created_at->format('H:i d.m.Y')}}  <span> </b>
                                    </div>

                                    <hr>
                                    <div class="content">
                                        {!! strip_tags (str_replace(array("\r\n", "\r", "\n"), '<br>', $message->content),'<br><a><b>') !!}
                                    </div>
                               
                                @if(Auth::user()->group->name == 'admin')
                                <div class="del"> 
                                    <form method="post" action="{{ route('forum.message.delete', ['section'=> $section,'topic'=> $topic, 'message'=> $message]) }}">
                                        @csrf
                                        <input class="blue-link" type="submit" value="Удалить">
                                        
                                    </form>
                                </div>
                                @endif
                                

                            </div>
                            @endforeach

                            <div class="col-12 item section_item">
                            
                                <form class="fullwidth" action="{{ route('forum.message.send', ['section'=> $section, 'topic'=> $topic]) }}" method="POST">
                                    @csrf
                                <div class="loading-input-container ">
                                            
                                    <label for="">
                                        <span>Сообщение</span>  <br>
                                        <textarea class="load-redaction big-input fullwidth" name="message" rows="15" type="text" value="" required="1" > </textarea>
                                    </label>

                                    @error('message')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                   
                                 </div>

                                 <div class="loading-btn-container">
                                    <label class="blue-but-sub" for="">
                                            <div class="blue-big-cont">
                                                <input class="blue-big-btn" type="submit" value="Отправить">
                                            </div>
                                        </label>
                                </div>

                            </form>

                                

                            </div>

                        </div>
                            

                </section>







@endsection