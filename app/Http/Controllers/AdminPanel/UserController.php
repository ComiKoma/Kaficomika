<?php

namespace App\Http\Controllers\AdminPanel;
use App\Http\Requests\StoreProductRequest;
use App\Http\Controllers\OsnovniController;
use App\Http\Requests\StoreUserRequest;
use App\Models\Nav_link;
use App\Models\User;
use App\Models\Useractivity;
use App\Models\Users;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Mockery\Exception;

class UserController extends OsnovniController{

    const PROD_PER_PAGE = 7;
    private $usersModel;
    private $activityModel;
    protected $user;

    public function __construct()
    {
        parent::__construct();
        $this->usersModel = new Users();

    }

    public function index(){
        $this->logPageAccessActivity("Admin panel - Korisnici");

        $this->data['user']= Users::orderBy('id', 'asc')->paginate(self::PROD_PER_PAGE);

        $this->data['adminPageLinks'] = Nav_link::all()->where('nav_admin', 1);


        return view('admin.users.index', $this->data);
    }

    public function show(){
        return view('admin.users.show', $this->data);
    }

    public function store(StoreUserRequest $request){
        DB::beginTransaction();

        try {
            $pass = md5($request->uPass);

            $mailExixts = Users::where("uEmail", $request->uEmail)->first();

            if(!$mailExixts){
                Users::create($request->except('uPass') + ["uPass" => $pass]);
                DB::commit();
                return redirect()->route('users.index')->with("success", "Uspesno dodavanje korisnika.");
            }else{
                return redirect()->route('users.index')->with("error", "Korisnik sa unetim e-mailom vec postoji.");
            }

        }catch (Exception $e){
            Log::error($e->getMessage());
        }


    }

    public function create(){
        $this->logPageAccessActivity("Admin panel - Kreiraj korisnika");

        $this->data['user'] = Users::all();
        return view('admin.users.create', $this->data);

    }

    public function edit($id){
        $this->logPageAccessActivity("Admin panel - Edit korisnika id:$id");

        $this->data['user'] = Users::findOrFail($id);

        return view('admin.users.edit', $this->data);

    }

    public function update(Request $request, $id){
        try {
            $data = $request->all();
            unset($data["_token"]);
            unset($data["_method"]);

            $user = Users::find($id);

            $mailExixts = Users::where("uEmail", $request->uEmail)->first();

            if($user->id == $mailExixts->id || !$mailExixts){
                if($data["uPass"] != $user->uPass){
                    $data["uPass"] = md5($data["uPass"]);
                }
                foreach ($data as $key => $value) {
                    $user->$key = $value;
                }

                $user->save();
                return redirect()->route('users.index')->with("success", "Korisnik je uspešno izmenjen.");

            }else{
                return redirect()->route('users.index')->with("error", "Korisnik sa unetim e-mailom vec postoji.");
            }
        }catch (Exception $e){
            Log::error($e->getMessage());
            return redirect()->route('users.index')->with("error", "Neuspešna izmena korisnika.");
        }
    }

    public function destroy($id){
        try {
            Users::destroy($id);
            return redirect()->route('users.index')->with("success", "Uspesno brisanje korisnika.");

        }catch (Exception $e){
            Log::error($e->getMessage());
            return redirect()->route('users.index')->with("error", "Doslo je do greske prilikom brisanja korisnika.");
        }
    }

    public function getFiltered(Request $request)
    {
        $sortValue = $request->usrSortValue;
        $sortColumn = $request->usrSortColumn;
        $uName = $request->uName;


        $users = $this->usersModel->getFiltered($sortValue, $sortColumn, $uName)->paginate(self::PROD_PER_PAGE);

        return response()->json($users);
    }

    public function getFilteredActivity(Request $request){
        dd($request);
        $date = $request->dateOfActivity;
        $activities = $this->activityModel->getFiltered($date)->paginate(self::PROD_PER_PAGE);

        return response()->json($activities);
    }

    public function destroyActivity($id){
        try {
            Useractivity::destroy($id);
            return redirect()->route('users.activity')->with("success", "Uspesno brisanje aktivnosti.");

        }catch (Exception $e){
            Log::error($e->getMessage());
            return redirect()->route('users.activity')->with("error", "Doslo je do greske prilikom brisanja aktivnosti.");
        }
    }

    public function activity($id = null){
        if(!$id)
            return redirect()->route('users.index')->with("error", "Korisnik za prikaz aktivnosti nije pronadjen.");

        $this->data['user'] = Users::findOrFail($id);
        $this->data['activity'] = Useractivity::where("uId", $id)->paginate(self::PROD_PER_PAGE);
        $this->data['adminPageLinks'] = Nav_link::all()->where('nav_admin', 1);


        return view('admin.users.activity', $this->data);

    }


}
