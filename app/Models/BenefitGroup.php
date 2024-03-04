<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BenefitGroup extends Model
{
    use HasFactory;

    protected $with = ['benefit_types'];

    public function benefit_types()
    {
        return $this->hasMany(BenefitType::class);
    }
}
