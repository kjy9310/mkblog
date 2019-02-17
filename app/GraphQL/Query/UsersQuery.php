<?php

namespace App\GraphQL\Query;

use Folklore\GraphQL\Support\Query;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use GraphQL\Type\Definition\ListOfType;
use GraphQL;
use Illuminate\Database\Eloquent\Collection;
use App\User;

class UsersQuery extends Query
{
    protected $attributes = [
        'name' => 'users',
        'description' => 'A query'
    ];

    public function type()
    {
        return Type::listOf(GraphQL::type('UserType'));
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
            'email' => [
                'name' => 'email',
                'type' => Type::string(),
            ]
        ];
    }

    public function resolve(array $root, array $args) : Collection
    {
        $query = User::query();

        if (isset($args['id'])) {
            $query->where('id', $args['id']);
        }

        if (isset($args['ids'])) {
            $query->whereIn('id', $args['ids']);
        }

        if (isset($args['email'])) {
            $query->where('email', $args['email']);
        }

        return $query->get();
    }
}
