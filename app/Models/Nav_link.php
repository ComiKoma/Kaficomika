<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nav_link extends Model
{
    protected $table = 'nav_link';
    public $timestamps = 'false';
    protected $primaryKey = 'id';
    use HasFactory;

    public function navbar(){
        return $this->belongsTo(Navbar::class);
    }
}
