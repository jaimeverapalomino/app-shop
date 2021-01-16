@extends('layouts.app')

@section('title', 'Resultados de la búsqueda')

@section('body-class', 'profile-page')
@section('styles')
    <style type="text/css">
        .rounded {
           height: 100px;
           width: 100px;
           -webkit-border-radius: 50%;
           -moz-border-radius: 50%;
           -ms-border-radius: 50%;
           -o-border-radius: 50%;
           border-radius: 50%;
           background-size:cover;
        }

        .team {
          padding-bottom: 50px; 
        }

        .team .row .col-md-4 {
          margin-bottom: 5em;
        }

        .team .row {
          display: -webkit-box;
          display: -webkit-flex;
          display: -ms-flexbox;
          display: flex;
          flex-wrap: wrap;
        }

        .team .row > [class*='col-'] {
          display: flex;
          flex-direction: column;
        }
    </style>
@endsection



@section('content')
<div class="header header-filter" style="background-image: url('/img/examples/city.jpg');"></div>

<div class="main main-raised">
    <div class="profile-content">
        <div class="container">
            <div class="row">
                <div class="profile">
                    <div class="name">
                        <h3 class="title">Resultados de la búsqueda</h3>
                    </div>

                    @if (session('notification'))
                      <div class="alert alert-success" role="alert">
                       {{ session('notification') }}
                      </div>
                    @endif
                    
                </div>
            </div>
            <div class="description text-center">
                <p>Se encontraron {{ $products->count() }} resultados para el término {{ $query }}</p>
            </div>

            <div class="team text-center">
                <div class="row">
                    @foreach($products as $product) 
                    <div class="col-md-4">
                        <div class="team-player">
                            <img src="{{ $product->featured_image_url }}" alt="Thumbnail Image" class="img-raised rounded">
                            <h4 class="title">
                                <a href="{{ url('/products/'.$product->id) }}">{{ $product->name }}</a>
                            </h4>
                            <p class="description">{{ $product->descripcion }} </p>
                        </div>
                    </div>
                    @endforeach
                </div>
                <div class="text-center">
                    {{ $products->links() }}
                </div>
            </div>            


        </div>
    </div>
</div>

@include('includes.footer')
@endsection