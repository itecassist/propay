@extends('layouts.app')
@section('content')
<form id="candidateForm">
    @csrf
    <div class="card">
        <div class="card-header">
            <a href="{{ route('candidates.index') }}">{{ __('candidates.title') }}</a> / {{ __('global.create') }}
        </div>
        <div class="card-body">
            @include('candidates.form')
        </div>
    </div>
</form>
@endsection
