<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\CreditCard;
use App\Models\Feature;
use Illuminate\Support\Facades\DB;

class AdditionalCreditCardInfoSeeder extends Seeder
{
    public function run()
    {
        // Define additional features not provided by API
        $extraFeatures = [
            ['name' => '100% móvil, diseñada por y para ti.', 'type' => 'positive'],
            ['name' => 'Gratuita y sin comisiones', 'type' => 'positive'],
            ['name' => 'Descuento especial en restaurantes', 'type' => 'positive'],
            ['name' => 'Asistencia telefónica gratuita', 'type' => 'positive'],
            ['name' => 'Acceso a salas VIP de aeropuertos', 'type' => 'positive'],
            ['name' => 'Coste de 9,90 € mensuales por membresía especial', 'type' => 'warning'],
            ['name' => 'Altas comisiones internacionales', 'type' => 'warning'],
            ['name' => 'Sin ventajas adicionales', 'type' => 'warning'],
        ];

        // Insert features into DB
        foreach ($extraFeatures as $featureData) {
            Feature::firstOrCreate(['name' => $featureData['name']], ['type' => $featureData['type']]);
        }

        $features = Feature::all();

        // Get all credit cards from DB
        $cards = CreditCard::all();

        // Randomly link each card with 2-4 extra features
        foreach ($cards as $card) {
            // pick 2-4 random features
            $randomFeatures = $features->random(rand(2,4))->pluck('id')->toArray();

            // attach features without duplicates
            $card->features()->syncWithoutDetaching($randomFeatures);
        }

        // Add additional manual edits (extra card info) for random cards
        $additionalInfo = [
            'Hasta 1.500€ de crédito. Seguros de accidente gratuito',
            'Disfruta viajando por todo el mundo sin preocuparte por comisiones',
            'Apertura de cuenta gratuita sin coste inicial',
            'Promoción especial los primeros 12 meses',
            'Ideal para jóvenes menores de 30 años',
        ];

        foreach ($cards as $card) {
            // Random chance to have additional info (50%)
            if (rand(0,1)) {
                DB::table('manual_edits')->insert([
                    'credit_card_id' => $card->id,
                    'field_name' => 'extra_info',
                    'manual_value' => $additionalInfo[array_rand($additionalInfo)],
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}
