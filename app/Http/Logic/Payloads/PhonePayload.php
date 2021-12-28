<?php

namespace App\Http\Logic\Payloads;

use App\Http\Logic\Payloads\Contracts\PayloadInterface;
use Illuminate\Support\Arr;

class PhonePayload implements PayloadInterface
{
    public function getFilters(array $payloads): array
    {
        return [];
    }

    public function getCredentials(array $payloads): array
    {
        return Arr::only($payloads, [
            'phone',
            'contact_id',
        ]);
    }
}
