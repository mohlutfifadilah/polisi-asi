<div class="row row-bordered g-0">
    <div class="col-lg-4 p-4">
        <div class="demo-inline-spacing">
            @php
              $id = \App\Models\User::where('name', $user->name)->first();
            @endphp
            <form method="get" action="{{ url('/admin/users/' . $id->id . '/edit') }}">
                <button class="btn btn-warning mr-2" type="submit">
                    <i class="tf-icons mdi mdi-file-edit-outline"></i>
                </button>
            </form>
            <form method="post" action="{{ route('users.destroy', $id->id) }}" id="delete_from_{{ $id->id }}">
                @csrf
                @method('DELETE')
                <button class="btn btn-danger _delete_data" type="submit" data-id="{{ $id->id }}"
                    onclick="return false">
                    <i class="tf-icons mdi mdi-delete"></i>
                </button>
            </form>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
<script>
    $(document).ready(function() {
        $('._delete_data').click(function(e) {
            var data_id = $(this).attr('data-id');
            Swal.fire({
                title: 'Hapus data pengguna',
                text: "Yakin akan menghapus data ini ?",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#a9a9a9',
                confirmButtonText: 'Hapus',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.value) {
                    $(document).find('#delete_from_' + data_id).submit();
                }
            })
        });
    });
</script>
