@livewireScripts
<!-- jQuery -->
<script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
<!-- jQuery UI 1.11.4 -->
<script src="{{ asset('plugins/jquery-ui/jquery-ui.min.js') }}"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
    $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- ChartJS -->
<script src="{{ asset('plugins/chart.js/Chart.min.js') }}"></script>
<!-- Sparkline -->
<script src="{{ asset('plugins/sparklines/sparkline.js') }}"></script>
<!-- JQVMap -->
<script src="{{ asset('plugins/jqvmap/jquery.vmap.min.js') }}"></script>
<script src="{{ asset('plugins/jqvmap/maps/jquery.vmap.usa.js') }}"></script>
<!-- jQuery Knob Chart -->
<script src="{{ asset('plugins/jquery-knob/jquery.knob.min.js') }}"></script>
<!-- daterangepicker -->
<script src="{{ asset('plugins/moment/moment.min.js') }}"></script>
<script src="{{ asset('plugins/daterangepicker/daterangepicker.js') }}"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="{{ asset('plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>
<!-- Summernote -->
<script src="{{ asset('plugins/summernote/summernote-bs4.min.js') }}"></script>
<!-- overlayScrollbars -->
<script src="{{ asset('plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('dist/js/adminlte.js') }}"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="{{ asset('dist/js/pages/dashboard.js') }}"></script>
{{-- combo box select 2 --}}
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="{{ asset('plugins/sweetalert2/sweetalert2.min.js') }}"></script>
<script src="{{ asset('plugins/sweetalert2/sweetalert2.all.min.js') }}"></script>
<script>
    var Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000
    });
    @if (session('insertsuccess'))
        Toast.fire({
            icon: 'success',
            title: "{{ session('insertsuccess') }}"
        })
    @endif
    @if (session('success'))
        Toast.fire({
            icon: 'success',
            title: "{{ session('success') }}"
        })
    @endif
    @if (session('gagal'))
        Toast.fire({
            icon: 'error',
            title: "{{ session('gagal') }}"
        })
    @endif

    $(document).ready(function() {
        $('.select2').select2();
    });





    // Mendapatkan elemen input
    var inputUang = document.getElementById('uang');

    // Menambahkan event listener untuk event input
    inputUang.addEventListener('input', function() {
        if (inputUang.value === '') {
            // Jika kosong, atur nilai default ke '0'
            inputUang.value = '0';
        } else if (inputUang.value.startsWith('0') && inputUang.value !== '0') {
            // Menghapus '0' di depan jika ada
            inputUang.value = inputUang.value.replace(/^0+/, '');
        }
    });

    // Mencegah input dari peristiwa keydown yang akan menghapus nilai
    inputUang.addEventListener('keydown', function(event) {
        if (event.key === 'Backspace' && inputUang.value === '0') {
            event.preventDefault();
        }
    });
</script>
</body>

</html>
