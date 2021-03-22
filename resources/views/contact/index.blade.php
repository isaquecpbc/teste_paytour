@extends('templates.srtdash.template')

@push('styles')
    @include('templates.srtdash.inc.datatablecss')
@endpush

@push('scripts')
    @include('templates.srtdash.inc.datatablejs')
@endpush

@section('content')
<div class="row justify-content-center form-row align-items-center">

    @if(isset($errors) && count($errors) > 0)

    <div class="col-md-12 mt-3">
        <div class="alert alert-danger w-100">
           @foreach( $errors->all() as $error )
            <p>{{$error}}</p>
            @endforeach
        </div>
    </div>

    @endif
    
    @if(session()->has('status'))

    <div class="col-md-12 mt-3">
        <div class="alert alert-success w-100">
            <p>{{session()->get('status')}}</p>
        </div>
    </div>
    @endif

    <div class="col-md-12 mt-3">
        <div class="col-md-12">
            <h1 class="col-md-11 d-inline-block">Contatos:</h1>
            <a href="{{route('contacts.create')}}"><button type="button" class="btn btn-primary float-end">Cadastrar</button></a>
        </div>
    </div>

    <!-- data table start -->
    <div class="col-12 mt-5">
        <div class="card">
            <div class="card-body">
                <div class="data-tables">
                    <table id="dataTable" class="table table-hover text-center">
                        <thead class="text-capitalize bg-info">
                            <tr class="text-white">
                                <th>ID</th>
                                <th>Nome</th>
                                <th>Telefone</th>
                                <th>E-mail</th>
                                <th>Cargo</th>
                                <th>Escolaridade</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($contacts as $contact)
                            <tr>
                                <th scope="row">{{$contact->id}}</th>
                                <td>{{$contact->name}}</td>
                                <td>{{$contact->phone}}</td>
                                <td>{{$contact->email}}</td>
                                <td>{{$contact->desired_job}}</td>
                                <td>{{$contact->education}}</td>
                                <td>
                                    <ul class="d-flex justify-content-center">
                                        <li class="mr-3"><a href="{{route('contacts.show', $contact->id)}}" class="text-secondary text-info" data-toggle="tooltip" data-placement="bottom" title="Visualizar" alt="Visualizar"><i class="fa fa-eye"></i></a></li>
                                        <li class="mr-3"><a href="{{route('contacts.edit', $contact->id)}}" class="text-secondary" data-toggle="tooltip" data-placement="bottom" title="Editar" alt="Editar"><i class="fa fa-edit"></i></a></li>
                                        <li>
                                            {!! Form::open(['route' => ['contacts.destroy', $contact->id], 'class' => '', 'method' => 'DELETE']) !!}
                                                <button type="submit" class="text-danger bnt-excluir" data-toggle="tooltip" data-placement="bottom" title="Excluir" alt="Excluir"><i class="ti-trash"></i></button>
                                            {!! Form::close() !!}
                                        </li>
                                    </ul>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- data table end -->

</div>
@endsection

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<script type="text/javascript">
    
  $('.form-delete').submit(function(e) {
      e.preventDefault();

      if ( confirm("Are you sure you want to delete?") ) {
          $(this).submit();
      }
  });

</script>