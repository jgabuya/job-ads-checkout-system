<?php

namespace App\Modules\Checkout;

use App\Customer;
use Illuminate\Support\Collection;

class PriceCalculator
{
    private $pricingRules;

    function __construct(Collection $myPricingRules)
    {
        // initialize properties
        $this->pricingRules = $myPricingRules;
    }

    /**
     * Calculate and return the total price
     * @param $customer
     * @param $items
     * @return number
     */
    public function total(Customer $customer, Collection $items)
    {
        $total = 0;
        $processedItemIds = [];

        foreach ($items as $item) {
            if (in_array($item->id, $processedItemIds)) {
                continue;
            }

            // get rule for customer-item pair
            $rule = $this->pricingRules->first(function ($value, $key) use ($customer, $item) {
                return $value->customer_id == $customer->id &&
                        $value->ad_id == $item->id;
            });

            $itemsFilterCount = $items->where('id', $item->id)->count();

            // check if rule exists and
            // if the number of items satisfies the minimum quantity
            if ($rule && $itemsFilterCount >= $rule->min_qty) {
                if ($rule->continuous) {
                    // x for y discount
                    $normalPricesCount = $itemsFilterCount % $rule->min_qty;
                    $total += ($rule->price * ($itemsFilterCount - $normalPricesCount)) + ($item->price * $normalPricesCount);
                } else {
                    // discount at minimum quantity
                    $total += $rule->price * $itemsFilterCount;
                }
            } else {
                // add item in its normal price
                $total += $item->price * $itemsFilterCount;
            }

            array_push($processedItemIds, $item->id);
        }

        return $total;
    }
}