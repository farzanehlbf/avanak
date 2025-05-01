<?php

namespace Avanak\Contracts;

interface HttpClientInterface
{
    public function request(string $method, string $url, array $options = []);
}
