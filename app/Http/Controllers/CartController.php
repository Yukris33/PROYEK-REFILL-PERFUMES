<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;
use App\Models\ProductVariant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    protected function getActiveCart()
    {
        if (Auth::check()) {
            $sessionId = session()->getId();

            $guestCart = Cart::with('items')
                ->whereNull('user_id')
                ->where('session_id', $sessionId)
                ->where('status', 'active')
                ->first();

            $userCart = Cart::with('items')
                ->where('user_id', Auth::id())
                ->where('status', 'active')
                ->first();

            if ($guestCart && $userCart && $guestCart->id !== $userCart->id) {
                foreach ($guestCart->items as $guestItem) {
                    $existingItem = CartItem::where('cart_id', $userCart->id)
                        ->where('product_id', $guestItem->product_id)
                        ->where('product_variant_id', $guestItem->product_variant_id)
                        ->first();

                    if ($existingItem) {
                        $existingItem->qty += $guestItem->qty;
                        $existingItem->subtotal = $existingItem->qty * $existingItem->price_snapshot;
                        $existingItem->save();

                        $guestItem->delete();
                    } else {
                        $guestItem->cart_id = $userCart->id;
                        $guestItem->save();
                    }
                }

                $guestCart->delete();
                session(['active_cart_id' => $userCart->id]);

                return $userCart;
            }

            if ($guestCart && !$userCart) {
                $guestCart->user_id = Auth::id();
                $guestCart->save();

                session(['active_cart_id' => $guestCart->id]);

                return $guestCart;
            }

            if ($userCart) {
                session(['active_cart_id' => $userCart->id]);
                return $userCart;
            }

            $cart = Cart::create([
                'user_id' => Auth::id(),
                'session_id' => $sessionId,
                'status' => 'active',
            ]);

            session(['active_cart_id' => $cart->id]);

            return $cart;
        }

        $cart = Cart::firstOrCreate([
            'user_id' => null,
            'session_id' => session()->getId(),
            'status' => 'active',
        ]);

        session(['active_cart_id' => $cart->id]);

        return $cart;
    }

    protected function getProductConfig(): array
    {
        return [
            'blue-neroli' => [
                'name' => 'SCENTC Blue Neroli Eau De Toilette',
                'brand' => 'SCENTC',
                'category' => 'refill',
                'description' => 'Fresh citrus woody perfume',
                'image' => 'img/blue.png',
                'sizes' => [
                    20 => 35000,
                    25 => 45000,
                    30 => 55000,
                ],
            ],

            'citrus-aura-fresh' => [
                'name' => 'SCENTC Citrus Aura Fresh Eau De Cologne',
                'brand' => 'SCENTC',
                'category' => 'refill',
                'description' => 'Fresh citrus cologne perfume',
                'image' => 'img/citrus.png',
                'sizes' => [
                    10 => 25000,
                    30 => 49000,
                    50 => 69000,
                    70 => 89000,
                ],
            ],


        'emerald-cedar' => [
            'name' => 'SCENTC Emerald Cedar Eau De Parfum',
            'brand' => 'SCENTC',
            'category' => 'refill',
            'description' => 'Deep woody parfum',
            'image' => 'img/green.jpeg',
            'sizes' => [
                10 => 35000,
                20 => 49000,
                30 => 65000,
            ],
        ],

        'midnight-oud-intense' => [
    'name' => 'SCENTC Midnight Oud Intense Eau De Parfum',
    'brand' => 'SCENTC',
    'category' => 'refill',
    'description' => 'Dark bold oud parfum',
    'image' => 'img/midnight.png',
    'sizes' => [
        20 => 49000,
        50 => 95000,
        100 => 159000,
    ],
],

    'ocean-breeze-aqua' => [
    'name' => 'SCENTC Ocean Breeze Aqua Eau De Parfum',
    'brand' => 'SCENTC',
    'category' => 'refill',
    'description' => 'Fresh aquatic parfum',
    'image' => 'img/ocean breeze fix.png',
    'sizes' => [
        20 => 35000,
        30 => 55000,
        50 => 79000,
        100 => 139000,
    ],
],

    'prestige-signature' => [
    'name' => 'SCENTC Prestige Signature Eau De Parfum',
    'brand' => 'SCENTC',
    'category' => 'refill',
    'description' => 'Premium warm elegant parfum',
    'image' => 'img/peach bloom 4 (1) (1).png',
    'sizes' => [
        15 => 39000,
        30 => 69000,
        50 => 99000,
        100 => 169000,
    ],
],

    'silver-mist' => [
'name' => 'SCENTC Silver Mist Eau De Toilette',
'brand' => 'SCENTC',
'category' => 'refill',
'description' => 'Cool clean woody parfum',
'image' => 'img/silver2.png',
'sizes' => [
10 => 29000,
20 => 39000,
25 => 45000,
30 => 55000,
],
],

    'vanilla-suede' => [
    'name' => 'SCENTC Vanilla Suede Eau De Parfum',
    'brand' => 'SCENTC',
    'category' => 'refill',
    'description' => 'Warm creamy vanilla parfum',
    'image' => 'img/vanila.png',
    'sizes' => [
        10 => 35000,
        30 => 59000,
        50 => 85000,
        70 => 109000,
    ],
],

    'velvet-bloom' => [
'name' => 'SCENTC Velvet Bloom Eau De Toilette',
'brand' => 'SCENTC',
'category' => 'refill',
'description' => 'Soft elegant floral parfum',
'image' => 'img/velvet1.png',
'sizes' => [
20 => 39000,
50 => 79000,
70 => 99000,
],
],
        ];
    }

    protected function resolveProductData(string $slug, int $size): ?array
    {
        $products = $this->getProductConfig();

        if (!isset($products[$slug])) {
            return null;
        }

        $product = $products[$slug];

        if (!isset($product['sizes'][$size])) {
            return null;
        }

        return [
            'slug' => $slug,
            'name' => $product['name'],
            'brand' => $product['brand'],
            'category' => $product['category'],
            'description' => $product['description'],
            'image' => $product['image'],
            'size' => $size,
            'price' => $product['sizes'][$size],
        ];
    }

    public function add(Request $request)
    {
        $request->validate([
            'product_slug' => ['required', 'string'],
            'size' => ['required', 'integer'],
            'qty' => ['nullable', 'integer', 'min:1'],
        ]);

        $qty = (int) ($request->qty ?? 1);
        $size = (int) $request->size;
        $slug = $request->product_slug;

        $productData = $this->resolveProductData($slug, $size);

        if (!$productData) {
            return redirect()
                ->back()
                ->with('error', 'Produk atau ukuran tidak valid.');
        }

        $product = Product::firstOrCreate(
            ['slug' => $productData['slug']],
            [
                'name' => $productData['name'],
                'brand' => $productData['brand'],
                'category' => $productData['category'],
                'description' => $productData['description'],
                'image' => $productData['image'],
                'status' => 'active',
            ]
        );

        $productNeedsUpdate = false;

        if ($product->name !== $productData['name']) {
            $product->name = $productData['name'];
            $productNeedsUpdate = true;
        }

        if ($product->brand !== $productData['brand']) {
            $product->brand = $productData['brand'];
            $productNeedsUpdate = true;
        }

        if ($product->category !== $productData['category']) {
            $product->category = $productData['category'];
            $productNeedsUpdate = true;
        }

        if ($product->description !== $productData['description']) {
            $product->description = $productData['description'];
            $productNeedsUpdate = true;
        }

        if ($product->image !== $productData['image']) {
            $product->image = $productData['image'];
            $productNeedsUpdate = true;
        }

        if ($product->status !== 'active') {
            $product->status = 'active';
            $productNeedsUpdate = true;
        }

        if ($productNeedsUpdate) {
            $product->save();
        }

        $variant = ProductVariant::firstOrCreate(
            [
                'product_id' => $product->id,
                'size_ml' => $productData['size'],
            ],
            [
                'price' => $productData['price'],
                'sku' => strtoupper(str_replace('-', '', $productData['slug'])) . '-' . $productData['size'],
                'stock' => 100,
                'is_active' => 1,
            ]
        );

        $variantNeedsUpdate = false;

        if ((float) $variant->price !== (float) $productData['price']) {
            $variant->price = $productData['price'];
            $variantNeedsUpdate = true;
        }

        if ((int) $variant->is_active !== 1) {
            $variant->is_active = 1;
            $variantNeedsUpdate = true;
        }

        if ($variantNeedsUpdate) {
            $variant->save();
        }

        $cart = $this->getActiveCart();

        $cartItem = CartItem::where('cart_id', $cart->id)
            ->where('product_id', $product->id)
            ->where('product_variant_id', $variant->id)
            ->first();

        if ($cartItem) {
            $cartItem->qty += $qty;
            $cartItem->subtotal = $cartItem->qty * $cartItem->price_snapshot;
            $cartItem->save();
        } else {
            CartItem::create([
                'cart_id' => $cart->id,
                'product_id' => $product->id,
                'product_variant_id' => $variant->id,
                'qty' => $qty,
                'price_snapshot' => $variant->price,
                'subtotal' => $variant->price * $qty,
            ]);
        }

        return redirect()
            ->route('cart.index')
            ->with('success', 'Produk berhasil dimasukkan ke keranjang.');
    }

    public function index()
    {
        $cart = $this->getActiveCart()->load([
            'items.product.variants',
            'items.variant',
            'user',
        ]);

        $grandTotal = $cart->items->sum('subtotal');
        $totalItem = $cart->items->sum('qty');

        return view('cart', compact(
            'cart',
            'grandTotal',
            'totalItem'
        ));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'size' => ['required', 'integer'],
        ]);

        $cart = $this->getActiveCart();

        $item = CartItem::with(['product', 'variant'])
            ->where('id', $id)
            ->where('cart_id', $cart->id)
            ->firstOrFail();

        $slug = $item->product->slug ?? null;
        $size = (int) $request->size;

        if (!$slug) {
            return redirect()
                ->route('cart.index')
                ->with('error', 'Produk tidak valid.');
        }

        $productData = $this->resolveProductData($slug, $size);

        if (!$productData) {
            return redirect()
                ->route('cart.index')
                ->with('error', 'Varian ukuran tidak ditemukan.');
        }

        $newVariant = ProductVariant::firstOrCreate(
            [
                'product_id' => $item->product_id,
                'size_ml' => $productData['size'],
            ],
            [
                'price' => $productData['price'],
                'sku' => strtoupper(str_replace('-', '', $slug)) . '-' . $productData['size'],
                'stock' => 100,
                'is_active' => 1,
            ]
        );

        $variantNeedsUpdate = false;

        if ((float) $newVariant->price !== (float) $productData['price']) {
            $newVariant->price = $productData['price'];
            $variantNeedsUpdate = true;
        }

        if ((int) $newVariant->is_active !== 1) {
            $newVariant->is_active = 1;
            $variantNeedsUpdate = true;
        }

        if ($variantNeedsUpdate) {
            $newVariant->save();
        }

        $existingItem = CartItem::where('cart_id', $cart->id)
            ->where('product_id', $item->product_id)
            ->where('product_variant_id', $newVariant->id)
            ->where('id', '!=', $item->id)
            ->first();

        if ($existingItem) {
            $existingItem->qty += $item->qty;
            $existingItem->subtotal = $existingItem->qty * $existingItem->price_snapshot;
            $existingItem->save();

            $item->delete();

            return redirect()
                ->route('cart.index')
                ->with('success', 'Ukuran produk berhasil diperbarui.');
        }

        $item->product_variant_id = $newVariant->id;
        $item->price_snapshot = $newVariant->price;
        $item->subtotal = $item->qty * $newVariant->price;
        $item->save();

        return redirect()
            ->route('cart.index')
            ->with('success', 'Ukuran produk berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $cart = $this->getActiveCart();

        $item = CartItem::where('id', $id)
            ->where('cart_id', $cart->id)
            ->firstOrFail();

        $item->delete();

        return redirect()
            ->route('cart.index')
            ->with('success', 'Produk berhasil dihapus dari keranjang.');
    }
}