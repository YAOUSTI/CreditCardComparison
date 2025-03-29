@extends('layouts.app')

@section('content')
<h2>Manage Credit Cards</h2>

@if(session('success'))
<div class="alert alert-success">{{ session('success') }}</div>
@endif

<table class="table table-bordered">
    <thead>
        <tr>
            <th>Name</th>
            <th>Bank</th>
            <th>Fees (€)</th>
            <th>Manual Edits</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($cards as $card)
        <tr>
            <td>{{ $card->product_name }}</td>
            <td>{{ $card->bank->name }}</td>
            <td>{{ number_format($card->fees, 2, ',', '.') }}</td>
            <td>
                @if($card->manualEdits->count())
                    <span class="text-warning">Edited</span>
                @else
                    <span class="text-success">Original</span>
                @endif
            </td>
            <td>
                <a href="{{ route('admin.cards.edit', $card->id) }}" class="btn btn-sm btn-primary">Edit</a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
