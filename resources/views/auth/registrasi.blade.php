    @include('auth.header')

    <main>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">

                    <div class="d-flex justify-content-center py-4">
                        <a href="{{ url('/') }}" class="logo d-flex align-items-center w-auto">
                            <img src="{{ asset('assets') }}/CB.png" alt="">
                            <span class="d-none d-lg-block">Cashier Bintang</span>
                        </a>
                    </div><!-- End Logo -->

                    <div class="card mb-3">

                        <div class="card-body">

                            <div class="pt-4 pb-2">
                                <h5 class="card-title text-center pb-0 fs-4">Buat Akun</h5>
                            </div>

                            <form class="row g-3 needs-validation" method="POST" action="{{ route('registrasi') }}" novalidate>
                                @csrf
                                <div class="col-12">
                                    <label for="name" class="form-label">Nama</label>
                                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="name" value="{{ old('name') }}" required placeholder="Masukan Nama Anda">
                                    @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-12">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" id="email" value="{{ old('email') }}" required placeholder="Masukan Email Anda">
                                    @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-12">
                                    <label for="password" class="form-label">Kata Sandi</label>
                                    <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" id="password" required placeholder="Masukan Kata Sandi Anda">
                                    @error('password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-12">
                                    <label for="alamat" class="form-label">Alamat</label>
                                    <input type="alamat" name="alamat" class="form-control @error('alamat') is-invalid @enderror" id="alamat" required placeholder="Masukan Alamat Anda">
                                    @error('alamat')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-12">
                                    <label for="ponsel" class="form-label">Ponsel</label>
                                    <input type="ponsel" name="ponsel" class="form-control @error('ponsel') is-invalid @enderror" id="ponsel" required placeholder="Masukan Ponsel Anda">
                                    @error('ponsel')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-12">
                                    <label for="level" class="form-label">Jenis</label>
                                    <div class="input-group">
                                        <select class="form-select" id="level" name="level">
                                            <option selected disabled>Pilih Role</option>
                                            <option value="1">Admin</option>
                                            <option value="2">Kasir</option>
                                        </select>
                                        <label class="input-group-text" for="level"><i class="fas fa-caret-down"></i></label>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="form-check">
                                        <input class="form-check-input" name="terms" type="checkbox" value="" id="acceptTerms" required>
                                        <label class="form-check-label" for="acceptTerms">Saya setuju dan menerima <a href="#">Syarat dan Ketentuan</a></label>
                                        <div class="invalid-feedback">Kamu harus menyetujui untuk mendaftar.</div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <button class="btn btn-primary w-100" type="submit">Buat Akun</button>
                                </div>
                                <div class="col-12">
                                    <p class="small mb-0">Sudah mempunyai akun? <a href="{{ route('login') }}">Log in</a></p>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="credits">
                        <!-- All the links in the footer should remain intact. -->
                        <!-- You can delete the links only if you purchased the pro version. -->
                        <!-- Licensing information: https://bootstrapmade.com/license/ -->
                        <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/ -->
                        Designed by <a href="#">Bintang Alfarisyi</a>
                    </div>

                </div>
            </div>
        </div>
    </main><!-- End #main -->

    @include('auth.footer')