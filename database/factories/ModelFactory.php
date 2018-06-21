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

    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\Entities\Category::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->sentence($nbWords = 6, $variableNbWords = true),
        'description' => $faker->text,
        'created_at' => $faker->dateTime($max = 'now', $timezone = date_default_timezone_get()),
    ];
});

$factory->define(App\Entities\User::class, function (Faker\Generator $faker) {
    return [
        'socialite_id' => $faker->numberBetween($min = 1, $max = 1000),
        'email' => $faker->email,
        'password' => $faker->password,
        'name' => $faker->name,
        'address' => $faker->address,
        'phone' => $faker->phoneNumber,
        'role' => $faker->numberBetween($min = 1, $max = 3),
        'created_at' => $faker->dateTime($max = 'now', $timezone = date_default_timezone_get())
    ];
});

$factory->define(App\Entities\Product::class, function (Faker\Generator $faker) {
    $get_category = DB::table('categories')->pluck('id')->toArray();
    $category_random_id = array_rand($get_category, 2);
    return [
        'name' => $faker->sentence($nbWords = 5, $variableNbWords = true),
        'slug' => $faker->slug,
        'price' => $faker->numberBetween($min = 100000, $max = 99000),
        'attribute' => $faker->sentence($nbWords = 5, $variableNbWords = true),
        'categories_id' => $category_random_id[1],
        'created_at' => $faker->dateTime($max = 'now', $timezone = date_default_timezone_get()),
    ];
});

$factory->define(App\Entities\Topic::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->sentence($nbWords = 5, $variableNbWords = true),
        'description' => $faker->paragraph($nbSentences = 3, $variableNbSentences = true),
        'created_at' => $faker->dateTime($max = 'now', $timezone = date_default_timezone_get()),
    ];
});

$factory->define(App\Entities\Blueprint::class, function (Faker\Generator $faker) {
    $topic = DB::table('topics')->pluck('id')->toArray();
    $topic_random_id = array_rand($topic, 2);
    $user = DB::table('users')->pluck('id')->toArray();
    $user_random_id = array_rand($user, 2);
    return [
        'title' => $faker->sentence($nbWords = 5, $variableNbWords = true),
        'description' => $faker->paragraph($nbSentences = 3, $variableNbSentences = true),
        'topics_id' => $topic_random_id[1],
        'created_at' => $faker->dateTime($max = 'now', $timezone = date_default_timezone_get()),
        'users_id' => $user_random_id[1]
    ];
});

$factory->define(App\Entities\Gallery::class, function (Faker\Generator $faker) {
    $blueprint = DB::table('blueprints')->pluck('id')->toArray();
    $blueprint_random_id = array_rand($blueprint, 2);
    return [
        'image_name' => $faker->imageUrl(400, 300),
        'blueprints_id' => $blueprint_random_id[1],
        'created_at' => $faker->dateTime($max = 'now', $timezone = date_default_timezone_get()),
    ];
});

$factory->define(App\Entities\BlueprintDetail::class, function (Faker\Generator $faker) {
    $blueprint = $blueprint = DB::table('blueprints')->pluck('id')->toArray();
    $blueprint_random_id = array_rand($blueprint, 2);

    $product = DB::table('products')->pluck('id')->toArray();
    $product_random_id = array_rand($product, 2);
    return [
        'quantity' => $faker->numberBetween($min = 1, $max = 100),
        'blueprints_id' => $blueprint_random_id[1],
        'products_id' => $product_random_id[1],
        'created_at' => $faker->dateTime($max = 'now', $timezone = date_default_timezone_get()),
    ];
});

$factory->define(App\Entities\Type::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->sentence($nbWords = 5, $variableNbWords = true),
        'description' => $faker->paragraph($nbSentences = 3, $variableNbSentences = true),
        'created_at' => $faker->dateTime($max = 'now', $timezone = date_default_timezone_get()),
    ];
});

$factory->define(App\Entities\SuggestProduct::class, function (Faker\Generator $faker) {
    $blueprint = $blueprint = DB::table('blueprints')->pluck('id')->toArray();
    $blueprint_random_id = array_rand($blueprint, 2);
    $get_category = DB::table('categories')->pluck('id')->toArray();
    $category_random_id = array_rand($get_category, 2);
    $attribute = [
        $faker->sentence($nbWords = 2, $variableNbWords = true) => $faker->sentence($nbWords = 3, $variableNbWords = true),
        $faker->sentence($nbWords = 5, $variableNbWords = true) => $faker->sentence($nbWords = 5, $variableNbWords = true),
        $faker->sentence($nbWords = 2, $variableNbWords = true) => $faker->sentence($nbWords = 3, $variableNbWords = true),
        $faker->sentence($nbWords = 5, $variableNbWords = true) => $faker->sentence($nbWords = 5, $variableNbWords = true),
    ];
    return [
        'name' => $faker->sentence($nbWords = 5, $variableNbWords = true),
        'price' => $faker->numberBetween($min = 100000, $max = 99000),
        'attribute' => json_encode($attribute),
        'blueprints_id' => $blueprint_random_id[1],
        'categories_id' => $category_random_id[1],
        'created_at' => $faker->dateTime($max = 'now', $timezone = date_default_timezone_get()),
    ];
});

