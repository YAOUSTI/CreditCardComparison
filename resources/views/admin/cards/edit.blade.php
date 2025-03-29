@extends('layouts.app')

@section('content')
<h2>Edit Credit Card - {{ $card->product_name }}</h2>

<!-- Update Form -->
<form id="update-card-form" action="{{ route('admin.cards.update', $card->id) }}" method="POST">
    @csrf
    @method('PUT')

    <div class="mb-3">
        <label>Name</label>
        <input type="text" name="product_name" class="form-control"
            value="{{ $edits['product_name'] ?? $card->product_name }}">
    </div>

    <div class="mb-3">
        <label>Fees (€)</label>
        <input type="number" step="0.01" name="fees" class="form-control"
            value="{{ $edits['fees'] ?? $card->fees }}">
    </div>

    <div class="mb-3">
        <label>Annual Fee First Year (€)</label>
        <input type="number" step="0.01" name="annual_fee_first_year" class="form-control"
            value="{{ $edits['annual_fee_first_year'] ?? $card->annual_fee_first_year }}">
    </div>

    <div class="mb-3">
        <label>TAE (%)</label>
        <input type="number" step="0.01" name="tae" class="form-control"
            value="{{ $edits['tae'] ?? $card->tae }}">
    </div>

    <button type="submit" class="btn btn-success">Save Changes</button>
    <a href="{{ route('admin.cards.index') }}" class="btn btn-secondary">Cancel</a>
</form>

<hr>

<!-- Section for Removing Manual Edits -->
<h3>Manual Edits</h3>
<ul>
    @if(isset($edits['product_name']))
    <li>
        <strong>Name</strong> was manually edited.
        <form action="{{ route('admin.cards.removeEdit', ['cardId' => $card->id, 'field' => 'product_name']) }}" method="POST" style="display:inline;">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-sm btn-danger">Remove Edit</button>
        </form>
    </li>
    @endif

    @if(isset($edits['fees']))
    <li>
        <strong>Fees</strong> was manually edited.
        <form action="{{ route('admin.cards.removeEdit', ['cardId' => $card->id, 'field' => 'fees']) }}" method="POST" style="display:inline;">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-sm btn-danger">Remove Edit</button>
        </form>
    </li>
    @endif

    @if(isset($edits['annual_fee_first_year']))
    <li>
        <strong>Annual Fee First Year</strong> was manually edited.
        <form action="{{ route('admin.cards.removeEdit', [$card->id, 'annual_fee_first_year']) }}" method="POST" style="display:inline;">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-sm btn-danger">Remove Edit</button>
        </form>
    </li>
    @endif

    @if(isset($edits['tae']))
    <li>
        <strong>TAE</strong> was manually edited.
        <form action="{{ route('admin.cards.removeEdit', [$card->id, 'tae']) }}" method="POST" style="display:inline;">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-sm btn-danger">Remove Edit</button>
        </form>
    </li>
    @endif
</ul>
@endsection