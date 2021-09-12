<?php
require_once('../config/database.php');
require_once('../includes/functions.php');
require_once('../vendor/autoload.php');

// use the factory to create a Faker\Generator instance
$faker = Faker\Factory::create();

for ($i = 1; $i < 30; $i++) {
    $q = $db->prepare("INSERT INTO users(name,pseudo,email,password,active,created_at,city,country,sex,available_for_hiring,bio)
                       VALUES(:name,:pseudo,:email,:password,:active,:created_at,:city,:country,:sex,:available_for_hiring,:bio)");

    $q->execute([
         'name'=> $faker->unique()->name,
         'pseudo'=>$faker->unique()->userName,
         'email'=>$faker->unique()->email,
         'password'=>bcrypt_hash_password('123654'),
         'active'=>1,
         'created_at'=>$faker->date().' '.$faker->time(),
         'city'=>$faker->city,
         'country'=>$faker->country,
         'sex'=>$faker->randomElement(['H','F']),
         'available_for_hiring'=>$faker->randomElement(['0','1']),
         'bio'=>$faker->paragraph()
    ]);

    $id=$db->lastInsertId();
    $q=$db->prepare("INSERT INTO friends_relationships(user_id1,user_id2,status)
                     VALUES(:user_id1,:user_id2,:status)");
    $q->execute([
        'user_id1'=>$id,
        'user_id2'=>$id,
        'status'=>'2'
    ]);
}

echo('Users added!!!');
