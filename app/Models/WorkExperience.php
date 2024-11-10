<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WorkExperience extends Model
{
    protected $fillable = ['applicant_id', 'company', 'role', 'start_date', 'end_date'];

    public function applicant()
    {
        return $this->belongsTo(Applicant::class);
    }
}
