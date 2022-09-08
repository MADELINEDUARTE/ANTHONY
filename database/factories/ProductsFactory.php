<?php

namespace Database\Factories;

use App\Http\Controllers\Api\SubscriptionStripeController as ManageStripe;
use App\Models\ProductCategorie;
use App\Models\Products;
use Illuminate\Database\Eloquent\Factories\Factory;
class ProductsFactory extends Factory
{

    protected $model = Products::class;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            
            'categorie_id' => ProductCategorie::factory(),
            'name'         => $this->faker->text($maxNbChars = 40),
            'description'  => $this->faker->text($maxNbChars = 300),
            'stock'        => $this->faker->randomDigit(),
            'status'       => 1,
            // 'price'        => $this->faker->numberBetween($min = 50, $max = 1000),
            'price_id_offert'  => 0,
            // 'stripe_id'    => ,
        ];
    }

    public function configure()
    {
        return $this->afterCreating(function (Products $product) {
            $manageStripe = new ManageStripe();
            $productStripe = $manageStripe->createProduct([
                'name'        => $product->name,
                'description' => $product->description,
                'status'      => true,
                'id' => $product->id
            ]);

            if($product && $product->id){

                $product->stripe_id = $productStripe->id;
                $product->save();

                $price = $product->productsPrices[0];

                if($price){

                    $priceStripe = $manageStripe->createPriceUnique([
                        'amount' => $price->price,
                        'product_id'     => $productStripe->id,
                        'name'    => $product->name,
                    ]);

                    if($priceStripe){
                        $price->stripe_id = $priceStripe->id;
                        $price->save();
                    }
                }
            }

        });
    }
}
