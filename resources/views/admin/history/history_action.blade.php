@include('sweetalert::alert')
{{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.6.9/sweetalert2.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.6.9/sweetalert2.min.js"></script> --}}

<div class="row">
    @php
        $id = \App\Models\Aduan::where('aduan', $aduan->aduan)->first();
    @endphp
    <div class="col-1">
        <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault" name="publish"
            value="{{ $id->is_publish }}">
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
        $('.form-check-input').click(function(e) {
          $status = $('input[name="publish"]').val();
          if ($status == 1){
            $message = "Yakin akan ubah menjadi tidak publish ?";
          } else {
            $message = "Yakin akan publish aduan ini ?";
          }
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
                    if ($status === null || $status === 0) {
                        $.ajax({
                            url: url{{ '/admin/history/' . $id->id . '/update-publish' }},
                            method: 'POST',
                            dataType: 'json',
                            data: {
                                _token: '{{ csrf_token() }}',
                                is_publish: 1,
                            },
                            success: function(response) {
                                // Handle respons dari server jika diperlukan
                                console.log(response);
                                $('input[type="checkbox"]').prop('checked', true);
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
                      $.ajax({
                          url: '/admin/history/{{ $id->id }}/update-publish',
                          method: 'POST',
                          dataType: 'json',
                          data: {
                              _token: '{{ csrf_token() }}',
                              is_publish: 0,
                          },
                          success: function(response) {
                              // Handle respons dari server jika diperlukan
                              console.log(response);
                              $('input[type="checkbox"]').prop('checked', false);
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

                    }
                } else {
                    // Hapus seleksi radio button saat pembatalan
                    $('input[type="checkbox"]').prop('checked', false);
                }
            });
        });
    });
</script>
