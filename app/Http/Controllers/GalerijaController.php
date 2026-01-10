<?php

namespace App\Http\Controllers;
use App\Models\Gallery;

class GalerijaController extends OsnovniController{
    public function index(){
        $this->data['img'] = Gallery::all();
        $this->logPageAccessActivity("Galerija");

        return view('pages.gallery.index', $this->data);
    }
}
