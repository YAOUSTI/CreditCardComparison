<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\CreditCard;
use App\Models\Bank;
use App\Models\Feature;
use App\Models\ManualEdit;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\Test;

class CreditCardTest extends TestCase
{
    // use RefreshDatabase;

    #[Test]
    public function it_imports_credit_cards_from_api_correctly()
    {
        $this->artisan('creditcards:import')->assertExitCode(0);

        $this->assertGreaterThan(0, CreditCard::count());
        $this->assertDatabaseHas('credit_cards', ['id' => CreditCard::first()->id]);
    }

    #[Test]
    public function it_has_correct_database_structure_and_relationships()
    {
        $bank = Bank::factory()->create(['name' => 'Test Bank']);

        $card = CreditCard::factory()->create(['bank_id' => $bank->id]);

        $this->assertInstanceOf(Bank::class, $card->bank);
        $this->assertEquals('Test Bank', $card->bank->name);
    }

    #[Test]
    public function it_links_features_to_credit_cards_correctly()
    {
        $card = CreditCard::factory()->create();
        $feature = Feature::factory()->create(['name' => 'Test Feature', 'type' => 'positive']);

        $card->features()->attach($feature->id);

        $this->assertTrue($card->features->contains($feature));
        $this->assertDatabaseHas('card_features', [
            'credit_card_id' => $card->id,
            'feature_id' => $feature->id
        ]);
    }

    #[Test]
    public function admin_can_add_and_remove_manual_edits_correctly()
    {
        $card = CreditCard::factory()->create();

        $edit = ManualEdit::factory()->create([
            'credit_card_id' => $card->id,
            'field_name' => 'fees',
            'manual_value' => '15.99'
        ]);

        $this->assertDatabaseHas('manual_edits', [
            'credit_card_id' => $card->id,
            'field_name' => 'fees',
            'manual_value' => '15.99'
        ]);

        $edit->delete();

        $this->assertDatabaseMissing('manual_edits', [
            'credit_card_id' => $card->id,
            'field_name' => 'fees'
        ]);
    }
}
