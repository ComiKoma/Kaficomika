<?php

namespace App\Http\Controllers;
use App\Models\About_us;
use Illuminate\Http\Request;

class OnamaController extends OsnovniController
{
    public function index(){
        $this->data['onama'] = About_us::all();
        $this->logPageAccessActivity("O nama");

        return view('pages.main.onama', $this->data);
    }
}
