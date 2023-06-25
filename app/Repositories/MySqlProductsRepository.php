<?php

namespace App\Repositories;

use App\Interfaces\ProductsRepositoryInterface;
use App\Models\Product;
use App\ProductType;
use Core\Database\MySql\MySqlDatabaseConnection;
use Opis\ORM\EntityManager;

class MySqlProductsRepository implements ProductsRepositoryInterface
{
    protected EntityManager $orm;

    public function __construct()
    {
        $this->orm = new EntityManager(
            MySqlDatabaseConnection::instance()->connection()
        );
    }

    public function get(array $filters): array
    {
        $columns = ['sku', 'name', 'price', 'productType'];

        $filters = array_filter($filters, function ($key) use ($columns) {
            return in_array($key, $columns);
        }, ARRAY_FILTER_USE_KEY);

        $query = $this->orm->query(Product::class);

        foreach ($filters as $column => $value) {
            $query->where($column)->is($value);
        }

        return $query->orderBy('id','desc')->all();
    }

    public function create(array $payload): bool
    {
        $productAttributes = ProductType::getAttributesOfType($payload['productType']);

        $attributes = array_filter($payload, function ($value) use ($productAttributes) {
            return in_array($value, $productAttributes);
        }, ARRAY_FILTER_USE_KEY);

        $product = $this->orm->create(Product::class)
            ->setSku($payload['sku'])
            ->setName($payload['name'])
            ->setPrice($payload['price'])
            ->setType($payload['productType'])
            ->setAttributes($attributes);

        return $this->orm->save($product);
    }

    public function destroy(array $skus): bool
    {
        return $this->orm->query(Product::class)
            ->where('sku')
            ->in($skus)
            ->delete();
    }

    public function getBySKU(string $sku): array
    {
        return $this->orm->query(Product::class)->where('sku')->is($sku)->all();
    }
}
