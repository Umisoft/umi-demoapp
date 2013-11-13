<?php
use umi\orm\metadata\field\IField;
use umi\orm\object\IObject;

return [
    'dataSource' => [
        'sourceName'   => 'posts',
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
        'title'                 => [
            'type'          => IField::TYPE_TEXT,
            'columnName'    => 'title',
            'localizations' => [
                'ru-RU' => ['columnName' => 'title'],
                'en-US' => ['columnName' => 'title_en']
            ]
        ],
        'publishTime'           => ['type' => IField::TYPE_INTEGER, 'columnName' => 'publish_time'],
        'content'               => [
            'type'          => IField::TYPE_TEXT,
            'columnName'    => 'content',
            'localizations' => [
                'ru-RU' => ['columnName' => 'content'],
                'en-US' => ['columnName' => 'content_en']
            ]
        ],
        'owner'                 => ['type' => IField::TYPE_BELONGS_TO, 'columnName' => 'owner_id', 'target' => 'users'],
        'tags'                  => [
            'type'         => IField::TYPE_MANY_TO_MANY,
            'target'       => 'tags',
            'bridge'       => 'postTags',
            'relatedField' => 'post',
            'targetField'  => 'tag'
        ],
    ],
    'types'      => [
        'base' => [
            'fields' => [
                IObject::FIELD_IDENTIFY,
                IObject::FIELD_GUID,
                IObject::FIELD_TYPE,
                IObject::FIELD_VERSION,
                'title',
                'publishTime',
                'content',
                'owner',
                'tags'
            ]
        ]
    ]
];