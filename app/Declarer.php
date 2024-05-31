<?php
namespace App;
use Illuminate\Database\Eloquent\Model;

class Declarer extends Model
{
    protected $fillable = ['phone','cusname','contact_time','email'];
    
    public function ProDetail()
    {
    return $this->hasOne('App\Estate','item_id');
    
        }
}
