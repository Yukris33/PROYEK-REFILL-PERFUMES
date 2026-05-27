@extends('layouts.app')

@section('title', 'Keranjang')

@section('content')
<div data-page-css="{{ asset('css/main.css') }}"></div>

<section class="cart-page">
<div class="cart-container">

<div class="cart-header">
<h1>Keranjang Belanja</h1>
<p>Cek kembali item pilihan Anda sebelum lanjut ke checkout.</p>

<div class="cart-user">
@if($cart->user)
User: {{ $cart->user->email }}
@else
User: Guest
@endif
</div>
</div>


@if (session('success'))
<div style="background:#eafaf1;color:#166534;padding:14px;border-radius:12px;margin-bottom:16px;">
{{ session('success') }}
</div>
@endif


<div class="cart-grid">

<div class="cart-items">

@forelse($cart->items as $item)

<div class="cart-item">

<div class="cart-check">
<input
type="checkbox"
class="cart-check-item"
data-price="{{ $item->subtotal }}"
checked
>
</div>


<div class="cart-img">
<img
src="{{ asset($item->product->image ?? 'img/default.png') }}"
>
</div>


<div class="cart-info">

<h3>{{ $item->product->name }}</h3>

<p>
Ukuran :
{{ $item->variant->size_ml ?? '-' }} ml
</p>

<p>
Harga :
Rp{{ number_format($item->price_snapshot,0,',','.') }}
</p>


<div class="cart-actions">

<form action="{{ route('cart.update',$item->id) }}" method="POST">
@csrf

<select name="size" class="cart-size-select">

@foreach ($item->product->variants->where('is_active',1)->sortBy('size_ml') as $variant)

<option
value="{{ $variant->size_ml }}"
{{ $item->product_variant_id == $variant->id ? 'selected':'' }}
>

{{ $variant->size_ml }} ml

</option>

@endforeach

</select>

<button type="submit" class="cart-update-btn">
Update
</button>

</form>


<form action="{{ route('cart.remove',$item->id) }}" method="POST">

@csrf
@method('DELETE')

<button
type="submit"
class="cart-delete-btn"
onclick="return confirm('Yakin mau hapus item ini?')"
>

Delete

</button>

</form>

</div>

</div>


<div class="cart-subtotal">

Rp{{ number_format($item->subtotal,0,',','.') }}

</div>

</div>

@empty

<div class="cart-empty">
Keranjang masih kosong
</div>

@endforelse

</div>


<div class="cart-summary">

<h3>Ringkasan Belanja</h3>

<div class="summary-row">
<span>Total Item</span>
<span id="totalItem">{{ $totalItem }}</span>
</div>

<div class="summary-row">
<span>Total Belanja</span>
<strong id="grandTotal">
Rp{{ number_format($grandTotal,0,',','.') }}
</strong>
</div>


<a href="{{ route('checkout.show') }}" class="checkout-btn">
Checkout
</a>

</div>

</div>

</div>
</section>


<script>

function formatRupiah(value)
{
return 'Rp'+ new Intl.NumberFormat('id-ID').format(value)
}


function recalcCart()
{
let total = 0
let itemCount = 0

document.querySelectorAll('.cart-check-item').forEach(cb=>{

if(cb.checked)
{
total += parseInt(cb.dataset.price)
itemCount++
}

})

document.getElementById('grandTotal').innerText = formatRupiah(total)
document.getElementById('totalItem').innerText = itemCount
}


document.querySelectorAll('.cart-check-item').forEach(cb=>{

cb.addEventListener('change',recalcCart)

})

</script>

@endsection