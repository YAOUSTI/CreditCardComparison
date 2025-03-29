<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CreditCard;
use App\Models\ManualEdit;
use Illuminate\Http\Request;

class CreditCardController extends Controller
{
    public function index()
    {
        $cards = CreditCard::with(['bank', 'manualEdits'])->get();
        return view('admin.cards.index', compact('cards'));
    }

    public function edit($id)
    {
        $card = CreditCard::with(['bank', 'manualEdits'])->findOrFail($id);
        $edits = $card->manualEdits->pluck('manual_value', 'field_name');
        return view('admin.cards.edit', compact('card', 'edits'));
    }

    public function update(Request $request, $id)
    {
        $card = CreditCard::findOrFail($id);

        $editableFields = ['product_name', 'fees', 'annual_fee_first_year', 'tae'];

        foreach ($editableFields as $field) {
            if ($card->isFillable($field)) {
                $newValue = $request->input($field);
                $currentValue = $card->$field;

                if ($newValue !== $currentValue) {
                    ManualEdit::updateOrCreate(
                        ['credit_card_id' => $card->id, 'field_name' => $field],
                        ['manual_value' => $newValue]
                    );
                }
            }
        }

        return redirect()->route('admin.cards.index')->with('success', 'Manual edits updated successfully.');
    }

    public function removeEdit($cardId, $field)
    {
        ManualEdit::where('credit_card_id', $cardId)
            ->where('field_name', $field)
            ->delete();

        return redirect()->back()->with('success', 'Manual edit removed successfully.');
    }
}
