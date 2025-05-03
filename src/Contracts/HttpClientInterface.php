<?php

namespace Avanak\Contracts;

/**
 * Interface for HTTP client abstraction.
 */
interface HttpClientInterface
{
    /**
     * Send an HTTP request.
     *
     * @param string $method HTTP method (GET, POST, etc.)
     * @param string $url Full request URL
     * @param array $options Request options (headers, body, etc.)
     * @return mixed
     */
    public function request(string $method, string $url, array $options = []);
}

