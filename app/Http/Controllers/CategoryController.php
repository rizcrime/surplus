<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
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
            $req_enable = $request->enable ?? 1;
            if ($this->validationNullEmpty($req_name) == true) {
                $result = Category::create([
                    "name" => $req_name,
                    "enable" => $req_enable,
                ]);
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
            $data = Category::with('category_products')->get();
            $req_id = $request->id;
            $req_name = $request->name;
            $req_enable = $request->enable ?? 1;
            if ($this->ValidationNullEmpty($req_id) == true) {
                $result = Category::where('id', $req_id)->update([
                    "name" => ($this->ValidationNullEmpty($req_name) == false) ? $data[$req_id - 1]->name : $req_name,
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
                $result = Category::destroy($req_id);
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
