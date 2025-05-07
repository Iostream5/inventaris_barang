<div class="modal fade" id="transactionModal" tabindex="-1" aria-labelledby="transactionModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="transactionModalLabel">
                    {{ isset($transaction) ? 'Edit Transaksi' : 'Tambah Transaksi' }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
            </div>
            <div class="modal-body">
                <form
                    action="{{ isset($transaction) ? route('transactions.update', $transaction->id) : route('transactions.store') }}"
                    method="POST">
                    @csrf
                    @if (isset($transaction))
                        @method('PUT')
                    @endif

                    <div class="mb-3">
                        <label for="item_id" class="form-label">Item</label>
                        <select name="item_id" id="item_id" class="form-control">
                            @foreach ($items as $item)
                                <option value="{{ $item->id }}"
                                    {{ old('item_id', $transaction->item_id ?? '') == $item->id ? 'selected' : '' }}>
                                    {{ $item->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="user_id" class="form-label">User</label>
                        <select name="user_id" id="user_id" class="form-control">
                            @foreach ($users as $user)
                                <option value="{{ $user->id }}"
                                    {{ old('user_id', $transaction->user_id ?? '') == $user->id ? 'selected' : '' }}>
                                    {{ $user->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="type" class="form-label">Transaction Type</label>
                        <select name="type" id="type" class="form-control">
                            <option value="in"
                                {{ old('type', $transaction->type ?? '') == 'in' ? 'selected' : '' }}>In</option>
                            <option value="out"
                                {{ old('type', $transaction->type ?? '') == 'out' ? 'selected' : '' }}>Out</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="quantity" class="form-label">Quantity</label>
                        <input type="number" name="quantity" id="quantity" class="form-control"
                            value="{{ old('quantity', $transaction->quantity ?? '') }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="notes" class="form-label">Notes</label>
                        <textarea name="notes" id="notes" class="form-control">{{ old('notes', $transaction->notes ?? '') }}</textarea>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-success">Simpan Transaksi</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    const transactionModal = document.getElementById('transactionModal');

    transactionModal.addEventListener('show.bs.modal', function(event) {
        const button = event.relatedTarget;

        // Ambil data dari tombol pemicu modal
        const transactionId = button.getAttribute('data-id');
        const transactionItem = button.getAttribute('data-item');
        const transactionUser = button.getAttribute('data-user');
        const transactionType = button.getAttribute('data-type');
        const transactionQuantity = button.getAttribute('data-quantity');
        const transactionNotes = button.getAttribute('data-notes');

        // Referensi elemen-elemen di dalam modal
        const modalTitle = transactionModal.querySelector('.modal-title');
        const form = transactionModal.querySelector('form');
        const itemSelect = transactionModal.querySelector('select[name="item_id"]');
        const userSelect = transactionModal.querySelector('select[name="user_id"]');
        const typeSelect = transactionModal.querySelector('select[name="type"]');
        const quantityInput = transactionModal.querySelector('input[name="quantity"]');
        const notesInput = transactionModal.querySelector('textarea[name="notes"]');

        if (transactionId) {
            // Mode edit
            modalTitle.textContent = `Edit Transaksi: ${transactionItem}`;
            form.action = `/transactions/${transactionId}`;
            form.method = 'POST';

            // Tambahkan input _method hanya jika belum ada
            let inputMethod = form.querySelector('input[name="_method"]');
            if (!inputMethod) {
                inputMethod = document.createElement('input');
                inputMethod.setAttribute('type', 'hidden');
                inputMethod.setAttribute('name', '_method');
                inputMethod.setAttribute('value', 'PUT');
                form.appendChild(inputMethod);
            }
        } else {
            // Mode tambah
            modalTitle.textContent = 'Tambah Transaksi';
            form.action = '/transactions';
            form.method = 'POST';

            // Hapus _method jika sebelumnya ada
            let existingMethod = form.querySelector('input[name="_method"]');
            if (existingMethod) {
                existingMethod.remove();
            }
        }

        // Isi data ke dalam form
        itemSelect.value = transactionItem || '';
        userSelect.value = transactionUser || '';
        typeSelect.value = transactionType || '';
        quantityInput.value = transactionQuantity || '';
        notesInput.value = transactionNotes || '';
    });
</script>
