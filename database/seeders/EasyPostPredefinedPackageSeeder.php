<?php

namespace Database\Seeders;

use App\Models\EasyPostPredefinedPackage;
use Illuminate\Database\Seeder;

class EasyPostPredefinedPackageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [ 'type' => 'Envelope'    ,     'size' => '12 ½" x 9 ½"'                          , 'predefined_name' => 'FlatRateEnvelope'    ],
            [ 'type' => 'Window Envelope' , 'size' => '10" x 5" or 12 ½" x 9 ½"'              , 'predefined_name' => 'FlatRateWindowEnvelope'  ],
            [ 'type' => 'Small Envelope'  , 'size' => '10" x 6"'                              , 'predefined_name' => 'SmallFlatRateEnvelope'   ],
            [ 'type' => 'Padded Envelope' , 'size' => '12 ½" x 9 ½"'                          , 'predefined_name' => 'FlatRatePaddedEnvelope'  ],
            [ 'type' => 'Legal Envelope'  , 'size' => '15" x 9 ½"'                            , 'predefined_name' => 'FlatRateLegalEnvelope'   ],
            [ 'type' => 'Small Box'   ,     'size' => '8 11⁄16" x 5 7⁄16" x 1 ¾"'             , 'predefined_name' => 'SmallFlatRateBox'    ],
            [ 'type' => 'Medium Box'  ,     'size' => '11 ¼" x 8 ¾" x 6" or 14" x 12" x 3 ½"' , 'predefined_name' => 'MediumFlatRateBox'   ],
            [ 'type' => 'Large Box'   ,     'size' => '12" x 12 ¼" x 6"'                      , 'predefined_name' => 'LargeFlatRateBox'    ],
            [ 'type' => 'APO/FPO Box' ,     'size' => '12" x 12 ¼" x 6"'                      , 'predefined_name' => 'LargeFlatRateBoxAPOFPO'  ]
        ];

        EasyPostPredefinedPackage::insert($data);
    }
}
