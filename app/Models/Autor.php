<?php


namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Autor extends Model
{
    protected $table = 'autor';
    public $timestamps = 'false';
    protected $primaryKey = 'id';
    use HasFactory;



}
