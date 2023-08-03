<?php

namespace Domain\Product\Builders\Directors;

use Domain\Product\Builders\IBuilders\IProductBuilder;
use Domain\Product\DataTransferObjects\CreateOrUpdateProductData;

class ProductDirector
{
    public function __construct(protected IProductBuilder $builder) {
    }

    public function createProduct($title, $description, $price, $discount, $quantity, $available, $productColorInfo, $productBrandIds, $productCategoryIds): CreateOrUpdateProductData
    {
        return $this->builder
            ->setTitle($title)
            ->setDescription($description)
            ->setPrice($price)
            ->setDiscount($discount)
            ->setQuantity($quantity)
            ->setAvailable($available)
            ->setProductColorInfo($productColorInfo)
            ->setProductBrandIds($productBrandIds)
            ->setProductCategoryIds($productCategoryIds)
            ->build();
    }
}
