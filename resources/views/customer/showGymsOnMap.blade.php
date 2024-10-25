@extends('layouts.app')
@section('content')

<div class="card">
    <div class="card-header center"><p class="">استعراض الأندية على الخريطة</p></div>
    <div class="card-body">
         <div class="container" style="margin-top: 50px;">
        <div id="map"></div>
    </div>
    </div>
   
</div>
    
    

@endsection


<script>
    function initMap() {
        const latLng = { lat: 26.2555032, lng: 44.0218632 };
        const mapOptions = {
            zoom: 10,
            center: latLng,
        };
        const map = new google.maps.Map(document.getElementById("map"), mapOptions);
        new google.maps.Marker({
            position: { lat: 26.2555032, lng: 44.0218632 },
            map: map,
            title: "نادي كل الرياضة",
        });
        new google.maps.Marker({
            position: { lat: 26.2955032, lng: 44.0369632 },
            map: map,
            title: "body motion",
        })
    }
    window.initMap = initMap;
</script>
<script
    src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_MAP_KEY') }}&callback=initMap"
    async defer>
</script>