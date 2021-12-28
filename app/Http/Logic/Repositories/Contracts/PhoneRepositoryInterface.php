<?php

namespace App\Http\Logic\Repositories\Contracts;

use App\Models\Phone;

use Illuminate\Database\Eloquent\Builder;

interface PhoneRepositoryInterface
{
    public function findById(int $contactID, int $phoneID): Phone|Builder;

    public function store(array $credentials): Phone|Builder;

    public function update(int $contactID, int $phoneID, array $credentials): Phone|Builder;

    public function delete(int $contactID, int $phoneID): mixed;
}
