@include('sweetalert::alert')
{{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.6.9/sweetalert2.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.6.9/sweetalert2.min.js"></script> --}}
<div class="row">
    @php
        $id = \App\Models\Aduan::where('aduan', $aduan->aduan)->first();
    @endphp
    <div class="col-1">
        <input class="form-check-input" type="checkbox" id="is_publish_switch" name="publish" value="{{ $id->is_publish }}"
            {{ $id->is_publish === null || $id->is_publish === 0 ? '' : 'checked' }}>
        <form action="{{ url('/admin/history/' . $id->id . '/update-publish') }}" method="POST" style="display: none;">
            @csrf
            <button type="submit" class="btn btn-primary" hidden>Simpan</button>
        </form>
    </div>
    <div class="col-2">
        <div class="form-check form-switch m-0 p-0">
            <label class="form-check-label" for="flexSwitchCheckDefault">
                @if (is_null($id->is_publish) || $id->is_publish === 0)
                    <span class="badge rounded-pill bg-warning">Tidak Publish</span>
                @else
                    <span class="badge rounded-pill bg-success">Publish</span>
                @endif
            </label>
        </div>
    </div>

</div>
{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.6.9/sweetalert2.min.js"></script> --}}
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
<script>
    $(document).ready(function() {
        $('#is_publish_switch').click(function(e) {
            e.preventDefault();
            $checkbox = $(this);
            $status = $checkbox.is(':checked');
            $message = $status ? "Yakin akan publish aduan ini ?" :
                "Yakin akan ubah menjadi tidak publish ?";

            Swal.fire({
                title: 'Publish',
                text: $message,
                type: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yakin',
                cancelButtonText: 'Batal',
                customClass: {
                    confirmButton: 'btn btn-success',
                    cancelButton: 'btn btn-secondary',
                },
            }).then((result) => {
                if (result.value) {
                    console.log(result);
                    $('form').submit();
                } else {
                    // Kembalikan status checkbox jika pembatalan
                    $checkbox.prop('checked', !$status);
                }
            });
        });
    });
    // $(document).ready(function() {
    //     $('#is_publish_switch').change(function() {
    //         var isChecked = $(this).is(':checked');
    //         var newStatus = isChecked ? 1 : null; // Sesuaikan dengan nilai yang sesuai

    //         Swal.fire({
    //             title: 'Publish',
    //             text: isChecked ? 'Yakin akan publish aduan ini?' :
    //                 'Yakin akan ubah menjadi tidak publish?',
    //             type: 'warning',
    //             showCancelButton: true,
    //             confirmButtonText: 'Yakin',
    //             cancelButtonText: 'Batal',
    //             customClass: {
    //                 confirmButton: 'btn btn-success',
    //                 cancelButton: 'btn btn-secondary',
    //             },
    //         }).then((result) => {
    //             if (result.value) {
    //                 $.ajax({
    //                     url: '/admin/history/{{ $id->id }}/update-publish',
    //                     method: 'POST',
    //                     dataType: 'json',
    //                     data: {
    //                         _token: $('#token').val(),
    //                         is_publish: newStatus,
    //                     },
    //                     success: function(response) {
    //                         // Handle respons dari server jika diperlukan
    //                         console.log(response);

    //                         // Jika sukses, tampilkan pesan sukses menggunakan SweetAlert2
    //                         Swal.fire('Sukses', 'Status berhasil diubah',
    //                         'success');

    //                         // Refresh halaman setelah 1 detik (1000 milidetik)
    //                         setTimeout(function() {
    //                             location.reload();
    //                         }, 1000);
    //                     },
    //                     error: function(error) {
    //                         // Handle error jika terjadi kesalahan
    //                         console.error(error);
    //                     }
    //                 });
    //             } else {
    //                 // Reset switch box jika pembatalan
    //                 $('#is_publish_switch').prop('checked', !isChecked);
    //             }
    //         });
    //     });
    // });
</script>
