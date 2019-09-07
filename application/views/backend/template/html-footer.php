</div>

<script src="<?= base_url("assets/backend/components/bootstrap/dist/js/bootstrap.min.js") ?>"></script>
<script src="<?= base_url("assets/backend/components/select2/dist/js/select2.full.min.js") ?>"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.11/jquery.mask.min.js"></script>
<script src="<?= base_url("assets/backend/components/input-mask/jquery.inputmask.js") ?>"></script>
<script src="<?= base_url("assets/backend/components/input-mask/jquery.inputmask.date.extensions.js") ?>"></script>
<script src="<?= base_url("assets/backend/components/input-mask/jquery.inputmask.extensions.js") ?>"></script>
<script src="<?= base_url("assets/backend/components/datatables.net/js/jquery.dataTables.min.js") ?>"></script>
<script src="<?= base_url("assets/backend/components/datatables.net-bs/js/dataTables.bootstrap.min.js") ?>"></script>
<script src="<?= base_url("assets/backend/components/jquery-slimscroll/jquery.slimscroll.min.js") ?>"></script>
<script src="<?= base_url("assets/backend/components/fastclick/lib/fastclick.js") ?>"></script>
<script src="<?= base_url("assets/backend/components/ckeditor/ckeditor.js") ?>"></script>
<script src="<?= base_url("assets/backend/components/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js") ?>"></script>
<script src="<?= base_url("assets/backend/components/bootstrap-fileupload/bootstrap-fileupload.min.js") ?>"></script>
<script src="<?= base_url("assets/backend/components/dropzone/dropzone.min.js") ?>"></script>
<script src="<?= base_url("assets/backend/components/dropzone/form-dropzone.min.js") ?>"></script>
<script src="<?= base_url("assets/backend/components/remodal/dist/remodal.min.js") ?>"></script>
<script src="<?= base_url("assets/backend/js/adminlte.min.js") ?>"></script>
<script src="<?= base_url("assets/backend/js/demo.js") ?>"></script>
<script>

    function copyToClipboard(id) {
        var $hur = id;
        alert(id.val());
        document.getElementById(id).value.select();
        document.execCommand("copy");
        alert("Link Copiado: " + $(id).val());
    }


    $(function () {
        $('.select2').select2();
        $('#datemask').inputmask('dd/mm/yyyy', {'placeholder': 'dd/mm/yyyy'});
          $("#telefone").mask("(99) 99999-9999");
        $('#datemask2').inputmask('mm/dd/yyyy', {'placeholder': 'mm/dd/yyyy'});
        $('[data-mask]').inputmask();
    });
    $(function () {
        $('#tabelinha').DataTable()
        $('#example2').DataTable({
            'paging': true,
            'lengthChange': false,
            'searching': false,
            'ordering': true,
            'info': true,
            'autoWidth': false
        });
    });
    $(function () {
        // Replace the <textarea id="editor1"> with a CKEditor
        // instance, using default configuration.
        CKEDITOR.replace('editor1')
        //bootstrap WYSIHTML5 - text editor
        $('.textarea').wysihtml5()
    })
</script>
</body>
</html>
