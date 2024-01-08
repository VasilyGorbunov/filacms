<?php

namespace App\Services\Contracts;

interface ICartManager
{
    public function add($productId, $variantId = null);
    public function exists();
    public function remove();
    public function update();
    public function associateWithUser();
    public function getCart();
    public function getSubtotal();
}
