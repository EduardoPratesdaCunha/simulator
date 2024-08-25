@extends('layouts.app')

@section('content')
<section>
  <form action="{{ route('simulate.update', ['id' => $simulate->id]) }}" method="post">
    @method('PATCH')
    @csrf

    @include('components.form_simulate', ['title' => 'Editar simulado']);

  </form>
</section>
@endsection