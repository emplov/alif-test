<?php

namespace App\Http\Logic\Repositories;

use App\Models\Email;
use App\Http\Logic\Repositories\Contracts\EmailRepositoryInterface;

use Illuminate\Database\Eloquent\Builder;

class EmailRepository implements EmailRepositoryInterface
{
    private Email $model;

    /**
     * @param int $contactID
     * @param int $emailID
     * @return Email|Builder
     */
    public function findById(int $contactID, int $emailID): Email|Builder
    {
        return $this->model->newModelQuery()
            ->where('contact_id', $contactID)
            ->findOrFail($emailID);
    }

    /**
     * @param Email $model
     */
    public function __construct(Email $model)
    {
        $this->model = $model;
    }

    /**
     * @param array $credentials
     * @return Email|Builder
     */
    public function store(array $credentials): Email|Builder
    {
        return $this->model->newModelQuery()->create($credentials);
    }

    /**
     * @param int $contactID
     * @param int $emailID
     * @param array $credentials
     * @return Email|Builder
     */
    public function update(int $contactID, int $emailID, array $credentials): Email|Builder
    {
        $email = $this->findById($contactID, $emailID);

        $email->update($credentials);

        return $email;
    }

    /**
     * @param int $contactID
     * @param int $emailID
     * @return mixed
     */
    public function delete(int $contactID, int $emailID): mixed
    {
        $phone = $this->findById($contactID, $emailID);

        return $phone->delete();
    }
}
