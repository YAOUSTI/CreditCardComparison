@extends('layouts.app')

@section('title', 'Comparison of Credit Cards')

@section('content')
<div class="text-center">
    <p class="mb-4">Find the credit card that suits your needs.</p>
    <a href="{{ route('cards.index') }}" class="btn btn-primary">Compare Now</a>
</div>
@endsection