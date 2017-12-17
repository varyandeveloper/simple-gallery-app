<?php

require_once 'config.php';

/**
 * Seed test users
 * @param int $count
 */
function seedUsers($count = 10)
{
    $storage = new \VS\Gallery\Storage\JsonStorage();
    $data = [];
    $roles = ['regular', 'editor'];
    for ($i = 1; $i <= $count; $i++) {
        $data[] = [
            'id' => $i,
            "role" => $roles[mt_rand(0,1)],
            'name' => 'testuser' . $i
        ];
    }
    try {
        $storage->name('users')->create($data, true);
    } catch (\Exception $exception) {
        var_dump($exception);
        exit;
    }
}

/**
 * Seed test galleries
 * @param int $count
 */
function seedGalleries($count = 30)
{
    $storage = new \VS\Gallery\Storage\JsonStorage();
    $data = [];
    for ($i = 1; $i <= $count; $i++) {
        $data[] = [
            'id' => $i,
            'user_id' => rand(1, 10),
            'name' => 'Test Gallery ' . $i
        ];
    }
    try {
        $storage->name('galleries')->create($data, true);
    } catch (\Exception $exception) {
        var_dump($exception);
        exit;
    }
}

/**
 * Seed test photos
 */
function seedPhotos($count = 60)
{
    $storage = new \VS\Gallery\Storage\JsonStorage();
    $data = [];
    for ($i = 1; $i <= $count; $i++) {
        $data[] = [
            'id' => $i,
            'gallery_id' => rand(1, 30),
            'name' => 'Test photo ' . $i,
            'path' => 'https://dummyimage.com/300'
        ];
    }
    try {
        $storage->name('photos')->create($data, true);
    } catch (\Exception $exception) {
        var_dump($exception);
        exit;
    }
}

seedUsers();
seedGalleries();
//seedPhotos();
