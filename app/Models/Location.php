<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Location extends Model
{
    protected $table = 'locations';
    public $timestamps = 'false';
    protected $primaryKey = 'id';
    use HasFactory;
    public function getLocations(){
        return DB::table('locations')->get();
    }
}
