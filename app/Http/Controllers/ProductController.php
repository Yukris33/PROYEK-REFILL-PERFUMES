public function refill()
{
    $products = \App\Models\Product::paginate(9); // 9 biar 3x3

    return view('products.refill', compact('products'));
}