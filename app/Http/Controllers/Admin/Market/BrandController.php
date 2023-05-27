<?php

namespace App\Http\Controllers\Admin\Market;

use App\Models\Market\Brand;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Services\Image\ImageService;
use Intervention\Image\ImageServiceProvider;
use App\Http\Requests\Admin\Market\BrandRequest;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $brands = Brand::orderBy('created_at', 'desc')->simplePaginate(15);
        return view('Admin.market.brand.index', compact('brands'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Admin.market.brand.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BrandRequest $request, ImageService $imageServeice)
    {
        $inputs = $request->all();

        if ($request->hasFile('logo')) {
            $imageServeice->setExclusiveDirectory('images' . DIRECTORY_SEPARATOR . 'brand');
            $result = $imageServeice->createIndexAndSave($request->file('logo'));

            if ($result === false) {
                return redirect()->route('admin.content.category.index')->with('swal-error', 'اپلود عکس با خطا مواجه شد');
            }
            $inputs['logo'] = $result;
        }

        $brand = Brand::create($inputs);
        return redirect()->route('admin.market.brand.index')->with('swal-success', ' برند شما با موفقیت ایجاد شد');
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Brand $brand)
    {
        return view('Admin.market.brand.edit', compact('brand'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(BrandRequest $request, Brand $brand, ImageService $imageServeice)
    {
        $inputs = $request->all();
        if ($request->hasFile('logo')) {
            if (!empty($brand->logo)) {
                $imageServeice->deleteDirectoryAndFiles($brand->logo['directory']);
            }

            $imageServeice->setExclusiveDirectory('images' . DIRECTORY_SEPARATOR . 'brand');
            $result = $imageServeice->createIndexAndSave($request->file('logo'));

            if ($result === false) {
                return redirect()->route('admin.market.brand.index')->with('swal-error', 'اپلود عکس با خطا مواجه شد');
            }
            $inputs['logo'] = $result;
        } else {

            if (isset($inputs['currentImage']) && !empty($brand->logo)) {
                $logo = $brand->logo;
                $logo['currentImage'] = $inputs['currentImage'];
                $logo['image'] = $logo;
            }
        }

        $brand->update($inputs);
        return redirect()->route('admin.market.brand.index')->with('swal-success', ' برند شما با موفقیت اپدیت شد');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Brand $brand)
    {
        $result = $brand->delete();
        return redirect()->route('admin.market.brand.index')->with('swal-success', ' برند شما با موفقیت حذف شد');
    }

    public function status(Brand $brand)
    {
        $brand->status = $brand->status == 0 ? 1 : 0;
        $result = $brand->save();

        if ($result) {

            if ($brand->status == 0) {
                return response()->json(['status' => true, 'checked' => false]);
            } else {
                return response()->json(['status' => true, 'checked' => true]);
            }
        } else {
            return response()->json(['status' => false]);
        }
    }

}
