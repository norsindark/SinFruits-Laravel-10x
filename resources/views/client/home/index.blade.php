@extends('client.layouts.master')

@section('content')

  <body>
    <div class="home-wrapper home-1">

      <!-- Begin Slider Area One -->
      @include('client.components.slider')
      <!-- Slider Area One End Here -->


      <!-- Feature Area Start Here -->
      @include('client.components.feature')
      <!-- Feature Area End Here -->


      <!-- Product Area Start Here -->
      @include('client.components.products')
      <!-- Product Area End Here -->


      <!-- Banner Fullwidth Area Start Here -->
      @include('client.components.banner')
      
      <!-- Banner Area End Here -->


      <!-- Product Area Start Here -->
      @include('client.components.product-2')
      <!-- Product Area End Here -->


      <!-- Newslatter Area Start Here -->
      @include('client.components.newsletter')
      <!-- Newslatter Area End Here -->

      
      <!-- Latest Blog Area Start Here -->
      @include('client.components.blog')
      <!-- Latest Blog Area End Here -->





    </div>

    <!-- Modal Area Start Here -->
    @include('client.components.modal')    
    <!-- Modal Area End Here -->
  </body>

@endsection