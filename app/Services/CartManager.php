<?php

namespace App\Services;

use App\Models\Cart;
use App\Models\CartItem;
use App\Models\User;
use App\Services\Contracts\ICartManager;
use Auth;
use Illuminate\Session\SessionManager;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class CartManager implements ICartManager
{
    protected $cart;
    protected $session;

    public function __construct(protected SessionManager $sessionManager)
    {
        $this->session = $sessionManager->driver();
    }

    public function exists()
    {
        return $this->session->has(config('cart.session.cart_key')) && $this->getCart();
    }

    public function create(?User $user = null)
    {
        $cart = Cart::make();

        if ($user) {
            $cart->user()->associate($user);
        }

        $cart->save();
        $this->session->put(config('cart.session.cart_key'), $cart->cart_id);

    }

    public function associateWithUser(): void
    {
        $this->cart->user_id = Auth::id();
        $this->cart->save();
    }

    public function add($productId, $variantId = null, $quantity = 1)
    {
        $item = CartItem::make();
        $item->product_id = $productId;
        $item->cart_id = $this->getCart()->id;
        $item->quantity = $quantity;

        if($variantId)
            $item->variant_id = $variantId;

        $item->save();
    }

    public function getItemsCount(): int
    {
        return $this->getCart()->items()->count();
    }


    public function update()
    {

    }

    public function getCart()
    {
        if ($this->cart)
            return $this->cart;

        return $this->cart = Cart::whereCartId($this->session->get(config('cart.session.cart_key')))->first();
    }

    public function getSubtotal()
    {

    }
}
