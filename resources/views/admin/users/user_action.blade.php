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
            <form method="post" action="{{ route('users.destroy', $id->id) }}" onsubmit="return confirm('Anda yakin ingin menghapusnya ?');">
                @csrf
                @method('DELETE')
                <button class="btn btn-danger _delete_data" type="submit">
                    <i class="tf-icons mdi mdi-delete"></i>
                </button>
            </form>
        </div>
    </div>
</div>
