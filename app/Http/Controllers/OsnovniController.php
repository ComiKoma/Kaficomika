<?php

namespace App\Http\Controllers;

use App\Models\Autor;
use App\Models\Nav_link;
use App\Models\Navbar;
use App\Models\Useractivity;
use App\Models\Users;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class OsnovniController extends Controller
{
    protected $data;
    protected $meni;
    protected $meniLink;
    protected $rola;

    public function __construct(){
        $this->data['meni'] = Navbar::all();
        $this->data['linkovi'] = Nav_link::where('nav_admin', 0)->get();
        $this->data['adminLink'] = Nav_link::where('nav_admin', 1)->where('nav_href', 'admin')->get();
    }

    public function logPageAccessActivity($page){
        try {
            if (session()->has("user"))
                $id = session("user")->getUserId();
            if (session()->has("admin"))
                $id = session("admin")->getUserId();

            Useractivity::create(["activity" => "Korisnik pristupio stranici $page", "uId" => $id]);
        }catch(\Exception $e){
            Log::error($e->getMessage());
        }
    }

    public function autor()
    {
        $this->data['autor'] = Autor::all();
        return view('pages.autor', $this->data);
    }

    public function logout(Request $request){
        try{
            if(session()->has("user")){
                $id = session("user")->getUserId();
                $request->session()->remove("user");
            }

            if(session()->has("admin")){
                $id = session("admin")->getUserId();
                $request->session()->remove("admin");
            }

            Useractivity::create(["activity" => "Korisnik se izlogovao", "uId" => $id]);

            return redirect()->route('home')->with("success", "Uspesan logout");
        }catch (\Exception $e){
            Log::error($e->getMessage());
            return redirect()->route('home')->with("error", "Neuspesan logout");
        }

    }

    public function login(Request $request){
        $request->all();
        Users::validateLogin($request);

        try{
            $user = Users::where("uEmail", $request->uEmail)->where("uPass", md5($request->uPass))->where("uStatus", 1)->first();

            if($user->uAdmin == 0)
                $request->session()->put("user", $user);

            if($user->uAdmin == 1)
                $request->session()->put("admin", $user);

            Useractivity::create(["activity" => "Korisnik se ulogovao", "uId" => $user->id]);

            return redirect()->route('home')->with("success", "Uspesan login");

        }catch (\Exception $e){
            Log::error($e->getMessage());
            return redirect()->route('home')->with("error", "Doslo je do greske prilikom logovanja.");
        }

    }

    public function register(Request $request){
        $request->all();
        //Users::validate($request);
        DB::beginTransaction();

        try{
            $pass = md5($request->uPass);

            $mailExixts = Users::where("uEmail", $request->uEmail)->first();

            if(!$mailExixts){
                $user = Users::create($request->except('uPass') + ["uPass" => $pass]);
                DB::commit();
                $request->session()->put("user", $user);
                Log::info("Uspesno ste se registrovali.");
                Useractivity::create(["activity" => "Korisnik se registrovao", "uId" => $user->id]);
                return redirect()->route('home')->with("success", "Uspesno ste se registrovali.");
            }else{
                Log::error("Korisnik sa unetim e-mailom vec postoji.");
                return redirect()->route('home')->with("error", "Korisnik sa unetim e-mailom vec postoji.");
            }

        }catch (\Exception $e){
            Log::error($e->getMessage());
            return redirect()->route('home')->with("error", "Doslo je do greske prilikom registracije.");
        }
    }
}
