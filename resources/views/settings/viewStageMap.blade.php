@extends('layouts.app')

@section('content')
    <!-- Map Script -->
    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCGDHu1sOYoepvEmSLmatyJVGNvCCONh48&libraries=drawing&callback=initMap&v=weekly&channel=2"> </script>
    <script>
        let map;
        const coords = [];

        function initMap() {

            let stageArr = <?php echo json_encode($stageMaps); ?>;
            for (i = 0; i < stageArr.length; i++) {
                coords[i] = new google.maps.LatLng(
                    parseFloat(stageArr[i]['latitude']),
                    parseFloat(stageArr[i]['longitude'])
                );
            }

            map = new google.maps.Map(document.getElementById("map"), {
                zoom: 1,
                center: coords, // Center the map on Malaysia.
            });

            const stageMaps = new google.maps.Polygon({
                paths: coords,
                strokeColor: "#FF0000",
                strokeOpacity: 0.8,
                strokeWeight: 3,
                fillColor: "#FF0000",
                fillOpacity: 0.35,
            });
            stageMaps.setMap(map);
        }
    </script>

    <div class="row">
        @if (session()->has('message'))
            <div class="alert alert-success">
                {{ session('message') }}
            </div>
        @endif
        <div class="main py-4">
            <div class="d-block mb-md-0" style="position: relative">
                <h2>View Stage Map for <span>{{ $stage->route->route_name }}</span></h2>
            </div>
            <div class="card card-body border-0 shadow table-wrapper table-responsive">
                <table class="table table-hover">
                    <thead>
                    <th class="border-gray-200">{{ __('Company Name:') }}</th>
                    <th class="border-gray-200"><span class="badge bg-primary">{{ $stage->route->company->company_name }}</span></th>
                    <th class="border-gray-200">{{ __('Route Name:') }}</th>
                    <th class="border-gray-200"><span class="badge bg-primary">{{ $stage->route->route_name }}</span></th>
                    </thead>
                    <tbody>
                    <tr>
                        <td colspan="4"><span class="fw-normal">Stage Map:</span></td>
                    </tr>
                    <tr>
                        <td colspan="4">
                            <div id="map"></div>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="4">
                            <div class="d-block mb-md-0" style="position: relative">
                                <input type="button" onclick="window.history.back()" class="btn btn-warning" value="Back">
                            </div>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
