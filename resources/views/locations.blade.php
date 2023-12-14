<x-layouts.location>

    <head>
        <!-- Include Leaflet CSS -->
        <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />

        <!-- Include Leaflet JavaScript -->
        <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>

        <script src="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.js"></script>
    </head>



    @foreach ($eventsByLocation as $location => $events)
        <h2 style="font-size: 1.5rem; color: #4a5568; margin-top: 30px;">{{ $location }}</h2>
        @foreach ($events as $event)
            <div class="card" style="width: 18rem;">
                <div class="card-body">
                    <h5 class="card-title">{{ $event->title }}</h5>
                    <div id="map-{{ $event->id }}" style="height: 250px;" class="map-container"></div>
                </div>
            </div>
        @endforeach
    @endforeach


<script>
    function initMaps() {
        @foreach ($eventsByLocation as $events)
        @foreach ($events as $event)
        var coordinates = [{{ $event->latitude }}, {{ $event->longitude }}];
        var map = L.map('map-{{ $event->id }}').setView(coordinates, 13);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: '© OpenStreetMap contributors'
        }).addTo(map);

        L.marker(coordinates).addTo(map)
            .bindPopup('{{ $event->title }}')
            .openPopup();
        @endforeach
        @endforeach
    }

    document.addEventListener('DOMContentLoaded', (event) => {
        initMaps();
    });
</script>

</x-layouts.location>
