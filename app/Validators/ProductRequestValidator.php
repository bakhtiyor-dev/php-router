<?php

namespace App\Validators;

use App\ProductType;
use Respect\Validation\Validator;
use Symfony\Component\HttpFoundation\Request;

class ProductRequestValidator
{
    public static function validate(Request $request)
    {
        $payload = $request->toArray();

        $validator = Validator::key('sku', Validator::stringType())
            ->key('name', Validator::stringType())
            ->key('price', Validator::positive())
            ->key('productType', Validator::in(ProductType::cases()));

        foreach (ProductType::getAttributesOfType($payload['productType']) as $attribute) {
            $validator->key($attribute, Validator::number());
        }

        $validator->assert($payload);
    }
}
