<?php

namespace App\Interfaces;

interface ProductsRepositoryInterface
{
    public function get(array $filters): array;

    public function getBySKU(string $sku): array;

    public function create(array $payload): bool;

    public function destroy(array $skus): bool;
}
