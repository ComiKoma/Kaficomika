<?php

namespace App\Http\Controllers;

use App\Models\Nav_link;
use Illuminate\Http\Request;

class AdminController extends OsnovniController
{
    public function index(){
        $this->data['adminPageLinks'] = Nav_link::all()->where('nav_admin', 1);

        $this->logPageAccessActivity("Admin panel");

        return view('pages.admin.index', $this->data);
    }
}
