# Google map Location Picker
forked from https://packagist.org/packages/sadiq/filament-gmap-location-picker

## Installation

You can install the package via composer:

```php
 composer require yemenpoint/filament-google-map-location-picker
```

Optionally, you can publish the config using

```php
php artisan vendor:publish --tag="filament-google-map-location-picker-config"
```
### Config
#### filament-google-map-location-picker.php
```php

<?php

return [
    'google_map_key' => "",
];


```

## make migration  location column to database
add location column to database

```php
...
        Schema::table('table_name', function (Blueprint $table) {
            $table->json("location")->nullable();
        });
...
```

```php
use Yemenpoint\FilamentGoogleMapLocationPicker\Forms\Components\LocationPicker;

...

    public static function form(Form $form): Form
    {
        return $form->schema([
              LocationPicker::make("location")->required(),
              LocationPicker::make('location')
                  ->default(json_encode(["lat" => 15.3419776, "lng" => 44.2171392]))//set default location
                  ->defaultZoom(12)// set zoom 
                  ->setLocationCenter([
                      'lat' => 15.3419776,
                      'lng' => 44.2171392,
                  ]) //set location center 
                  ->required()
                  ->columnSpan(2),
        ]);
    }
...

```
<div align="center">
    <img src="https://github.com/yemenpoint/filament-google-map-location-picker/blob/main/images/image1.png" alt="">
</div>
<br/>

####  

### Model

#### add column name to fillable 

```php
...

    protected $fillable = [
        "location"
    ];
...
```


#### if u have separate column for lat and lng add this Mutator

```php
...
    function setLocationAttribute($value)
    {
        //replace lat_column_name and lng_column_name with your column names
        $this->attributes['location'] = $value;
        $_location = @json_decode($value,true);
        $this->attributes['lat_column_name'] = data_get($_location,"lat");
        $this->attributes['lng_column_name'] = data_get($_location,"lng");
    }

...
```




## Credits

- [yemenpoint](https://github.com/yemenpoint)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
