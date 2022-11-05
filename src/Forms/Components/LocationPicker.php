<?php

namespace Yemenpoint\FilamentGoogleMapLocationPicker\Forms\Components;

use Exception;
use Filament\Forms\Components\Field;
use JsonException;

class LocationPicker extends Field
{

    protected string $view = 'filament-google-map-location-picker::forms.components.location-picker';

    public int $defaultZoom = 8;

    public array $controls = [
        'mapTypeControl' => true,
        'scaleControl' => true,
        'streetViewControl' => true,
        'rotateControl' => true,
        'fullscreenControl' => true,
        'zoomControl' => true,
        'searchBoxControl' => false
    ];

    public array $locationCenter = [
        'lat' => 15.3419776,
        'lng' => 44.2171392,
    ];

    public function getDefaultZoom(): int
    {
        return $this->defaultZoom;
    }

    public function getLocationCenter(): string
    {
        return json_encode($this->locationCenter, JSON_THROW_ON_ERROR);
    }

    public function setLocationCenter(array $locationCenter): static
    {
        $this->locationCenter = $locationCenter;

        return $this;
    }

    public function defaultZoom(int $defaultZoom): static
    {
        $this->defaultZoom = $defaultZoom;

        return $this;
    }

    /**
     * @throws JsonException
     */
    public function getMapControls(): string
    {
        return json_encode($this->controls, JSON_THROW_ON_ERROR);
    }

    public function isSearchBoxControlEnabled(): bool
    {
        return $this->controls['searchBoxControl'];
    }

    public function mapControls(array $controls): static
    {
        $this->controls = array_merge($this->controls, $controls);

        return $this;
    }

    public function getState()
    {
        $state = parent::getState();

        if (is_array($state)) {
            return json_encode($state);
        } else {
            try {
                return $state;
            } catch (Exception $e) {
                return json_encode([
                    'lat' => 0,
                    'lng' => 0
                ]);
            }
        }
    }
}
