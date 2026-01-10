<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder;

class Users extends Model
{
    use HasFactory;

    protected $table = 'users';
    public $timestamps = 'false';
    protected $primaryKey = 'id';

    protected $fillable = ['uName', 'uEmail', 'uPass'];

    public function useractivity()
    {
        return $this->hasMany(Useractivity::class, 'id', 'uId');
    }

    public static function validateLogin($request)
    {
        $request->validate([
            'uEmail' => 'required|min:11|max:50',
            'uPass' => 'required|min:3|max:50'
        ], [
            'required' => 'Polje :attribute je obavezno.',
            'uEmail.min' => 'Email ne sme biti kraći od :min karaktera.',
            'uEmail.max' => 'Email ne sme biti duži od :max karaktera.',
            'uPass.min' => 'Lozinka ne sme biti kraća od :min karaktera.',
            'uPass.max' => 'Lozinka ne sme biti duža od :max karaktera.'
        ]);
    }

    public static function validateStore($request)
    {
        $request->validate([
            'uName' => 'required|min:3|max:15',
            'uEmail' => 'required|unique:users|min:11|max:50',
            'uPass' => 'required|min:3|max:50'

        ], [
            'required' => 'Polje :attribute je obavezno.',
            'unique' => 'Polje :attribute mora biti jedinstveno.',
            'uName.min' => 'Ime ne sme biti kraće od :min karaktera.',
            'uName.max' => 'Ime ne sme biti duže od :max karaktera.',
            'uEmail.min' => 'Email ne sme biti kraći od :min karaktera.',
            'uEmail.max' => 'Email ne sme biti duži od :max karaktera.',
            'uPass.min' => 'Lozinka ne sme biti kraća od :min karaktera.',
            'uPass.max' => 'Lozinka ne sme biti duža od :max karaktera.'
        ]);
    }

    public function getFiltered($sortValue, $sortColumn, $uName)
    {
        $users = Users::with('useractivity');

        if ($sortValue && $sortColumn) {
            $users->orderBy($sortColumn, $sortValue);
        }

        if ($uName) {
            $users->where('uName', 'like', '%' . $uName . '%');
        }

        return $users;
    }


    public function getUserId()
    {
        return $this->id;
    }

}
