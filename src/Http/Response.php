<?php 
declare(strict_types=1);

namespace Elephant\Framework\Http;

use Elephant\Framework\Contracts\ResponseInterface;

class Response implements ResponseInterface
{
    public function __construct(
        private ?string $content = '',
        private int $status = 200,
        private array $headers = [],
    ){
        http_response_code($status);
    }

    public function send(): void
    {
        echo $this->content;
    }
}