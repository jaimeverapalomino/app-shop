@extends('layouts.app')

@section('title', 'Bienvenido a '. config('app.name'))

@section('body-class', 'landing-page')

@section('styles')
    <style type="text/css">
        .team .row .col-md-4 {
            margin-bottom: 1em;
        }

        .team .row {
            display: -webkit-box;
            display: -webkit-flex;
            display: -ms-flexbox;
            display:         flex;
            flex-wrap: wrap;
        }

        .team .row > [class*='col-'] {
            display: flex;
            flex-direction: column;
        }

        .rounded {
            height: 150px;
            width: 150px;
            -webkit-border-radius: 50%;
            -moz-border-radius: 50%;
            -ms-border-radius: 50%;
            -o-border-radius: 50%;
            border-radius: 50%;
            background-size:cover;
        }

        .tt-query {
            -webkit-box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075);
            -moz-box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075);
            box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075);
    }

        .tt-hint {
            color: #999
        }

        .tt-menu {    /* used to be tt-dropdown-menu in older versions */
            width: 222px;
            margin-top: 4px;
            padding: 4px 0;
            background-color: #fff;
            border: 1px solid #ccc;
            border: 1px solid rgba(0, 0, 0, 0.2);
            -webkit-border-radius: 4px;
                -moz-border-radius: 4px;
                    border-radius: 4px;
            -webkit-box-shadow: 0 5px 10px rgba(0,0,0,.2);
                -moz-box-shadow: 0 5px 10px rgba(0,0,0,.2);
                    box-shadow: 0 5px 10px rgba(0,0,0,.2);
        }

        .tt-suggestion {
            padding: 3px 20px;
            line-height: 24px;
        }

        .tt-suggestion.tt-cursor,.tt-suggestion:hover {
            color: #fff;
            background-color: #0097cf;
        }

        .tt-suggestion p {
            margin: 0;
        }
    </style>
@endsection

@section('content')
<div class="header header-filter" style="background-image: url('https://images.unsplash.com/photo-1423655156442-ccc11daa4e99?crop=entropy&dpr=2&fit=crop&fm=jpg&h=750&ixjsv=2.1.0&ixlib=rb-0.3.5&q=50&w=1450');">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <h1 class="title">Bienvenido a {{ config('app.name') }}</h1>
                <h4>Pedidos en Linea.</h4>
                <br />
                <a href="https://www.youtube.com/watch?v=dQw4w9WgXcQ" class="btn btn-danger btn-raised btn-lg">
                    <i class="fa fa-play"></i> ¿Como Funciona?
                </a>
            </div>
        </div>
    </div>
</div>

<div class="main main-raised">
    <div class="container">
        <div class="section text-center section-landing">
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <h2 class="title">Let's talk product</h2>
                    <h5 class="description">This is the paragraph where you can write more details about your product. Keep you user engaged by providing meaningful information. Remember that by this time, the user is curious, otherwise he wouldn't scroll to get here. Add a button if you want the user to see more.</h5>
                </div>
            </div>

            <div class="features">
                <div class="row">
                    <div class="col-md-4">
                        <div class="info">
                            <div class="icon icon-primary">
                                <i class="material-icons">chat</i>
                            </div>
                            <h4 class="info-title">Atendemos tus dudas</h4>
                            <p>Atendemos rápidamente cualquier consulta que tengas vía chat. No estás sólo, siempre estamos atentos a tus inquietudes.</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="info">
                            <div class="icon icon-success">
                                <i class="material-icons">verified_user</i>
                            </div>
                            <h4 class="info-title">Pago Seguro</h4>
                            <p>Todo pedido que realices será confirmado a través de una llamada. Si no confías en los pagos en lìnea, puedes pagar contra entrega el valor acordado.</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="info">
                            <div class="icon icon-danger">
                                <i class="material-icons">fingerprint</i>
                            </div>
                            <h4 class="info-title">Información Privada</h4>
                            <p>Los pedidos que realices sólo los conocerás tú a través de tu pnale de usuario. Nadie más tiene acceso a esta información.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="section text-center">
            <h2 class="title">Categorías Disponibles</h2>
                <form class="form-inline" method="get" action="{{ url('/search') }}">
                    <input type="text" placeholder="Buscar producto" class="form-control" name="query" id="search">
                    <button class="btn btn-primary btn-just-icon" type="submit">
                        <i class="material-icons">search</i>
                        
                    </button>

                </form>
            <div class="team">
                <div class="row">
                    @foreach($categories as $category) 
                    <div class="col-md-4">
                        <div class="team-player">
                            <img src="{{ $category->random_image_url }}" alt="Imagen representativa de la categoría {{ $category->name }}" class="img-raised rounded">
                            <h4 class="title">
                                <a href="{{ url('/categories/'.$category->id) }}">{{ $category->name }}</a>
                            </h4>
                            <p class="description">{{ $category->descripcion }} </p>
                        </div>
                    </div>
                    @endforeach
                </div>

        </div>
    </div>

</div>

@include('includes.footer')
@endsection

@section('scritps')
    <script src= "{{ asset('/js/typeahead.bundle.min.js') }}"></script>

    <script>
        $(function() {
            // constructs the suggestion engine
            var products = new Bloodhound({
                datumTokenizer: Bloodhound.tokenizers.whitespace,
                queryTokenizer: Bloodhound.tokenizers.whitespace,
                prefetch: '{{ url("/products/json") }}'
            });

            //init typehead
            $('#search').typeahead({
                //propiedades
                hint: true,
                hight: true,
                minLength: 1
            }, {
                //dataset
                name: 'products',
                source: products
            });
        });
    </script>
@endsection
