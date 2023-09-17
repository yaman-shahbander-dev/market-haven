<?php

namespace Domain\Product\Builders\Builders;

use Domain\Product\Builders\IBuilders\IProductBuilder;
use Domain\Product\DataTransferObjects\CreateOrUpdateProductData;
use Domain\Product\DataTransferObjects\ProductColorData;
use Spatie\LaravelData\DataCollection;

class ProductBuilder implements IProductBuilder
{
    public function __construct(
        protected CreateOrUpdateProductData $productData
    ) {
    }

    public function setTitle(string $title): self
    {
        $this->productData->title = $title;
        return $this;
    }

    public function setDescription(string $description): self
    {
        $this->productData->description = $description;
        return $this;
    }

    public function setPrice(string $price): self
    {
        $this->productData->price = $price;
        return $this;
    }

    public function setDiscount(string $discount): self
    {
        $this->productData->discount = $discount;
        return $this;
    }

    public function setQuantity(string $quantity): self
    {
        $this->productData->quantity = $quantity;
        return $this;
    }

    public function setAvailable(string $available): self
    {
        $this->productData->available = $available;
        return $this;
    }

    public function setProductColorInfo(array $productColorInfo): self
    {
        $this->productData->productColorInfo = new DataCollection(ProductColorData::class, $productColorInfo);
        return $this;
    }

    public function setProductBrandIds(array $productBrandIds): self
    {
        $this->productData->productBrandIds = $productBrandIds;
        return $this;
    }

    public function setProductCategoryIds(array $productCategoryIds): self
    {
        $this->productData->productCategoryIds = $productCategoryIds;
        return $this;
    }

    public function build(): CreateOrUpdateProductData
    {
        return $this->productData;
    }
}
