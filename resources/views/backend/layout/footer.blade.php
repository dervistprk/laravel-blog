</div>
</div>
<footer class="sticky-footer bg-white">
    <div class="container my-auto">
        <div class="copyright text-center my-auto">
            <span>Copyright &copy; Blogger Admin Paneli {{date('Y')}}</span>
        </div>
    </div>
</footer>
</div>
</div>
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Çıkış Yapmak İstediğinize Emin misiniz?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">Çıkış yapmak için <b>Çıkış Yap</b> butonuna tıklayınız.</div>
            <div class="modal-footer">
                <button class="btn btn-primary" type="button" data-dismiss="modal">İptal</button>
                <a class="btn btn-danger" href="{{route('admin.logout')}}">Çıkış Yap</a>
            </div>
        </div>
    </div>
</div>
<script src="{{ URL::asset('back/vendor/jquery/jquery.min.js') }}"></script>
<script src="{{ URL::asset('back/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ URL::asset('back/vendor/jquery-easing/jquery.easing.min.js') }}"></script>
<script src="{{ URL::asset('back/js/sb-admin-2.min.js') }}"></script>
<script src="{{ URL::asset('back/vendor/chart.js/Chart.min.js') }}"></script>
<script src="{{ URL::asset('back/js/demo/chart-area-demo.js') }}"></script>
<script src="{{ URL::asset('back/js/demo/chart-pie-demo.js') }}"></script>
<script src="{{ URL::asset('back/vendor/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ URL::asset('back/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ URL::asset('back/js/demo/datatables-demo.js') }}"></script>
@yield('custom-js')
@toastr_js
@toastr_render
</body>
</html>
