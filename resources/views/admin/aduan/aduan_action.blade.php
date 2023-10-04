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
                    {{ $id->id_role === 3 || $id->id_role === 4 || $id->id_role === 6 ? 'disabled' : '' }} />
                <label class="form-check-label" for="defaultRadio1">
                    PPSKS
                </label>
            </div>
            <div class="form-check">
                <input name="default-radio-1" class="form-check-input disposisi" type="radio" value="4"
                    id="defaultRadio2" {{ $id->id_role === 4 ? 'checked' : '' }}
                    {{ $id->id_role === 3 || $id->id_role === 4 || $id->id_role === 6 ? 'disabled' : '' }} />
                <label class="form-check-label" for="defaultRadio2">
                    PPMKS
                </label>
            </div>
            <div class="form-check">
                <input name="default-radio-1" class="form-check-input disposisi" type="radio" value="6"
                    id="defaultRadio3" {{ $id->id_role === 6 ? 'checked' : '' }}
                    {{ $id->id_role === 3 || $id->id_role === 4 || $id->id_role === 6 ? 'disabled' : '' }} />
                <label class="form-check-label" for="defaultRadio3">
                    Sekretaris 2
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
</script>
