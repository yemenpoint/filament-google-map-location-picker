# Google map Location Picker
#### forked from https://packagist.org/packages/sadiq/filament-gmap-location-picker

## Installation

You can install the package via composer:

```bash
 composer require yemenpoint/filament-google-map-location-picker
```

Optionally, you can publish the config using

```bash
php artisan vendor:publish --tag="filament-google-map-location-picker-config"
```

## Usage

```php
use Yemenpoint\FilamentGoogleMapLocationPicker\Forms\Components\LocationPicker;

...
    protected function getFormSchema(): array
    {
        return [
                LocationPicker::make("location")->required(),
        ];
    }
...
```

<div align="center">
    <img src="https://github.com/yemenpoint/filament-google-map-location-picker/blob/main/images/image1.png" alt="">
</div>
<br/>

####  

### Model

#### replace lat_column_name and lng_column_name with your column names

```php
...


    protected $appends = [
        "location"
    ];
    
    protected $fillable = [
        "location"
    ];
    
    function getLocationAttribute($value)
    {
    //replace lat_column_name and lng_column_name with your column names
        return json_encode([
            "lat" => (float)$this->lat_column_name,
            "lng" => (float)$this->lng_column_name,
        ]);
    }

    function setLocationAttribute($value)
    {
    //replace lat_column_name and lng_column_name with your column names
        $this->attributes['lat_column_name'] = $value["lat"];
        $this->attributes['lng_column_name'] = $value["lng"];
    }

...
```

## Credits

- [yemenpoint](https://github.com/yemenpoint)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
