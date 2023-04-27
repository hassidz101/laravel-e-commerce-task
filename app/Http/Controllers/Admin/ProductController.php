<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\FakerURL;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Models\Product;
use Image;

class ProductController extends Controller
{
    /*Products*/
    public function index()
    {
        $request = request();
        if ($request->ajax()) {
            $search = $request->input('search.value', '');
            $orderArray = ['id'];
            $orderByColumn = $orderArray[$request->input('order.0.column', 0)];
            $orderBy = $request->input('order.0.dir', 'asc');
            $agencies = Product::where('status',1);
            if (!empty($search)) {
                $agencies = $agencies->where(function ($query) use ($search) {
                    $query->orWhere('name', 'like', '%'. $search . '%');
                });
            }
            $agencies = $agencies->orderBy($orderByColumn, $orderBy);
            $count = $agencies->count();
            $agencies = $agencies->skip($request->start ?? 0)->take($request->length ?? 10)->get();
            return response()->json([
                'recordsTotal' => $count,
                'recordsFiltered' => $count,
                'data' => $agencies
            ], 200);
        }
        $title = 'Products';
        return view('admin.products.index',compact('title'));
    }

    public function addEditProduct($productId='')
    {
        $product = [];
        if (!empty($productId)) {
            $product = Product::findOrFail(FakerURL::id_d($productId));
            $title = 'Edit Product';
        } else {
            $title = 'Add Product';
        }
        return view('admin.products.add_edit',compact('title','product'));
    }

    public function deleteProduct($productId='')
    {
        if ($productId) {
            $product = Product::where('id',FakerURL::id_d($productId))->first();
            if (!empty($product)) {
                unlink(public_path('product-images/' . $product->image));
                $product->delete();
                return response()->json([
                    'status' => 'success',
                    'msg'    => 'Product has been deleted successfully.'
                ]);
            }
        }
        return response()->json([
            'status' => 'warning',
            'msg'    => 'Product has not been deleted.'
        ]);
    }

    public function saveProduct(ProductRequest $request, $productId='')
    {
        $imageName = '';
        if ($request->hasFile('image')) {
            $image_tmp = $request->file('image');
            if ($image_tmp->isValid()) {
                $extension = $image_tmp->getClientOriginalExtension();
                $image_name = $image_tmp->getClientOriginalName();
                $imageName = rand(111, 99999) . '.' . $extension;
                $image = public_path('product-images/' . $imageName);
                Image::make($image_tmp)->save($image);
            }
        }
        $request = $request->all();
        if (empty($imageName)) {
            unset($request['image']);
        } else {
            $request['image'] = $imageName;
        }
        if (!empty($productId)) {
            $product = Product::findOrFail(FakerURL::id_d($productId));
            $requestRes = $product->update($request);
        } else {
            $requestRes = Product::create($request);
        }
        if (!empty($requestRes)) {
            return response()->json([
                'status' => 'success',
                'msg'    => 'Product has been saved successfully.'
            ]);
        } else {
            return response()->json([
                'status' => 'warning',
                'msg'    => 'Product has not been saved.'
            ]);
        }
    }
}
