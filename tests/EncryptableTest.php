<?php

namespace MartinBean\Eloquent\Encryptable\Tests;

use Illuminate\Support\Facades\Crypt;
use MartinBean\Eloquent\Encryptable\Tests\Stubs\BritishCitizen;
use Orchestra\Testbench\TestCase;

class EncryptableTest extends TestCase
{
    public function testItCanEncryptAndDecryptValues(): void
    {
        Crypt::shouldReceive('encrypt')->with('plaintext')->andReturn('ciphertext');
        Crypt::shouldReceive('decrypt')->with('ciphertext')->andReturn('plaintext');

        $citizen = new BritishCitizen([
            'national_insurance_number' => 'plaintext',
        ]);

        $attributes = $citizen->getAttributes();

        $this->assertEquals('ciphertext', $attributes['national_insurance_number']);
        $this->assertEquals('plaintext', $citizen->national_insurance_number);
    }
}
