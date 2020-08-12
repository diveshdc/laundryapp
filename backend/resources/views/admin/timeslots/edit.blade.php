@extends('layouts.admin')
@section('content')
<head>
    <link rel="stylesheet" href="{{ asset('css/admin/jquery.timepicker.min.css')}}">
</head>
<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('global.timeslot.title_singular') }}
    </div>

    <div class="card-body">
        <form action="{{ route('admin.timeslot.update', [$timeSlotId]) }}" method="POST" enctype="multipart/form-data" id="edit_role">
            @csrf
            @method('PUT')
            <div class="form-group {{ $errors->has('collection_date') ? 'has-error' : '' }}">
                <div id="collection_date" class="row">
                <div class="form-group col-sm-3">
               <label for="collection_date">{{ trans('global.timeslot.fields.collection_date') }}*</label>
                  <input name="collection_date" type="text" value="{{ old('collection_date', isset($collectionTimeSlotArray) ? $collectionTimeSlotArray['collection_date'] : '') }}" class="date start form-control" placeholder="Collection Time">
              </div>
                <div class="form-group col-sm-3">
                <label for="postal-code">Time From</label>
               <input name="collection_time_start" type="text" value="{{ old('collection_time_start', isset($collectionTimeSlotArray) ? $collectionTimeSlotArray['collection_time_start'] : '') }}" class="time start form-control" placeholder="00:00">
                </div>
                    <strong style="margin-top: 4%;">To</strong> 
                 <div class="form-group col-sm-3">
                <label for="postal-code">Time To</label>
                <input name="collection_time_end" type="text" value="{{ old('collection_time_end', isset($collectionTimeSlotArray) ? $collectionTimeSlotArray['collection_time_end'] : '') }}" class="time end form-control" placeholder="00:00">
                </div>
                @if($errors->has('collection_date'))
                    <em class="invalid-feedback">
                        {{ $errors->first('collection_date') }}
                    </em>
                @endif
                <p class="helper-block">
                    {{ trans('global.timeslot.fields.title_helper') }}
                </p>
                </div>
            </div>

             <div class="form-group {{ $errors->has('delivery_date') ? 'has-error' : '' }}">
                <div id="delivery_date" class="row">
            <div class="form-group col-sm-3">
                <label for="title">{{ trans('global.timeslot.fields.delivery_date') }}*</label>
                 <input name="delivery_date" type="text" value="{{ old('delivery_date', isset($deliveryTimeSlotArray) ? $deliveryTimeSlotArray['delivery_date'] : '') }}" class="date start form-control">
                </div>
                <div class="form-group col-sm-3">
                <label for="postal-code">Time From</label>
             <input name="delivery_time_start" type="text" value="{{ old('delivery_time_start', isset($deliveryTimeSlotArray) ? $deliveryTimeSlotArray['delivery_time_start'] : '') }}" class="time start form-control">
                </div>
                    <strong style="margin-top: 4%;">To</strong> 
                 <div class="form-group col-sm-3">
                <label for="postal-code">Time To</label>
                <input name="delivery_time_end" type="text" value="{{ old('delivery_time_end', isset($deliveryTimeSlotArray) ? $deliveryTimeSlotArray['delivery_time_end'] : '') }}" class="time end form-control">
                </div>
            </div>
        </div>
                @if($errors->has('delivery_date'))
                    <em class="invalid-feedback">
                        {{ $errors->first('delivery_date') }}
                    </em>
                @endif
                <p class="helper-block">
                    {{ trans('global.timeslot.fields.title_helper') }}
                </p>
            <div class="card-footer">
                <input class="btn btn-danger" type="submit" value="{{ trans('global.save') }}">
            </div>
        </form>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.4.1.min.js"
  integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
  crossorigin="anonymous"></script>
<script src="{{ asset('js/admin/datepair.min.js') }}"></script>
  <script src="{{ asset('js/admin/jquery.timepicker.min.js') }}"></script>
   <script>
    // initialize input widgets first
    $('#collection_date .time').timepicker({
        'showDuration': true,
        'timeFormat': 'H:i'
    });

    $('#collection_date .date').datepicker({
        'format': 'm/d/yyyy',
         'startDate': new Date(),
        'autoclose': true,
    });
    // initialize datepair
    $('#collection_date').datepair();
</script>
<script>
     $('#delivery_date .time').timepicker({
        'showDuration': true,
        'timeFormat': 'H:i'
    });

    $('#delivery_date .date').datepicker({
        'format': 'm/d/yyyy',
        'minDate': dateToday,
        'autoclose': true
    });

    // initialize datepair
    $('#delivery_date').datepair();
</script>

@endsection