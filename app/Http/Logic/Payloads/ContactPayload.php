<?php

namespace App\Http\Logic\Payloads;

use App\Http\Logic\Payloads\Contracts\PayloadInterface;

use Illuminate\Support\Arr;

class ContactPayload implements PayloadInterface
{
    /**
     * @param array $payloads
     * @return array
     */
    public function getFilters(array $payloads): array
    {
        return Arr::only($payloads, [
            'name',
        ]);
    }

    /**
     * @param array $payloads
     * @return array
     */
    public function getCredentials(array $payloads): array
    {
        return Arr::only($payloads, [
            'name',
        ]);
    }
}
