<?php

namespace App\Http\Controllers;

use App\Models\Location;
use Illuminate\Http\Request;

class LokacijeController extends OsnovniController
{
    public function index(){
        $this->data['loc'] = Location::all();
        $this->logPageAccessActivity("Lokacije");

        return view('pages.main.lokacije', $this->data);
    }
}
