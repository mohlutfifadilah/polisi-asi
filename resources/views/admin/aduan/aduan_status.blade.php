@if ($aduan->id_role === 2)
  <span class="badge rounded-pill bg-danger">Belum Disposisi oleh Kepala Dinas</span>
  @elseif ($aduan->id_role === 3 || $aduan->id_role === 4)
  <span class="badge rounded-pill bg-warning">Menunggu respon Kepala Bidang terkait</span>
  @else
  <span class="badge rounded-pill bg-success">Selesai</span>
@endif
