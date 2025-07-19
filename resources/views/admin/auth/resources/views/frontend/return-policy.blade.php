<!-- resources/views/home.blade.php -->
@extends('frontend.app')
@section('pageclass')
<div class="returnPolicy">
@endsection
@section('header')
@include('frontend.header') {{-- Include header content --}}
@endsection

@section('content')
<div class="heroBanner">
              <h1 class="siteTitle">Return Policy</h1>
            </div>
            <div class="bodyText">
              <h2 class="bodyTitle">Return Policy</h2>
              <p>
                Since this is an investment product, there is no return policy
              </p>
            </div>
@endsection

@section('footer')
@include('frontend.footer') {{-- Include footer content --}}
@endsection