@extends('layouts.lk')

@section('content')



                <section id="unloading">
                    <div class="container request">

                        <div class="row request-row justify-content-between">
                        <div class="reg-txt"> <a class="text-white" href="{{ route('forum') }}">Форумы</a> <a class="text-white" href="{{ route('forum.section', $section->id) }}"> - {{ $section->name }}</a> - Новая тема </div>

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

                        
                        <div class="row loading">

                        <form class="fullwidth col-12" action="{{ route('forum.topic.store', $section->id) }}" method="POST">
                            @csrf
                            
                                <div class="loading-input-container ">
                                            
                                    <label for="">
                                        <span>Название темы</span><br>
                                        <input class="load-redaction fullwidth" name="name" type="text" value="" required="1" > 
                                    </label>
                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                   
                                 </div>

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
                            

                </section>







@endsection