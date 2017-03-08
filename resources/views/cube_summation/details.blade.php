@extends('layouts.app')

@section('content')
<div class="container">
    <h3>Tests <small>Detalles</small></h3>
    <a class="btn btn-success btn-lg" href="{{ route('cube_summation.generate_plain') }}">
        + Nuevo
    </a>

    <hr>

    <div class="table-responsive">
        <table class="table table-bordered table-hover table-condensed">       
            <caption><h4>Resultados</h4></caption>
            <tbody> 
                @foreach($test->cubes as $case)
                <tr class="active">
                    <td colspan="2">
                        <strong>Matrix Size: </strong>{{ $case->matrix_size }} <strong>Number Operations: </strong>{{ $case->number_operations }}
                    </td>
                </tr>   
                @foreach ($case->operationsUpdate as $operation)
                <tr>                
                    <td>UPDATE {{ $operation->x }} {{ $operation->y }} {{ $operation->z }} {{ $operation->W }}</td>
                    <td>-</td>               
                </tr>
                @endforeach

                @foreach ($case->operationsQuery as $operation)
                <tr>                
                    <td>QUERY {{ $operation->x1 }} {{ $operation->y1 }} {{ $operation->z1 }} {{ $operation->x2 }} {{ $operation->y2 }} {{ $operation->z2 }}</td>
                    <td>{{ $operation->result }}</td>               
                </tr>
                @endforeach
                @endforeach
            </tbody>
        </table>
    </div>


</div>
@endsection


