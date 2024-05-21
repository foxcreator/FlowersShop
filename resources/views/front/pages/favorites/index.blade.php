@extends('front.layouts.app')
@section('content')
     <div class="container" style="padding-top: 200px; margin-bottom: 400px">
         <h1>{{ __('profile.favorite') }}</h1>
         @include('front.pages.favorites.parts.favorites', ['products' => $products])
     </div>
@endsection
