# Eloquent Encryptable trait
Adds encryptable attributes to Eloquent models, for storing sensitive data.

## Usage
Simply add the trait to your Eloquent model, and define an array of attributes
whose values should be encrypted in your database in an `$encryptable` property:

```php
<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use MartinBean\Eloquent\Encryptable;

class Patient extends Model
{
    use Encryptable;

    protected $encryptable = [
        'medical_conditions',
        'medical_notes',
        'allergies_and_reactions',
        'medications',
        'blood_type',
        'is_organ_donor',
        'emergency_contact_id',
    ];
}
```

You can retrieve these attributes as normal and they’ll be decrypted:

```php
$medical_conditions = $patient->medical_conditions;
```

## License
Licensed under the MIT License.

## Support
Please [create an Issue][1] for any problems with this library.

[1]: https://github.com/martinbean/eloquent-encryptable/issues/new
