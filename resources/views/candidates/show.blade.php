@extends('layouts.app')
@section('content')
<div class="card">
    <div class="card-header">
        <div class="row">
            <div class="col-sm-8"><a href="{{ route('candidates.index') }}">{{ __('candidates.title') }}</a> / {{ __('global.show') }}</div>
            <div class="col-sm-4 text-end">
                <a href="{{ route('candidates.edit', $candidate->id) }}">{{ __('global.edit') }}</a>
            </div>
        </div>

    </div>
    <div class="card-body">
        <div class="row mb-3">
            <div class="col-sm-6">
                <label class="form-label">{{ __('candidates.fields.name') }}</label>
                <b>{{ $candidate->name }}</b>
            </div>
            <div class="col-sm-6">
                <label class="form-label">{{ __('candidates.fields.surname') }}</label>
                <b>{{ $candidate->surname }}</b>
            </div>
            <div class="col-sm-6 mt-2">
                <label class="form-label">{{ __('candidates.fields.email') }}</label>
                <b>{{ $candidate->email }}</b>
            </div>
            <div class="col-sm-6 mt-2">
                <label class="form-label">{{ __('candidates.fields.sa_id') }}</label>
                <b>{{ $candidate->sa_id }}</b>
            </div>
            <div class="col-sm-4 mt-2">
                <label class="form-label">{{ __('candidates.fields.mobile_number') }}</label>
                <b>{{ $candidate->mobile_number }}</b>
            </div>

            <div class="col-sm-4 mt-2">
                <label class="form-label">{{ __('candidates.fields.language') }}</label>
                <b>{{ $candidate->language }}</b>
            </div>
            <div class="col-sm-4 mt-2">
                <label class="form-label">{{ __('candidates.fields.date_of_birth') }}</label>
                <b>{{ $candidate->date_of_birth }}</b>
            </div>

        </div>
        <div class="col-sm-12 mt-2">
            <label class="form-label">{{ __('candidates.fields.interests') }}</label>
            <div class="row">
                @foreach (__('candidates.interests') as $k => $v)
                @php
                    $interests = explode(',', $candidate->interests);
                @endphp
                @if (in_array($k, $interests))
                    <div class="col-sm-4 mb-2">
                        <div class="form-check">
                            <input class="form-check-input" name="interests[]" type="checkbox" checked id="int_{{ $k }}" disabled >
                            <label class="form-check-label" for="int_{{ $k }}">
                                {{ $v }}
                            </label>
                        </div>
                    </div>
                @endif

                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection
