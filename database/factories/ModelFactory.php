<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\User::class, function (Faker\Generator $faker) {
    static $password;
    $name = $faker->name;
    return [
        'name' => $name,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
        'username' => str_slug(strtolower($name)),
    ];
});
$factory->define(App\Service::class, function (Faker\Generator $faker) {
    $name = $faker->sentence;
    return [
        'name' => $name,
        'description' => $faker->paragraph,
        'hours' => $faker->randomElement($array = array (0,1,2,3)),
        'minutes' => $faker->randomElement($array = array (15,30,45)),
        'user_id' => App\User::all()->random()->id,
        'link' => str_slug(strtolower($name)),
    ];
});
$factory->define(App\Schedule::class, function (Faker\Generator $faker) {
	$type = $faker->randomElement($array = array ('I','D','R'));
	$rollingDays = NULL;
	$dateStart = NULL;
	$dateEnd = NULL;
	if ($type == 'D'){
		$randomDays = $faker->randomElement($array = array (10,30,60,90));
		$dateStart = Carbon\Carbon::now()->toDateString();
		$dateEnd = Carbon\Carbon::now()->addDays($randomDays)->toDateString();
	}else if ($type == 'R'){
		$rollingDays = $faker->randomElement($array = array (10,30,60,90));
	}
    return [
        'type' => $type,
        'rolling_days' => $rollingDays,
        'date_start' => $dateStart,
        'date_end' => $dateEnd,
        'time_start' => $faker->randomElement($array = array ('08:00:00','10:00:00','13:00:00')),
        'time_end' => $faker->randomElement($array = array ('15:00:00','17:00:00')),
        'day' => $faker->dayOfWeek(),
        'user_id' => App\User::all()->random()->id,
        'service_id' => NULL,
    ];
});
// $factory->define(App\Appointment::class, function (Faker\Generator $faker) {
//     return [
//         'name' => $faker->sentence,
//         'activity_id' => App\Activity::all()->random()->id,
//         'hours' => $faker->randomElement($array = array (0,1,2,3)),
//         'minutes' => $faker->randomElement($array = array (15,30,45)),
//         'user_id' => App\User::all()->random()->id,
//     ];
// });