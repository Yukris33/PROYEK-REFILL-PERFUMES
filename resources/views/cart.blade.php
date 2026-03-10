@extends('layouts.app')

@section('title','Keranjang')

@section('content')
<div data-page-css="{{ asset('css/main.css') }}"></div>

<section class="cart-page">
  <div class="cart-container">
    <div class="cart-header">
      <h1>Keranjang Belanja</h1>
      <p>Cek kembali item pilihan Anda sebelum lanjut ke checkout.</p>
    </div>

    @php
      $total = 0;
      $totalItem = 0;

      foreach($cart as $item){
        $total += $item['price'] * $item['qty'];

        if(($item['type'] ?? 'each') == 'ml'){
          $totalItem += (int) str_replace(' ml', '', $item['size']);
        } else {
          $totalItem += $item['qty'];
        }
      }
    @endphp

    <div class="cart-grid">
      <div class="cart-items">
        @forelse($cart as $key => $item)
          <div class="cart-item">
            <div class="cart-check">
              <input type="checkbox" checked>
            </div>

            <div class="cart-img">
              <img src="{{ $item['image'] }}" alt="{{ $item['name'] }}">
            </div>

            <div class="cart-info">
              <h3>{{ $item['name'] }}</h3>

              <p>Ukuran : {{ $item['size'] }} {{ ($item['type'] ?? 'each') == 'ml' ? 'ml' : '' }}</p>
              <p>Harga : Rp{{ number_format($item['price']) }}</p>

              <div class="cart-actions">
                <button
                  type="button"
                  class="cart-edit-btn"
                  onclick="openEditModal('{{ $key }}', '{{ $item['size'] }}', '{{ $item['price'] }}')"
                >
                  Edit
                </button>

                <form action="{{ route('cart.delete', $key) }}" method="POST" style="display:inline;">
                  @csrf
                  <button type="submit" class="delete" onclick="return confirm('Yakin mau hapus item ini?')">
                    Delete
                  </button>
                </form>
              </div>
            </div>

            <div class="cart-subtotal">
              Rp{{ number_format($item['price'] * $item['qty']) }}
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
          <span>{{ $totalItem }}</span>
        </div>

        <div class="summary-row">
          <span>Total Belanja</span>
          <strong>Rp{{ number_format($total) }}</strong>
        </div>

        <button class="checkout-btn">Checkout</button>
      </div>
    </div>
  </div>
</section>

<div class="cart-modal" id="editCartModal" style="display:none;">
  <div class="cart-modal-box">
    <h3>Edit Item</h3>

    <form id="editCartForm" method="POST">
      @csrf

      <div class="form-group">
        <label for="editSize">Pilih Ukuran</label>
        <select id="editSize" name="size">
          <option value="15" data-price="39000">15 ml</option>
          <option value="30" data-price="69000">30 ml</option>
          <option value="50" data-price="99000">50 ml</option>
          <option value="100" data-price="169000">100 ml</option>
        </select>
      </div>

      <input type="hidden" name="price" id="editPriceInput">

      <div class="form-group">
        <label>Harga</label>
        <div id="editPriceText">Rp0</div>
      </div>

      <div class="cart-modal-actions">
        <button type="button" onclick="closeEditModal()">Batal</button>
        <button type="submit">Simpan</button>
      </div>
    </form>
  </div>
</div>

<script>
(function () {
    const modal = document.getElementById('editCartModal');
    const form = document.getElementById('editCartForm');
    const sizeSelect = document.getElementById('editSize');
    const priceInput = document.getElementById('editPriceInput');
    const priceText = document.getElementById('editPriceText');

    function formatRupiah(number) {
        return 'Rp' + new Intl.NumberFormat('id-ID').format(Number(number));
    }

    function updateEditPrice() {
        const selectedOption = sizeSelect.options[sizeSelect.selectedIndex];
        const price = selectedOption ? selectedOption.dataset.price : 0;

        priceInput.value = price;
        priceText.textContent = formatRupiah(price);
    }

    window.openEditModal = function (key, currentSize) {
        form.action = "{{ url('/cart/update') }}/" + key;

        if (sizeSelect) {
            sizeSelect.value = String(currentSize).replace(' ml', '');
            updateEditPrice();
        }

        modal.style.display = 'flex';
    };

    window.closeEditModal = function () {
        modal.style.display = 'none';
    };

    if (sizeSelect) {
        sizeSelect.addEventListener('change', updateEditPrice);
    }

    if (modal) {
        modal.addEventListener('click', function (e) {
            if (e.target === modal) {
                closeEditModal();
            }
        });
    }
})();
</script>
@endsection