@extends('layouts/app')

{{-- nav-bar --}}
@section('badminton-nav','active')
@section('badminton-subnav', 'show-dropdown')

@switch($category)
    @case('rackets')
        @section('badminton-rackets', 'subnav-active')
        @break
    @case('footwears')
        @section('badminton-footwears', 'subnav-active')
        @break
    @case('apparels')
        @section('badminton-apparels', 'subnav-active')
        @break
    @case('bags')
        @section('badminton-bags', 'subnav-active')
        @break
    @case('accessories')
        @section('badminton-accessories', 'subnav-active')
        @break
    @default        
@endswitch

{{-- components --}}
@include('products/components/product-js')
@include('products/components/product-card')