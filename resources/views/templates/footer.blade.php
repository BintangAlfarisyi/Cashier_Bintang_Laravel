<!-- ======= Footer ======= -->
<footer id="footer" class="footer">
    <div class="copyright">
        &copy; Copyright <strong><span>Bintang Alfarisyi</span></strong>. All Rights Reserved
    </div>
</footer><!-- End Footer -->

<a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

<!-- Vendor JS Files -->
<script src="{{ asset('admin') }}/vendor/apexcharts/apexcharts.min.js"></script>
<script src="{{ asset('admin') }}/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="{{ asset('admin') }}/vendor/chart.js/c hart.umd.js"></script>
<script src="{{ asset('admin') }}/vendor/echarts/echarts.min.js"></script>
<script src="{{ asset('admin') }}/vendor/quill/quill.min.js"></script>
<script src="{{ asset('admin') }}/vendor/simple-datatables/simple-datatables.js"></script>
<script src="{{ asset('admin') }}/vendor/tinymce/tinymce.min.js"></script>
<script src="{{ asset('admin') }}/vendor/php-email-form/validate.js"></script>

<!-- Template Main JS File -->
<script src="{{ asset('admin') }}/js/main.js"></script>

<!-- Bootstrap -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

<!-- Sweetalert -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<!-- dataTable -->
<script src="https://code.jquery.com/jquery-3.7.1.js" type="text/javascript"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js" type="text/javascript"></script>
<script src="https://cdn.datatables.net/2.0.2/js/dataTables.js" type="text/javascript"></script>
<script src="https://cdn.datatables.net/2.0.2/js/dataTables.bootstrap5.js" type="text/javascript"></script>

<!-- JQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    new DataTable('#myTable');

    document.getElementById('logout-link').addEventListener('click', function(event) {
        event.preventDefault();

        Swal.fire({
            icon: 'error',
            title: 'Konfirmasi Logout',
            text: 'Apakah kamu yakin akan keluar?',
            showDenyButton: true,
            confirmButtonText: 'Ya',
            denyButtonText: 'Tidak',
        }).then((result) => {
            if (result.isConfirmed)
                window.location.href = "/logout"
            else swal.close()
        })
    });
</script>

@stack('script')
</body>

</html>