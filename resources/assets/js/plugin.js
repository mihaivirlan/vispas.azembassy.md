'use strict';
// import gmap from './components/googlemap';
Vue.component('modal', {
    template: '\n    <transition name="modal">\n        <div class="modal-mask" @click="$emit(\'close\')">\n            <div class="modal-wrapper">\n                <div class="modal-container">\n                    <div class="modal-close" @click="$emit(\'close\')">\n                        <svg width="20" version="1.1" xmlns="http://www.w3.org/2000/svg" height="20" viewBox="0 0 64 64" xmlns:xlink="http://www.w3.org/1999/xlink" enable-background="new 0 0 64 64">\n                          <g>\n                            <path  d="M28.941,31.786L0.613,60.114c-0.787,0.787-0.787,2.062,0,2.849c0.393,0.394,0.909,0.59,1.424,0.59   c0.516,0,1.031-0.196,1.424-0.59l28.541-28.541l28.541,28.541c0.394,0.394,0.909,0.59,1.424,0.59c0.515,0,1.031-0.196,1.424-0.59   c0.787-0.787,0.787-2.062,0-2.849L35.064,31.786L63.41,3.438c0.787-0.787,0.787-2.062,0-2.849c-0.787-0.786-2.062-0.786-2.848,0   L32.003,29.15L3.441,0.59c-0.787-0.786-2.061-0.786-2.848,0c-0.787,0.787-0.787,2.062,0,2.849L28.941,31.786z"/>\n                          </g>\n                        </svg>\n                    </div>\n                    <div class="modal-body" @click.stop><slot></slot></div>\n                </div>\n            </div>\n        </div>\n    </transition>'
});

if(document.getElementById('slider')){
    $('#slider').slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        arrows: true,
        fade: true,
        swipe:true,
        dots:true,
        nextArrow:`<div class="arrow arrow-next">
						<svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
							 viewBox="0 0 47.255 47.255" style="enable-background:new 0 0 47.255 47.255;" xml:space="preserve">
							<path d="M12.314,47.255c-0.256,0-0.512-0.098-0.707-0.293c-0.391-0.391-0.391-1.023,0-1.414l21.92-21.92l-21.92-21.92
								c-0.391-0.391-0.391-1.023,0-1.414s1.023-0.391,1.414,0L35.648,22.92c0.391,0.391,0.391,1.023,0,1.414L13.021,46.962
								C12.825,47.157,12.57,47.255,12.314,47.255z"/>
						</svg>
					</div>`,
        prevArrow:`<div class="arrow arrow-prev">
							<svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
								 viewBox="0 0 47.255 47.255" style="enable-background:new 0 0 47.255 47.255;" xml:space="preserve">
								<path d="M12.314,47.255c-0.256,0-0.512-0.098-0.707-0.293c-0.391-0.391-0.391-1.023,0-1.414l21.92-21.92l-21.92-21.92
									c-0.391-0.391-0.391-1.023,0-1.414s1.023-0.391,1.414,0L35.648,22.92c0.391,0.391,0.391,1.023,0,1.414L13.021,46.962
									C12.825,47.157,12.57,47.255,12.314,47.255z"/>
							</svg>
						</div>`,
    });
    $('#slider').css('opacity','1');
}

if(document.getElementById('services')){

    function LoadMap() {
        var marker_image = '/img/pin.png';

        var markers = marker();
        var mapOptions = {
            center: new google.maps.LatLng(markers[0].lat, markers[0].lng),
            zoom: 15, //Not required.
            mapTypeId: google.maps.MapTypeId.ROADMAP
        };
        var infoWindow = new google.maps.InfoWindow();
        var map = new google.maps.Map(document.getElementById("map"), mapOptions);

        //Create LatLngBounds object.
        var latlngbounds = new google.maps.LatLngBounds();

        for (var i = 0; i < markers.length; i++) {
            var data = markers[i]
            var myLatlng = new google.maps.LatLng(data.lat, data.lng);
            var marker = new google.maps.Marker({
                position: myLatlng,
                map: map,
                title: data.title,
                icon: marker_image
            });

            (function (marker, data) {
                google.maps.event.addListener(marker, "click", function (e) {
                    //infoWindow.setContent("<div style = 'width:200px;min-height:40px'>" + data.description + "</div>");
                    infoWindow.setContent("<div style = 'width:200px;min-height:40px'>" + data.title + "</div>");
                    infoWindow.open(map, marker);
                });
            })(marker, data);

            //Extend each marker's position in LatLngBounds object.
            latlngbounds.extend(marker.position);
        }

        //Get the boundaries of the Map.
        var bounds = new google.maps.LatLngBounds();

        //Center map and adjust Zoom based on the position of all markers.
        map.setCenter(latlngbounds.getCenter());
        if (markers.length != 1) map.fitBounds(latlngbounds);

        function marker(){
            var marker_massiv = [];
            var activ_massiv = [];
            var i = 0;
            var activ = false;
            $('.office').each(function(){
                if (!$(this).hasClass('hide_office')){
                    marker_massiv[i] = [];
                    marker_massiv[i]['lat'] = $(this).attr('data-y');
                    marker_massiv[i]['lng'] = $(this).attr('data-x');
                    marker_massiv[i]['title'] = $(this).find('.adress').html();
                    i++;
                }
                if ($(this).hasClass('active')){
                    activ = true;
                    activ_massiv[0] = [];
                    activ_massiv[0]['lat'] = $(this).attr('data-y');
                    activ_massiv[0]['lng'] = $(this).attr('data-x');
                    activ_massiv[0]['title'] = $(this).find('.adress').html();
                    i++;
                }
            });
            if (activ == true) return activ_massiv;
            else return marker_massiv;
        }
    }
    window.loadMap = LoadMap;
    window.servicemap = new Vue({
        el:'#services',
        data:{
            city:'city_4',
            dist:'all',
            tab: 1,
            slug:''
        },
        watch:{
            city(){
                this.dist = 'all'
                setTimeout(function(){
                    loadMap();
                },100)
            },
            dist(){
                setTimeout(function(){
                    loadMap();
                },100)
            },
            tab(val){
                if(val == 1){
                    setTimeout(function(){
                        loadMap();
                    },100)
                }
            }
        },
        methods:{
            checkDisplay(city,dist){
                if(city == this.city && dist == this.dist || city == this.city && this.dist == 'all'){
                    return false
                }else{
                    return true
                }
            },
            change(event){
                if($(event.currentTarget).hasClass('active')){
                    $('.office').removeClass('active');
                    LoadMap();
                }
                else{
                    $('.office').removeClass('active');
                    $(event.currentTarget).addClass('active');
                    LoadMap();
                }
            },
            slugs(slug){
                History(slug)
            }
        },
    });
}