@extends('layouts.app')

@section('title', 'Status Return Botol')

@section('content')
<div data-page-css="{{ asset('css/return.css?v=125') }}"></div>

<section class="rb-return-page">
  <div class="rb-return-container">

    <div class="rb-return-hero">
      <span class="rb-return-label">RETURN STATUS</span>

      <h1>QR Return Botol Berhasil Dibuat</h1>

      <p>
        Tunjukkan QR return ini di vending machine Scentcycle sesuai lokasi yang dipilih.
        Status awal return adalah pending. Poin baru masuk jika return dinyatakan success oleh sistem.
      </p>

      <div class="rb-return-actions rb-return-hero-actions">
        <a href="{{ route('products.botol') }}" class="rb-status-btn rb-action-link">
          Kembali ke Page Botol
        </a>

        <a href="{{ route('return.botol') }}" class="rb-generate-btn rb-action-link">
          Buat Return Baru
        </a>
      </div>
    </div>

    <div class="rb-return-layout">

      {{-- LEFT STATUS --}}
      <div class="rb-return-card">

        <div class="rb-return-card__head">
          <span>{{ strtoupper($return->status) }}</span>

          <h2>{{ $return->return_code }}</h2>

          <p>
            Lokasi mesin: <strong>{{ $return->machine_location }}</strong><br>
            Total botol: <strong>{{ $return->total_bottles }}</strong><br>
            Estimasi poin: <strong>{{ $return->estimated_points }} poin</strong><br>
            Poin masuk: <strong>{{ $return->awarded_points }} poin</strong>
          </p>
        </div>

        @if (session('success'))
          <div class="rb-status-note" style="background:#ecfdf3;color:#166534;">
            {{ session('success') }}
          </div>
        @endif

        @if (session('error'))
          <div class="rb-status-note" style="background:#fff1f1;color:#991b1b;">
            {{ session('error') }}
          </div>
        @endif

        <div class="rb-return-summary">
          <div>
            <span>Status Return</span>

            @if ($return->status === 'success')
              <strong>Success</strong>
            @elseif ($return->status === 'failed')
              <strong>Failed</strong>
            @else
              <strong>Pending</strong>
            @endif
          </div>

          @if ($return->status === 'pending')
            <p>
              Status return masih pending. QR sudah dibuat, tetapi botol belum dinyatakan valid oleh sistem.
              Silakan scan QR di vending machine, masukkan botol ke return bay, lalu tunggu proses sensor dan quality check.
              Poin belum masuk selama status masih pending.
            </p>
          @elseif ($return->status === 'success')
            <p>
              Status return success. Botol sudah diterima, lolos validasi sensor dan quality check.
              Poin sebesar {{ $return->awarded_points }} poin sudah masuk ke akun kamu.
            </p>
          @else
            <p>
              Status return failed. Botol tidak valid atau tidak lolos quality check.
              Poin tidak masuk ke akun.
            </p>
          @endif
        </div>

        <div class="rb-status-note">
          <strong>Detail botol:</strong>
          <br>

          @foreach($return->items as $item)
            - {{ $item->bottle_size_ml }}ml =
            {{ $item->points }} poin /
            sensor: {{ $item->sensor_status }} /
            kondisi: {{ $item->condition_status }}
            <br>
          @endforeach
        </div>

        <div class="rb-return-actions">
          <a href="{{ route('return.botol.status', $return->return_code) }}" class="rb-generate-btn rb-action-link">
            Cek Status Return
          </a>

          <a href="{{ route('nav.voucher-bantuan') }}#kendala" class="rb-status-btn rb-action-link">
            Contact Customer
          </a>
        </div>

      </div>

      {{-- RIGHT QR + MACHINE --}}
      <aside class="rb-return-preview">

        <div class="rb-qr-result is-visible" aria-hidden="false">
          <div class="rb-qr-result__code">
            <div class="rb-big-qr">
              <span></span><span></span><span></span>
              <span></span><span></span><span></span>
              <span></span><span></span><span></span>
            </div>
          </div>

          <div class="rb-qr-result__copy">
            <span>QR RETURN CODE</span>
            <strong>{{ $return->return_code }}</strong>
            <p>
              QR ini dibuat setelah kamu klik Generate QR Return.
              Scan kode ini di vending machine lokasi {{ $return->machine_location }}.
            </p>
          </div>
        </div>

        <div class="rb-machine rb-machine--status">
          <div class="rb-machine__screen">
            <small>BOTTLE RETURN</small>
            <strong>{{ strtoupper($return->status) }}</strong>
          </div>

          <div class="rb-machine__qr-slot is-active">
            <div class="rb-mini-qr">
              <span></span><span></span><span></span>
              <span></span><span></span><span></span>
              <span></span><span></span><span></span>
            </div>
          </div>

          <div class="rb-machine__return-bay">
            <span>RETURN BOTTLE HERE</span>

            <div class="rb-machine__bottle {{ $return->status !== 'pending' ? 'is-inserted' : '' }}"></div>

            <div class="rb-machine__scan {{ $return->status === 'pending' ? 'is-active' : '' }}"></div>
          </div>

          <div class="rb-machine__esp">
            <span>ESP32</span>

            @if ($return->status === 'failed')
              <i></i>
            @else
              <i class="is-active"></i>
            @endif
          </div>

          <div class="rb-machine__status-pill {{ $return->status === 'success' ? 'is-success' : '' }}">
            {{ strtoupper($return->status) }}
          </div>
        </div>

        <div class="rb-status-note rb-status-help-note">
          <strong>Catatan:</strong><br>

          @if ($return->status === 'pending')
            Poin akan diproses maksimal <strong>1x24 jam</strong> setelah botol berhasil discan,
            masuk ke return bay, dan lolos pengecekan sensor serta quality check.
          @elseif ($return->status === 'success')
            Return sudah dinyatakan success. Poin sudah ditambahkan ke akun kamu dan tercatat di transaksi poin.
          @else
            Return gagal diproses. Jika merasa ada kesalahan, silakan hubungi customer support melalui tombol Contact Customer.
          @endif
        </div>

      </aside>

    </div>

  </div>
</section>
@endsection