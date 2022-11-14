<?php

namespace App\Models\Clerk;

use App\Models\Admin\Fees;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Beneficiaryform extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    /**
     * Get the academicinfo associated with the Beneficiaryform
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function academicinfo(): HasOne
    {
        return $this->hasOne(AcademicInfo::class, 'beneficiary_id',);
    }

    /**
     * Get the yearfee associated with the Beneficiaryform
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function yearfee(): HasOne
    {
        return $this->hasOne(Fees::class, 'beneficiary_id');
    }
}
