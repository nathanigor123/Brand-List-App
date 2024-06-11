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
