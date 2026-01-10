<?php

namespace App\Http\Controllers;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facadesades\DB;

class ProductController extends OsnovniController{

    const PROD_PER_PAGE = 6;
    private $productsModel;

    protected $product;

    public function __construct()
    {
        parent::__construct();
        $this->productsModel = new Product();
    }

    public function index(){
        $this->logPageAccessActivity("Meni");

        $this->data['kategorije'] = Category::all();
        $this->data['proizvod'] = Product::orderBy('price', 'DESC')->paginate(self::PROD_PER_PAGE);

        return view('pages.product.index', $this->data);
    }

    public function show(Product $id){
        $this->logPageAccessActivity("Meni - Proizvod id: $id");

        $this->data["p"] = $id;
        $this->data['k'] = Category::find($id->cId);

        return view('pages.product.show', $this->data);
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
