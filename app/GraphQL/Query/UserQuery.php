<?php

namespace App\GraphQL\Query;

use Folklore\GraphQL\Support\Query;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use GraphQL;
use App\User;

class UserQuery extends Query
{
    protected $attributes = [
        'name' => 'user',
        'description' => 'A query'
    ];

    public function type()// : ObjectType
    {
        return GraphQL::type('UserType');
    }

    public function args()// : array
    {
        return [
            'id' => [
                'name' => 'id',
                'type' => Type::id(),
            ],
        ];
    }

    public function resolve(array $root, array $args)// : User
    {
        $query = User::query();

        if (isset($args['id'])) {
            $query->where('id', $args['id']);
        }

        return $query->first();
    }
}
