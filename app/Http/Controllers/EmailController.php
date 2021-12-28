<?php

namespace App\Http\Controllers;

use App\Http\Requests\EmailRequest;
use App\Http\Logic\Payloads\EmailPayload;
use App\Http\Logic\Repositories\Contracts\EmailRepositoryInterface;
use App\Http\Logic\Repositories\Contracts\ContactRepositoryInterface;

use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\Foundation\Application;

class EmailController extends Controller
{
    private EmailRepositoryInterface $emailRepository;

    private EmailPayload $emailPayload;

    private ContactRepositoryInterface $contactRepository;

    /**
     * @param EmailRepositoryInterface $emailRepository
     * @param EmailPayload $emailPayload
     * @param ContactRepositoryInterface $contactRepository
     */
    public function __construct(
        EmailRepositoryInterface $emailRepository,
        EmailPayload $emailPayload,
        ContactRepositoryInterface $contactRepository,
    )
    {
        $this->emailRepository = $emailRepository;
        $this->emailPayload = $emailPayload;
        $this->contactRepository = $contactRepository;
    }

    /**
     * @param int $id
     * @return Application|Factory|View
     */
    public function create(int $id): Application|Factory|View
    {
        $contact = $this->contactRepository->findById($id);

        return view('pages.email.create', compact('contact'));
    }

    /**
     * @param EmailRequest $request
     * @param int $contactID
     * @return RedirectResponse
     */
    public function store(EmailRequest $request, int $contactID): RedirectResponse
    {
        $credentials = $this->emailPayload->getCredentials($request->all());

        $contact = $this->contactRepository->findById($contactID);

        $this->emailRepository->store($credentials);

        return redirect()->route('contacts.show', $contact->id);
    }

    /**
     * @param int $contactID
     * @param int $emailID
     * @return Application|Factory|View
     */
    public function edit(int $contactID, int $emailID): Application|Factory|View
    {
        $contact = $this->contactRepository->findById($contactID);

        $email = $this->emailRepository->findById($contactID, $emailID);

        return view('pages.email.edit', compact('contact', 'email'));
    }

    /**
     * @param EmailRequest $request
     * @param int $contactID
     * @param int $emailID
     * @return RedirectResponse
     */
    public function update(EmailRequest $request, int $contactID, int $emailID): RedirectResponse
    {
        $contact = $this->contactRepository->findById($contactID);

        $credentials = $this->emailPayload->getCredentials($request->all());

        $this->emailRepository->update($contactID, $emailID, $credentials);

        return redirect()->route('contacts.show', $contact->id);
    }

    /**
     * @param int $contactID
     * @param int $emailID
     * @return RedirectResponse
     */
    public function destroy(int $contactID, int $emailID): RedirectResponse
    {
        $contact = $this->contactRepository->findById($contactID);

        $this->emailRepository->delete($contactID, $emailID);

        return redirect()->route('contacts.show', $contact->id);
    }
}
