<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Settings;
use Faker\Generator as Faker;

$factory->define(Settings::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'logo1' => $faker->url,
        'logo2' => $faker->url,
        'telephone' => $faker->e164PhoneNumber(),
        'email' => $faker->email,
        'about' => $faker->paragraph(3),
        'facebook' => $faker->url,
        'googleplus' => $faker->url,
        'youtube' => $faker->url,
        'twitter' => $faker->url,
        'telegram' => $faker->url,
        'whatsapp' => $faker->url,
        'snapchat' => $faker->url,
        'linkedin' => $faker->url,
        'play_store' => $faker->url,
        'app_store' => $faker->url,
        'microsoft_store' => $faker->url,
        'qr_code' => $faker->url,
        'currency' => 'SAR', 
    ];
});
