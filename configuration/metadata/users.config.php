<?php
use umi\orm\metadata\field\IField;
use umi\orm\object\IObject;

return [
    'dataSource' => [
        'sourceName'   => 'users',
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
        'login'                 => [
            'type'       => IField::TYPE_STRING,
            'columnName' => 'login',
            'accessor'   => 'getLogin',
            'mutator'    => 'setLogin',
            'validators' => ['required' => []]
        ],
        'email'                 => [
            'type'       => IField::TYPE_STRING,
            'columnName' => 'email',
            'validators' => ['email' => []]
        ],
        'password'              => [
            'type'       => IField::TYPE_PASSWORD,
            'columnName' => 'password',
            'accessor'   => 'getPassword',
            'mutator'    => 'setPassword'
        ],
        'isActive'              => ['type' => IField::TYPE_BOOL, 'columnName' => 'is_active', 'defaultValue' => 1],
        'posts'                 => ['type' => IField::TYPE_HAS_MANY, 'target' => 'posts', 'targetField' => 'owner'],

    ],
    'types'      => [
        'base' => [
            'fields' => [
                IObject::FIELD_IDENTIFY,
                IObject::FIELD_GUID,
                IObject::FIELD_TYPE,
                IObject::FIELD_VERSION,
                'name',
                'login',
                'email',
                'password',
                'isActive',
                'posts'
            ]
        ]
    ]
];