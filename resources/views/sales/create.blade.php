<x-app-layout>
    <x-slot name="header">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <p class="text-uppercase small text-warning fw-bold mb-1">Transaksi</p>
                <h2 class="h4 mb-0 fw-bold text-dark">POS Penjualan</h2>
            </div>
        </div>
    </x-slot>

    <div class="container py-4">
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show rounded-4 border-0 shadow-sm" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger alert-dismissible fade show rounded-4 border-0 shadow-sm" role="alert">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="row g-4">
            <div class="col-lg-7">
                <div class="card border-0 shadow-sm rounded-4 mb-4">
                    <div class="card-body p-4">
                        <div class="row g-3 align-items-end">
                            <div class="col-md-6">
                                <label for="customer_id" class="form-label fw-semibold">Pelanggan</label>
                                <select class="form-select" id="customer_id" name="customer_id">
                                    <option value="">Umum / Walk In</option>
                                    @foreach ($customers as $customer)
                                        <option value="{{ $customer->id }}">{{ $customer->nama }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="productSearch" class="form-label fw-semibold">Cari Produk</label>
                                <input type="text" class="form-control" id="productSearch" placeholder="Cari nama atau kode produk">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card border-0 shadow-sm rounded-4">
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover align-middle mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th class="px-4">Produk</th>
                                        <th>Stok</th>
                                        <th>Harga</th>
                                        <th class="text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody id="productTableBody">
                                    @foreach ($products as $product)
                                        <tr data-product-id="{{ $product->id }}" data-product-name="{{ $product->nama }}" data-product-stock="{{ $product->stok }}" data-product-price="{{ $product->harga_jual }}">
                                            <td class="px-4">
                                                <div class="fw-semibold">{{ $product->nama }}</div>
                                                <small class="text-muted">{{ $product->kode_produk }}</small>
                                            </td>
                                            <td>{{ $product->stok }}</td>
                                            <td>Rp {{ number_format($product->harga_jual, 0, ',', '.') }}</td>
                                            <td class="text-center">
                                                <button type="button" class="btn btn-sm btn-primary rounded-pill add-to-cart" data-product-id="{{ $product->id }}">
                                                    Tambah
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-5">
                <div class="card border-0 shadow-sm rounded-4 h-100">
                    <div class="card-body p-4">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h3 class="h5 fw-bold mb-0">Keranjang</h3>
                            <span class="badge bg-light text-dark rounded-pill px-3 py-2" id="itemCount">0 item</span>
                        </div>

                        <form action="{{ route('sales.store') }}" method="POST" id="saleForm">
                            @csrf
                            <input type="hidden" name="items" id="itemsInput">
                            <input type="hidden" name="pelanggan_id" id="pelangganInput">

                            <div class="table-responsive mb-3">
                                <table class="table align-middle mb-0">
                                    <thead class="table-light">
                                        <tr>
                                            <th>Produk</th>
                                            <th>Qty</th>
                                            <th>Subtotal</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody id="cartTableBody">
                                        <tr>
                                            <td colspan="4" class="text-center text-muted py-4">Keranjang masih kosong.</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                            <div class="border-top pt-3">
                                <div class="d-flex justify-content-between mb-2">
                                    <span>Total</span>
                                    <strong id="totalDisplay">Rp 0</strong>
                                </div>
                                <div class="mb-3">
                                    <label for="dibayar" class="form-label fw-semibold">Pembayaran</label>
                                    <input type="number" min="0" step="0.01" class="form-control" id="dibayar" name="dibayar" value="0">
                                </div>
                                <div class="d-flex justify-content-between mb-3">
                                    <span>Kembalian</span>
                                    <strong id="kembalianDisplay">Rp 0</strong>
                                </div>
                                <div class="mb-3">
                                    <label for="catatan" class="form-label fw-semibold">Catatan</label>
                                    <textarea class="form-control" id="catatan" name="catatan" rows="3" placeholder="Catatan tambahan (opsional)"></textarea>
                                </div>
                                <button type="submit" class="btn btn-warning fw-semibold w-100 rounded-pill">
                                    Simpan Transaksi
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        const cart = [];
        const productTableBody = document.getElementById('productTableBody');
        const cartTableBody = document.getElementById('cartTableBody');
        const itemsInput = document.getElementById('itemsInput');
        const pelangganInput = document.getElementById('pelangganInput');
        const customerIdSelect = document.getElementById('customer_id');
        const dibayarInput = document.getElementById('dibayar');
        const totalDisplay = document.getElementById('totalDisplay');
        const kembalianDisplay = document.getElementById('kembalianDisplay');
        const itemCount = document.getElementById('itemCount');

        function formatCurrency(value) {
            return new Intl.NumberFormat('id-ID', {
                style: 'currency',
                currency: 'IDR',
                maximumFractionDigits: 0,
            }).format(value);
        }

        function renderCart() {
            if (cart.length === 0) {
                cartTableBody.innerHTML = '<tr><td colspan="4" class="text-center text-muted py-4">Keranjang masih kosong.</td></tr>';
                totalDisplay.textContent = formatCurrency(0);
                kembalianDisplay.textContent = formatCurrency(0);
                itemCount.textContent = '0 item';
                itemsInput.value = JSON.stringify([]);
                return;
            }

            let total = 0;
            cartTableBody.innerHTML = cart.map((item, index) => {
                total += item.subtotal;
                return `
                    <tr>
                        <td>
                            <div class="fw-semibold">${item.nama}</div>
                        </td>
                        <td>
                            <div class="d-flex align-items-center gap-2">
                                <button type="button" class="btn btn-sm btn-outline-secondary" data-action="decrease" data-index="${index}">-</button>
                                <input type="number" min="1" class="form-control form-control-sm text-center" value="${item.jumlah}" data-action="qty" data-index="${index}" style="width: 70px;">
                                <button type="button" class="btn btn-sm btn-outline-secondary" data-action="increase" data-index="${index}">+</button>
                            </div>
                        </td>
                        <td>${formatCurrency(item.subtotal)}</td>
                        <td>
                            <button type="button" class="btn btn-sm btn-outline-danger" data-action="remove" data-index="${index}">Hapus</button>
                        </td>
                    </tr>
                `;
            }).join('');

            itemCount.textContent = `${cart.reduce((sum, item) => sum + item.jumlah, 0)} item`;
            totalDisplay.textContent = formatCurrency(total);
            itemsInput.value = JSON.stringify(cart.map(item => ({
                produk_id: item.produk_id,
                jumlah: item.jumlah,
            })));
            updateKembalian();
        }

        function updateKembalian() {
            const total = cart.reduce((sum, item) => sum + item.subtotal, 0);
            const dibayar = Number(dibayarInput.value || 0);
            const kembalian = Math.max(0, dibayar - total);
            kembalianDisplay.textContent = formatCurrency(kembalian);
        }

        function addToCart(productId, productName, price, stock) {
            const existing = cart.find(item => item.produk_id === productId);

            if (existing) {
                if (existing.jumlah >= stock) {
                    alert('Stok tidak mencukupi untuk produk ini.');
                    return;
                }
                existing.jumlah += 1;
                existing.subtotal = existing.jumlah * price;
            } else {
                cart.push({
                    produk_id: productId,
                    nama: productName,
                    jumlah: 1,
                    harga: price,
                    subtotal: price,
                });
            }

            renderCart();
        }

        function updateQty(index, newQty) {
            const item = cart[index];
            if (!item) return;

            const row = document.querySelector(`tr[data-product-id="${item.produk_id}"]`);
            const stock = Number(row?.dataset.productStock || 0);
            const qty = Number(newQty || 0);

            if (qty < 1) {
                cart.splice(index, 1);
                renderCart();
                return;
            }

            if (qty > stock) {
                alert('Jumlah melebihi stok yang tersedia.');
                item.jumlah = stock;
                item.subtotal = stock * item.harga;
                renderCart();
                return;
            }

            item.jumlah = qty;
            item.subtotal = qty * item.harga;
            renderCart();
        }

        document.addEventListener('click', function (event) {
            const button = event.target.closest('.add-to-cart');
            if (button) {
                const row = button.closest('tr');
                addToCart(
                    Number(button.dataset.productId),
                    row.dataset.productName,
                    Number(row.dataset.productPrice),
                    Number(row.dataset.productStock)
                );
            }

            const actionButton = event.target.closest('[data-action]');
            if (!actionButton) return;

            const index = Number(actionButton.dataset.index);
            const action = actionButton.dataset.action;

            if (action === 'increase') {
                const item = cart[index];
                const row = document.querySelector(`tr[data-product-id="${item.produk_id}"]`);
                const stock = Number(row?.dataset.productStock || 0);
                if (item.jumlah >= stock) {
                    alert('Stok tidak mencukupi untuk produk ini.');
                    return;
                }
                item.jumlah += 1;
                item.subtotal = item.jumlah * item.harga;
            }

            if (action === 'decrease') {
                const item = cart[index];
                item.jumlah -= 1;
                if (item.jumlah <= 0) {
                    cart.splice(index, 1);
                } else {
                    item.subtotal = item.jumlah * item.harga;
                }
            }

            if (action === 'remove') {
                cart.splice(index, 1);
            }

            renderCart();
        });

        document.addEventListener('input', function (event) {
            const target = event.target;
            if (target.dataset.action === 'qty') {
                updateQty(Number(target.dataset.index), Number(target.value));
            }
        });

        customerIdSelect.addEventListener('change', function () {
            pelangganInput.value = customerIdSelect.value;
        });

        dibayarInput.addEventListener('input', updateKembalian);

        document.getElementById('saleForm').addEventListener('submit', function (event) {
            const total = cart.reduce((sum, item) => sum + item.subtotal, 0);
            const dibayar = Number(dibayarInput.value || 0);

            if (cart.length === 0) {
                event.preventDefault();
                alert('Keranjang masih kosong.');
                return;
            }

            if (dibayar < total) {
                event.preventDefault();
                alert('Pembayaran harus cukup untuk menutup total transaksi.');
                return;
            }

            itemsInput.value = JSON.stringify(cart.map(item => ({
                produk_id: item.produk_id,
                jumlah: item.jumlah,
            })));
        });

        document.getElementById('productSearch').addEventListener('input', function () {
            const query = this.value.toLowerCase();
            const rows = productTableBody.querySelectorAll('tr');

            rows.forEach(row => {
                const text = (row.dataset.productName + ' ' + row.dataset.productId).toLowerCase();
                row.style.display = text.includes(query) ? '' : 'none';
            });
        });
    </script>
</x-app-layout>
