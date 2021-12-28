<?php

namespace App\Http\Logic\Repositories;

use App\Models\Phone;
use App\Http\Logic\Repositories\Contracts\PhoneRepositoryInterface;

use Illuminate\Database\Eloquent\Builder;

class PhoneRepository implements PhoneRepositoryInterface
{
    private Phone $model;

    /**
     * @param int $contactID
     * @param int $phoneID
     * @return Phone|Builder
     */
    public function findById(int $contactID, int $phoneID): Phone|Builder
    {
        return $this->model->newModelQuery()
            ->where('contact_id', $contactID)
            ->findOrFail($phoneID);
    }

    /**
     * @param Phone $model
     */
    public function __construct(Phone $model)
    {
        $this->model = $model;
    }

    /**
     * @param array $credentials
     * @return Phone|Builder
     */
    public function store(array $credentials): Phone|Builder
    {
        return $this->model->newModelQuery()->create($credentials);
    }

    /**
     * @param int $contactID
     * @param int $phoneID
     * @param array $credentials
     * @return Phone|Builder
     */
    public function update(int $contactID, int $phoneID, array $credentials): Phone|Builder
    {
        $phone = $this->findById($contactID, $phoneID);

        $phone->update($credentials);

        return $phone;
    }

    /**
     * @param int $contactID
     * @param int $phoneID
     * @return mixed
     */
    public function delete(int $contactID, int $phoneID): mixed
    {
        $phone = $this->findById($contactID, $phoneID);

        return $phone->delete();
    }
}
