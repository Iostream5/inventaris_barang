<div class="modal fade" id="itemModal" tabindex="-1" aria-labelledby="itemModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="itemModalLabel">{{ isset($item) ? 'Edit' : 'Tambah' }} Barang</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
            </div>
            <div class="modal-body">
                <form action="{{ isset($item) ? route('items.update', $item->id) : route('items.store') }}"
                    method="POST" enctype="multipart/form-data">
                    @csrf
                    @if (isset($item))
                        @method('PUT')
                    @endif

                    <div class="mb-3">
                        <label>Nama Barang</label>
                        <input type="text" name="name" class="form-control"
                            value="{{ old('name', $item->name ?? '') }}">
                    </div>

                    <div class="mb-3">
                        <label>Kategori</label>
                        <select name="category_id" class="form-select">
                            @foreach ($categories as $cat)
                                <option value="{{ $cat->id }}"
                                    {{ old('category_id', $item->category_id ?? '') == $cat->id ? 'selected' : '' }}>
                                    {{ $cat->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label>Stok</label>
                        <input type="number" name="stock" class="form-control"
                            value="{{ old('stock', $item->stock ?? 0) }}">
                    </div>

                    <div class="mb-3">
                        <label>Satuan</label>
                        <input type="text" name="unit" class="form-control"
                            value="{{ old('unit', $item->unit ?? '') }}">
                    </div>

                    <div class="mb-3">
                        <label>Deskripsi</label>
                        <textarea name="description" class="form-control">{{ old('description', $item->description ?? '') }}</textarea>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-success">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    const itemModal = document.getElementById('itemModal');
    itemModal.addEventListener('show.bs.modal', function(event) {
        const button = event.relatedTarget; // Tombol yang memicu modal
        const itemId = button.getAttribute('data-id');
        const itemName = button.getAttribute('data-name');
        const itemCategory = button.getAttribute('data-category');
        const itemStock = button.getAttribute('data-stock');
        const itemUnit = button.getAttribute('data-unit');

        const modalTitle = itemModal.querySelector('.modal-title');
        const form = itemModal.querySelector('form');
        const nameInput = itemModal.querySelector('input[name="name"]');
        const categorySelect = itemModal.querySelector('select[name="category_id"]');
        const stockInput = itemModal.querySelector('input[name="stock"]');
        const unitInput = itemModal.querySelector('input[name="unit"]');

        // Mengubah judul modal dan menyesuaikan aksi berdasarkan ID
        if (itemId) {
            modalTitle.textContent = `Edit Barang: ${itemName}`;
            form.action = `/items/${itemId}`; // Ubah action form ke route update
            form.method = 'POST'; // Tetap gunakan POST, karena kita menggunakan PUT melalui _method
            let inputMethod = document.createElement('input');
            inputMethod.setAttribute('name', '_method');
            inputMethod.setAttribute('value', 'PUT');
            form.appendChild(inputMethod);
        } else {
            modalTitle.textContent = 'Tambah Barang';
            form.action = '/items'; // Action untuk menyimpan barang baru
            form.method = 'POST';
            let existingMethod = form.querySelector('[name="_method"]');
            if (existingMethod) {
                existingMethod.remove(); // Hapus _method jika ada
            }
        }

        // Isi form dengan data yang relevan
        nameInput.value = itemName;
        categorySelect.value = itemCategory;
        stockInput.value = itemStock;
        unitInput.value = itemUnit;
    });
</script>
