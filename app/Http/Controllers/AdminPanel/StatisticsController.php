<?php

namespace App\Http\Controllers\AdminPanel;
use App\Http\Requests\StoreProductRequest;
use App\Http\Controllers\OsnovniController;
use App\Models\Nav_link;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Mockery\Exception;

class StatisticsController extends OsnovniController{

    const PROD_PER_PAGE = 7;

    public function __construct()
    {
        parent::__construct();
    }

    public function index(){
        $this->logPageAccessActivity("Admin panel - Statistika");

        $this->data['adminPageLinks'] = Nav_link::all()->where('nav_admin', 1);


        return view('admin.statistics.index', $this->data);
    }

    public function show(){
        return view('admin.statistics.show', $this->data);
    }

    public function store(StoreProductRequest $request){
        DB::beginTransaction();

        try {

        }catch (Exception $e){
            Log::error($e->getMessage());
        }


    }

    public function create(){
    }

    public function edit($id){
    }

    public function update(Request $request, $id){
        try {

        }catch (Exception $e){
            Log::error($e->getMessage());
        }
    }

    public function destroy($id){
        try {

        }catch (Exception $e){
            Log::error($e->getMessage());
        }
    }

    public function getFiltered(Request $request)
    {
        //dd($request);
        $categories = $request->categories;
        //dd($categories);
        $sortValue = $request->sortValue;

        $productName = $request->productName;



        $products = $this->productsModel->getFiltered($categories, $sortValue, $productName)->paginate(self::PROD_PER_PAGE);

        return response()->json($products);
    }

}
