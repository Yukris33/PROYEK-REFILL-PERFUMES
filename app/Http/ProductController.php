use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    public function refill(Request $request)
    {
        $q = Product::query()->where('category', 'refill-parfum');

        // contoh filter
        if ($request->filled('price_min')) $q->where('price', '>=', (int)$request->price_min);
        if ($request->filled('price_max')) $q->where('price', '<=', (int)$request->price_max);

        // sort
        $sort = $request->get('sort', 'popular');
        $q = match ($sort) {
            'price_asc'  => $q->orderBy('price', 'asc'),
            'price_desc' => $q->orderBy('price', 'desc'),
            'newest'     => $q->orderBy('created_at', 'desc'),
            default      => $q->orderBy('sold_count', 'desc'), // popular
        };

        $products = $q->paginate(12)->withQueryString();

        return view('products.refill', compact('products', 'sort'));
    }
}