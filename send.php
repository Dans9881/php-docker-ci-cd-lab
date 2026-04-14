<?php

require_once __DIR__ . '/vendor/autoload.php';

use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;

$connection = new AMQPStreamConnection(
    'rabbitmq',
    5672,
    'admin',
    'admin123'
);

$channel = $connection->channel();

$channel->queue_declare('test-queue', false, true, false, false);

$data = "Hello dari PHP App";

$msg = new AMQPMessage($data);

$channel->basic_publish($msg, '', 'test-queue');

echo " [x] Sent: $data\n";

$channel->close();
$connection->close();