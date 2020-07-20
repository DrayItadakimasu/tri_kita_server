document.addEventListener("DOMContentLoaded", function () {

    jQuery('.rating-input').each(function (i) {
        let $set = $('.rating-input .rating-star-big');
        var count = $set.length;

        jQuery('.rating-input').on('click', '.rating-star-big', function () {
            var n = $set.index(this) + 1;
            $set.siblings('input').val(n);
            $set.removeClass('full_star-big');

            if (!$set.eq(n - 1).hasClass('full_star-big')) {
                var select = $set.eq(n);

                $set.each(function (i) {
                    if (n - 1 < i) return false;
                    $(this).addClass('full_star-big');

                });
            }

        });
    });

    jQuery('.rating-output').each(function (i) {

        let rating = jQuery(this).attr('data-rating');

        jQuery(this).children('.rating-star').removeClass('half-star')
        jQuery(this).children('.rating-star').removeClass('empty-star')
        jQuery(this).children('.rating-star').removeClass('full-star')
        jQuery(this).children('.rating-star').addClass('empty-star')

        if (rating > 0 && rating < 1) {

            jQuery(this).children('.rating-star').eq(0).removeClass('empty-star')
            jQuery(this).children('.rating-star').eq(0).addClass('half-star')

        } else if (rating == 1) {

            jQuery(this).children('.rating-star').eq(0).removeClass('empty-star')
            jQuery(this).children('.rating-star').eq(0).addClass('full-star')

        } else if (rating > 1 && rating < 2) {

            jQuery(this).children('.rating-star').eq(0).removeClass('empty-star')
            jQuery(this).children('.rating-star').eq(1).removeClass('empty-star')
            jQuery(this).children('.rating-star').eq(0).addClass('full-star')
            jQuery(this).children('.rating-star').eq(1).addClass('half-star')

        } else if (rating == 2) {

            jQuery(this).children('.rating-star').eq(0).removeClass('empty-star')
            jQuery(this).children('.rating-star').eq(1).removeClass('empty-star')
            jQuery(this).children('.rating-star').eq(0).addClass('full-star')
            jQuery(this).children('.rating-star').eq(1).addClass('full-star')

        } else if (rating > 2 && rating < 3) {

            jQuery(this).children('.rating-star').eq(0).removeClass('empty-star')
            jQuery(this).children('.rating-star').eq(1).removeClass('empty-star')
            jQuery(this).children('.rating-star').eq(2).removeClass('empty-star')
            jQuery(this).children('.rating-star').eq(0).addClass('full-star')
            jQuery(this).children('.rating-star').eq(1).addClass('full-star')
            jQuery(this).children('.rating-star').eq(2).addClass('half-star')

        } else if (rating == 3) {

            jQuery(this).children('.rating-star').eq(0).removeClass('empty-star')
            jQuery(this).children('.rating-star').eq(1).removeClass('empty-star')
            jQuery(this).children('.rating-star').eq(2).removeClass('empty-star')
            jQuery(this).children('.rating-star').eq(0).addClass('full-star')
            jQuery(this).children('.rating-star').eq(1).addClass('full-star')
            jQuery(this).children('.rating-star').eq(2).addClass('full-star')

        } else if (rating > 3 && rating < 4) {

            jQuery(this).children('.rating-star').eq(0).removeClass('empty-star')
            jQuery(this).children('.rating-star').eq(1).removeClass('empty-star')
            jQuery(this).children('.rating-star').eq(2).removeClass('empty-star')
            jQuery(this).children('.rating-star').eq(3).removeClass('empty-star')
            jQuery(this).children('.rating-star').eq(0).addClass('full-star')
            jQuery(this).children('.rating-star').eq(1).addClass('full-star')
            jQuery(this).children('.rating-star').eq(2).addClass('full-star')
            jQuery(this).children('.rating-star').eq(3).addClass('half-star')

        } else if (rating == 4) {

            jQuery(this).children('.rating-star').eq(0).removeClass('empty-star')
            jQuery(this).children('.rating-star').eq(1).removeClass('empty-star')
            jQuery(this).children('.rating-star').eq(2).removeClass('empty-star')
            jQuery(this).children('.rating-star').eq(3).removeClass('empty-star')
            jQuery(this).children('.rating-star').eq(0).addClass('full-star')
            jQuery(this).children('.rating-star').eq(1).addClass('full-star')
            jQuery(this).children('.rating-star').eq(2).addClass('full-star')
            jQuery(this).children('.rating-star').eq(3).addClass('full-star')

        } else if (rating > 4 && rating < 5) {

            jQuery(this).children('.rating-star').eq(0).removeClass('empty-star')
            jQuery(this).children('.rating-star').eq(1).removeClass('empty-star')
            jQuery(this).children('.rating-star').eq(2).removeClass('empty-star')
            jQuery(this).children('.rating-star').eq(3).removeClass('empty-star')
            jQuery(this).children('.rating-star').eq(4).removeClass('empty-star')
            jQuery(this).children('.rating-star').eq(0).addClass('full-star')
            jQuery(this).children('.rating-star').eq(1).addClass('full-star')
            jQuery(this).children('.rating-star').eq(2).addClass('full-star')
            jQuery(this).children('.rating-star').eq(3).addClass('full-star')
            jQuery(this).children('.rating-star').eq(4).addClass('half-star')

        } else if (rating == 5) {

            jQuery(this).children('.rating-star').eq(0).removeClass('empty-star')
            jQuery(this).children('.rating-star').eq(1).removeClass('empty-star')
            jQuery(this).children('.rating-star').eq(2).removeClass('empty-star')
            jQuery(this).children('.rating-star').eq(3).removeClass('empty-star')
            jQuery(this).children('.rating-star').eq(4).removeClass('empty-star')
            jQuery(this).children('.rating-star').eq(0).addClass('full-star')
            jQuery(this).children('.rating-star').eq(1).addClass('full-star')
            jQuery(this).children('.rating-star').eq(2).addClass('full-star')
            jQuery(this).children('.rating-star').eq(3).addClass('full-star')
            jQuery(this).children('.rating-star').eq(4).addClass('full-star')

        }
    });


    jQuery('.mob-menu-but').click(function () {
        jQuery('.mob-menu-container').addClass('mob-menu-active')
    })

    jQuery('.mob-menu-close').click(function () {
        jQuery('.mob-menu-container').removeClass('mob-menu-active')
    })

    $('.bt-accordion').click(function () {
        if (!$('.filter-form').hasClass('active')) {
            $('.filter-form').show("slow", function () {
            }).addClass('active');
            $(this).text("Скрыть фильтры");
        } else {
            $('.filter-form').hide("slow", function () {
            }).removeClass('active');
            $(this).text("Показать фильтры");
        }
    });


    $('.map-accordion').click(function () {
        if (!$('.map-container').hasClass('active')) {
            $('.map-container').toggle({
                complete: function () {

                },
                duration: 'slow'
            }).addClass('active');
            $(this).text("Скрыть карту");

        } else {
            $('.map-container').toggle({
                complete: function () {

                },
                duration: 'slow'
            }).removeClass('active');
            $(this).text("Показать на карте");
        }
        window.dispatchEvent(new Event('resize'));
    });


    $('.user-menu').click(function () { // button.dropdown-toggle
        var parentContainer = $(this);
        var menu = parentContainer.find('.dropdown-menu');
        if (!menu.hasClass('show')) menu.addClass('show').show(500);
        else menu.removeClass('show').hide(500);


    });

    //$("input#phone").mask("+7 (999) 999-99-99");
    $('input[name="phone"]').mask("+7 (999) 999-99-99");


    // только при инициализации osm
    if ((typeof L != "undefined") && (typeof addressPoints != "undefined")) {

        $.ajaxSetup({
            type: "post",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            dataType: "json",
            error: function (jqXHR, textStatus, errorThrown) {
                console.log('Ошибка: ' + textStatus + ' | ' + errorThrown);
            }

        })

        function getInfo(id) {
            var result = $.ajax({
                type: "post",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: '/getdata/application',
                data: {s: id},
                dataType: "json",

                success: function (msg) {
                    return msg;
                }
            })


            return result;


        }


        //Определяем карту, координаты центра и начальный масштаб
        var map = L.map('map').setView([46.529, 41.342], 6);

        if (screen.width > 960) map.scrollWheelZoom.disable();

        //Добавляем на нашу карту слой OpenStreetMap
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="http://osm.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);

        var greenIcon = L.icon({
            iconUrl: 'assets/img/marker.png',
            //shadowUrl: 'info/leaf-shadow.png',

            iconSize: [32, 32], // size of the icon
            //shadowSize:   [50, 64], // size of the shadow
            iconAnchor: [15, 27], // point of the icon which will correspond to marker's location
            //shadowAnchor: [4, 62],  // the same for the shadow
            popupAnchor: [-3, -20] // point from which the popup should open relative to the iconAnchor
        });


        var markers = new L.MarkerClusterGroup();

        for (var i = 0; i < addressPoints.length; i++) {
            var a = addressPoints[i];
            var ida = a[2];
            var marker = new L.Marker(new L.LatLng(a[0], a[1]), {id: ida, icon: greenIcon});

            markers.addLayer(marker);


            function showMarker(marker) {

                var popup = marker.target

                console.log(popup);
                r = getInfo(marker.target.options.id);
                var card;
                r.done(function (r) {
                    //r = r[0];
                    console.log(r);
                    card = '<h3>' + r.culture['name'] + '</h3>';
                    card += 'Погрузка: ' + r.load_full_address + '<br>';
                    card += 'Выгрузка: ' + r.unload_full_address + '<br>';
                    card += 'Расстояние: ' + r.distance + ' км. <br>';
                    card += 'Объем: ' + r.amount + ' т.<br>';
                    card += 'Цена: ' + r.cost + ' руб/кг. <br> <hr>';
                    card += '<b>' + r.client['org'] + '</b>';
                    console.log(r.client['phone']);

                    if (typeof r.client['phone'] == "undefined") {
                        card += '<b> <a href="/lk/application/' + r.id + '">Узнать больше</a></b>';
                    } else {
                        card += '<b> Тел: <a href="tel:' + r.client['phone'] + '">' + r.client['phone'] + '</a></b>';
                        card += '<br><b> <a class="blue-btn" href="/lk/application/' + r.id + '">Узнать больше</a></b>';
                    }


                    popup.bindPopup(card);
                    popup.openPopup();
                })


            }

            marker.on('click', showMarker);

        }

        map.addLayer(markers);


    }


    var selectinput;
    $('#loadselect, #unloadselect').select2({
        placeholder: 0,
        language: {
            noResults: function (params) {
                return "Ничего не найдено";
            },
            searching: function () {
                return "Поиск в системе ..."
            }
        },
        //minimumInputLength: 3,
        ajax: {
            type: "POST",
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            url: '/getdata/loadplace',
            data: function (params) {
                var query = {
                    s: params.term,
                    where: $(this).attr('name')
                };
                // Query parameters will be ?search=[term]&type=public
                return query;
            },

            processResults: function (data) {
                // Transforms the top-level key of the response object from 'items' to 'results'


                return {

                    results: $.map(data, function (item) {

                        console.log(item);
                        if (item.load_area || item.load_city || item.load_settlement || item.load_full_address || item.load_region) {
                            if (!item.load_area) item.load_area = '';
                            if (!item.load_city) item.load_city = '';


                            if (!item.load_settlement) item.load_settlement = '';

                            if (item.load_city) {
                                $idData = item.load_city
                            } else if (item.load_area) {
                                $idData = item.load_area
                            } else
                                $idData = item.load_settlement;

                            if (item.load_region && !item.load_full_address) {
                                return {
                                    text: item.load_region,
                                    id: item.load_region
                                }
                            }

                            return {
                                text: item.load_area + " " + item.load_full_address,
                                id: item.load_full_address
                            }
                        } // end load

                        if (item.unload_area || item.unload_city || item.unload_settlement || item.unload_full_address || item.unload_region) {
                            if (!item.unload_area) item.unload_area = '';
                            if (!item.unload_city) item.unload_city = '';
                            if (!item.unload_settlement) item.unload_settlement = '';

                            if (item.unload_city) {
                                $idData = item.unload_city
                            } else if (item.unload_area) {
                                $idData = item.unload_area
                            } else
                                $idData = item.unload_settlement;


                            if (item.unload_region && !item.unload_full_address) {
                                return {
                                    text: item.unload_region,
                                    id: item.unload_region
                                }
                            }

                            return {
                                text: item.unload_area + " " + item.unload_full_address,
                                id: item.unload_full_address
                            }
                        } // end load


                    })
                };
            }


        }
    });


    $(document).ready(function () {
        $('.loading-input-container select').select2({
            language: {
                noResults: function (params) {
                    return "Ничего не найдено";
                },
                searching: function () {
                    return "Поиск в системе ..."
                }
            }
        });


        // select region

        $('.select-region-load').on("select2:select", function (e) {

            $("#load_address").removeAttr('disabled');

            var cladr_region = e.params.data.id;
            load_address_data.constraints.locations.kladr_id = cladr_region;
            $("#load_address").suggestions(load_address_data);
            $("#load_address").removeAttr('disabled');

        });

        // select region unload

        $('.select-region-unload').on("select2:select", function (e) {

            $("#unload_address").removeAttr('disabled');

            var cladr_region = e.params.data.id;
            unload_address_data.constraints.locations.kladr_id = cladr_region;
            $("#unload_address").suggestions(unload_address_data);

        });


    });

    load_address_data = {
        token: "483b95b0ba0126846c2b39ca578caa921365e8cc",
        type: "ADDRESS",
        bounds: "city-settlement",
        constraints: {
            locations: {kladr_id: ''}
        },
        /* Вызывается, когда пользователь выбирает одну из подсказок */
        onSelect: function (suggestion) {
            console.log(suggestion);
            $('#load_address').attr('data_value', suggestion.value);
            window.dataSecure.load_full_address = true;
            $('#load_region').val(suggestion.data.region_with_type);
            $('#load_region_code').val(suggestion.data.region_kladr_id);
            $('#load_area').val(suggestion.data.area_with_type);
            $('#load_area_code').val(suggestion.data.area_kladr_id);
            $('#load_city').val(suggestion.data.city_with_type);
            $('#load_city_code').val(suggestion.data.city_kladr_id);
            $('#load_settlement').val(suggestion.data.settlement_with_type);
            $('#load_settlement_code').val(suggestion.data.settlement_kladr_id);
            $('#load_street').val(suggestion.data.street_with_type);
            $('#load_street_code').val(suggestion.data.street_kladr_id);
            $('#load_house').val(suggestion.data.house); //.getDistance();
            $('#load_lat').val(suggestion.data.geo_lat).getDistance();
            $('#load_lon').val(suggestion.data.geo_lon).getDistance();
            $("#load_place").removeAttr('disabled'); // включаем поле выбор организации
            if (suggestion.data.settlement_kladr_id) load_place_data.constraints.locations.kladr_id = suggestion.data.settlement_kladr_id;
            if (suggestion.data.city_kladr_id) load_place_data.constraints.locations.kladr_id = suggestion.data.city_kladr_id;
            $("#load_place").suggestions(load_place_data);

            if (suggestion.data.area_with_type) {
                $('#load_area_label').text(suggestion.data.area_with_type);
            } else {
                $('#load_area_label').empty();
            }


        }
    };


    var unload_address_data = {
        token: "483b95b0ba0126846c2b39ca578caa921365e8cc",
        type: "ADDRESS",
        bounds: "city-settlement",
        constraints: {
            locations: {kladr_id: ''}
        },
        /* Вызывается, когда пользователь выбирает одну из подсказок */
        onSelect: function (suggestion) {
            window.dataSecure.unload_full_address = true;
            $('#unload_address').attr('data_value', suggestion.value);
            $('#unload_region').val(suggestion.data.region_with_type);
            $('#unload_region_code').val(suggestion.data.region_kladr_id);
            $('#unload_area').val(suggestion.data.area_with_type);
            $('#unload_area_code').val(suggestion.data.area_kladr_id);
            $('#unload_city').val(suggestion.data.city_with_type);
            $('#unload_city_code').val(suggestion.data.city_kladr_id);
            $('#unload_settlement').val(suggestion.data.settlement_with_type);
            $('#unload_settlement_code').val(suggestion.data.settlement_kladr_id);
            $('#unload_street').val(suggestion.data.street_with_type);
            $('#unload_street_code').val(suggestion.data.street_kladr_id);
            $('#unload_house').val(suggestion.data.house);
            $('#unload_lat').val(suggestion.data.geo_lat).getDistance();
            $('#unload_lon').val(suggestion.data.geo_lon).getDistance();
            $("#unload_place").removeAttr('disabled'); // включаем поле выбор организации
            if (suggestion.data.settlement_kladr_id) unload_place_data.constraints.locations.kladr_id = suggestion.data.settlement_kladr_id;
            if (suggestion.data.city_kladr_id) unload_place_data.constraints.locations.kladr_id = suggestion.data.city_kladr_id;
            $("#unload_place").suggestions(unload_place_data);
            if (suggestion.data.area_with_type) {
                $('#unload_area_label').text(suggestion.data.area_with_type);
            } else {
                $('#unload_area_label').empty();
            }

        }

    }


    var load_place_data = {
        token: "483b95b0ba0126846c2b39ca578caa921365e8cc",
        type: "PARTY",
        constraints: {
            locations: {kladr_id: ''}
        },
        /* Вызывается, когда пользователь выбирает одну из подсказок */
        onSelect: function (suggestion) {
            $('#load_place').attr('data_value', suggestion.value);
            $('#load_region').val(suggestion.data.address.data.region_with_type);
            $('#load_region_code').val(suggestion.data.address.data.region_kladr_id);
            $('#load_area').val(suggestion.data.address.data.area_with_type);
            $('#load_area_code').val(suggestion.data.address.data.area_kladr_id);
            $('#load_city').val(suggestion.data.address.data.city_with_type);
            $('#load_city_code').val(suggestion.data.address.data.city_kladr_id);
            $('#load_settlement').val(suggestion.data.address.data.settlement_with_type);
            $('#load_settlement_code').val(suggestion.data.address.data.settlement_kladr_id);
            $('#load_street').val(suggestion.data.address.data.street_with_type);
            $('#load_street_code').val(suggestion.data.address.data.street_kladr_id);
            $('#load_house').val(suggestion.data.address.data.house);
            $('#load_lat').val(suggestion.data.address.data.geo_lat).getDistance();
            $('#load_lon').val(suggestion.data.address.data.geo_lon).getDistance();
        }

    };


    var unload_place_data = {
        token: "483b95b0ba0126846c2b39ca578caa921365e8cc",
        type: "PARTY",
        constraints: {
            locations: {kladr_id: ''}
        },
        /* Вызывается, когда пользователь выбирает одну из подсказок */
        onSelect: function (suggestion) {
            console.log(suggestion.data.address.data);
            window.dataSecure.unload_place = true;
            $('#unload_place').attr('data_value', suggestion.value);
            $('#unload_region').val(suggestion.data.address.data.region_with_type);
            $('#unload_region_code').val(suggestion.data.address.data.region_kladr_id);
            $('#unload_area').val(suggestion.data.address.data.area_with_type);
            $('#unload_area_code').val(suggestion.data.address.data.area_kladr_id);
            $('#unload_city').val(suggestion.data.address.data.city_with_type);
            $('#unload_city_code').val(suggestion.data.address.data.city_kladr_id);
            $('#unload_settlement').val(suggestion.data.address.data.settlement_with_type);
            $('#unload_settlement_code').val(suggestion.data.address.data.settlement_kladr_id);
            $('#unload_street').val(suggestion.data.address.data.street_with_type);
            $('#unload_street_code').val(suggestion.data.address.data.street_kladr_id);
            $('#unload_house').val(suggestion.data.address.data.house);
            $('#unload_lat').val(suggestion.data.address.data.geo_lat).getDistance();
            $('#unload_lon').val(suggestion.data.address.data.geo_lon).getDistance();
        }

    };


    $("#new_exporter").suggestions({
        token: "483b95b0ba0126846c2b39ca578caa921365e8cc",
        type: "PARTY",
        /* Вызывается, когда пользователь выбирает одну из подсказок */
        onSelect: function (suggestion) {

        }

    });

    $(".default-address").suggestions({
        token: "483b95b0ba0126846c2b39ca578caa921365e8cc",
        type: "ADDRESS",
        /* Вызывается, когда пользователь выбирает одну из подсказок */
        onSelect: function (suggestion) {

        }

    });

    function allowData() {
        if ($('#load_address').attr('data_value') != $('#load_address').val()) return false;
        //if ($('#load_place').attr('data_value') != $('#load_place').val()) return false;
        if ($('#unload_address').attr('data_value') != $('#unload_address').val()) return false;
        //if ($('#unload_place').attr('data_value') != $('#unload_place').val()) return false;
        return true;
    }


    $('#load_address').on("blur", function () {
        $('#load_address').val($('#load_address').val().trim());
    });
    $('#unload_address').on("blur", function () {
        $('#unload_address').val($('#unload_address').val().trim());
    });

    window.dataSecure = {
        load_full_address: false,
        unload_full_address: false,
        unload_place: false,


        allowSend: function () {
            console.log(allowData());
            if (this.load_full_address && this.unload_full_address && allowData()) return true; //this.unload_place
            else {

                alert("Данные не верны, поля - Населенный пункт погрузки, Населенный пункт выгрузки, - должны быть заполнены путем выбора из выпадающего списка, не допускается ввода иной информации");

            }

        }
    }


    $.fn.getDistance = function () {

        var load_lat = $('#load_lat').val();
        var load_lon = $('#load_lon').val();
        var unload_lat = $('#unload_lat').val();
        var unload_lon = $('#unload_lon').val();
        if (load_lat != '' && load_lon != '' && unload_lat != '' && unload_lon != '') {

            $.ajax({
                type: "POST",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "/getdata/distance",
                dataType: "json",
                data: {
                    load_lat: load_lat,
                    load_lon: load_lon,
                    unload_lat: unload_lat,
                    unload_lon: unload_lon
                },
                beforeSend: function () {
                    $('#distance').attr('disabled', '');
                },
                success: function (msg) {
                    $('#distance').removeAttr('disabled');
                    if (!msg.errors) {
                        $('#distance').val(msg.distance);
                    } else {
                        $('#distance').attr('placeholder', msg.message);
                    }
                },
                error: function () {
                    $('#distance').removeAttr('disabled');
                    $('#distance').attr('placeholder', 'Ошибка отправки запроса на расчет');
                },

            });

        }

    };


    // расчет расстояния


    // function FixTable(table) {
    //     var inst = this;
    //     this.table = table;
    //
    //     $('tr > th', $(this.table)).each(function (index) {
    //         var div_fixed = $('<div/>').addClass('fixtable-fixed');
    //         var div_relat = $('<div/>').addClass('fixtable-relative');
    //         div_fixed.html($(this).html());
    //         div_relat.html($(this).html());
    //         $(this).html('').append(div_fixed).append(div_relat);
    //         $(div_fixed).hide();
    //     });
    //
    //     this.StyleColumns();
    //     this.FixColumns();
    //
    //     $(window).scroll(function () {
    //         inst.FixColumns()
    //     }).resize(function () {
    //         inst.StyleColumns()
    //     });
    // }
    //
    // FixTable.prototype.StyleColumns = function () {
    //     var inst = this;
    //     $('tr > th', $(this.table)).each(function () {
    //         var div_relat = $('div.fixtable-relative', $(this));
    //         var th = $(div_relat).parent('th');
    //         $('div.fixtable-fixed', $(this)).css({
    //             'width': $(th).outerWidth(true) - parseInt($(th).css('border-left-width')) + 'px',
    //             'height': $(th).outerHeight(true) + 'px',
    //             'left': $(div_relat).offset().left - parseInt($(th).css('padding-left')) + 'px',
    //             'padding-top': $(div_relat).offset().top - $(inst.table).offset().top + 'px',
    //             'padding-left': $(th).css('padding-left'),
    //             'padding-right': $(th).css('padding-right')
    //         });
    //     });
    // }
    //
    // FixTable.prototype.FixColumns = function () {
    //     var inst = this;
    //     var show = false;
    //     var s_top = $(window).scrollTop();
    //     var h_top = $(inst.table).offset().top;
    //
    //     if (s_top < (h_top + $(inst.table).height() - $(inst.table).find('.fixtable-fixed').outerHeight()) && s_top > h_top) {
    //         show = true;
    //     }
    //
    //     $('tr > th > div.fixtable-fixed', $(this.table)).each(function () {
    //         show ? $(this).show() : $(this).hide()
    //     });
    // }
    //
    // $(document).ready(function () {
    //     $('.preloader-container').remove();
    // });
    //
    //
    // $(document).ready(function () {
    //     $('.fixtable').each(function () {
    //         new FixTable(this);
    //     });
    // });


    function correctDateEnd(date) {

        let time = new Date(((Date.parse(date) / 1000) + 1209600) * 1000);
        let time_start = new Date((Date.parse(date) / 1000) * 1000);

        var formatDate = time.getFullYear() + '-' + ('0' + (time.getMonth() + 1)).slice(-2) + '-' + ('0' + time.getDate()).slice(-2);
        var formatDate2 = time_start.getFullYear() + '-' + ('0' + (time_start.getMonth() + 1)).slice(-2) + '-' + ('0' + time_start.getDate()).slice(-2);

        $("[name='date_end']").attr('max', formatDate);
        $("[name='date_end']").attr('min', formatDate2);

        $("[name='date_end']").attr('value', formatDate);

        console.log(formatDate);

    }


    // subscribe load

    var subscribe_load_area = {
        token: "483b95b0ba0126846c2b39ca578caa921365e8cc",
        type: "ADDRESS",
        bounds: "area",
        constraints: {
            locations: {kladr_id: ''}
        },
        /* Вызывается, когда пользователь выбирает одну из подсказок */
        onSelect: function (suggestion) {

        }
    };

    $("#subscribe_load_region").suggestions({
        token: "483b95b0ba0126846c2b39ca578caa921365e8cc",
        type: "ADDRESS",
        bounds: "region",
        /* Вызывается, когда пользователь выбирает одну из подсказок */
        onSelect: function (suggestion) {
            $("#subscribe_load_area").removeAttr('disabled');

            subscribe_load_area.constraints.locations.kladr_id = suggestion.data.region_kladr_id;
            $("#subscribe_load_area").val('');
            $("#subscribe_load_area").suggestions(subscribe_load_area);
        }
    });

    // subscribe un

    var subscribe_unload_area = {
        token: "483b95b0ba0126846c2b39ca578caa921365e8cc",
        type: "ADDRESS",
        bounds: "area",
        constraints: {
            locations: {kladr_id: ''}
        },
        /* Вызывается, когда пользователь выбирает одну из подсказок */
        onSelect: function (suggestion) {
            subscribe_unload_settlement.constraints.locations.kladr_id = suggestion.data.area_kladr_id;
            subscribe_unload_settlement.bounds = 'city-settlement';
            $("#subscribe_unload_settlement").val('');
            $("#subscribe_unload_settlement").suggestions(subscribe_unload_settlement);
            $("#subscribe_unload_settlement").removeAttr('disabled');
        }
    };

    var subscribe_unload_settlement = {
        token: "483b95b0ba0126846c2b39ca578caa921365e8cc",
        type: "ADDRESS",
        bounds: "city-settlement",
        constraints: {
            locations: {kladr_id: ''}
        },
        /* Вызывается, когда пользователь выбирает одну из подсказок */
        onSelect: function (suggestion) {
            $("#subscribe_unload_org").val('');
            subscribe_unload_org.constraints.locations.kladr_id = suggestion.data.kladr_id;
            $("#subscribe_unload_org").suggestions(subscribe_unload_org);
            $("#subscribe_unload_org").removeAttr('disabled');

        }
    };


    var subscribe_unload_org = {
        token: "483b95b0ba0126846c2b39ca578caa921365e8cc",
        type: "PARTY",
        constraints: {
            locations: {kladr_id: ''}
        },
        /* Вызывается, когда пользователь выбирает одну из подсказок */
        onSelect: function (suggestion) {


        }
    };

    $("#subscribe_unload_region").suggestions({
        token: "483b95b0ba0126846c2b39ca578caa921365e8cc",
        type: "ADDRESS",
        bounds: "region",
        /* Вызывается, когда пользователь выбирает одну из подсказок */
        onSelect: function (suggestion) {
            $("#subscribe_unload_area").removeAttr('disabled');
            $("#subscribe_unload_settlement").removeAttr('disabled');
            subscribe_unload_settlement.constraints.locations.kladr_id = suggestion.data.region_kladr_id;
            subscribe_unload_settlement.bounds = 'city';
            $("#subscribe_unload_settlement").suggestions(subscribe_unload_settlement);
            subscribe_unload_area.constraints.locations.kladr_id = suggestion.data.region_kladr_id;
            $("#subscribe_unload_area").val('');
            $("#subscribe_unload_area").suggestions(subscribe_unload_area);
        }
    });

    $("#inn").suggestions({
        token: "483b95b0ba0126846c2b39ca578caa921365e8cc",
        type: "PARTY",

        /* Вызывается, когда пользователь выбирает одну из подсказок */
        onSelect: function (suggestion) {

            $('#inn').val(suggestion.data.inn);
            $('#agency_name').val(suggestion.data.name.full_with_opf);
            $('#ogrn').val(suggestion.data.ogrn);
        }
    });

    $(".del-subscr").on('click', function () {
        let status, id, type, check;
        check = $(this);
        type = $(this).attr('data-subscribe-type');
        id = $(this).attr('data-subscribe-id');
        user_id = $(this).attr('data-user-id');

        if ($(this).is(':checked')) {
            console.log(id);
            console.log('ON');
            status = 1;


        } else {
            console.log(id);
            console.log('OFF');
            status = 0;

        }

        $.ajax({
            type: "POST",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: "/lk/profile/" + user_id + "/subscribe/update/" + type + "/" + id + "?set_status=" + status,
            dataType: "json",
            beforeSend: function () {
                $(this).closest('slider').css('opacity', '0.5');
            },
            success: function (msg) {

                if (msg.status == "fail") {
                    if (status == 1) {
                        check.prop('checked', false);
                    }
                    if (status == 0) {
                        check.prop('checked', true);
                    }
                    return false;
                }

                $(this).closest('slider').css('opacity', '1');

            },
            error: function (msg) {
                alert('Ошибка отправки запроса');
                if (status == 1) {
                    check.prop('checked', false);
                }
                if (status == 0) {
                    check.prop('checked', true);
                }
            }
        });


    })


    $(".user_settings_checkbox").on('click', function () {
        let status, id, type, check;
        check = $(this);
        type = $(this).attr('data-setting');
        id = $(this).attr('data-id');

        if ($(this).is(':checked')) {
            console.log(id);
            console.log('ON');
            status = 1;


        } else {
            console.log(id);
            console.log('OFF');
            status = 0;

        }

        $.ajax({
            type: "POST",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: "/lk/profile/update/" + id + "?action=" + type + "&status=" + status,
            dataType: "json",
            beforeSend: function () {
                $(this).closest('slider').css('opacity', '0.5');
            },
            success: function (msg) {

                if (msg.status == "fail") {
                    if (status == 1) {
                        check.prop('checked', false);
                    }
                    if (status == 0) {
                        check.prop('checked', true);
                    }
                    return false;
                }

                $(this).closest('slider').css('opacity', '1');

            },
            error: function (msg) {
                alert('Ошибка отправки запроса');
                if (status == 1) {
                    check.prop('checked', false);
                }
                if (status == 0) {
                    check.prop('checked', true);
                }
            }
        });


    })


    //back-bt
    var back = $(".back");
    if (document.referrer) {
        back.show();
        back.click(function () {
            history.back();
            return false;
        })
    }

    let Map = document.querySelector("#map");
    let thead = document.querySelector('.thead-fixed')
    window.addEventListener("scroll", (event) => {
        let y = window.innerHeight / 1.5
        let Table = document.querySelector(".table").getBoundingClientRect().top
        let buttonShowMap = document.querySelector(".show-map")
        console.log(Table)
        console.log(y)
        if (Table < y) {
            Map.classList.add('hide')
            buttonShowMap.style.display = 'block'
        } else {
            Map.style.display = 'block'
        }
        buttonShowMap.onclick = function () {
            Map.classList.remove('hide')
            buttonShowMap.style.display = 'none'
        }
        if (Table < 0) {
            thead.classList.add("fix-thead");
        } else {
            thead.classList.remove("fix-thead");
        }

    });
    function ChangeType(str) {
        let _str = str.replace(/[^.+\d]/g, '');
        let num = Number(_str);
        return num;
    }

    function changeToFullWidth(target, offsetFrom) {
        let container = document.querySelector(offsetFrom);
        let _target = document.querySelector(target);
        if (_target) {
            let tmp1 = getComputedStyle(container).marginRight;
            let tmp2 = getComputedStyle(_target).width;
            let tmp3 = getComputedStyle(container).paddingRight;
            let _width = ChangeType(tmp1) + ChangeType(tmp2) + (ChangeType(tmp3) * 2 + 1);

            _target.style.width = _width + 'px';
        } else {
            return false;
        }

    }
    if (window.innerWidth > 767) {
        changeToFullWidth('.left-image-child', '.container');
        changeToFullWidth('.bg-gray-child', '.container');
        changeToFullWidth('.bg-header-child', '.container');
    }

});











