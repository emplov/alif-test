<?php

namespace App\Http\Logic\Repositories\Contracts;

use App\Models\Email;

use Illuminate\Database\Eloquent\Builder;

interface EmailRepositoryInterface
{
    public function findById(int $contactID, int $emailID): Email|Builder;

    public function store(array $credentials): Email|Builder;

    public function update(int $contactID, int $emailID, array $credentials): Email|Builder;

    public function delete(int $contactID, int $emailID): mixed;
}
