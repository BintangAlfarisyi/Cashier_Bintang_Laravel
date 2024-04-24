<!-- Profile Edit Form -->
<form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="row mb-3">
        <label for="profileImage" class="col-md-4 col-lg-3 col-form-label">Profile Image</label>
        <div class="col-md-8 col-lg-9">
            <img src="assets/img/profile-img.jpg" alt="Profile">
            <div class="pt-2">
                <a href="#" class="btn btn-primary btn-sm" title="Upload new profile image"><i class="bi bi-upload"></i></a>
                <a href="#" class="btn btn-danger btn-sm" title="Remove my profile image"><i class="bi bi-trash"></i></a>
            </div>
        </div>
    </div>

    <div class="row mb-3">
        <label for="name" class="col-md-4 col-lg-3 col-form-label">Nama</label>
        <div class="col-md-8 col-lg-9">
            <input name="name" type="text" class="form-control" id="name" value="{{ Auth::user()->name }}">
        </div>
    </div>

    @if(Auth::check())
    <div class="row mb-3">
        <label for="level" class="col-md-4 col-lg-3 col-form-label">Role</label>
        <div class="col-md-8 col-lg-9">
            <select name="level" class="form-control" id="level" readonly>
                <option value="1" {{ Auth::user()->level == 1 ? 'selected' : '' }}>Admin</option>
                <option value="2" {{ Auth::user()->level == 2 ? 'selected' : '' }}>Kasir</option>
            </select>
        </div>
    </div>
    @endif

    <div class="row mb-3">
        <label for="alamat" class="col-md-4 col-lg-3 col-form-label">Alamat</label>
        <div class="col-md-8 col-lg-9">
            <input name="alamat" type="text" class="form-control" id="alamat" value="{{ Auth::user()->alamat }}">
        </div>
    </div>

    <div class="row mb-3">
        <label for="ponsel" class="col-md-4 col-lg-3 col-form-label">Ponsel</label>
        <div class="col-md-8 col-lg-9">
            <input name="ponsel" type="text" class="form-control" id="ponsel" value="{{ Auth::user()->ponsel }}">
        </div>
    </div>

    <div class="row mb-3">
        <label for="Email" class="col-md-4 col-lg-3 col-form-label">Email</label>
        <div class="col-md-8 col-lg-9">
        <input name="email" type="email" class="form-control" id="Email" value="{{ Auth::user()->email }}">
        </div>
    </div>

    <div class="text-center">
        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
    </div>
</form><!-- End Profile Edit Form -->