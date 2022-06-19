<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\CategoryProduct;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            DB::beginTransaction();
            $req_name = $request->name;
            $req_desc = $request->desc;
            $req_enable = $request->enable ?? 1;
            $req_category = $request->category ?? 1;
            $product = new Product;
            $category_product = new CategoryProduct;
            if (
                $this->validationNullEmpty($req_name) == true
                && $this->validationNullEmpty($req_desc) == true
            ) {
                $product->name = $req_name;
                $product->description = $req_desc;
                $product->enable = $req_enable;
                $product->save();

                $category_product->category_id = $req_category;
                $category_product->product_id = $product->id;
                $result = $category_product->save();
            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'Data input is wrong'
                ]);
            }
            DB::commit();
            return response()->json([
                'status' => true,
                'message' => 'Success',
                'data' => $result
            ]);
        } catch (\Throwable $th) {
            DB::rollback();
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ProductImage  $productImage
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        try {
            DB::beginTransaction();
            $data = Product::with('category_products')->get();
            $req_id = $request->id;
            $req_name = $request->name;
            $req_desc = $request->desc;
            $req_enable = $request->enable ?? 1;
            if ($this->ValidationNullEmpty($req_id) == true) {
                $result = Product::where('id', $req_id)->update([
                    "name" => ($this->ValidationNullEmpty($req_name) == false) ? $data[$req_id - 1]->name : $req_name,
                    "description" => ($this->ValidationNullEmpty($req_desc) == false) ? $data[$req_id - 1]->description : $req_desc,
                    "enable" => ($this->ValidationNullEmpty($req_enable) == false) ? $data[$req_id - 1]->enable : $req_enable
                ]);
            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'Id Product is empty'
                ]);
            }
            DB::commit();
            return response()->json([
                'status' => true,
                'message' => 'Success',
                'data' => $result
            ]);
        } catch (\Throwable $th) {
            DB::rollback();
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ProductImage  $productImage
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        try {
            DB::beginTransaction();
            $req_id = $request->id;
            if ($this->ValidationNullEmpty($req_id) == true) {
                $result = Product::destroy($req_id);
            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'Id Product is empty'
                ]);
            }
            DB::commit();
            return response()->json([
                'status' => true,
                'message' => 'Success',
                'data' => $result
            ]);
        } catch (\Throwable $th) {
            DB::rollback();
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ]);
        }
    }

    public function ValidationNullEmpty($fill)
    {
        if ($fill == '' || $fill == null) {
            return false;
        } else {
            return true;
        }
    }
}
