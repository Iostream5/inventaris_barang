<div class="modal fade" id="userModal" tabindex="-1" aria-labelledby="userModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="userModalLabel">{{ isset($user) ? 'Edit User' : 'Tambah User' }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
            </div>
            <div class="modal-body">
                <form action="{{ isset($user) ? route('users.update', $user->id) : route('users.store') }}"
                    method="POST">
                    @csrf
                    @if (isset($user))
                        @method('PUT')
                    @endif
                    <div class="mb-3">
                        <label class="form-label">Nama</label>
                        <input type="text" name="name" class="form-control"
                            value="{{ old('name', $user->name ?? '') }}">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" class="form-control"
                            value="{{ old('email', $user->email ?? '') }}">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Password
                            {{ isset($user) ? '(kosongkan jika tidak diubah)' : '' }}</label>
                        <input type="password" name="password" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Konfirmasi Password</label>
                        <input type="password" name="password_confirmation" class="form-control">
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
    // Handler untuk User Modal
    const userModal = document.getElementById('userModal');
    userModal.addEventListener('show.bs.modal', function(event) {
        const button = event.relatedTarget;
        const userId = button.getAttribute('data-id');
        const userName = button.getAttribute('data-name');
        const userEmail = button.getAttribute('data-email');

        const modalTitle = userModal.querySelector('.modal-title');
        const form = userModal.querySelector('form');
        const nameInput = userModal.querySelector('input[name="name"]');
        const emailInput = userModal.querySelector('input[name="email"]');

        if (userId) {
            modalTitle.textContent = `Edit User: ${userName}`;
            form.action = `/users/${userId}`;
            form.method = 'POST';
            let inputMethod = document.createElement('input');
            inputMethod.setAttribute('name', '_method');
            inputMethod.setAttribute('value', 'PUT');
            form.appendChild(inputMethod);

            nameInput.value = userName;
            emailInput.value = userEmail;
        } else {
            modalTitle.textContent = 'Tambah User';
            form.action = `/users`;
            form.method = 'POST';
            let existingMethod = form.querySelector('[name="_method"]');
            if (existingMethod) existingMethod.remove();

            nameInput.value = '';
            emailInput.value = '';
        }
    });

    // Handler untuk Category Modal (jika memang ada)
    const categoryModal = document.getElementById('categoryModal');
    categoryModal?.addEventListener('show.bs.modal', function(event) {
        const button = event.relatedTarget;
        const categoryId = button.getAttribute('data-id');
        const categoryName = button.getAttribute('data-name');
        const categoryDescription = button.getAttribute('data-description');

        const modalTitle = categoryModal.querySelector('.modal-title');
        const form = categoryModal.querySelector('form');
        const nameInput = categoryModal.querySelector('input[name="name"]');
        const descriptionInput = categoryModal.querySelector('textarea[name="description"]');

        if (categoryId) {
            modalTitle.textContent = `Edit Kategori: ${categoryName}`;
            form.action = `/categories/${categoryId}`;
            form.method = 'POST';
            let inputMethod = document.createElement('input');
            inputMethod.setAttribute('name', '_method');
            inputMethod.setAttribute('value', 'PUT');
            form.appendChild(inputMethod);
        } else {
            modalTitle.textContent = 'Tambah Kategori';
            form.action = '/categories';
            form.method = 'POST';
            let existingMethod = form.querySelector('[name="_method"]');
            if (existingMethod) existingMethod.remove();
        }

        nameInput.value = categoryName;
        descriptionInput.value = categoryDescription;
    });
</script>