$factory->define(App\Entities\Order::class, function (Faker\Generator $faker) {
    $user = DB::table('users')->pluck('id')->toArray();
    $user_random_id = array_rand($user, 2);
    return [
        'description' => $faker->paragraph($nbSentences = 3, $variableNbSentences = true),
        'confirm_token' => $faker->sha1,
        'users_id' => $user_random_id[1],
        'created_at' => $faker->dateTime($max = 'now', $timezone = date_default_timezone_get()),
    ];
});

$factory->define(App\Entities\OrderDetail::class, function (Faker\Generator $faker) {
    $order = DB::table('orders')->pluck('id')->toArray();
    $order_random_id = array_rand($order, 2);

    $product = DB::table('products')->pluck('id')->toArray();
    $product_random_id = array_rand($product, 2);
    return [
        'quantity' => $faker->numberBetween($min = 1, $max = 20),
        'price_per_product' => $faker->numberBetween($min = 100000, $max = 99000),
        'products_id' => $product_random_id[1],
        'orders_id' => $order_random_id[1],
        'created_at' => $faker->dateTime($max = 'now', $timezone = date_default_timezone_get()),
    ];
});

$factory->define(App\Entities\Post::class, function (Faker\Generator $faker) {
    $type = DB::table('types')->pluck('id')->toArray();
    $type_random_id = array_rand($type, 2);

    $user = DB::table('users')->pluck('id')->toArray();
    $user_random_id = array_rand($user, 2);
    return [
        'title' => $faker->sentence($nbWords = 10, $variableNbWords = true),
        'body' => $faker->paragraph($nbSentences = 3, $variableNbSentences = true),
        'slug' => $faker->slug,
        'users_id' => $user_random_id[1],
        'types_id' => $type_random_id[1],
        'created_at' => $faker->dateTime($max = 'now', $timezone = date_default_timezone_get()),
    ];
});

$factory->define(App\Entities\Review::class, function (Faker\Generator $faker) {
    $user = DB::table('users')->pluck('id')->toArray();
    $user_random_id = array_rand($user, 2);

    $post = DB::table('posts')->pluck('id')->toArray();
    $post_random_id = array_rand($post, 2);
    return [
        'rate' => $faker->numberBetween($min = 1, $max = 5),
        'comment' => $faker->sentence($nbWords = 10, $variableNbWords = true),
        'users_id' => $user_random_id[1],
        'posts_id' => $post_random_id[1],
        'created_at' => $faker->dateTime($max = 'now', $timezone = date_default_timezone_get()),
    ];
});

$factory->define(App\Entities\ImproveBlueprint::class, function (Faker\Generator $faker) {
    $blueprint = DB::table('blueprints')->pluck('id')->toArray();
    $blueprint_random_id = array_rand($blueprint, 2);

    $user = DB::table('users')->pluck('id')->toArray();
    $user_random_id = array_rand($user, 2);

    return [
        'description' => $faker->paragraph($nbSentences = 3, $variableNbSentences = true),
        'blueprints_id' => $blueprint_random_id[1],
        'users_id' => $user_random_id[1],
        'created_at' => $faker->dateTime($max = 'now', $timezone = date_default_timezone_get()),
    ];
});


$factory->define(App\Entities\ImproveDetail::class, function (Faker\Generator $faker) {
    $improve_blueprint = DB::table('improve_blueprints')->pluck('id')->toArray();
    $improve_blueprint_random_id = array_rand($improve_blueprint, 2);

    $product = DB::table('products')->pluck('id')->toArray();
    $product_random_id = array_rand($product, 2);
    return [
        'quantity' => $faker->numberBetween($min = 1, $max = 150),
        'improve_blueprints_id' => $improve_blueprint_random_id[1],
        'products_id' => $product_random_id[1],
        'created_at' => $faker->dateTime($max = 'now', $timezone = date_default_timezone_get()),
    ];
});

$factory->define(App\Entities\RequestBlueprint::class, function (Faker\Generator $faker) {
    $improve_blueprint = DB::table('improve_blueprints')->pluck('id')->toArray();
    $improve_blueprint_random_id = array_rand($improve_blueprint, 2);

    $user = DB::table('users')->pluck('id')->toArray();
    $user_random_id = array_rand($user, 2);
    return [
        'description' => $faker->paragraph($nbSentences = 3, $variableNbSentences = true),
        'improve_blueprints_id' => $improve_blueprint_random_id[1],
        'users_id' => $user_random_id[1],
        'created_at' => $faker->dateTime($max = 'now', $timezone = date_default_timezone_get()),
    ];
});
