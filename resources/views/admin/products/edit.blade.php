@extends('layouts.app')

@section('title', 'Bienvenido a App Shop')

@section('body-class', 'product-page')

@section('content')
<div class="header header-filter" style="background-image: url('https://images.unsplash.com/photo-1423655156442-ccc11daa4e99?crop=entropy&dpr=2&fit=crop&fm=jpg&h=750&ixjsv=2.1.0&ixlib=rb-0.3.5&q=50&w=1450');">

</div>

<div class="main main-raised">
    <div class="container">
        <div class="section">
            <h2 class="title text-center">Editar producto seleccionado</h2>
            @if ($errors->any())
                <div class="alert alert-danger">
                    <u1>
                        @foreach ($errors->all() as $error)
                            <li> {{ $error }} </li>
                        @endforeach
                    </u1>
                </div>
            @endif

            <form method="post" action="{{ url('/admin/products/'.$product->id.'/edit') }}">
                @csrf
                <div class="=row">
                    <div class="col-sm-6">
                        <div class="form-group label-floating">
                            <label class="control-label">Nombre del producto</label>
                            <input type="text" class="form-control" name="name" value="{{ old('name', $product->name) }}">
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="form-group label-floating">
                            <label class="control-label">Precio del producto</label>
                            <input type="number" step="0.01" class="form-control" name="price" value="{{ old('price', $product->price) }}">
                        </div>
                    </div>
                </div> 

                <div class="form-group label-floating">
                    <label class="control-label">Descripción corta  </label>
                    <input type="text" class="form-control" name="descripcion" value="{{ old('descripcion', $product->descripcion) }}">
                </div> 

                <textarea class="form-control" placeholder="Descripción extensa del producto" name="long_descripcion" rows="5">{{ old('long_descripcion', $product->long_descripcion) }}</textarea>

                <button class="btn btn-primary">Guardar cambios</button>
                <a class="btn btn-default" href=" {{ url('/admin/products') }}">Cancelar</a>
            </form>
        </div>
    </div>

</div>

@include('includes.footer')
@endsection
