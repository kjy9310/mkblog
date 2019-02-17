<?php

namespace App\GraphQL\Query;

use Folklore\GraphQL\Support\Query;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use GraphQL;
use App\Article;

class ArticleQuery extends Query
{
    protected $attributes = [
        'name' => 'article',
        'description' => 'A query'
    ];

    public function type()
    {
        return GraphQL::type('ArticleType');
    }

    public function args()
    {
        return [
            'id' => [
                'name' => 'id',
                'type' => Type::id(),
            ],
            'title' => [
                'name' => 'title',
                'type' => Type::string(),
            ],
        ];
    }

    public function resolve($root, $args, $context, ResolveInfo $info)
    {
        $query = Article::query();

        if (isset($args['id'])) {
            $query->where('id', $args['id']);
        }

        return $query->first();
    }
}
