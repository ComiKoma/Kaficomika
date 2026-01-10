<?php

namespace App\Http\Controllers;

use App\Models\Nav_link;
use App\Models\Product;
use http\Env\Response;
use Illuminate\Http\Request;

class CartController extends OsnovniController
{
    public function index(){
        return view("user.cart");
    }

    public function addToCart($pId){
        //dd(session()->get('cartItems'));
        $p = Product::findOrFail($pId);
        $cartItems = session()->get('cartItems');

        if(!$cartItems){
            $cartItems = [];
        }
        //ako postoji u korpi na kom indeksu se
        // nalazi u korpi jer je korpa obican niz

        $existingIndex = null;

        foreach ($cartItems as $index => $item){
            //da li identifikator koji smo prosledili url adresom
            // odgovara ovom indeksu u korpi
            if($item->product->id == $pId){
                $existingIndex = $index;
                break;
            }
        }

        if($existingIndex !== null){
            $cartItems[$existingIndex]->quantity++;
        }else{
            $cartItem = new \stdClass(); //pocetni proizvod u korpi
            $cartItem->quantity = 1;
            $cartItem->product = $p;

            array_push($cartItems, $cartItem);
        }


        session()->put('cartitems', $cartItems);

        return response()->json()->status(200);
    }

    public function removeFromCart($pId){
        //kada bi neko hteo da izbrise
        //iz korpe proizvod koji ne postoji
        //vraca se status code 409 - conflict

        $existingIndex = null;
        $cartItems = session()->get('cartItems');

        if(!$cartItems){
            $cartItems = [];
        }

        foreach ($cartItems as $index => $item){
            //da li identifikator koji smo prosledili url adresom
            // odgovara ovom indeksu u korpi
            if($item->product->id == $pId){
                $existingIndex = $index;
                break;
            }
        }
        if($existingIndex !== null){
            unset($cartItems[$existingIndex]);
            session()->put("cartItems", $cartItems);
            return response()->json([], 204);
        }

        return response()->json(["message" => "Ne moze da se izbrise iz korpe jer proizvod ne postoji u njoj"]);
    }

    public function changeQuantity(Request $request){
        $pId = $request->get("id");
        $quantity = $request->get("quantity");
        $existingIndex = null;
        $cartItems = session()->get('cartItems');
        if(!$cartItems){
            $cartItems = [];
        }

        foreach ($cartItems as $index => $item){
            //da li identifikator koji smo prosledili url adresom
            // odgovara ovom indeksu u korpi
            if($item->product->id == $pId){
                $existingIndex = $index;
                break;
            }
        }

        if($existingIndex !== null){
            unset($cartItems[$existingIndex]);
            session()->put("cartItems", $cartItems);
            return response()->json([], 204);
        }

    }
}
