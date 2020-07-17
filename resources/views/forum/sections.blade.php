@extends('layouts.lk')

@section('content')



                <section id="unloading">
                    <div class="container request">

                        <div class="row request-row justify-content-between">
                        <div class="reg-txt"> <a class="text-white" href="{{ route('forum') }}">Форумы</a> - Список разделов </div>
                        <div class="bucket-cont d-flex">
                        
                        @if(Auth::user()->group->name == 'admin')
                        <a class="trash-but text-white" href="{{route('forum.section.create' )}}">Добавить раздел</a>
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
                            @foreach($sections as $section)
                            <div class="col-12 item section_item">
                            <a href="{{ route('forum.section', $section->id) }}">
                                    <div class="name">
                                    <h2>{{$section->name}}</h2>
                                    </div>
                                    @if($section->description)
                                    <div class="description">
                                        {{$section->description}}
                                    </div>
                                    @endif
                                </a>
                                @if(Auth::user()->group->name == 'admin')
                                <div class="del"> 
                                    <form method="post" action="{{ route('forum.section.delete', $section->id) }}">
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