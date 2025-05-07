<div class="modal fade" id="categoryModal" tabindex="-1" aria-labelledby="categoryModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="categoryModalLabel">{{ isset($category) ? 'Edit' : 'Tambah' }} Kategori</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
            </div>
            <div class="modal-body">
                <form
                    action="{{ isset($category) ? route('categories.update', $category->id) : route('categories.store') }}"
                    method="POST">
                    @csrf
                    @if (isset($category))
                        @method('PUT')
                    @endif

                    <div class="mb-3">
                        <label>Nama Kategori</label>
                        <input type="text" name="name" class="form-control"
                            value="{{ old('name', $category->name ?? '') }}">
                    </div>

                    <div class="mb-3">
                        <label>Deskripsi</label>
                        <textarea name="description" class="form-control">{{ old('description', $category->description ?? '') }}</textarea>
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
    const categoryModal = document.getElementById('categoryModal');
    categoryModal.addEventListener('show.bs.modal', function(event) {
        const button = event.relatedTarget;
        const userId = button.getAttribute('data-id');
        const userName = button.getAttribute('data-name');
        const userEmail = button.getAttribute('data-email');

        const modalTitle = categoryModal.querySelector('.modal-title');
        const form = categoryModal.querySelector('form');
        const nameInput = categoryModal.querySelector('input[name="name"]');
        const emailInput = categoryModal.querySelector('input[name="email"]');

        if (userId) {
            modalTitle.textContent = `Edit User: ${userName}`;
            form.action = `/users/${userId}`;
            form.method = 'POST';
            let inputMethod = document.createElement('input');
            inputMethod.setAttribute('name', '_method');
            inputMethod.setAttribute('value', 'PUT');
            form.appendChild(inputMethod);
        } else {
            modalTitle.textContent = 'Tambah User';
            form.action = '/users';
            form.method = 'POST';
            let existingMethod = form.querySelector('[name="_method"]');
            if (existingMethod) {
                existingMethod.remove();
            }
        }

        // Isi form dengan data yang relevan
        nameInput.value = userName;
        emailInput.value = userEmail;
    });
</script>
