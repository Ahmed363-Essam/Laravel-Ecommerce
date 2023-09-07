<x-front-layout title='Maps'>

    <x-slot name="breadcrumb">

        <div class="breadcrumbs">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-6 col-md-6 col-12">
                        <div class="breadcrumbs-content">
                            <h1 class="page-title">Order number # {{ $order->number }}</h1>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-12">
                        <ul class="breadcrumb-nav">
                            <li><a href="{{ url('/') }}"><i class="lni lni-home"></i> Home</a></li>
                            <li><a href="index.html">Orders</a></li>
                            <li> <a href="#"> {{ $order->number }} </a> </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

    </x-slot>





    <section class="checkout-wrapper section">
        <div class="container">
            <div id="map" style="height: 50vh;"></div>
        </div>
    </section>


    <script src="https://js.pusher.com/7.2/pusher.min.js"></script>


    <script>
        let marker;
        // Enable pusher logging - don't include this in production
        Pusher.logToConsole = true;

        var pusher = new Pusher('3814ada05d8027b7a06c', {
            cluster: 'eu',


        });


        var channel = pusher.subscribe('deliveries.{{ $order->id }}');
        channel.bind('location-updated', function(data) {
            marker.setPosition({
                lat: Number(data.lat),
                lng: Number(data.lng)
            });
        });
    </script>

    <script>
        // Initialize and add the map
        function initMap() {
            // The location of Delivery
            const location = {
                lat: Number("{{ $delivery->lat }}"),
                lng: Number("{{ $delivery->lng }}")
            };
            // The map, centered at Uluru
            map = new google.maps.Map(document.getElementById("map"), {
                zoom: 15,
                center: location,
            });
            // The marker, positioned at Uluru
            marker = new google.maps.Marker({
                position: location,
                map: map,
            });
        }
        window.initMap = initMap;
    </script>
    <script
        src="https://maps.googleapis.com/maps/api/js?key={{ Config::get('services.map.client_key') }}&callback=initMap&v=weekly"
        defer></script>

</x-front-layout>
