<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Brand extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'brands';
    public $timestamps = true;
    protected $fillable = ['brand_name', 'brand_image', 'rating', 'country_code', 'is_default'];
    const DEFAULT_BRAND = 1;
    const NOT_DEFAULT_BRAND = 0;


    public static $exampleBrandNames = [
        'Jackpot BOB',
        'Cresus Casino',
        'Casombie',
        'Winoui Casino',
        'Wild Sultan',
        'Vegas​Plus',
        'Ma​Chance',
        'Ruby Vegas',
        'Madnix',
        'Azur Casino',
        'Betzino',
        'Casin​ozer',
        'Neon​54',
    ];

    public static $exampleImageUrls = [
        'https://www.casinoonlinefrancais.info/cdn-cgi/image/format=auto,width=75,height=75,quality=80/img/logo300/jackpotbob-casino.png',
        'https://www.casinoonlinefrancais.info/cdn-cgi/image/format=auto,width=75,height=75,quality=80/img/logo300/Cresus-Casino.png',
        'https://www.casinoonlinefrancais.info/cdn-cgi/image/format=auto,width=75,height=75,quality=80/img/logo300/Casombie-Casino.png',
        'https://www.casinoonlinefrancais.info/cdn-cgi/image/format=auto,width=75,height=75,quality=80/img/logo300/Winoui-Casino.png',
        'https://www.casinoonlinefrancais.info/cdn-cgi/image/format=auto,width=75,height=75,quality=80/img/logo300/Wild-Sultan-Casino.png',
        'https://www.casinoonlinefrancais.info/cdn-cgi/image/format=auto,width=75,height=75,quality=80/img/logo300/vegasplus-casino.png',
        'https://www.casinoonlinefrancais.info/cdn-cgi/image/format=auto,width=75,height=75,quality=80/img/logo300/MaChance-Casino.png',
        'https://www.casinoonlinefrancais.info/cdn-cgi/image/format=auto,width=75,height=75,quality=80/img/logo300/ruby-vegas-casino.png',
        'https://www.casinoonlinefrancais.info/cdn-cgi/image/format=auto,width=75,height=75,quality=80/img/logo300/Madnix.png',
        'https://www.casinoonlinefrancais.info/cdn-cgi/image/format=auto,width=75,height=75,quality=80/img/logo300/Azur-Casino.png',
        'https://www.casinoonlinefrancais.info/cdn-cgi/image/format=auto,width=75,height=75,quality=80/img/logo300/betzino-casino.png',
        'https://www.casinoonlinefrancais.info/cdn-cgi/image/format=auto,width=75,height=75,quality=80/img/logo300/Casinozer-Casino.png',
        'https://www.casinoonlinefrancais.info/cdn-cgi/image/format=auto,width=75,height=75,quality=80/img/logo300/neon54-casino.png'
    ];


    public function getBrandImageAttribute($value)
    {
        if (blank($value)) {
            return url('img/brand_placeholder.png');
        }

        if (strpos($value, 'casinoonlinefrancais')) {
            return $value;
        }

        return url('uploads/' . $value);
    }

    public static function brandImagePath()
    {
        return [
            'image' => 'brands/images',
        ];
    }

    public static function getImagePath($image)
    {
        return str_replace(url('uploads'), '', $image);
    }
}
