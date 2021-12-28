@extends('layouts.app')

@section('title', 'Главная')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <span>{{ __('message.contacts') }}</span>
                            <a href="{{ route('contacts.create') }}" class="btn btn-success">
                                {{ __('message.create') }}
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-12 mt-3">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('contacts.index') }}" method="get">
                            <div class="mb-3">
                                <label for="name">{{ __('message.name') }}</label>
                                <input type="text" id="name" name="name" class="form-control" placeholder="{{ __('message.name') }}" value="{{ old('name', request()->get('name')) }}">
                            </div>

                            <button class="btn btn-success">{{ __('message.search') }}</button>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-md-12 my-3">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>{{ __('message.name') }}</th>
                                    <th>{{ __('message.actions') }}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($contacts as $contact)
                                    <tr>
                                        <th>{{ $contact->id }}</th>
                                        <td>{{ $contact->name }}</td>
                                        <td class="d-flex">
                                            <a href="{{ route('contacts.show', $contact->id) }}" class="btn btn-success">{{ __('message.show') }}</a>
                                            <a href="{{ route('contacts.edit', $contact->id) }}" class="btn btn-warning mx-3">{{ __('message.edit') }}</a>
                                            <form action="{{ route('contacts.destroy', $contact->id) }}" method="post">
                                                @csrf
                                                @method('delete')

                                                <button class="btn btn-danger" onclick="return confirm('{{ __('message.are_u_sure') }}');">{{ __('message.delete') }}</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>

                        <div class="d-flex justify-content-center">
                            {{ $contacts->appends(request()->all())->links('components.pagination') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
