@extends('layouts.public')

@section('content')
{!! Form::open(['method' => 'POST', 'route' => 'cube_summation.public_generator.execute']) !!}

{!! Field::textarea('cases') !!}                    

<div class="form-group">
    <div>
        <button type="submit" class="btn btn-default">
            @lang('validation.attributes.generate')
        </button>
    </div>
</div>
{!! Form::close() !!}

@endsection

@section('content_r')

@if (isset($response))
<div class="table-responsive">
    <table class="table table-bordered table-hover table-condensed">       
        <caption><h4>Resultados</h4></caption>
        <tbody> 
            @foreach($response['cases'] as $case)
            <tr class="active">
                <td colspan="2">
                    <strong>Case: </strong>{{ $case['case_number'] }} <strong>Matrix Size: </strong>{{ $case['matrix_size'] }} <strong>Number Operations: </strong>{{ $case['number_operations'] }}
                </td>
            </tr>   
            @foreach ($case['operation'] as $operation)
            <tr>                
                <td>{{ $operation['text']  }}</td>
                <td>{{ isset($operation['result']) ? $operation['result'] : '-'}}</td>               
            </tr>
            @endforeach
            @endforeach
        </tbody>
    </table>
</div>
@endif
@endsection
