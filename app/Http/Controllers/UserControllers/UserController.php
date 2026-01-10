<?php

namespace App\Http\Controllers\UserControllers;
use App\Http\Controllers\OsnovniController;
use App\Models\Users;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Mockery\Exception;

class UserController extends OsnovniController
{
    protected $user;

    public function index(){
        return view('pages.user.index', $this->data);
    }

    public function update(Request $request, $id){
        //dd($id);
        //Users::validateLogin($request);
        try {
            $data = $request->all();
            unset($data["_token"]);
            unset($data["_method"]);
            //dd($data["uStatus"]);

            if($data["uPass"]){
                $data["uPass"] = md5($data["uPass"]);
            }else{
                unset($data["uPass"]);
            }

            if($data["uEmail"]){
                $data["uEmail"];
            }else{
                unset($data["uPass"]);
            }

            $user = Users::find($id);

            foreach ($data as $key => $value) {
                $user->$key = $value;
            }

            $user->save();
            if(session()->has("user") )
                $rola = "user";
            if(session()->has("admin"))
                $rola = "admin";


            if($data["uStatus"] == 1){
                $request->session()->put($rola, $user);
                return redirect()->route('user')->with("success", "Profil je uspešno izmenjen.");
            }else{
                try{
                    $request->session()->remove($rola);
                    return redirect()->route('home')->with("success", "Uspesna deaktivacija");
                }catch (\Exception $e){
                    Log::error($e->getMessage());
                    return redirect()->route('home')->with("error", "Neuspesna deaktivacija");
                }
            }


        }catch (Exception $e){
            Log::error($e->getMessage());
            return redirect()->route('user')->with("error", "Greška pri izmeni profila.");

        }
    }
}
