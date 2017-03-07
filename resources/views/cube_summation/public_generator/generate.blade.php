@extends('layouts.public')

@section('content')
{!! Form::open(['method' => 'POST', 'route' => 'cube_summation.public_generator.execute']) !!}

{!! Field::textarea('cases') !!}                    

<div class="form-group">
    <div class="col-md-6 col-md-offset-4">
        <button type="submit" class="btn btn-primary">
            @lang('validation.attributes.generate')
        </button>
    </div>
</div>
{!! Form::close() !!}
@endsection
