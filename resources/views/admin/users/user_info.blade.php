{{-- <div class="user-info">
    <img src="{{ $user->profile_photo_path }}" alt="Foto" />
    <span>{{ $user->name }}</span>
</div> --}}
<div class="d-flex justify-content-start align-items-center user-info">
    <div class="avatar-wrapper">
        <div class="avatar avatar-sm me-3">
            @if ($user->profile_photo_path)
              <img src="{{ $user->profile_photo_path }}" alt="Avatar" class="rounded-circle">
            @else
              <span class="avatar-initial rounded-circle bg-label-success"></span>
            @endif
        </div>
    </div>
    <div class="d-flex flex-column">
        <a href="userView" class="text-heading text-truncate">
          <span class="fw-semibold"> {{ $user->name }}</span>
        </a>
        <small class="text-muted">
            {{ $user->email }}
        </small>
    </div>
</div>
