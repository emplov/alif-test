@extends('layouts.app')

@section('title', 'Создание')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <a href="{{ route('contacts.index') }}" class="btn btn-success">{{ __('message.back') }}</a>
                    </div>
                </div>
            </div>

            <div class="col-md-12 mt-3">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('contacts.store') }}" method="post">
                            @csrf

                            <div class="mb-3">
                                <label for="name" class="form-label">{{ __('message.name') }}</label>
                                <div class="input-group">
                                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name"
                                           value="{{ old('name') }}" placeholder="{{ __('message.name') }}">
                                    @error('name')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>

                            <button class="btn btn-success">
                                {{ __('message.create') }}
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
