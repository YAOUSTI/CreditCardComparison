<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CreditCard;

class CreditCardController extends Controller
{
    public function start()
    {
        return view('cards.start');
    }

    public function index(Request $request)
    {
        $sort = $request->get('sort', 'fees');
        $allowedSorts = ['fees', 'name'];

        if (!in_array($sort, $allowedSorts)) {
            $sort = 'fees';
        }

        $cards = CreditCard::with(['features', 'manualEdits'])
            ->get()
            ->map(function ($card) {
                $edits = $card->manualEdits->pluck('manual_value', 'field_name');
                $card->display_name = $edits['product_name'] ?? $card->product_name;
                $card->display_fees = $edits['fees'] ?? $card->fees;
                return $card;
            });

        if ($sort === 'name') {
            $cards = $cards->sortBy('display_name');
        } else {
            $cards = $cards->sortBy('display_fees');
        }

        return view('cards.index', compact('cards', 'sort'));
    }
}
