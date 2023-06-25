<?php

namespace App\Controllers;

use App\Interfaces\ProductsRepositoryInterface;
use App\Repositories\MySqlProductsRepository;
use App\Transformers\ProductTransformer;
use App\Validators\ProductRequestValidator;
use Respect\Validation\Exceptions\NestedValidationException;
use Symfony\Component\HttpFoundation\Request;

class ProductController extends Controller
{
    protected ProductsRepositoryInterface $productsRepository;

    public function __construct()
    {
        $this->productsRepository = new MySqlProductsRepository();
    }

    public function index(Request $request)
    {
        $products = $this->productsRepository->get($request->query->all());

        return $this->responseJson(ProductTransformer::json($products), 200);
    }

    public function store(Request $request)
    {
        try {
            ProductRequestValidator::validate($request);
        } catch (NestedValidationException $exception) {
            return $this->responseJson([
                'message' => $exception->getMessage()
            ], 422);
        }

        $products = $this->productsRepository->getBySKU($request->toArray()['sku']);

        if (count($products) > 0) {
            return $this->responseJson(['message' => 'Product with this sku already exists!'], 422);
        }

        $this->productsRepository->create($request->toArray());

        return $this->responseJson(['success' => true], 200);
    }

    public function delete(Request $request)
    {
        $this->productsRepository->destroy($request->toArray()['skus']);
    }
}
