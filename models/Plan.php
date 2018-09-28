<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Plan extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name',
        'max_number',
        'price'];

    protected $dates = ['created_at', 'updated_at', 'deleted_at'];

    public function corp(){
        // return $this->belongsTo(Corp::class);
        return $this->hasMany('App/Models/Corp', 'corp_id');
    }
}
