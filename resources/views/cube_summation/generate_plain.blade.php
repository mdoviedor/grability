@extends('layouts.app')

@section('content')
<div class="container">
    {!! Form::open(['method' => 'POST', 'route' => 'cube_summation.generate_plain.execute']) !!}

    {!! Field::textarea('cases') !!}                    

    <div class="form-group">
        <div>
            <button type="submit" class="btn btn-default">
                @lang('validation.attributes.generate')
            </button>
        </div>
    </div>
    {!! Form::close() !!}
</div>
@endsection