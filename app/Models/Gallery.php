<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Gallery extends Model
{
    protected $table = 'gallery';
    public $timestamps = 'false';
    protected $primaryKey = 'id';
    use HasFactory;
    public function getGallery(){
       return DB::table('gallery')->get();
    }
}
