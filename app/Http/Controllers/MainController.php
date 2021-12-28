<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;

class MainController extends Controller
{
    /**
     * @return RedirectResponse
     */
    public function __invoke(): RedirectResponse
    {
        return redirect()->route('contacts.index');
    }
}
