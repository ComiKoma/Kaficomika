<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;


class Product extends Model
{
    use HasFactory;

    protected $table = 'product';
    public $timestamps = 'false';
    protected $primaryKey = 'id';

    //mozemo i da napravimo jednu klasu u kojoj cemo timestamps postaviti na false, pa da iz nje izvodimo ostale modele
    //ili mozemo i u source fajlu da promenimo

    protected $fillable = ["pName","price", "volume", "pEngName", "pImg", "cId"];


    public function categories(){
        return $this->belongsTo(Category::class, 'cId', 'id');
    }

    public static function uploadImage($image){
        Log::error($image);
        $path = Storage::disk('public')->putFile('assets/img/product', $image);
        $exploded = explode('/', $path);
        return $exploded[count($exploded) - 1];
    }

    public static function deleteImage($image){
        Storage::disk('public')->delete('assets/img/product/' . $image);
    }

    public static function validate($request){
        $request->validate([
            'pName' => 'required|min:3|max:35',
            'price' => 'required|numeric',
            'pEngName' => 'required|min:3|max:35',
            'image' => 'required|image'
        ], [
            'required' => 'Polje :attribute je obavezno.',
            'pName.min' => 'Naziv mora imati više od :min karaktera.',
            'pName.max' => 'Naziv mora imati manje od :max karaktera.',
            'pEngName.min' => 'Englegski naziv mora imati više od :min karaktera.',
            'pEngName.max' => 'Engleski naziv mora imati manje od :max karaktera.',
            'numeric' => 'Polje :attribute mora biti broj.',
            'image.image' => 'Postavljeni fajl mora biti tipa image.'
        ]);
    }


    public function getFiltered($categories, $sortValue, $sortColumn, $productName){
        $products = Product::with('categories');

        if(is_array($categories)){
/*            $products->whereHas('categories', function ($query) use($categories){
                return $query->whereIn('id', $categories);
            });*/
            $products->whereIn('cId', $categories);
        }
        if($sortValue && $sortColumn){
            $products->orderBy($sortColumn,$sortValue);
        }

        if($productName){
            $products->where('pName', 'like', '%'.$productName.'%');

        }

        return $products;
    }
}
