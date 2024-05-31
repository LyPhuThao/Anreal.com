<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Estate extends Model
{
    protected $fillable = ['user_id','realtype','status','area','district','address','transaction','price','contact_time','description','filename'];
    public function product(){
        return $this->belongsTo('App\User');
        }
    
}
