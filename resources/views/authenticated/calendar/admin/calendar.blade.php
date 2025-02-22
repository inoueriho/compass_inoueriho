@extends('layouts.sidebar')

@section('content')
@can ('admin_only')
<div class="w-75 m-auto">
  <div class="w-100">
    <p>{{ $calendar->getTitle() }}</p>
    <p>{!! $calendar->render() !!}</p>
  </div>
</div>
@endcan
@endsection
