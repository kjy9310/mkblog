<?php

namespace App\GraphQL\Query;

use Folklore\GraphQL\Support\Query;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use GraphQL\Type\Definition\ListOfType;
use GraphQL;
use Illuminate\Database\Eloquent\Collection;
use App\Article;

class ArticlesQuery extends Query
{
    protected $attributes = [
        'name' => 'articles',
        'description' => 'A query'
    ];

    public function type()
    {
        return Type::listOf(GraphQL::type('ArticleType'));
    }

    public function args()
    {
        return [
            'id' => [
                'name' => 'id',
                'type' => Type::id(),
            ],
            'ids' => [
                'name' => 'ids',
                'type' => Type::listOf(Type::id()),
            ],
            'user_id' => [
                'name' => 'user_id',
                'type' => Type::int(),
            ]
        ];
    }

    public function resolve($root, $args, $context, ResolveInfo $info)
    {
        $query = Article::query();

        if (isset($args['id'])) {
            $query->where('id', $args['id']);
        }

        if (isset($args['ids'])) {
            $query->whereIn('id', $args['ids']);
        }

        if (isset($args['user_id'])) {
            $query->where('user_id', $args['user_id']);
        }

        return $query->get();
    }
}
