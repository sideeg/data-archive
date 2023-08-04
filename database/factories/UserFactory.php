<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Job;
use App\User;
use App\Order;
use App\Employee;
use App\Pharmacy;
use App\Medication;
use App\OrderStatus;
use App\DeliveryTime;
use App\MedicationStatus;
use Illuminate\Support\Str;
use Faker\Generator as Faker;


/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/


$factory->define(User::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'phone' => $faker->e164PhoneNumber,
        'otp' => $faker->numberBetween(1111 , 9999),
    ];
});

$factory->define(Order::class, function (Faker $faker) {

    // $order_status = OrderStatus::has('orders')->get()->random();
    return [
        'order_name' => $faker->word,
        'prescription_photo' => $faker->imageUrl($width = 400, $height = 480),
        'order_price' => $faker->numberBetween(50 , 200),
        'user_id' => factory('App\User')->create(),
        'order_status_id' => $faker->numberBetween(1 , 7),
        'delivery_time_id' => factory('App\DeliveryTime')->create(),
        'medication_id' => factory('App\Medication')->create(),
        'employee_id' => factory('App\Employee')->create(),
    ];
});

// $factory->define(OrderStatus::class, function (Faker $faker,OrderStatus $order_status) {
//     return [
//         'order_status' => $order_status->id,
//           ];
// });

$factory->define(DeliveryTime::class, function (Faker $faker) {
    return [
        'delivery_time' => $faker->dateTime,
          ];
});

$factory->define(Medication::class, function (Faker $faker) {

    // $medicine_status = MedicationStatus::has('medications')->get()->random();

    return [
        'effective_material' => $faker->word,
        'company_name' => $faker->company,
        'license_number' => $faker->randomNumber,
        'price' => $faker->numberBetween(50 , 200),
        'pharmacy_id' =>  factory('App\Pharmacy')->create(),
        'medication_status_id' => $faker->numberBetween(1 , 4),
    ];
});

$factory->define(Employee::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'phone' => $faker->e164PhoneNumber,
        'password' => $faker->password,
        'identification_number' => $faker->unique()->randomNumber(),
        'job_id' => factory('App\Job')->create(),
    ];
});

// $factory->define(MedicationStatus::class, function (Faker $faker) {
//     $medicine_status_id = MedicationStatus::find();
//     return [
//         'medicine_status_id' => $medicine_status_id,
//           ];
// });



$factory->define(Pharmacy::class, function (Faker $faker) {
    return [
        'name' => $faker->word,
        'owner' => $faker->name,
        'phone' => $faker->e164PhoneNumber,
        'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
        'license_number' => $faker->unique()->randomNumber(),
        'long' => $faker->longitude($min = -180, $max= 180),
        'lat' => $faker->latitude($min = -90, $max= 90),
        'insurance' => $faker->numberBetween(0 , 1),
    ];
});

$factory->define(Job::class, function (Faker $faker) {
    return [
        'name' => $faker->jobTitle,
    ];
});