<?php

namespace textagroup\dia;

use SilverStripe\ORM\DataObject;

/**
 * Model to store the following contact details
 *
 * name
 * address
 * email
 * phone
 *
 * @config
 * @var array
 */
class Contact extends DataObject
{
    private static $db = [
        'Name' => 'Varchar(255)',
        'Address' => 'Varchar(255)',
        'Email' => 'Varchar(254)',
        'Phone' => 'Varchar(32)'
    ];

    public function validate()
    {
        $result = parent::validate();

        // TODO Match up the JS validation with Server validation

        return $result;
    }
}
