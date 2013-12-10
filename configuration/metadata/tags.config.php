<?php
/**
 * UMI.Framework (http://umi-framework.ru/)
 *
 * @link      http://github.com/Umisoft/framework for the canonical source repository
 * @copyright Copyright (c) 2007-2013 Umisoft ltd. (http://umisoft.ru/)
 * @license   http://umi-framework.ru/license/bsd-3 BSD-3 License
 */

use umi\orm\metadata\field\IField;
use umi\orm\object\IObject;

return [
    'dataSource' => [
        'sourceName'   => 'tags',
        'masterServer' => 'demoDB',
        'slaveServer'  => 'demoDB'
    ],
    'fields'     => [
        IObject::FIELD_IDENTIFY => ['type' => IField::TYPE_IDENTIFY, 'columnName' => 'id', 'accessor' => 'getId'],
        IObject::FIELD_GUID     => [
            'type'       => IField::TYPE_GUID,
            'columnName' => 'guid',
            'accessor'   => 'getGuid',
            'mutator'    => 'setGuid'
        ],
        IObject::FIELD_TYPE     => [
            'type'       => IField::TYPE_STRING,
            'columnName' => 'type',
            'accessor'   => 'getType',
            'readOnly'   => true
        ],
        IObject::FIELD_VERSION  => [
            'type'         => IField::TYPE_VERSION,
            'columnName'   => 'version',
            'accessor'     => 'getVersion',
            'mutator'      => 'setVersion',
            'defaultValue' => 1
        ],
        'name'                  => [
            'type'          => IField::TYPE_STRING,
            'columnName'    => 'name',
            'localizations' => [
                'ru-RU' => ['columnName' => 'name'],
                'en-US' => ['columnName' => 'name_en']
            ]
        ],
        'posts'                 => [
            'type'         => IField::TYPE_MANY_TO_MANY,
            'target'       => 'posts',
            'bridge'       => 'postTags',
            'relatedField' => 'tag',
            'targetField'  => 'post'
        ],

    ],
    'types'      => [
        'base' => [
            'fields' => [
                IObject::FIELD_IDENTIFY,
                IObject::FIELD_GUID,
                IObject::FIELD_TYPE,
                IObject::FIELD_VERSION,
                'name',
                'posts'
            ]
        ]
    ]
];
