<?php

namespace App\Models;

use Opis\ORM\Entity;
use Opis\ORM\IEntityMapper;
use Opis\ORM\IMappableEntity;

class Product extends Entity implements IMappableEntity
{

    public function id(): int
    {
        return $this->orm()->getColumn('id');
    }

    public function getName(): string
    {
        return $this->orm()->getColumn('name');
    }

    public function getSKU(): string
    {
        return $this->orm()->getColumn('sku');
    }

    public function getPrice(): int
    {
        return $this->orm()->getColumn('price');
    }

    public function getType(): string
    {
        return $this->orm()->getColumn('type');
    }

    public function getWeight()
    {
        return $this->getAttributes()->weight;
    }

    public function getHeight()
    {
        return $this->getAttributes()->height;
    }

    public function getLength()
    {
        return $this->getAttributes()->length;
    }

    public function getWidth()
    {
        return $this->getAttributes()->width;
    }

    public function getSize()
    {
        return $this->getAttributes()->size;
    }

    public function getAttributes()
    {
        return $this->orm()->getColumn('attributes');
    }

    public function setName(string $name): self
    {
        $this->orm()->setColumn('name', $name);
        return $this;
    }

    public function setSku(string $sku): self
    {
        $this->orm()->setColumn('sku', $sku);
        return $this;
    }

    public function setPrice(int $price): self
    {
        $this->orm()->setColumn('price', $price);
        return $this;
    }

    public function setType(string $type): self
    {
        $this->orm()->setColumn('type', $type);
        return $this;
    }

    public function setAttributes(array $attributes): self
    {
        $this->orm()->setColumn('attributes', $attributes);
        return $this;
    }

    public static function mapEntity(IEntityMapper $mapper)
    {
        $mapper->cast([
            'id' => 'integer',
            'sku' => 'string',
            'name' => 'string',
            'price' => 'integer',
            'type' => 'string',
            'attributes' => 'json',
        ]);
    }
}
