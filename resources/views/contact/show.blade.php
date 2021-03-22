@extends('templates.srtdash.template')

@push('styles')
    @include('templates.srtdash.inc.datatablecss')
@endpush

@push('scripts')
    @include('templates.srtdash.inc.datatablejs')
@endpush

@section('content')
    <!-- <h2>Listagem do Brand {{$contact->name}}.</h2> -->
    <div id="logoShow">
    <div class='col-md-12'>
      <h2 class="col-md-11 d-inline-block">Contato de <i>{{$contact->name}}</i></h2>
      <a href="{{route('contacts.index')}}"><button type="button" class="btn btn-primary float-end">Voltar</button></a>
    </div>
    <div class='col-md-12'>
      <ul class="d-flex mt-3">
                <li class="mr-3">
                  <a href="{{route('contacts.edit', $contact->id)}}" class="text-secondary" data-toggle="tooltip" data-placement="bottom" title="Edit data" alt="Edit Brand data"><i class="fa fa-edit"></i></a>
                </li>
                <li class="justify-content-center">
                    {!! Form::open(['route' => ['contacts.destroy', $contact->id], 'class' => 'justify-content-center form-delete', 'method' => 'DELETE', 'onsubmit' => 'return confirm("Are you sure you want to delete?")']) !!}
                        <button type="submit" class="text-danger bnt-excluir" data-toggle="tooltip" data-placement="bottom" title="Delete" alt="Delete"><i class="ti-trash"></i></button>
                    {!! Form::close() !!}
                </li>
            </ul>
    </div>
    <hr>
    </div>

    <div class='container py-4'>
        <div class='row justify-content-center'>
          <div class='col-md-8'>
            <div class='card'>
              <div class='card-header bg-primary text-white'>
                <h4 class='list-inline-item'>Dados de: <strong>{{$contact->name}}</strong></h4>
              </div>
              <div class='card-body'>

                <ul class='list-group list-group-flush' id="phones">
                    <div class='list-group-item list-group-item-action d-flex'>
                        <i>Name</i><p>{{$contact->name}}</p>
                    </div>
                    <div class='list-group-item list-group-item-action d-flex'>
                        <i>Telefone</i><p>{{$contact->phone}}</p>
                    </div>
                    <div class='list-group-item list-group-item-action d-flex'>
                        <i>E-mail</i><p>{{$contact->email}}</p>
                    </div>
                    <div class='list-group-item list-group-item-action d-flex'>
                        <i>Cargo</i><p>{{$contact->desired_job}}</p>
                    </div>
                    <div class='list-group-item list-group-item-action d-flex'>
                        <i>Escolaridade</i><p>{{$contact->education}}</p>
                    </div>
                    <div class='list-group-item list-group-item-action d-flex'>
                        <i>Arquivo</i><p>{{$contact->archive}}</p>
                    </div>
                    <div class='list-group-item list-group-item-action d-flex'>
                        <i>Ip</i><p>{{$contact->ip_address}}</p>
                    </div>
                    <div class='list-group-item list-group-item-action d-flex'>
                        <i>Data<br>created</i><p>{{$contact->created_at}}</p>
                    </div>
                </ul>
              </div>
            </div>
          </div>
        </div>
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