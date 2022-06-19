<?php

namespace App\Http\Controllers;

use App\Models\Image;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ImageController extends Controller
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
            $req_file = $request->file;
            $req_product = $request->product ?? 1;
            $image = new Image;
            $product_image = new ProductImage;
            if (
                $this->validationNullEmpty($req_name) == true
                && $this->validationNullEmpty($req_file) == true
            ) {
                $image->name = $req_name;
                $image->file = $req_file;
                $image->save();

                $product_image->product_id = $req_product;
                $product_image->image_id = $image->id;
                $result = $product_image->save();
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
            $data = Image::with('product_images')->get();
            $req_id = $request->id;
            $req_name = $request->name;
            $req_file = $request->file;
            // return $data;
            if ($this->ValidationNullEmpty($req_id) == true) {
                $result = Image::where('id', $req_id)->update([
                    "name" => ($this->ValidationNullEmpty($req_name) == false) ? $data[$req_id - 1]->name : $req_name,
                    "file" => ($this->ValidationNullEmpty($req_file) == false) ? $data[$req_id - 1]->file : $req_file
                ]);
            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'Id Image is empty'
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
                $result = Image::destroy($req_id);
            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'Id Image is empty'
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
