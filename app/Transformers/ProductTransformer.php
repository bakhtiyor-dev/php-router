<?php

namespace App\Transformers;

class ProductTransformer extends Transformer
{

    public function toArray($entity): array
    {
        return [
            'sku' => $entity->getSKU(),
            'name' => $entity->getName(),
            'price' => $entity->getPrice(),
            'productType' => $entity->getType(),
            'size' => $entity->getSize(),
            'weight' => $entity->getWeight(),
            'height' => $entity->getHeight(),
            'length' => $entity->getLength(),
            'width' => $entity->getWidth()
        ];
    }
}
