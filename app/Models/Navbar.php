<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Navbar extends Model
{
    use HasFactory;

    protected $table = 'navbar';
    public $timestamps = 'false';
    protected $primaryKey = 'id';

    public function nav_link(){
        return $this->hasMany(Nav_link::class);
    }
}
