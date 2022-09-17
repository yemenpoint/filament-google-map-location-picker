<script
        src="https://maps.googleapis.com/maps/api/js?key={{config('filament-google-map-location-picker.google_map_key')}}&libraries=places&v=weekly&language={{app()->getLocale()}}">
</script>
<script>
    function googleMapPicker(config) {
        return {
            value: config.value,
            markerLocation: {},
            zoom: config.zoom,
            init: function () {
                var defaultLocation = {!! $getDefaultLocation() !!};

                var valueLocation = JSON.parse(this?.value);

                var center = {
                    lat: valueLocation?.lat || defaultLocation.lat,
                    lng: valueLocation?.lng || defaultLocation.lng
                }

                var map = new google.maps.Map(this.$refs.map, {
                    center: center,
                    zoom: this.zoom,
                    zoomControl: false,
                    ...config.controls
                })

                var marker = new google.maps.Marker({
                    map
                });


                if (valueLocation?.lat && valueLocation?.lng) {
                    marker.setPosition(valueLocation);
                }


                map.addListener('click', (event) => {
                    this.markerLocation = event.latLng.toJSON();
                });

                if (config.controls.searchBoxControl) {
                    const input = this.$refs.pacinput;
                    const searchBox = new google.maps.places.SearchBox(input);
                    map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);
                    searchBox.addListener("places_changed", () => {
                        input.value = ''
                        this.markerLocation = searchBox.getPlaces()[0].geometry.location
                    })
                }

                this.$watch('markerLocation', () => {
                    let position = this.markerLocation;
                    this.value = position;
                    marker.setPosition(position);
                    map.panTo(position);
                })
            }

        }
    }
</script>

<x-forms::field-wrapper
        :id="$getId()"
        :label="$getLabel()"
        :label-sr-only="$isLabelHidden()"
        :helper-text="$getHelperText()"
        :hint="$getHint()"
        :hint-icon="$getHintIcon()"
        :required="$isRequired()"
        :state-path="$getStatePath()">

    <div wire:ignore x-data="googleMapPicker({
            value: $wire.entangle('{{ $getStatePath() }}'),
            zoom: {{$getDefaultZoom()}},
            controls: {{$getMapControls()}}
        })" x-init="init()">
        @if($isSearchBoxControlEnabled())
            <input x-ref="pacinput" type="text" placeholder="Search Box"/>
        @endif
        <div x-ref="map" class="w-full" style="min-height: 40vh"></div>
    </div>
</x-forms::field-wrapper>
