<?php

require_once __DIR__ . '/../../vendor/autoload.php';

use PhpAmqpLib\Connection\AMQPStreamConnection;

$connection = new AMQPStreamConnection(
    'rabbitmq',
    5672,
    'admin',
    'admin123'
);

$channel = $connection->channel();

$channel->queue_declare('test-queue', false, true, false, false);

echo " [*] Waiting for messages...\n";

$callback = function ($msg) {
    echo " [x] Received: ", $msg->body, "\n";
};

$channel->basic_consume(
    'test-queue',
    '',
    false,
    true,
    false,
    false,
    $callback
);

while ($channel->is_consuming()) {
    $channel->wait();
}