<?php


namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Useractivity extends Model
{
    use HasFactory;

    protected $table = "useractivity";
    public $timestamps = 'false';
    const UPDATED_AT = null;
    const CREATED_AT = null;
    protected $primaryKey = 'id';

    protected $fillable  = ['activity', 'lDate', 'uId'];

    public function users(){
        return $this->belongsTo(Users::class, 'uId', 'id');
    }

    public function getFiltered($date)
    {
        $activities = Useractivity::with('users');

        if ($date){
            $activities->where('lDate', $date);
        }

        return $activities;
    }


}
