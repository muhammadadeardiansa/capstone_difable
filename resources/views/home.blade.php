@extends('layout')

@section('content')
<h1>Mata Pelajaran</h1>
<div class="list-group">
    @foreach($subjects as $subject)
    <a href="/quiz/{{ $subject->id }}" class="list-group-item list-group-item-action">
        {{ $subject->name }}
    </a>
    @endforeach
</div>
@endsection