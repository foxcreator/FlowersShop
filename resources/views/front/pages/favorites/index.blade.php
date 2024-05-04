@extends('front.layouts.app')
@section('content')
     <div class="container" style="padding-top: 150px; margin-bottom: 400px">
         <h1>Избранное</h1>
         @include('front.pages.favorites.parts.favorites', ['products' => $products])
     </div>
@endsection
