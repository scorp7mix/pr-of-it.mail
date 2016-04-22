<?php

namespace App\Models;

use T4\Orm\Model;

/**
 * Class Queue
 * @package App\Models
 *
 * @property string $template
 * @property \T4\Core\Std $content
 * @property string $status
 * 
 * @property \App\Models\User $user
 */
class Queue
    extends Model
{
    protected static $schema = [
        'table'     => 'mail_queue',
        'columns'   => [
            'template' => ['type' => 'string'],
            'content'  => ['type' => 'string'],
            'status'   => ['type' => 'int'],
        ],
        'relations' => [
            'user' => ['type' => self::BELONGS_TO, 'model' => User::class],
        ]
    ];

    const TEMPLATES = [
        'test' => 'test.html'
    ];

    const STATUSES = [
        'NEW'   => 0,
        'SENT'  => 1,
        'ERROR' => 2,
    ];

    public function getStatusTitle()
    {
        return array_search($this->status, self::STATUSES);
    }

}