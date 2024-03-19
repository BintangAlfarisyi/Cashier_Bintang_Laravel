@include('auth.header')

    <main>
        <div class="container">

            <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">

                            <div class="d-flex justify-content-center py-4">
                                <a href="index.html" class="logo d-flex align-items-center w-auto">
                                    <img src="{{ asset('assets') }}/CB.png" alt="">
                                    <span class="d-none d-lg-block">Cashier Bintang</span>
                                </a>
                            </div><!-- End Logo -->

                            <div class="card mb-3">

                                <div class="card-body">

                                    <div class="pt-4 pb-2">
                                        <h5 class="card-title text-center pb-0 fs-4">Login</h5>
                                    </div>

                                    @error('nofound')
                                    <div class="row mb-2">
                                        <div class="col-12 text-center text-danger">
                                            {{ $message }}
                                        </div>
                                    </div>
                                    @enderror

                                    <form class="row g-3 needs-validation" action="{{ route('cekLogin') }}" method="post" novalidate>
                                        @csrf
                                        <div class="col-12">
                                            <label for="email" class="form-label">Email</label>
                                            <div class="input-group has-validation">
                                                <span class="input-group-text" id="inputGroupPrepend">@</span>
                                                <input type="email" class="form-control 
                                                @error('email')
                                                    is-invalid
                                                @enderror
                                                " required name="email" id="email" value="{{ old('email') }}" placeholder="Masukan Email Anda">
                                                <div class="invalid-feedback">
                                                    Email harus diisi.
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <label for="password" class="form-label">Kata Sandi</label>
                                            <input type="password" name="password" class="form-control 
                                            @error('password')
                                            is-invalid
                                            @enderror " id="password" required value="{{ old('password') }}" placeholder="Masukan Kata Sandi Anda">
                                            <div class="invalid-feedback">
                                                Kata Sandi harus diisi!
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="remember" value="true" id="rememberMe">
                                                <label class="form-check-label" for="rememberMe">Remember me</label>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <button class="btn btn-primary w-100" type="submit">Login</button>
                                        </div>
                                        <div class="col-12">
                                            <p class="small mb-0">Tidak mempunyai Akun? <a href="{{ route('registrasi') }}">Buat Akun Baru</a></p>
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

            </section>

        </div>
    </main><!-- End #main -->

    @include('auth.footer')