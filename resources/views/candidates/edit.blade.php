@extends('layouts.app')

@section('content')
<form id="candidateForm">
    @csrf
    @method('PUT')
    <div class="card">
        <div class="card-header">
            <a href="{{ route('candidates.index') }}">{{ __('candidates.title') }}</a> / {{ __('global.update') }}
        </div>
        <div class="card-body">
            @include('candidates.form', ['candidate'=>$candidate])
        </div>
    </div>
</form>
@endsection
