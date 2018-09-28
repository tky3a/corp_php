<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Corp extends Model
{
    use SoftDeletes;

    protected $fillable = [
      'name',
      'plan_id',
      'credit_key',
      'payment_method_id',
      'payment_status',
      'payment_date',
      'postal_code',
      'prefecture_id',
      'address1',
      'address2',
    ];

    // protected $dates = [
    //   'created_at',
    //   'updated_at',
    //   'deleted_at',
    // ];

    public function corp_users() {
      return $this->hasMany('App\Models\CorpUser');
    }

    public function credit_errorlogs() {
      return $this->hasMany('App\Models\CreditErrorlog');
    }

    public function payment_methods() {
      return $this->belongsTo('App\Models\PaymentMethod', 'payment_method_id');
    }

    public function employee_users() {
      return $this->hasMany('App\Models\EmployeeUser');
    }

    public function prefectures() {
      return $this->belongsTo('App\Models\Prefecture', 'prefecture_id');
    }

    public function plans() {
       return $this->belongsTo('App\Models\Plan','plan_id');
    }

}
