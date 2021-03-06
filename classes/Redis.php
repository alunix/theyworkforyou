<?php

namespace MySociety\TheyWorkForYou;

class Redis extends \Predis\Client {
    public function __construct() {
        $redis_args = [
            'host' => REDIS_DB_HOST,
            'port' => REDIS_DB_PORT,
            'db' => REDIS_DB_NUMBER,
        ];
        if (REDIS_DB_PASSWORD) {
            $redis_args['password'] = REDIS_DB_PASSWORD;
        }
        parent::__construct($redis_args);
    }
}
