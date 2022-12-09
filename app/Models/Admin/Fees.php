<?php

namespace App\Models\Admin;

use App\Models\Clerk\Beneficiaryform;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Fees extends Model
{
    use HasFactory;

    protected $guarded = ['id','created_at','updated_at'];

    /**
     * Get the beneficiary that owns the Fees
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function beneficiary(): BelongsTo
    {
        return $this->belongsTo(Beneficiaryform::class);
    }
}
