<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>@yield('title', 'SCENTCYCLE')</title>

  @vite(['resources/css/app.css','resources/js/app.js'])

  <link rel="stylesheet" href="{{ asset('css/style.css') }}">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

  {{-- kalau ada CSS yang memang HARUS load via push (opsional) --}}
  @stack('styles')
</head>
<body>

  @include('partials.header')
  @include('partials.nav')

  <main>
    <div id="app-content">
      @yield('content')
    </div>
  </main>

  @include('partials.footer')

<script>
document.addEventListener("DOMContentLoaded", () => {
  const container = document.getElementById("app-content");
  if (!container) return;

  // Biar browser gak auto ngatur scroll saat history berubah
  if ("scrollRestoration" in history) history.scrollRestoration = "manual";

  function currentUrlKey(url) {
    try { return new URL(url, location.origin).pathname + new URL(url, location.origin).search; }
    catch { return url; }
  }

  function saveScrollForCurrentEntry() {
    const st = history.state || {};
    history.replaceState(
      { ...st, url: location.href, scrollY: window.scrollY },
      "",
      location.href
    );
  }

  // Tunggu CSS halaman selesai load (Promise)
  function loadPageCssFromDoc(doc) {
    const marker = doc.querySelector("[data-page-css]");
    if (!marker) return Promise.resolve();

    const cssUrl = marker.getAttribute("data-page-css");
    if (!cssUrl) return Promise.resolve();

    // hapus css halaman sebelumnya
    document.querySelectorAll("link[data-page-css]").forEach(l => l.remove());

    return new Promise((resolve) => {
      const link = document.createElement("link");
      link.rel = "stylesheet";
      link.href = cssUrl;
      link.setAttribute("data-page-css", "1");
      link.onload = () => resolve();
      link.onerror = () => resolve(); // kalau gagal load, jangan nge-freeze
      document.head.appendChild(link);
    });
  }

  // Init: kalau first load punya page css marker, load juga (tanpa nunggu)
  loadPageCssFromDoc(document);

  let inFlight = null;

  async function pjaxNavigate(url, { push = true, restoreScroll = false } = {}) {
    if (inFlight) return; // cegah spam klik (bikin “ngeleg”)
    inFlight = url;

    // simpan posisi scroll halaman sekarang sebelum pindah
    saveScrollForCurrentEntry();

    // anim keluar
    container.classList.add("pjax-anim");
    container.classList.remove("pjax-in-from-left", "pjax-in-from-right");
    container.classList.add("pjax-out-right");

    // tunggu anim keluar sebentar
    await new Promise(r => setTimeout(r, 180));

    let res;
    try {
      res = await fetch(url, { headers: { "X-Requested-With": "XMLHttpRequest" } });
    } catch {
      inFlight = null;
      window.location.href = url;
      return;
    }

    if (!res.ok) {
      inFlight = null;
      window.location.href = url;
      return;
    }

    const html = await res.text();
    const doc = new DOMParser().parseFromString(html, "text/html");

    const next = doc.querySelector("#app-content");
    if (!next) {
      inFlight = null;
      window.location.href = url;
      return;
    }

    // title
    const t = doc.querySelector("title");
    if (t) document.title = t.textContent;

    // PENTING: tunggu CSS halaman baru selesai load sebelum swap HTML
    await loadPageCssFromDoc(doc);

    // swap konten
    container.innerHTML = next.innerHTML;

    // update history
    if (push) {
      history.pushState({ url, scrollY: 0 }, "", url);
    }

    // scroll behavior:
    // - kalau klik nav biasa: ke atas
    // - kalau back/forward: restore scroll dari state
    if (restoreScroll) {
      const y = (history.state && typeof history.state.scrollY === "number") ? history.state.scrollY : 0;
      window.scrollTo({ top: y, behavior: "auto" });
    } else {
      window.scrollTo({ top: 0, behavior: "auto" });
    }

    // anim masuk
    container.classList.remove("pjax-out-right", "pjax-out-left");
    container.classList.add("pjax-in-from-right");

    requestAnimationFrame(() => {
      // biar transition kepake
      container.classList.remove("pjax-in-from-right");
    });

    inFlight = null;
  }

  // Simpan scroll terus menerus biar back/forward presisi
  window.addEventListener("scroll", () => {
    const st = history.state || {};
    history.replaceState({ ...st, url: location.href, scrollY: window.scrollY }, "", location.href);
  }, { passive: true });

  document.addEventListener("click", (e) => {
    const a = e.target.closest("a");
    if (!a) return;

    const href = a.getAttribute("href");
    if (!href) return;

    // modifier keys
    if (e.metaKey || e.ctrlKey || e.shiftKey || e.altKey) return;

    // skip anchors / download / new tab
    if (href.startsWith("#")) return;
    if (a.hasAttribute("download")) return;
    if ((a.getAttribute("target") || "").toLowerCase() === "_blank") return;

    // skip external
    const isAbsolute = /^https?:\/\//i.test(href);
    if (isAbsolute) {
      try {
        const u = new URL(href);
        if (u.origin !== location.origin) return;
      } catch {
        return;
      }
    }

    e.preventDefault();
    e.stopPropagation();
    e.stopImmediatePropagation();

    pjaxNavigate(href, { push: true, restoreScroll: false });
  }, true);

  window.addEventListener("popstate", () => {
    pjaxNavigate(location.href, { push: false, restoreScroll: true });
  });
});
</script>

</body>
</html>