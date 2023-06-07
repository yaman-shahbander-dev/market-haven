<?php

namespace Domain\Product\Builders\IBuilders;

use Domain\Product\DataTransferObjects\CreateOrUpdateProductData;

interface IProductBuilder
{
    public function setTitle(string $title): self;
    public function setDescription(string $description): self;
    public function setPrice(string $price): self;
    public function setDiscount(string $discount): self;
    public function setQuantity(string $quantity): self;
    public function setAvailable(string $available): self;
    public function setProductColorInfo(array $productColorInfo): self;
    public function setProductBrandIds(array $productBrandIds): self;
    public function setProductCategoryIds(array $productCategoryIds): self;

    public function build(): CreateOrUpdateProductData;
}
