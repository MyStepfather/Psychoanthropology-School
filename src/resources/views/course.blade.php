@extends('layout.main')

@section('title', 'Курс недели')

@section('content')
    <section class="course-page">
        <div class="wrapper course-page__wrapper">
            <a href="{{ url()->previous() }}">
                <span class="cross-shadow-inner">
                    <img class="course-page__cross" src="../img/icons/cross-course.svg" alt="Закрыть">
                </span>
            </a>
            @php dd($course->text) @endphp
            {!! $course->text !!}

            <a href="{{ url()->previous() }}">
                <button class="btn_white btn_white_border">Закрыть</button>
            </a>
        </div>
    </section>


@endsection

