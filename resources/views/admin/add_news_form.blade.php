@extends('layouts.lk')

@section('content')
    <div class="col middle-block" id="add_news_form">
        <div class="wrapper">
            <div class="row">
                <div class="col-xl-6">
                    <div class="col-12">
                        <h2>Добавить новость</h2>
                    </div>

                    <div class="col-12">
                        <label class="file_input">
                            Загрузить изображение новости
                            <input name="thumb" id="thumb" type="file">
                        </label>
                    </div>
                    <div class="col-12">
                        <p>Заголовок</p>
                        <input name="title" id="title" type="text">
                    </div>
                    <div class="col-12">
                        <p>Описание</p>
                        <textarea name="desc" id="desc" cols="30" rows="10"></textarea>
                    </div>
                    <div class="col-12">
                        <p>Мета описание</p>
                        <input type="text">
                    </div>
                    <div class="col-12">

                    </div>
                </div>
                <div class="col-xl-6">
                    <div class="col-12">
                        <h2>Превью</h2>
                    </div>
                    <div class="col-xl-8 p-3">
                        <div class="message-card">
                            <img id="new_thumb" src="/img/forum-img-example.png" width="100%" alt="">
                            <div class="message-body p-3">
                                <small>Дата создания</small>
                                <h2 id="new_title">
                                    Заголовок
                                </h2>
                                <p id="new_desc">
                                    Описание
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div>


            <style>
                .wrapper {
                    margin-left: 15px;
                    border-radius: 25px;
                    background-color: rgb(255, 255, 255);
                    width: 998px;
                    padding: 15px;
                    margin-bottom: 30px;
                    max-width: 98%;

                }
                .file_input{
                    cursor: pointer;

                }
                .file_input input{
                    display: none;
                }
                .message-card{
                    background-color: white;
                    border-radius: 25px;
                    box-shadow: 0 0 10px  rgba(0,0,0,.3);
                }
                .message-card img{
                    border: 1px solid #f0f3f8;
                    border-bottom: none;
                    border-top-left-radius: 25px;
                    border-top-right-radius: 25px;
                }
                .message-card p, .message-card small {
                    color: #626262;
                }
                .message-card small{
                    margin-bottom: 30px;
                }

            </style>
            <script>
                let preview_thumb = document.querySelector('#new_thumb'),
                    preview_title = document.querySelector('#new_title'),
                    preview_desc = document.querySelector('#new_desc');
                let inp_thumb = document.querySelector('#thumb'),
                    inp_title = document.querySelector('#title'),
                    inp_desc = document.querySelector('#desc');

                inp_title.oninput = function () {
                    if(this.value.length > 0 && this.value.length < 40){
                        preview_title.textContent = this.value;
                    }
                    else if(this.value.length == 0){
                        preview_title.textContent = 'Заголовок';
                    }
                }
                inp_desc.oninput = function () {
                    if(this.value.length > 0 && this.value.length < 150){
                        preview_desc.textContent = this.value;
                    }

                    else if (this.value.length == 0){
                        preview_desc.textContent = 'Описание';
                    }
                }
                preview_thumb.addEventListener('change',()=>{

                })
            </script>
@endsection
