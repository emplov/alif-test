<?php

namespace App\Http\Logic\Repositories;

use App\Models\Contact;
use App\Http\Logic\Repositories\Contracts\ContactRepositoryInterface;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class ContactRepository implements ContactRepositoryInterface
{
    private Contact $model;

    /**
     * @param Contact $model
     */
    public function __construct(Contact $model)
    {
        $this->model = $model;
    }

    /**
     * @param array $filters
     * @return LengthAwarePaginator
     */
    public function allPaginated(array $filters = []): LengthAwarePaginator
    {
        return $this->model->newModelQuery()
            ->latest('id')
            ->when($filters['name'] ?? null, function ($query, $name) {
                $query->where('name', 'like', "%$name%");
            })
            ->paginate(10);
    }

    /**
     * @param int $id
     *
     * @return Model|Contact|Collection|Builder|array|null
     */
    public function findById(int $id): Model|Contact|Collection|Builder|array|null
    {
        return $this->model->newModelQuery()
            ->with(['phones', 'emails'])
            ->findOrFail($id);
    }

    /**
     * @param array $credentials
     *
     * @return Model|Contact|Builder
     */
    public function store(array $credentials): Model|Contact|Builder
    {
        return $this->model->newModelQuery()->create($credentials);
    }

    /**
     * @param int $id
     * @param array $credentials
     *
     * @return Contact|Model|Collection|Builder|array|null
     */
    public function update(int $id, array $credentials): Contact|Model|Collection|Builder|array|null
    {
        $contact = $this->findById($id);

        $contact->update($credentials);

        return $contact;
    }

    public function delete(int $id)
    {
        $contact = $this->findById($id);

        return $contact->delete();
    }
}
