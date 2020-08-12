@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('global.new') }} {{ trans('global.pushnotification.title_singular') }}
    </div>

    <div class="card-body">
        <form action="{{ route('admin.pushnotification.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            
        </form>
    </div>
</div>

@endsection