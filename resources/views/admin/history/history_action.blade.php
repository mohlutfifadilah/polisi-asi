@include('sweetalert::alert')
{{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.6.9/sweetalert2.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.6.9/sweetalert2.min.js"></script> --}}
<div class="row">
    @php
        $id = \App\Models\Aduan::find($aduan->id);
    @endphp
    <div class="col-1">
        <input class="form-check-input" type="checkbox" id="is_publish_switch" name="publish" data-id="{{ $aduan->id }}" {{ $id->is_publish != 0 || $id->is_publish != null ? 'checked' : '' }}>
        {{-- <form action="{{ url('/admin/history/' . $aduan->id . '/update-publish') }}" method="POST" style="display: none;"> --}}
        <form action="" method="POST" style="display: none;" id="form">
            @csrf
            <input type="hidden" name="hadu" value="{{ $aduan->id }}" id="hadu">
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
        // console.log($('#hadu').val());

        $('.form-check-input').change(function() {
            var myForm = $('#form');
            var id = $(this).data('id');
            var input = $(this).closest('div').find('#hadu');
            var status = $('.form-check-input').is(':checked');
            var message = status ? "Yakin akan publish aduan ini ?" :
                "Yakin akan ubah menjadi tidak publish ?";

            Swal.fire({
                title: 'Publish',
                text: message,
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
                    // input.val('');
                    // input.val(id);
                    // console.log("id yang dikirim =", input.val());
                    // $('form').submit();
                    // $.ajax({
                    //     url: '/admin/history/' + id + '/update-publish',
                    //     method: 'POST',
                    //     dataType: 'json',
                    //     beforeSend: function(xhr, type) {
                    //         if (!type.crossDomain) {
                    //             xhr.setRequestHeader('X-CSRF-Token', $(
                    //                 'meta[name="csrf-token"]').attr(
                    //                 'content'));
                    //         }
                    //     },
                    //     data: {
                    //         _token: '{{ csrf_token() }}',
                    //         history: id
                    //     },
                    //     success: function(response) {
                    //         // Handle respons dari server jika diperlukan
                    //         console.log(response);
                    //         // Refresh halaman setelah 1 detik (1000 milidetik)
                    //         setTimeout(function() {
                    //             location.reload();
                    //         }, 1000);
                    //     },
                    //     error: function(error) {
                    //         console.log(id);
                    //         // Handle error jika terjadi kesalahan
                    //         console.error(error);
                    //     }
                    // });
                    console.log(id);
                    // $('form').action = '/admin/history/' + id + '/update-publish';
                    myForm.attr('action', '/admin/history/' + id + '/update-publish');
                    myForm.submit();
                } else {
                    // Kembalikan status checkbox jika pembatalan
                    $(this).prop('checked', !status);
                }
            });
        });
        function setFormAction(newAction) {
            myForm.action = newAction;
        }
    });
</script>
