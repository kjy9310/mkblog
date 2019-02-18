<?php

namespace App\GraphQL\Type;

use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Type as BaseType;
use GraphQL;

class ArticleType extends BaseType
{
    protected $attributes = [
        'name' => 'ArticleType',
        'description' => 'A type'
    ];

    public function fields()
    {
        return [
            'id' => [
                'type' => Type::id(),
                'description' => 'The id of the article'
            ],
            'title' => [
                'type' => Type::string(),
                'description' => 'The title of article',
            ],
            'content' => [
                'type' => Type::string(),
                'description' => 'The content of article',
            ],
            // 'created_at'=>[
            //     'type'=> Type::float(),
            //     'description'=> 'created_at'
            // ],
            'user' => [
                'type' => GraphQL::type('UserType'),
                'description' => 'The user of article',
            ],
        ];
    }
}
