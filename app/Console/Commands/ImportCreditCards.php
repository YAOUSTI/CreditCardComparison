<?php

namespace App\Console\Commands;

use App\Models\Bank;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use App\Models\CreditCard;
use App\Models\Feature;
use SimpleXMLElement;

class ImportCreditCards extends Command
{
    protected $signature = 'creditcards:import';
    protected $description = 'Imports credit card data from external XML API';

    public function handle()
    {
        $response = Http::get('https://tools.financeads.net/webservice.php', [
            'wf' => 1,
            'format' => 'xml',
            'calc' => 'kreditkarterechner',
            'country' => 'ES'
        ]);

        $xml = new SimpleXMLElement($response->body());

        foreach ($xml->product as $product) {
            // Get or create bank
            $bank = Bank::firstOrCreate(['name' => (string)$product->bank]);

            // Get or create credit card
            $card = CreditCard::updateOrCreate(
                ['product_id' => (string)$product->productid],
                [
                    'bank_id' => $bank->id,
                    'product_name' => (string)$product->produkt,
                    'link' => (string)$product->link,
                    'logo' => (string)$product->logo,
                    'fees' => (float)str_replace(',', '.', $product->gebuehren),
                    'annual_fee_first_year' => (float)str_replace(',', '.', $product->gebuehrenjahr1),
                    'tae' => (float)str_replace(',', '.', $product->incentive),
                ]
            );

            // Add features dynamically
            $featuresMap = [
                'bonusprogram' => 'Bonus Program',
                'insurances' => 'Insurance',
                'benefits' => 'Discounts',
                'services' => 'Additional Services'
            ];

            foreach ($featuresMap as $xmlField => $featureName) {
                if ((int)$product->$xmlField) {
                    $feature = Feature::firstOrCreate(['name' => $featureName, 'type' => 'positive']);
                    $card->features()->syncWithoutDetaching([$feature->id]);
                }
            }
        }
        $this->info('Credit cards imported successfully.');
    }
}
