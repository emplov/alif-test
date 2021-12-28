@extends('layouts.app')

@section('title', 'Просмотр')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex flex-wrap">
                            <a href="{{ route('contacts.index') }}" class="btn btn-success">{{ __('message.back') }}</a>
                            <a href="{{ route('contacts.edit', $contact->id) }}"
                               class="btn btn-warning mx-3">{{ __('message.edit') }}</a>
                            <form action="{{ route('contacts.destroy', $contact->id) }}" method="post">
                                @csrf
                                @method('delete')

                                <button class="btn btn-danger"
                                        onclick="return confirm('{{ __('message.are_u_sure') }}');">{{ __('message.delete') }}</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-12 mt-3">
                <div>
                    <a href="{{ route('phone.create', $contact->id) }}" class="btn btn-primary">{{ __('message.add_phone') }}</a>
                    <a href="{{ route('email.create', $contact->id) }}" class="btn btn-primary">{{ __('message.add_email') }}</a>
                </div>
            </div>

            <div class="col-md-12 mt-3">
                <ul class="list-group">
                    <li class="list-group-item">ID: {{ $contact->id }}</li>
                    <li class="list-group-item">{{ __('message.name') }}: {{ $contact->name }}</li>
                </ul>

                <ul class="list-group mt-3">
                    @foreach($contact->phones as $phone)
                        <li class="list-group-item">
                            <div class="d-flex justify-content-between">
                                <span>{{ __('message.phone') }}: {{ $phone->phone }}</span>
                                <div class="d-flex">
                                    <a href="{{ route('phone.edit', [$contact->id, $phone->id]) }}" class="btn btn-warning mx-3">{{ __('message.edit') }}</a>
                                    <form action="{{ route('phone.destroy', [$contact->id, $phone->id]) }}" method="post">
                                        @csrf

                                        <button class="btn btn-danger" onclick="return confirm('{{ __('message.are_u_sure') }}')">
                                            {{ __('message.delete') }}
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </li>
                    @endforeach
                </ul>

                <ul class="list-group mt-3">
                    @foreach($contact->emails as $email)
                        <li class="list-group-item">
                            <div class="d-flex justify-content-between">
                                <span>{{ __('message.email') }}: {{ $email->email }}</span>
                                <div class="d-flex">
                                    <a href="{{ route('email.edit', [$contact->id, $email->id]) }}" class="btn btn-warning mx-3">{{ __('message.edit') }}</a>
                                    <form action="{{ route('email.destroy', [$contact->id, $email->id]) }}" method="post">
                                        @csrf

                                        <button class="btn btn-danger" onclick="return confirm('{{ __('message.are_u_sure') }}')">
                                            {{ __('message.delete') }}
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>

@endsection
