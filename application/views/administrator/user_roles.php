<!-- additional css -->
<style>
    #toolbar {
        margin: 0;
    }
</style>
<!-- modal dimulai -->
<div class="modal fade" data-backdrop="static" data-keyboard="false" id="newRole" tabindex="-1" aria-labelledby="newRoleLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title text-white" id="newRoleLabel">Add User Role</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="FormRole">
                    <div class="form-group">
                        <label for="formGroupExampleInput">Nama Role</label>
                        <input type="text" class="form-control" name="nrole" id="nrole" placeholder="Isi nama role">
                    </div>
                    <div class="form-group">
                        <label for="formGroupExampleInput">Keterangan</label>
                        <input type="text" class="form-control" name="nketerangan" id="nketerangan" placeholder="Isi Keterangan">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                <button type="button" class="btn btn-primary sippan">Simpan</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" data-backdrop="static" data-keyboard="false" id="editRole" tabindex="-1" aria-labelledby="editRoleLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title text-white" id="editRoleLabel">Edit User Role</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="FormRoleEdit">
                    <div class="form-group">
                        <label for="xrole">Nama Role</label>
                        <input type="hidden" name="xid" id="xid">
                        <input type="text" class="form-control" name="xrole" id="xrole" placeholder="Isi nama role">
                    </div>
                    <div class="form-group">
                        <label for="xrole">Keterangan</label>
                        <input type="hidden" name="id" id="id">
                        <input type="text" class="form-control" name="xketerangan" id="xketerangan" placeholder="Isi keterangan">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                <button type="button" class="btn btn-primary gatti">Ubah</button>
            </div>
        </div>
    </div>
</div>
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h4 class="h4 mb-4 text-gray-800"><?= $title; ?></h4>
    <div class="row">
        <div class="col-lg-8">
            <?= $this->session->flashdata('message'); ?>
            <div class="card">
                <h5 class="card-title card-header">Management Roles Of User</h5>
                <div class="card-body">
                    <div id="toolbar">
                        <button class="btn btn-secondary tambah" data-toggle="tooltip" rel="tooltip" title="Tambah Roles"><i class="fas fa-fw fa-plus"></i> Role</button>
                    </div>
                    <table id="tb_role" class="table table-hover" data-show-toggle="true" data-show-pagination-switch="true" data-show-columns="true" data-mobile-responsive="true" data-check-on-init="true" data-advanced-search="true" data-id-table="advancedTable" data-show-columns-toggle-all="true"></table>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /.container-fluid -->
</div>
<!-- End of Main Content -->
<script>
    $(document).ready(() => {
        $(function() {
            $('[data-toggle="tooltip"]').tooltip()
            $('[rel="tooltip"]').tooltip()
        });

        $(".tambah").click(function() {
            $("#newRole").modal('show');
            $(".sippan").click(() => {
                var form = $("#FormRole").serializeArray();
                var role = $("#nrole").val();
                var ket = $("#nketerangan").val();
                if (role == '' || ket == '') {
                    swal.fire(
                        'Galat',
                        'Wajib isi field nama Role',
                        'warning'
                    )
                } else {
                    swal.fire({
                        title: "Simpan Role ?",
                        imageUrl: '<?= base_url('assets/img/icon') ?>/question.svg',
                        imageHeight: 200,
                        showCancelButton: true,
                        confirmButtonText: 'Simpan',
                        cancelButtonText: 'Batal'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $.ajax({
                                url: '<?= base_url("administrator/simpanRole"); ?>',
                                method: 'POST',
                                data: form,
                                success: function() {
                                    document.location.href = "<?= base_url('administrator/userRole'); ?>";
                                },
                                error: function() {
                                    alert('Error tidak terdefenisi');
                                }
                            });
                        } else if (result.dismiss === Swal.DismissReason.cancel) {
                            document.getElementById("FormRole").reset();
                        }
                    })
                }
            });
        });
    });
    $(document).ready(() => {
        $table = $("#tb_role")
        $table.bootstrapTable({
            url: '<?= base_url('administrator/getRoles') ?>',
            toolbar: '#toolbar',
            pagination: true,
            search: false,
            columns: [{
                field: 'no',
                title: '#'
            }, {
                field: 'role',
                title: 'Nama Role',
                sortable: 'true'
            }, {
                field: 'ket',
                title: 'Ketarangan'
            }, {
                field: 'id',
                title: 'Act',
                align: 'center',
                formatter: tombol
            }]
        });

        function tombol(value, row) {
            return [
                '<button class="btn btn-sm btn-primary access" id-role ="' + value + '" rel="tooltip" title="Edit access role"><i class="fas fa-fw fa-link"></i></button> ' +
                '<button class="btn btn-sm btn-info edit" id-role ="' + value + '" data-nama ="' + row.role + '" data-ket="' + row.ket + '" rel="tooltip" title="Edit Role"><i class="fas fa-fw fa-edit"></i></button>'
            ]
        }
        $('body').on('click', '#tb_role .access', function() { //set access dari role 
            var id = $(this).attr('id-role');
            window.location.href = "<?= base_url('administrator/setAccess/'); ?>" + id
        });

        $('body').on('click', '#tb_role .edit', function() { // edit nama role
            var id = $(this).attr('id-role');
            var nama_role = $(this).data('nama');
            var keter = $(this).data('ket');

            $("#editRole").modal('show');
            $("#xid").val(id);
            $("#xrole").val(nama_role);
            $("#xketerangan").val(keter);

            $(".gatti").click(function() {
                var forms = $("#FormRoleEdit").serializeArray();
                var rolex = $("#xrole").val();
                var ketx = $("#xketerangan").val();
                if(rolex == '' || ketx == ''){
                    swal.fire(
                        'Galat',
                        'Form Belum Lengkap',
                        'warning'
                    )
                } else {
                    $.ajax({
                        url: "<?= base_url('administrator/editRole') ?>",
                        method: 'POST',
                        data: forms,
                        success: function() {
                            swal.fire({
                                title: 'Berhasil Update',
                                text: 'Role Telah berhasil diubah',
                                showCancelButton: false,
                                confirmButtonText: 'Ok!, Terimakasih'
                            }).then((reslt) => {
                                if(reslt.isConfirmed){
                                    document.location.href = "<?= base_url('administrator/userRole'); ?>";
                                }
                            });
                        }
                    });
                }
            });
        });
    });
</script>