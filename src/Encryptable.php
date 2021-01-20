<?php

namespace MartinBean\Eloquent;

use Illuminate\Support\Facades\Crypt;

trait Encryptable
{
    /**
     * Get the encryptable attributes for the model.
     *
     * @return array
     */
    public function getEncryptable()
    {
        return (array) $this->encryptable;
    }

    /**
     * Get an attribute from the model.
     *
     * @param  string  $key
     * @return mixed
     */
    public function getAttribute($key)
    {
        $value = parent::getAttribute($key);

        if (in_array($key, $this->getEncryptable()) && ! empty($value)) {
            $value = Crypt::decrypt($value);
        }

        return $value;
    }

    /**
     * Set a given attribute on the model.
     *
     * @param  string  $key
     * @param  mixed  $value
     * @return $this
     */
    public function setAttribute($key, $value)
    {
        if (in_array($key, $this->getEncryptable()) && ! empty($value)) {
            $value = Crypt::encrypt($value);
        }

        return parent::setAttribute($key, $value);
    }
}
