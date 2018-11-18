<?php

namespace App\AfterShip;

interface Requestable
{
    public function send($method, $url, array $data = []);
}
