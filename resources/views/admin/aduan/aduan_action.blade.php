@include('sweetalert::alert')
{{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.6.9/sweetalert2.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.6.9/sweetalert2.min.js"></script> --}}

<div class="row row-bordered g-0">
    <div class="col-lg-4 p-4">
        <div class="demo-inline-spacing">
            @php
                $id = \App\Models\Aduan::where('aduan', $aduan->aduan)->first();
            @endphp
            <div class="form-check mt-3">
                <input name="default-radio-1" class="form-check-input disposisi" type="radio" value="3"
                    id="defaultRadio1" {{ $id->id_role === 3 ? 'checked' : '' }}
                    {{ $id->id_role === 3 || $id->id_role === 4 ? 'disabled' : '' }} />
                <label class="form-check-label" for="defaultRadio1">
                    Bidang 1
                </label>
            </div>
            <div class="form-check">
                <input name="default-radio-1" class="form-check-input disposisi" type="radio" value="4"
                    id="defaultRadio2" {{ $id->id_role === 4 ? 'checked' : '' }}
                    {{ $id->id_role === 3 || $id->id_role === 4 ? 'disabled' : '' }} />
                <label class="form-check-label" for="defaultRadio2 disposisi">
                    Bidang 2
                </label>
            </div>
        </div>
    </div>
</div>
{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.6.9/sweetalert2.min.js"></script> --}}
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
<script>
    $(document).ready(function() {
        $('.disposisi').click(function(e) {
            // var data_id = $(this).attr('data-id');
            Swal.fire({
                title: 'Disposisi',
                text: "Yakin akan disposisi ke bidang ini ?",
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
                    var selectedRadio = $('input[name="default-radio-1"]:checked').val();
                    if (selectedRadio) {
                        $.ajax({
                            url: '/admin/aduan/{{ $id->id }}/update-role',
                            method: 'POST',
                            dataType: 'json',
                            data: {
                                _token: '{{ csrf_token() }}',
                                id_role: selectedRadio, // Menggunakan nilai yang dipilih dari radio
                            },
                            success: function(response) {
                                // Handle respons dari server jika diperlukan
                                console.log(response);
                                // Refresh halaman setelah 1 detik (1000 milidetik)
                                setTimeout(function() {
                                    location.reload();
                                }, 1000);
                            },
                            error: function(error) {
                                // Handle error jika terjadi kesalahan
                                console.error(error);
                            }
                        });
                    } else {
                        Swal.fire('Peringatan', 'Pilih salah satu bidang terlebih dahulu.',
                            'warning');
                    }
                } else {
                    // Hapus seleksi radio button saat pembatalan
                    $('input[name="default-radio-1"]').prop('checked', false);
                }
            });
        });
    });
    // $(document).ready(function() {
    //           $('._delete_data').click(function(e) {
    //               var data_id = $(this).attr('data-id');
    //               Swal.fire({
    //                   title: 'Hapus data desa',
    //                   text: "Yakin akan menghapus data ini ?",
    //                   type: 'warning',
    //                   showCancelButton: true,
    //                   confirmButtonColor: '#d33',
    //                   cancelButtonColor: '#a9a9a9',
    //                   confirmButtonText: 'Hapus',
    //                   cancelButtonText: 'Batal'
    //               }).then((result) => {
    //                   if (result.value) {
    //                       $(document).find('#delete_from_' + data_id).submit();
    //                   }
    //               })
    //           });
    //       });
    // $(document).ready(function() {
    //     const radio1 = document.getElementById('defaultRadio1');
    //     const radio2 = document.getElementById('defaultRadio2');

    //     radio1.addEventListener('change', function() {
    //         if (confirm('Apakah Anda yakin ingin mengubah Bidang ke Bidang 1?')) {
    // // Ubah id_role ke 3 (Bidang 1) dengan Ajax
    // $.ajax({
    //     url: '/admin/aduan/{{ $id->id }}/update-role',
    //     method: 'POST',
    //     dataType: 'json',
    //     data: {
    //         _token: '{{ csrf_token() }}',
    //         id_role: 3, // Sesuaikan dengan nilai id_role yang Anda inginkan
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
    //         // Handle error jika terjadi kesalahan
    //         console.error(error);
    //     }
    // });
    //         } else {
    //             // Kembalikan radio ke status sebelumnya jika konfirmasi dibatalkan
    //             radio1.checked = false;
    //         }
    //     });

    //     radio2.addEventListener('change', function() {
    //         if (confirm('Apakah Anda yakin ingin mengubah Bidang ke Bidang 2?')) {
    //             // Ubah id_role ke 4 (Bidang 2) dengan Ajax
    //             $.ajax({
    //                 url: '/admin/aduan/{{ $id->id }}/update-role',
    //                 method: 'POST',
    //                 dataType: 'json',
    //                 data: {
    //                     _token: '{{ csrf_token() }}',
    //                     id_role: 4, // Sesuaikan dengan nilai id_role yang Anda inginkan
    //                 },
    //                 success: function(response) {
    //                     // Handle respons dari server jika diperlukan
    //                     console.log(response);
    //                     // Refresh halaman setelah 1 detik (1000 milidetik)
    //                     setTimeout(function() {
    //                         location.reload();
    //                     }, 1000);
    //                 },
    //                 error: function(error) {
    //                     // Handle error jika terjadi kesalahan
    //                     console.error(error);
    //                 }
    //             });
    //         } else {
    //             // Kembalikan radio ke status sebelumnya jika konfirmasi dibatalkan
    //             radio2.checked = false;
    //         }
    //     });
    // });
</script>
