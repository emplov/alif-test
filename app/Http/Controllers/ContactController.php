<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactRequest;
use App\Http\Logic\Payloads\ContactPayload;
use App\Http\Logic\Repositories\Contracts\ContactRepositoryInterface;

use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\Foundation\Application;

class ContactController extends Controller
{
    private ContactRepositoryInterface $repository;

    private ContactPayload $payload;

    /**
     * @param ContactRepositoryInterface $repository
     * @param ContactPayload $payload
     */
    public function __construct(ContactRepositoryInterface $repository, ContactPayload $payload)
    {
        $this->repository = $repository;

        $this->payload = $payload;
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return Application|Factory|View
     */
    public function index(Request $request): View|Factory|Application
    {
        $filters = $this->payload->getFilters($request->all());

        $contacts = $this->repository->allPaginated($filters);

        return view('pages.contacts.index', compact('contacts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create(): View|Factory|Application
    {
        return view('pages.contacts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param ContactRequest $request
     * @return RedirectResponse
     */
    public function store(ContactRequest $request): RedirectResponse
    {
        $credentials = $this->payload->getCredentials($request->all());

        $contact = $this->repository->store($credentials);

        return redirect()->route('contacts.show', $contact->id);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return Application|Factory|View
     */
    public function show(int $id): View|Factory|Application
    {
        $contact = $this->repository->findById($id);

        return view('pages.contacts.show', compact('contact'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return Application|Factory|View
     */
    public function edit(int $id): View|Factory|Application
    {
        $contact = $this->repository->findById($id);

        return view('pages.contacts.edit', compact('contact'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param ContactRequest $request
     * @param int $id
     * @return Application|Factory|View
     */
    public function update(ContactRequest $request, int $id): Application|Factory|View
    {
        $credentials = $this->payload->getCredentials($request->all());

        $contact = $this->repository->update($id, $credentials);

        return view('pages.contacts.show', compact('contact'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return RedirectResponse
     */
    public function destroy(int $id): RedirectResponse
    {
        $this->repository->delete($id);

        return redirect()->route('contacts.index');
    }
}
