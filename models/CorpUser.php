<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CorpUser extends Model
{
    use SoftDeletes;

    protected $fillable = [
      'corp_id',
      'name',
      'login_id',
      'email',
      'password',
      'remember_token',
    ];

    protected $dates = [
      'created_at',
      'updated_at',
      'deleted_at',
    ];

    public function corps() {
      return $this->belongsTo('App\Models\Corp', 'corp_id');
    }

}
