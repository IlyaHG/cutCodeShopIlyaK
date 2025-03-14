<?php

namespace Tests\RequestFactories;

use Worksome\RequestFactories\RequestFactory;

class SignUpRequestFactory extends RequestFactory
{
    public function definition(): array
    {
        return [
             'email' => $this->faker->email,
             'name' => $this->faker->name,
             'password' => $this->faker->password(8),
        ];
    }
}
