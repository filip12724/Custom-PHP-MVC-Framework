<?php

namespace Elephant\Framework\Contracts;

interface ResponseInterface
{
    public function send(): void;
}