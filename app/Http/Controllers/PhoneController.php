<?php

namespace App\Http\Controllers;

use App\Http\Requests\PhoneRequest;
use App\Http\Logic\Payloads\PhonePayload;
use App\Http\Logic\Repositories\Contracts\PhoneRepositoryInterface;
use App\Http\Logic\Repositories\Contracts\ContactRepositoryInterface;

use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\Foundation\Application;

class PhoneController extends Controller
{
    private ContactRepositoryInterface $contactRepository;

    private PhonePayload $phonePayload;

    private PhoneRepositoryInterface $phoneRepository;

    /**
     * @param ContactRepositoryInterface $contactRepository
     * @param PhonePayload $phonePayload
     * @param PhoneRepositoryInterface $phoneRepository
     */
    public function __construct(
        ContactRepositoryInterface $contactRepository,
        PhonePayload $phonePayload,
        PhoneRepositoryInterface $phoneRepository,
    )
    {
        $this->contactRepository = $contactRepository;
        $this->phonePayload = $phonePayload;
        $this->phoneRepository = $phoneRepository;
    }

    /**
     * @param int $id
     * @return Factory|View|Application
     */
    public function create(int $id): Factory|View|Application
    {
        $contact = $this->contactRepository->findById($id);

        return view('pages.phone_numbers.create', compact('contact'));
    }

    /**
     * @param PhoneRequest $request
     * @param int $contactID
     * @return RedirectResponse
     */
    public function store(PhoneRequest $request, int $contactID): RedirectResponse
    {
        $credentials = $this->phonePayload->getCredentials($request->all());

        $contact = $this->contactRepository->findById($contactID);

        $this->phoneRepository->store($credentials);

        return redirect()->route('contacts.show', $contact->id);
    }

    /**
     * @param int $contactID
     * @param int $phoneID
     * @return Application|Factory|View
     */
    public function edit(int $contactID, int $phoneID): Application|Factory|View
    {
        $contact = $this->contactRepository->findById($contactID);

        $phone = $this->phoneRepository->findById($contactID, $phoneID);

        return view('pages.phone_numbers.edit', compact('contact', 'phone'));
    }

    /**
     * @param PhoneRequest $request
     * @param int $contactID
     * @param int $phoneID
     * @return RedirectResponse
     */
    public function update(PhoneRequest $request, int $contactID, int $phoneID): RedirectResponse
    {
        $contact = $this->contactRepository->findById($contactID);

        $credentials = $this->phonePayload->getCredentials($request->all());

        $this->phoneRepository->update($contactID, $phoneID, $credentials);

        return redirect()->route('contacts.show', $contact->id);
    }

    /**
     * @param int $contactID
     * @param int $phoneID
     * @return RedirectResponse
     */
    public function destroy(int $contactID, int $phoneID): RedirectResponse
    {
        $contact = $this->contactRepository->findById($contactID);

        $this->phoneRepository->delete($contactID, $phoneID);

        return redirect()->route('contacts.show', $contact->id);
    }
}
