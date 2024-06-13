<?php

namespace App\Http\Controllers\Brand;

use App\Classes\ApiResponseClass;
use App\Http\Controllers\Controller;
use App\Http\Requests\Brand\StoreBrandRequest;
use App\Http\Requests\Brand\UpdateBrandRequest;
use App\Http\Resources\BrandResource;
use App\Interfaces\BrandRepositoryInterface;
use App\Models\Brand;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class BrandController extends Controller
{

    private BrandRepositoryInterface $brandRepositoryInterface;

    protected $userCountryCode;

    public function __construct(BrandRepositoryInterface $brandRepositoryInterface)
    {
        $this->brandRepositoryInterface = $brandRepositoryInterface;

        $ipAddress = request()->getClientIp();

        $this->userCountryCode = request()->hasHeader('CF-IPCountry') ? request()->header('CF-IPCountry') : null;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = $this->brandRepositoryInterface->index();

        return ApiResponseClass::sendResponse(BrandResource::collection($data), '', 200);
    }

    /**
     * Display a listing of the resource based on geolocation.
     */
    public function getTopListByCountry()
    {

        $data = $this->brandRepositoryInterface->getTopListByCountry($this->userCountryCode);

        return ApiResponseClass::sendResponse(BrandResource::collection($data), '', 200);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBrandRequest $request)
    {
        $data = $request->validated();

        if ($request->hasFile('brand_image')) {

            $fileImage = request()->file('brand_image');

            $brandImagePath = Brand::brandImagePath();

            $pathImage = $brandImagePath['image'];

            $path = Storage::disk('images')->put($pathImage, $fileImage);

            $data['brand_image'] = $path;
        }

        if ($this->userCountryCode) {

            $data['country_code'] = $this->userCountryCode;

            $data['is_default'] = Brand::NOT_DEFAULT_BRAND;
        }

        DB::beginTransaction();

        try {
            $brand = $this->brandRepositoryInterface->store($data);

            DB::commit();

            return ApiResponseClass::sendResponse(new BrandResource($brand), 'Brand Create Successful', 201);
        } catch (\Exception $ex) {

            return ApiResponseClass::rollback($ex);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Brand $brand)
    {
        $brand = $this->brandRepositoryInterface->show($brand->id);

        return ApiResponseClass::sendResponse(new BrandResource($brand), '', 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBrandRequest $request, Brand $brand)
    {
        $data = $request->validated();

        if ($request->hasFile('brand_image')) {


            $fileImage = request()->file('brand_image');

            $brandImagePath = Brand::brandImagePath();

            $pathImage = $brandImagePath['image'];

            if (!blank($brand->brand_image) && strpos($brand->brand_image, $pathImage)) {

                Storage::disk('images')->delete(Brand::getImagePath($brand->brand_image));
            }

            $path = Storage::disk('images')->put($pathImage, $fileImage);

            $data['brand_image'] = $path;
        }

        if ($this->userCountryCode) {

            $data['country_code'] = $this->userCountryCode;

            $data['is_default'] = Brand::NOT_DEFAULT_BRAND;
        }

        DB::beginTransaction();

        try {
            $brand = $this->brandRepositoryInterface->update($data, $brand->id);

            DB::commit();

            return ApiResponseClass::sendResponse(new BrandResource($brand), 'Brand Update Successful', 201);
        } catch (\Exception $ex) {

            return ApiResponseClass::rollback($ex);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Brand $brand)
    {

        $this->brandRepositoryInterface->delete($brand->id);

        return ApiResponseClass::sendResponse('Brand Delete Successful', '', 204);
    }
}
