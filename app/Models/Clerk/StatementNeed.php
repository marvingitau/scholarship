<?php

namespace App\Models\Clerk;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class StatementNeed extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    /**
     * Get the Beneficiary that owns the FamilyDetail
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function Beneficiary(): BelongsTo
    {
        return $this->belongsTo(Beneficiaryform::class, 'beneficiary_id');
    }
}
