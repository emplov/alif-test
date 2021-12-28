<?php

namespace App\Http\Logic\Payloads\Contracts;

interface PayloadInterface
{
    public function getFilters(array $payloads): array;

    public function getCredentials(array $payloads): array;
}
