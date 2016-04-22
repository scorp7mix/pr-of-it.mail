<?php

namespace App\Models;

use T4\Orm\Model;

/**
 * Class User
 * @package App\Models
 *
 * @property string $email
 * @property string $password
 * @property string $firstName
 * @property string $secondName
 * @property string $lastName
 * @property string $fullName
 */
class User
    extends Model
{
    protected static $schema = [
        'columns' => [
            'email'      => ['type' => 'string'],
            'password'   => ['type' => 'string'],
            'firstName'  => ['type' => 'string'],
            'secondName' => ['type' => 'string'],
            'lastName'   => ['type' => 'string'],
        ],
    ];

    public function getFullName()
    {
        return
            ( !empty($this->firstName) && !empty($this->lastName) )
            ?
                !empty($this->secondName)
                ?
                    implode(' ', [$this->firstName, $this->secondName, $this->lastName])
                :
                    implode(' ', [$this->firstName, $this->lastName])
            :
                $this->email
            ;
    }
}