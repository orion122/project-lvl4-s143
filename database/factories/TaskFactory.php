<?php

use Faker\Generator as Faker;

$factory->define(App\Task::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'description' => $faker->text,
        'status' => \App\TaskStatus::where('name', 'new')->first()->id,
        'creator' => factory(App\User::class)->create()->id,
        'assignedTo' => factory(App\User::class)->create()->id
    ];
});
