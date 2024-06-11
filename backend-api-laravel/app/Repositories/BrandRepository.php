<?php

namespace App\Repositories;

use App\Interfaces\BrandRepositoryInterface;
use App\Models\Brand;
use Illuminate\Support\Facades\Storage;

class BrandRepository implements BrandRepositoryInterface
{
    public function index()
    {
        return Brand::all();
    }

    public function show($id)
    {
       return Brand::findOrFail($id);
    }

    public function getTopListByCountry($userCountryCode)
    {

        if ($userCountryCode) {

            $brands = Brand::orderBy('rating', 'desc')->where('country_code', $userCountryCode)->get();

        } else {

            $brands = Brand::orderBy('rating', 'desc')->where('is_default', Brand::DEFAULT_BRAND)->get();
        }

        return  $brands;
    }

    public function store(array $data)
    {
        return Brand::create($data);
    }

    public function update(array $data, $id)
    {
        return Brand::whereId($id)->update($data);
    }

    public function delete($id)
    {
        $brand = Brand::find($id);

        $brandImagePath = Brand::brandImagePath();

        $pathImage = $brandImagePath['image'];

        if (!blank($brand->brand_image) && strpos($brand->brand_image, $pathImage)) {

            Storage::disk('images')->delete(Brand::getImagePath($brand->brand_image));
        }

        $brand->delete();

        return  $brand;
    }
}
