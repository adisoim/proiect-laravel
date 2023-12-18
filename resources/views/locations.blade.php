<x-layouts.location>

    <head>
        <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
        <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
        <script src="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.js"></script>
    </head>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @foreach ($eventsByLocation as $location => $events)
                <h2 class="text-lg font-semibold text-gray-900 mt-6 mb-2">{{ $location }}</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                    @foreach ($events as $event)
                        <div class="bg-white overflow-hidden shadow rounded-lg">
                            <div class="px-4 py-5 sm:p-6">
                                <h3 class="text-lg leading-6 font-medium text-gray-900">
                                    {{ $event->title }}
                                </h3>
                                <div id="map-{{ $event->id }}" class="mt-2 h-64"></div>
                            </div>
                        </div>


<script>
    function geocodeLocation(location, mapId) {
        fetch(`https://nominatim.openstreetmap.org/search?format=json&q=${encodeURIComponent(location)}`)
            .then(response => response.json())
            .then(data => {
                if (data.length > 0) {
                    var coordinates = [data[0].lat, data[0].lon];
                    var map = L.map(mapId).setView(coordinates, 13);

                    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                        maxZoom: 19,
                        attribution: '© OpenStreetMap'
                    }).addTo(map);

                    L.marker(coordinates).addTo(map);
                }
            })
            .catch(error => console.error('Error:', error));
    }

    document.addEventListener('DOMContentLoaded', (event) => {
        @foreach ($eventsByLocation as $events)
        @foreach ($events as $event)
        geocodeLocation("{{ $event->location }}", 'map-{{ $event->id }}');
        @endforeach
        @endforeach
    });

</script>

                    @endforeach
                </div>
            @endforeach
        </div>
    </div>

</x-layouts.location>
