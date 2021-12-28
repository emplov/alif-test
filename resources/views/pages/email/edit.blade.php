@extends('layouts.app')

@section('title', 'Редактирование')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <a href="{{ route('contacts.index') }}" class="btn btn-success">{{ __('message.back') }}</a>
                        <a href="{{ route('contacts.show', $contact->id) }}"
                           class="btn btn-success">{{ __('message.to_contact') }}</a>
                    </div>
                </div>
            </div>

            <div class="col-md-12 mt-3">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('email.update', [$contact->id, $email->id]) }}" method="post">
                            @csrf
                            @method('put')

                            <input type="hidden" name="contact_id" value="{{ $contact->id }}">

                            <div class="mb-3">
                                <label for="email" class="form-label">{{ __('message.email') }}</label>
                                <div class="input-group">
                                    <input type="text" class="form-control @error('email') is-invalid @enderror"
                                           id="email" name="email"
                                           value="{{ old('email', $email->email) }}" placeholder="{{ __('message.email') }}">
                                    @error('email')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>

                            <button class="btn btn-warning">
                                {{ __('message.edit') }}
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
