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

class ProductController extends OsnovniController{

    const PROD_PER_PAGE = 7;
    private $productsModel;

    protected $product;

    public function __construct()
    {
        parent::__construct();
        $this->productsModel = new Product();
    }

    public function index(Request $request){
        $this->logPageAccessActivity("Admin panel - Proizvodi");


        $this->data['adminPageLinks'] = Nav_link::all()->where('nav_admin', 1);

        $this->data['proizvod']= Product::orderBy('id', 'asc')->paginate(self::PROD_PER_PAGE);

        $this->data['kategorije'] = Category::all();

        return view('admin.products.index',
            ['proizvod' => $this->data['proizvod'],
            'linkovi' => $this->data['linkovi'],
            'adminLink' => $this->data['adminLink'],
            'meni' => $this->data['meni'],
            'adminPageLinks' => $this->data['adminPageLinks']]);
    }

    public function store(StoreProductRequest $request){
        DB::beginTransaction();

        try {
            Log::error($request);
            Log::error($request->pImg);


            $image = Product::uploadImage($request->pImg);
            $proizvod = Product::create($request->except('pImg') + ["pImg" => $image]);
            DB::commit();

            //$proizvod->save();

            return redirect()->route('products.index')->with("success", "Uspesno dodavanje proizvoda.");


        }catch (Exception $e){
            Log::error($e->getMessage());
            DB::rollBack();
            return redirect()->route('products.index')->with("error", "Doslo je do greske prilikom dodavanja proizvoda.");
        }


    }

    public function create(){
        $this->logPageAccessActivity("Admin panel - Kreiraj proizvod");

        return view('admin.products.create', [
            'proizvodi' => Product::all(),
            'kategorije' => Category::all(),
            'adminLink' => $this->data['adminLink'],
            'linkovi' => $this->data['linkovi'],
            'meni' => $this->data['meni']
        ]);


    }

    public function edit($id){
        $this->logPageAccessActivity("Admin panel - Izmena proizvoda id:$id");

        return view('admin.products.edit',[
            'proizvodi' => Product::findOrFail($id), //automatski vraca 404 ako ne postoji
            'kategorije' => Category::all(),
            'adminLink' => $this->data['adminLink'],
            'linkovi' => $this->data['linkovi'],
            'meni' => $this->data['meni']
        ]);
    }

    public function update(Request $request, $id){
        try {
            $data = $request->all();
            unset($data["_token"]);
            unset($data["_method"]);

            $product = Product::find($id);

            foreach($data as $key => $value){
                $product->$key = $value;
            }

            $product->save();
            return redirect()->route('products.index')->with("success", "Proizvod je uspešno izmenjen.");

        }catch (Exception $e){
            Log::error($e->getMessage());
            return redirect()->route('products.index')->with("error", "Doslo je do greske prilikom brisanja proizvoda.");
        }
    }

    public function destroy($id){
        try {
            Product::destroy($id);
            return redirect()->route('products.index')->with("success", "Uspesno brisanje proizvoda.");

        }catch (Exception $e){
            Log::error($e->getMessage()); //greska se upisuje u log fajl
            return redirect()->route('products.index')->with("error", "Doslo je do greske prilikom brisanja proizvoda.");
        }
    }

    public function getFiltered(Request $request)
    {
        $categories = $request->categories;
        $sortValue = $request->sortValue;
        $sortColumn = $request->sortColumn;
        $productName = $request->productName;

        $products = $this->productsModel->getFiltered($categories, $sortValue, $sortColumn, $productName)->paginate(self::PROD_PER_PAGE);

        return response()->json($products);
    }


}
