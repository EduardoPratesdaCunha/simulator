@extends('layouts.app')

@section('content')
<section>
  <form action="{{ route('simulate.store') }}" method="post">
    @method('POST')
    @csrf

    @include('components.form_simulate', ['title' => 'Criar simulado'])

  </form>
</section>
@endsection