<?php

namespace App\Http\Controllers;

use App\Models\CategoryProduct;
use Illuminate\Support\Facades\DB;

class CategoryProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            DB::beginTransaction();
            $data = CategoryProduct::with('products', 'images', 'categories')->get();
            $result = [];
            foreach ($data as $dt) {
                array_push($result, $dt);
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
}
