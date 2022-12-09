<?php

namespace App\Models\Clerk;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExpectedTermFee extends Model
{
    use HasFactory;
    protected $guarded = ['id','created_at','updated_at'];
}
