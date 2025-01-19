@extends('layout')

@section('content')
<div class="d-flex flex-column align-items-center">
    <div class="text-loader">
        <span>A</span>
        <span>Y</span>
        <span>O</span>
        <span> </span>
        <span>B</span>
        <span>E</span>
        <span>L</span>
        <span>A</span>
        <span>J</span>
        <span>A</span>
        <span>R</span>
    </div>
    <div
        class="container d-flex justify-content-center flex-row"
        style="overflow-x: auto; padding: 10px">
        <div class="d-flex gap-5">
            @foreach($subjects as $subject)
            <a
                href="/quiz/{{ $subject->id }}"
                class="grid__item position-relative text-white text-decoration-none"
                style="flex: 1">
                <div
                    class="item__content p-4 border border-light position-relative d-flex flex-column"
                    style="height: 250px; width: 250px; background-color: #c4d9ff">
                    <img
                        src="{{ asset('images/subject_' . $subject->id . '.png') }}"
                        alt="{{ $subject->name }}"
                        class="item__image mb-3" />
                    <h5
                        class="fw-bold mb-2"
                        style="
                  color: #ff9d23;
                  font-family: 'Chewy', serif;
                  letter-spacing: 1px;
                  text-align: center;
                ">
                        {{ $subject->name }}
                    </h5>
                </div>
            </a>
            @endforeach
        </div>
    </div>
</div>
@endsection