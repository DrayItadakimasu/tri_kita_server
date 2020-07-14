@extends('layouts.lk')

@section('content')
    <div class="col middle-block">

        <div class="row">

            @if (session()->has('success_main'))
                <div class="col-12">
                    <div class="alert success" id="popup_notification">
                        <strong>{{ session('success_main') }} </strong>
                    </div>
                </div>
            @endif

            @if (session()->has('success_main'))
                <div class="col-12">
                    <div class="alert fail" id="popup_notification">
                        <strong>{{ session('error_main') }} </strong>
                    </div>
                </div>
            @endif

            <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="table-container">

                    <div class="table-container">
                        <table class="table text-center">
                            <thead>
                            <tr>
                                <th scope="col">Создано</th>
                                <th scope="col">Дата окончания</th>
                                <th scope="col">Погрузка</th>
                                <th scope="col">Выгрузка</th>
                                <th scope="col">Культура</th>
                                <th scope="col">Объем, тонн</th>
                                <th scope="col">Расстояние, км</th>
                                <th scope="col">Цена, руб/кг</th>
                                <th scope="col">Отклики</th>
                                <th scope="col"></th>
                            </tr>
                            </thead>
                            <tbody>
                            <!--1-->
                            @foreach ($applications as $application)
                                <tr onclick="window.location.href = '{{ route('show.application',$application->id) }}'">
                                    <td data-label="Создано"><span
                                            class="white-date"> {{ $application->created_at->format('H:i d.m.Y') }} </span>
                                    </td>
                                    <td data-label="Дата окончания"
                                        class="custom-width-date">{{ $application->date_end->format('d.m.Y') }}
                                    </td>
                                    <td data-label="Погрузка" class="custom-width-load"><a
                                            href="{{ route('show.application',$application->id) }}">{{ $application->FullLoadPlace }}</a>
                                    </td>
                                    <td data-label="Выгрузка" class="custom-width-unload"><a
                                            href="{{ route('show.application',$application->id) }}">{{ $application->FullUnloadPlace }}</a>
                                    </td>
                                    <td data-label="Культура" class="custom-width-culture"><a
                                            href="{{ route('show.application',$application->id) }}">{{ $application->culture->name }}</a>
                                    </td>
                                    <td data-label="Объем, тонн" class="custom-width-weight">
                                        <a href="#">{{ $application->amount }}</a>
                                    </td>
                                    <td data-label="Расстояние, км" class="custom-width-distance"><a
                                            href="{{ route('show.application',$application->id) }}">{{ $application->distance }}</a>
                                    </td>
                                    <td data-label="Цена, руб/кг" class="custom-width-sale"><a
                                            href="{{ route('show.application',$application->id) }}">{{ $application->cost }}</a>
                                    </td>
                                    <td class="custom-width-user">
                                        @if($application->answer->count()) <a title="Ответов"
                                                                              href="@if($application->user_id == auth::user()->id){{ route('listing.answer', $application->id)}}@else#@endif"
                                                                              class=""><img
                                                src="/assets/img/user-black.png"
                                                alt=""> {{ $application->answer->count() }}</a> @endif <a href="#"
                                                                                                          class="text-blue"
                                                                                                          title="Просмотров"><img
                                                src="/assets/img/view.png" alt=""> {{ $application->views }}</a>
                                    </td>
                                    <td class="custom-width-doit">
                                        <div class="row">
                                            <a href="{{ route('edit.application', $application->id) }}">
                                                <button class="my-btn my-btn-edit">
                                                </button>
                                            </a>

                                            {{--                                        @if($application->status==1)--}}
                                            {{--                                        <form method="post" action="{{ route('up.application', $application->id) }}">--}}
                                            {{--                                            @csrf--}}
                                            {{--                                            <input class="blue-link " type="submit" value="Поднять">--}}

                                            {{--                                        </form>--}}
                                            {{--                                        @endif--}}


                                            @if($application->status==1)
                                                <form method="post"
                                                      action="{{ route('close.application', $application->id) }}">
                                                    @csrf
                                                    <input class="my-btn my-btn-archive" type="submit" value="">

                                                </form>
                                            @endif


                                            @if($application->status==2)
                                                <form method="post"
                                                      action="{{ route('start.application', $application->id) }}">
                                                    @csrf
                                                    <input class="blue-link " type="submit" value="Возобновить">

                                                </form>
                                            @endif

                                            <form method="post"
                                                  action="{{ route('destroy.application', $application->id) }}">
                                                @csrf
                                                <input class="my-btn my-btn-del" type="submit" value="">
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            <!--1-->

                            </tbody>

                        </table>
                    </div>

                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-12 d-flex justify-content-center">
                <div class="pagination-container">

                    {{$applications->links()}}

                </div>
            </div>
        </div>
    </div>
    <style>
        .lk .middle-block {
            padding-top: 0;
        }


    </style>
@endsection
