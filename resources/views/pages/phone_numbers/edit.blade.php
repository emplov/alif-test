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
                        <form action="{{ route('phone.update', [$contact->id, $phone->id]) }}" method="post">
                            @csrf
                            @method('put')

                            <input type="hidden" name="contact_id" value="{{ $contact->id }}">

                            <div class="mb-3">
                                <label for="phone" class="form-label">{{ __('message.phone') }} (998#########)</label>
                                <div class="input-group">
                                    <input type="text" class="form-control @error('phone') is-invalid @enderror"
                                           id="phone" name="phone"
                                           value="{{ old('phone', $phone->phone) }}" placeholder="{{ __('message.phone') }}">
                                    @error('phone')
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
