<div class="row row-bordered g-0">
    <div class="col-lg-4 p-4">
        <div class="demo-inline-spacing">
            @php
                $id = \App\Models\Aduan::where('aduan', $aduan->aduan)->first();
            @endphp
            <form method="get" action="{{ route('aduan.edit', $id->id) }}">
              @csrf
                <button class="btn btn-warning mr-2" type="submit">
                    <i class="tf-icons mdi mdi-file-edit-outline"></i>
                </button>
            </form>
        </div>
    </div>
</div>
