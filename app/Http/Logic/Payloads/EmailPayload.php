<?php

namespace App\Http\Logic\Payloads;

use App\Http\Logic\Payloads\Contracts\PayloadInterface;

use Illuminate\Support\Arr;

class EmailPayload implements PayloadInterface
{
    public function getFilters(array $payloads): array
    {
        return Arr::only($payloads, []);
    }

    public function getCredentials(array $payloads): array
    {
        return Arr::only($payloads, [
            'email',
            'contact_id',
        ]);
    }
}
