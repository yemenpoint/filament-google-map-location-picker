<?php

namespace Yemenpoint\FilamentGoogleMapLocationPicker;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class FilamentLocationPickerServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {

        $package
            ->name('filament-google-map-location-picker')
            ->hasConfigFile()
            ->hasViews();
    }
}
