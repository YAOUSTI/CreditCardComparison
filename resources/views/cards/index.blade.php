@extends('layouts.app')

@section('title', 'Comparison of Credit Cards')

@section('content')

<style>
    .card-item {
        display: flex;
        justify-content: space-between;
        background-color: #fff;
        padding: 20px;
        margin-bottom: 15px;
        border-radius: 4px;
        box-shadow: 0 1px 2px rgba(0, 0, 0, 0.1);
    }

    .card-left {
        display: flex;
    }

    .logo {
        width: 180px;
        height: auto;
        margin-right: 15px;
    }

    .features {
        display: flex;
        flex-direction: column;
        justify-content: center;
        font-size: 14px;
    }

    .features .check {
        color: green;
        font-weight: bold;
    }

    .features .warning {
        color: orange;
        font-weight: bold;
    }

    .card-right {
        text-align: right;
        font-weight: bold;
        color: #007bff;
        min-width: 180px;
    }

    .sort-buttons {
        margin-bottom: 20px;
        text-align: center;
    }
</style>

<div class="sort-buttons">
    <span>Sort by:</span>
    <a href="{{ route('cards.index', ['sort' => 'fees']) }}"
        class="btn btn-sm {{ request('sort', 'fees') == 'fees' ? 'btn-primary' : 'btn-outline-primary' }}">
        Price
    </a>
    <a href="{{ route('cards.index', ['sort' => 'name']) }}"
        class="btn btn-sm {{ request('sort') == 'name' ? 'btn-primary' : 'btn-outline-primary' }}">
        Alphabetical
    </a>
</div>

@foreach($cards as $card)
<h5>{{ $loop->iteration }}. <a href="{{ $card->link }}" target="_blank">{{ $card->display_name }}</a></h5>
<div class="card-item">
    <div class="card-left">
        <img src="{{ $card->logo }}" alt="{{ $card->display_name }}" class="logo">
        <div>
            <div class="features">
                @foreach($card->features as $feature)
                <div>
                    <span class="{{ $feature->type === 'positive' ? 'check' : 'warning' }}">
                        {{ $feature->type === 'positive' ? '✓' : '!' }}
                    </span>
                    {{ $feature->name }}
                </div>
                @endforeach
            </div>
        </div>
    </div>
    <div class="card-right">
        {{ number_format($card->display_fees, 2, ',', '.') }} €
        <div class="text-muted" style="font-size:0.8rem;">
            Cuota anual<br>
            (cuota primer año: <strong>{{ number_format($card->annual_fee_first_year, 2, ',', '.') }} €</strong>)<br>
            <strong>TAE {{ number_format($card->tae, 2, ',', '.') }}%</strong>
        </div>
        <div class="mt-2">
            <a href="{{ $card->link }}" target="_blank">ver oferta en la web »</a>
        </div>
    </div>
</div>
@endforeach

<div class="text-center mt-4">
    <a href="{{ route('cards.start') }}" class="btn btn-secondary">Back to Home</a>
</div>

@endsection