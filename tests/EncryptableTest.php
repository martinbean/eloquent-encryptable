<?php

require __DIR__.'/../vendor/autoload.php';

use Illuminate\Database\Eloquent\Model;
use Illuminate\Encryption\Encrypter;
use MartinBean\Eloquent\Encryptable;

class EncryptableTest extends PHPUnit_Framework_TestCase
{
    protected function setUp()
    {
        $key = 'tGUUkKzVnP+yvLESC2XXPbmBBaJdasrmrYgTASXiKWc=';

        $this->encrypter = new Encrypter(base64_decode($key), 'AES-256-CBC');

        BritishCitizen::setEncrypter($this->encrypter);
    }

    public function test_it_can_encrypt_and_decrypt_values()
    {
        $citizen = new BritishCitizen;

        $this->assertNull($citizen->national_insurance_number);

        $citizen->national_insurance_number = 'QQ123456C';

        $decrypted = $this->encrypter->decrypt(
            $citizen->getRawAttribute('national_insurance_number')
        );

        $this->assertEquals('QQ123456C', $decrypted);
    }
}

class BritishCitizen extends Model
{
    use Encryptable;

    protected static $encrypter;

    protected $encryptable = [
        'national_insurance_number',
    ];

    public function getRawAttribute($key)
    {
        return $this->attributes[$key];
    }

    public static function setEncrypter(Encrypter $encrypter)
    {
        static::$encrypter = $encrypter;
    }

    protected function getEncrypter()
    {
        return static::$encrypter;
    }
}
