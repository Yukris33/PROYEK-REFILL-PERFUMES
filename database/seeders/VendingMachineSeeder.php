<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\VendingMachine;
use App\Models\VendingMachineStock;
use Illuminate\Database\Seeder;

class VendingMachineSeeder extends Seeder
{
    public function run(): void
    {
        $machines = [
            [
                'machine_code' => 'VM-UMN-01',
                'machine_name' => 'SCENTCYCLE UMN Machine',
                'location_name' => 'Universitas Multimedia Nusantara',
                'city' => 'Tangerang',
                'status' => 'active',
                'empty_bottle_stock' => 120,
                'returned_bottle_stock' => 18,
                'scent_stocks' => [4200, 3700, 3100, 2800, 4500, 3900, 2500, 3300, 4100],
            ],
            [
                'machine_code' => 'VM-SMS-01',
                'machine_name' => 'SCENTCYCLE SMS Machine',
                'location_name' => 'Summarecon Mall Serpong',
                'city' => 'Tangerang',
                'status' => 'active',
                'empty_bottle_stock' => 95,
                'returned_bottle_stock' => 34,
                'scent_stocks' => [2600, 3400, 2200, 4100, 3800, 2400, 2900, 2100, 3600],
            ],
            [
                'machine_code' => 'VM-AEON-01',
                'machine_name' => 'SCENTCYCLE AEON Machine',
                'location_name' => 'AEON Mall BSD City',
                'city' => 'Tangerang',
                'status' => 'active',
                'empty_bottle_stock' => 140,
                'returned_bottle_stock' => 51,
                'scent_stocks' => [4600, 4300, 3900, 3200, 2700, 2500, 4000, 3500, 2300],
            ],
        ];

        $products = Product::orderBy('id')->limit(9)->get();

        foreach ($machines as $machineData) {
            $machine = VendingMachine::updateOrCreate(
                [
                    'machine_code' => $machineData['machine_code'],
                ],
                [
                    'machine_name' => $machineData['machine_name'],
                    'location_name' => $machineData['location_name'],
                    'city' => $machineData['city'],
                    'status' => $machineData['status'],
                ]
            );

            foreach ($products as $index => $product) {
                VendingMachineStock::updateOrCreate(
                    [
                        'vending_machine_id' => $machine->id,
                        'product_id' => $product->id,
                        'stock_type' => 'scent',
                    ],
                    [
                        'item_name' => $product->name,
                        'current_stock' => $machineData['scent_stocks'][$index] ?? 2500,
                        'max_capacity' => 5000,
                        'unit' => 'ml',
                    ]
                );
            }

            VendingMachineStock::updateOrCreate(
                [
                    'vending_machine_id' => $machine->id,
                    'stock_type' => 'empty_bottle',
                    'item_name' => 'Botol Kosong',
                ],
                [
                    'product_id' => null,
                    'current_stock' => $machineData['empty_bottle_stock'],
                    'max_capacity' => 200,
                    'unit' => 'botol',
                ]
            );

            VendingMachineStock::updateOrCreate(
                [
                    'vending_machine_id' => $machine->id,
                    'stock_type' => 'returned_bottle',
                    'item_name' => 'Botol Return',
                ],
                [
                    'product_id' => null,
                    'current_stock' => $machineData['returned_bottle_stock'],
                    'max_capacity' => 200,
                    'unit' => 'botol',
                ]
            );
        }
    }
}