@extends('layouts.app')

@section('content')
<div class="container">
    <h3>Tests <small>Lits</small></h3>
    <a class="btn btn-success btn-lg" href="{{ route('cube_summation.generate_plain') }}">
        + Nuevo
    </a>
    
    <hr>

    <div class="list-group">
        @foreach($tests as $test)
        <a href="{{ route('cube_summation.details', [$test->id]) }}" class="list-group-item"><strong>Número Pruebas: </strong>{{ $test->size }} - creado el {{ $test->created_at->format('Y-m-d H:i') }}</a>
        @endforeach
    </div>
</div>
@endsection


