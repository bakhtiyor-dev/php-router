<?php

namespace App\Transformers;


abstract class Transformer
{
    public abstract function toArray($entity);

    public static function json(array $items)
    {
        $transformer = new static();

        return json_encode(
            array_map(function ($item) use ($transformer) {
                return $transformer->toArray($item);
            }, $items)
        );
    }

    public static function make($entity)
    {
        $transformer = new static();

        return json_encode($transformer->toArray($entity));
    }
}
