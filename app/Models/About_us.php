<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class About_us extends Model
{
    protected $table = 'about_us';
    public $timestamps = 'false';
    protected $primaryKey = 'id';
    use HasFactory;
    public function aboutUs(){
        return DB::table('about_us')->get();
    }
}
