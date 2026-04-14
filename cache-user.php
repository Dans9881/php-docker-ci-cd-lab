<?php

$redis = new Redis();
$redis->connect(getenv('REDIS_HOST'), getenv('REDIS_PORT'));

if (!$redis->ping()) {
    die("Redis ga connect");
}

$conn = mysqli_connect(
    getenv('DB_HOST'),
    getenv('DB_USER'),
    getenv('DB_PASS'),
    getenv('DB_NAME')
);

if (!$conn) {
    die("MySQL error: " . mysqli_connect_error());
}

$userId = 1;
$cacheKey = "user:$userId";

$user = $redis->get($cacheKey);

if ($user) {
    echo "Dari Redis\n";
    $user = json_decode($user, true);
} else {
    echo "Dari MySQL\n";

    $result = mysqli_query($conn, "SELECT * FROM users WHERE id=$userId");
    $user = mysqli_fetch_assoc($result);

    if (!$user) {
        echo "User tidak ditemukan\n";
        exit;
    }

    $redis->setex($cacheKey, 60, json_encode($user));
    echo "Cache disimpan ke Redis\n";
}

print_r($user);