@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('global.client.title_singular') }}
    </div>

    <div class="card-body">
        <form action="{{ route('admin.clients.update', $user->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
         
                <input class="btn btn-danger" type="submit" value="{{ trans('global.save') }}">
        </form>
    </div>
</div>

@endsection