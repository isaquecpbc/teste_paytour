@extends('templates.srtdash.template')

@section('content')

    @if(isset($errors) && count($errors) > 0)

    <div class="alert alert-danger">
    	@foreach( $errors->all() as $error )
    	<p>{{$error}}</p>
    	@endforeach
    </div>

    @endif

    @if(isset($contact))
        {!! Form::open(['route' => ['contacts.update', $contact->id], 'class' => 'form', 'files' => true, 'enctype' => 'multipart/form-data', 'method' => 'PUT']) !!}
    @else
        {!! Form::open(['route' => 'contacts.store', 'class' => 'form', 'files' => true, 'enctype' => 'multipart/form-data',]) !!}
    	<div class="col-sm-12 py-5">
            <h1>Cadastro de Contato</h1>   
        </div>
    @endif
    <div class='row justify-content-center mt-3 form-row align-items-center'>
        <div class="col-sm-12 my-1"><div class="form-group">
            {!! Form::label('name', 'Nome', ['class' => 'custom-control']) !!}
            {!! Form::text('name', $contact->name ?? null, ['class' => 'form-control', 'placeholder' => 'Escreva seu nome...']) !!}</div></div>
        <div class="col-sm-6 my-1"><div class="form-group">
            {!! Form::label('phone', 'Telefone', ['class' => 'custom-control']) !!}
            {!! Form::text('phone', $contact->phone ?? null, ['class' => 'form-control', 'placeholder' => 'Apenas números...']) !!}</div></div>
        <div class="col-sm-6 my-1"><div class="form-group">
            {!! Form::label('email', 'E-mail', ['class' => 'custom-control']) !!}
            {!! Form::text('email', $contact->email ?? null, ['class' => 'form-control', 'placeholder' => 'Exemplo: email@exemplo.com.br']) !!}</div></div>
        <div class="col-sm-6 my-1"><div class="form-group">
            {!! Form::label('desired_job', 'Cargo desejado', ['class' => 'custom-control']) !!}
            {!! Form::text('desired_job', $contact->desired_job ?? null, ['class' => 'form-control', 'placeholder' => '']) !!}</div></div>
        <div class="col-sm-6 my-1"><div class="form-group">
            {!! Form::label('education', 'Escolaridade', ['class' => 'custom-control']) !!}
            {!! Form::select('education', $educations, $contact->education ?? 'selecione', ['id' => 'educations', 'class' => 'form-control']) !!}</div></div>

        <div class="col-md-6"><div class="form-group">
            {!! Form::label('archive', 'Anexo', ['class' => 'custom-control']) !!}
            {!! Form::file('archive', ['class' => 'form-control', 'id' => 'archive']) !!}</div></div>

            {!! Form::hidden('archive', $contact->ip_address ?? null) !!}

        <div class="col-md-6 ">{!! Form::submit('Salvar',['class' => 'btn btn-primary pull-right']) !!}</div>
    </div>
    {!! Form::close() !!}

@endsection