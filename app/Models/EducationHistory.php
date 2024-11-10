<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EducationHistory extends Model
{
    protected $fillable = ['applicant_id', 'institution', 'degree', 'year'];

    public function applicant()
    {
        return $this->belongsTo(Applicant::class);
    }
}
