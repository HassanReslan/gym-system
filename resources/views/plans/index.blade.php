@extends('layouts.master')
@section('title', 'Plans') 
@section('content')
<div class="container">
    <h1 style="margin-bottom: 2rem;">Available Plans</h1>

    <div class="plans-container">
    
     @foreach ($plans as $plans )
        <div class="plan-card">
            <div class="plan-title">{{$plans->name}}</div>
            <div class="plan-price">${{$plans->price}}/month</div>
            <div class="plan-details">
                {!! $plans->description !!}
            </div>
            <div class="actions">
            <button class="btn btn-subscribe">Subscribe</button>
            <button class="btn btn-edit" >Edit</button>
            <button class="btn btn-delete">Delete</button>
            </div>
        </div> 
     @endforeach ()
  
    </div>
</div>
@endsection
