<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OtherFee extends Model
{
    use HasFactory;


    protected $table = 'other_fees';
    protected $primaryKey = 'other_fee_id';


    protected $fillable = [
        'description',
        'amount',
        'is_active'
    ];
    

}
