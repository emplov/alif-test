<?php

namespace App\Http\Logic\Repositories\Contracts;

interface ContactRepositoryInterface
{
    public function allPaginated(array $filters = []);

    public function findById(int $id);

    public function store(array $credentials);

    public function update(int $id, array $credentials);

    public function delete(int $id);
}
