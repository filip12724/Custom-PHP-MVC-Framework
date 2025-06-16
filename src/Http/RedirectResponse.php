<?php

namespace Elephant\Framework\Http;

use Elephant\Framework\Contracts\ResponseInterface;

class RedirectResponse implements ResponseInterface
{
    public function __construct(
        private string $url,
        private int $status = 302
    ){
        http_response_code($status);
    }

    public function send(): void
    {
        header("Location: " . $this->url);
        exit;
    }
}