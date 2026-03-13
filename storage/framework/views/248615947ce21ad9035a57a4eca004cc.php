

<?php $__env->startSection('title', 'Keranjang'); ?>

<?php $__env->startSection('content'); ?>
<div data-page-css="<?php echo e(asset('css/main.css')); ?>"></div>

<section class="cart-page">
<div class="cart-container">

<div class="cart-header">
<h1>Keranjang Belanja</h1>
<p>Cek kembali item pilihan Anda sebelum lanjut ke checkout.</p>

<div class="cart-user">
<?php if($cart->user): ?>
User: <?php echo e($cart->user->email); ?>

<?php else: ?>
User: Guest
<?php endif; ?>
</div>
</div>


<?php if(session('success')): ?>
<div style="background:#eafaf1;color:#166534;padding:14px;border-radius:12px;margin-bottom:16px;">
<?php echo e(session('success')); ?>

</div>
<?php endif; ?>


<div class="cart-grid">

<div class="cart-items">

<?php $__empty_1 = true; $__currentLoopData = $cart->items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>

<div class="cart-item">

<div class="cart-check">
<input
type="checkbox"
class="cart-check-item"
data-price="<?php echo e($item->subtotal); ?>"
checked
>
</div>


<div class="cart-img">
<img
src="<?php echo e(asset($item->product->image ?? 'img/default.png')); ?>"
>
</div>


<div class="cart-info">

<h3><?php echo e($item->product->name); ?></h3>

<p>
Ukuran :
<?php echo e($item->variant->size_ml ?? '-'); ?> ml
</p>

<p>
Harga :
Rp<?php echo e(number_format($item->price_snapshot,0,',','.')); ?>

</p>


<div class="cart-actions">

<form action="<?php echo e(route('cart.update',$item->id)); ?>" method="POST">
<?php echo csrf_field(); ?>

<select name="size" class="cart-size-select">

<?php $__currentLoopData = $item->product->variants->where('is_active',1)->sortBy('size_ml'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $variant): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

<option
value="<?php echo e($variant->size_ml); ?>"
<?php echo e($item->product_variant_id == $variant->id ? 'selected':''); ?>

>

<?php echo e($variant->size_ml); ?> ml

</option>

<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

</select>

<button type="submit" class="cart-update-btn">
Update
</button>

</form>


<form action="<?php echo e(route('cart.remove',$item->id)); ?>" method="POST">

<?php echo csrf_field(); ?>
<?php echo method_field('DELETE'); ?>

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

Rp<?php echo e(number_format($item->subtotal,0,',','.')); ?>


</div>

</div>

<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>

<div class="cart-empty">
Keranjang masih kosong
</div>

<?php endif; ?>

</div>


<div class="cart-summary">

<h3>Ringkasan Belanja</h3>

<div class="summary-row">
<span>Total Item</span>
<span id="totalItem"><?php echo e($totalItem); ?></span>
</div>

<div class="summary-row">
<span>Total Belanja</span>
<strong id="grandTotal">
Rp<?php echo e(number_format($grandTotal,0,',','.')); ?>

</strong>
</div>


<a href="#" class="checkout-btn">
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

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\XAMPP 2\htdocs\perfume-projek\resources\views/cart.blade.php ENDPATH**/ ?>