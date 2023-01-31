<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h4 class="h4 mb-4 text-gray-800"><?= $title; ?></h4>
    <div class="card mb-3">
        <h5 class="card-header card-title">List non-active users</h5>
        <div class="card-body">
            <div class="row no-gutters">
                <div class="col-md-12">
                    <table class="table table-striped" id="tb_user" data-show-toggle="true" data-show-refresh="true" data-show-pagination-switch="true" data-show-columns="true" data-mobile-responsive="true" data-check-on-init="true" data-advanced-search="true" data-id-table="advancedTable" data-show-print="true" data-show-columns-toggle-all="true"></table>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /.container-fluid -->
</div>
<!-- End of Main Content -->
<script>
    $(document).ready(function() {
        $table = $("#tb_user")
        $table.bootstrapTable({
            url: '<?= base_url("user/usernonActive") ?>',
            search: true,
            pagination: true,
            toolbar: '#toolbar',
            columns: [{
                field: 'no',
                title: '#'
            }, {
                field: 'nama',
                title: 'User Name',
                sortable: 'true'
            }, {
                field: 'email',
                title: 'E-mail'
            }, {
                field: 'nohp',
                title: 'No. HP',
                align: 'center'
            }, {
                field: 'role_name',
                title: 'Role',
                sortable: 'true'
            }, {
                field: 'tgl_registrasi',
                title: 'Date Created',
                sortable: 'true'
            }, {
                field: 'id',
                title: 'Act',
                align: 'center',
                formatter: butong
            }]
        });

        function butong(value, row) {
            var ids = value.split("|")[0];
            var roleId = value.split("|")[1];
            return [
                '<button data-id="' + ids + '" data-nama="' + row.nama + '" class="btn btn-sm btn-info aktifkan" rel="tooltip" title="aktifkan data user"><i class="fas fa-fw fa-user-check"></i></button>'
            ]
        }

        $('body').on('click', '#tb_user .aktifkan', function() {
            var nama = $(this).data('nama');
            var id = $(this).data('id');
            var act = '1';

            swal.fire({
                title: 'Aktifkan User ?',
                text: nama + ' Akan dapat login lagi setelah diaktifkan',
                imageUrl: '<?= base_url("assets/img/icon/"); ?>question.svg',
                imageHeight: 150,
                showCancelButton: true,
                confirmButtonText: 'Aktifkan',
                cancelButtonText: 'Batal',
                confirmButtonColor: '#66CDAA',
                cancelButtonColor: '#DC143C',
                allowOutsideClick: false
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "<?= base_url('user/actUser') ?>",
                        method: 'post',
                        data: {
                            id: id,
                            act: act
                        },
                        success: function() {
                            swal.fire({
                                title: 'Berhasil',
                                text: nama + ' sudah diaktifkan',
                                imageUrl: "<?= base_url('assets/img/icon/'); ?>completed.svg",
                                imageHeight: 150,
                                showCancelButton: false
                            }).then((res) => {
                                if (res.isConfirmed) {
                                    document.location.href = "<?= base_url('user/activeUser'); ?>"
                                }
                            });
                        }
                    });
                }
            });
        });
    });
</script>