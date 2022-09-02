<?php

namespace Yemenpoint\FilamentGoogleMapLocationPicker\Forms\Components;

use Filament\Forms\Components\Field;

class LocationPicker extends Field
{
    protected string $view = 'filament-google-map-location-picker::forms.components.location-picker';

    public $defaultZoom = 8;

    public $controls = [
        'mapTypeControl' => true,
        'scaleControl' => true,
        'streetViewControl' => true,
        'rotateControl' => true,
        'fullscreenControl' => true,
        'searchBoxControl' => false
    ];

    public $defaultLocation = [
        "lat" => 15.3419776,
        "lng" => 44.2171392,
    ];

    public function getDefaultZoom()
    {
        return $this->defaultZoom;
    }

    public function setDefaultLocation(array $defaultLocation): static
    {
        $this->defaultLocation = $defaultLocation;

        return $this;
    }

    public function getDefaultLocation()
    {
        return json_encode($this->defaultLocation);
    }

    public function defaultZoom($defaultZoom)
    {
        $this->configure(function () use ($defaultZoom) {
            $this->defaultZoom = $defaultZoom;
        });

        return $this;
    }

    public function getMapControls()
    {
        return json_encode($this->controls);
    }

    public function isSearchBoxControlEnabled()
    {
        return $this->controls['searchBoxControl'];
    }

    public function mapControls(array $controls)
    {
        $this->configure(function () use ($controls) {
            $this->controls = array_merge($this->controls, $controls);
        });

        return $this;
    }

    public function getState()
    {
        $state = parent::getState();

        if (is_array($state)) {
            return $state;
        } else {
            try {
                $loc = @json_decode($state, true);
                return $loc;
            } catch (\Exception $e) {
                return $loc;
            }
        }
    }
}
