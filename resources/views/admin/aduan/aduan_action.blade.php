<div class="row row-bordered g-0">
    <div class="col-lg-4 p-4">
        <div class="demo-inline-spacing">
            @php
                $id = \App\Models\Aduan::where('aduan', $aduan->aduan)->first();
            @endphp
            <div class="form-check mt-3">
                <input name="default-radio-1" class="form-check-input" type="radio" value="" id="defaultRadio1"
                    {{ $id->id_role === 3 ? 'checked' : '' }} />
                <label class="form-check-label" for="defaultRadio1">
                    Bidang 1
                </label>
            </div>
            <div class="form-check">
                <input name="default-radio-1" class="form-check-input" type="radio" value="" id="defaultRadio2"
                    {{ $id->id_role === 4 ? 'checked' : '' }} />
                <label class="form-check-label" for="defaultRadio2">
                    Bidang 2
                </label>
            </div>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        const radio1 = document.getElementById('defaultRadio1');
        const radio2 = document.getElementById('defaultRadio2');

        radio1.addEventListener('change', function() {
            if (confirm('Apakah Anda yakin ingin mengubah Bidang ke Bidang 1?')) {
                // Ubah id_role ke 3 (Bidang 1) dengan Ajax
                $.ajax({
                    url: '/admin/aduan/{{ $id->id }}/update-role',
                    method: 'POST',
                    dataType: 'json',
                    data: {
                        _token: '{{ csrf_token() }}',
                        id_role: 3, // Sesuaikan dengan nilai id_role yang Anda inginkan
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
                // Kembalikan radio ke status sebelumnya jika konfirmasi dibatalkan
                radio1.checked = false;
            }
        });

        radio2.addEventListener('change', function() {
            if (confirm('Apakah Anda yakin ingin mengubah Bidang ke Bidang 2?')) {
                // Ubah id_role ke 4 (Bidang 2) dengan Ajax
                $.ajax({
                    url: '/admin/aduan/{{ $id->id }}/update-role',
                    method: 'POST',
                    dataType: 'json',
                    data: {
                        _token: '{{ csrf_token() }}',
                        id_role: 4, // Sesuaikan dengan nilai id_role yang Anda inginkan
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
                // Kembalikan radio ke status sebelumnya jika konfirmasi dibatalkan
                radio2.checked = false;
            }
        });
    });
</script>
