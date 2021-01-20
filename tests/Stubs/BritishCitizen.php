<?php

namespace MartinBean\Eloquent\Encryptable\Tests\Stubs;

use Illuminate\Database\Eloquent\Model;
use MartinBean\Eloquent\Encryptable;

class BritishCitizen extends Model
{
    use Encryptable;

    protected $fillable = [
        'national_insurance_number',
    ];

    protected $encryptable = [
        'national_insurance_number',
    ];
}
