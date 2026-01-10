<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class KontaktController extends OsnovniController
{
    public function index(){
        $this->logPageAccessActivity("Kontakt");

        return view('pages.main.kontakt', $this->data);
    }
}
