<?php

namespace App\Http\Controllers\Admin\Market;

use Illuminate\Http\Request;
use App\Models\Market\Product;
use App\Http\Controllers\Controller;
use App\Http\Services\Image\ImageService;
use App\Models\Market\Gallery;

class GalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Product $product)
    {
        return view('Admin.market.product.gallery.index', compact('product'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Product $product)
    {
        return view('Admin.market.product.gallery.create', compact('product'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, ImageService $imageService, Product $product)
    {
        $validated = $request->validate([
            'image' => 'image|mimes:png,jpg,jpeg,gif',
        ]);

        $inputs = $request->all();

        //set image
        if ($request->hasFile('image')) {
            $imageService->setExclusiveDirectory('images' . DIRECTORY_SEPARATOR . 'product-gallery');
            $result = $imageService->createIndexAndSave($request->file('image'));

            if ($result === false) {
                return redirect()->route('admin.market.gallery.index',$product->id)->with('swal-error', 'اپلود عکس با خطا مواجه شد');
            }

            $inputs['image'] = $result;
        }

        $inputs['product_id'] = $product->id;
        $result = Gallery::create($inputs);

        return redirect()->route('admin.market.gallery.index',$product->id)->with('swal-success', 'عکس شما با موفقیت ایجاد شد');
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
    public function edit( Product $product,Gallery $gallery)
    {
        return view('Admin.market.product.gallery.edit', compact('product','gallery'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ImageService $imageService, Product $product, Gallery $gallery)
    {

        $validated = $request->validate([
            'image' => 'image|mimes:png,jpg,jpeg,gif',
        ]);


        if ($request->hasFile('image')) {
            if (!empty($gallery->image)) {
                $imageService->deleteDirectoryAndFiles($gallery->image['directory']);            }

            $imageService->setExclusiveDirectory('images' . DIRECTORY_SEPARATOR . 'product-gallery');
            $result = $imageService->createIndexAndSave($request->file('image'));

            if ($result === false) {
                return redirect()->route('admin.market.gallery.index',$product->id)->with('swal-error', 'اپلود عکس با خطا مواجه شد');
            }

            $inputs['image'] = $result;
        } else {
            if (isset($inputs['currentImage']) && !empty($gallery->image)) {
                $image = $gallery->image;
                $image['currentImage'] = $inputs['currentImage'];
                $inputs['image'] = $image;
            }
        }
        $gallery->update($inputs);
        return redirect()->route('admin.market.gallery.index',$product->id)->with('swal-success', 'عکس شما با موفقیت اپدیت شد');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product, Gallery $gallery)
    {
        $result = $gallery->delete();
        return redirect()->route('admin.market.gallery.index',$product->id)->with('swal-success', ' عکس شما با موفقیت حذف شد');
    }
}
