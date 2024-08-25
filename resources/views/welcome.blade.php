@extends('layouts.layout')

@section('content')
<section>

  <form action="{{ route('simulate.store') }}" method="post">
    @method('POST')
    @csrf

    @include('components.form_simulate', ['title' => 'Simulador de juros composto'])

  </form>

</section>
@endsection
