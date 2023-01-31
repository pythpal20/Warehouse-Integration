<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h4 class="h4 mb-1 text-gray-800"><?= $title; ?></h4>
    <hr class="sidebar-divider">
    <div class="row">
        <div class="col-lg-12 mb-2">
            <button class="btn btn-sm btn-primary addmanual" data-toggle="tooltip" title="Tambah Manual PO XB"><span class="fa fa-plus-circle"></span> Add PO Manual</button>
            <button class="btn btn-sm btn-rounded btn-success export float-right"><span class="fas fa-fw fa-file-export"></span> Export Data</button>
        </div>
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item" style="background-color: #FFEFD5">
                            <a class="nav-link active" id="mwk-tab" data-toggle="tab" href="#mwk" role="tab" aria-controls="mwk" aria-selected="true">Mutli Wahana Kencana</a>
                        </li>
                        <li class="nav-item" style="background-color: #E6E6FA">
                            <a class="nav-link" id="mwm-tab" data-toggle="tab" href="#mwm" role="tab" aria-controls="mwm" aria-selected="false">Multi Wahana Makmur</a>
                        </li>
                        <li class="nav-item" style="background-color: #E0FFFF;">
                            <a class="nav-link" id="bak-tab" data-toggle="tab" href="#bak" role="tab" aria-controls="bak" aria-selected="false">Batavia Adimarga Kencana</a>
                        </li>
                        <li class="nav-item" style="background-color: #FFE4E1;">
                            <a class="nav-link" id="fci-tab" data-toggle="tab" href="#fci" role="tab" aria-controls="fci" aria-selected="false">Food Container Indonesia</a>
                        </li>
                        <li class="nav-item bg-gray-500">
                            <a class="nav-link" id="dtm-tab" data-toggle="tab" href="#dtm" role="tab" aria-controls="dtm" aria-selected="false">Dewata Titian Mas</a>
                        </li>
                    </ul>
                </div>
                <div class="card-body">
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="mwk" role="tabpanel" aria-labelledby="mwk-tab">
                            <table class="table-bordered table" id="tablemwk" data-toggle="tablemwk" data-show-toggle="true" data-show-refresh="true" data-show-pagination-switch="true" data-show-columns="true" data-mobile-responsive="true" data-check-on-init="true" data-advanced-search="true" data-id-table="advancedTable" data-show-print="true" data-show-columns-toggle-all="true"></table>
                        </div>
                        <div class="tab-pane fade" id="mwm" role="tabpanel" aria-labelledby="mwm-tab">
                            <table class="table-bordered table" id="tablemwm" data-toggle="tablemwm" data-show-toggle="true" data-show-refresh="true" data-show-pagination-switch="true" data-show-columns="true" data-mobile-responsive="true" data-check-on-init="true" data-advanced-search="true" data-id-table="advancedTable" data-show-print="true" data-show-columns-toggle-all="true"></table>
                        </div>
                        <div class="tab-pane fade" id="bak" role="tabpanel" aria-labelledby="bak-tab">
                            <table class="table-bordered table" id="tablebak" data-toggle="tablebak" data-show-toggle="true" data-show-refresh="true" data-show-pagination-switch="true" data-show-columns="true" data-mobile-responsive="true" data-check-on-init="true" data-advanced-search="true" data-id-table="advancedTable" data-show-print="true" data-show-columns-toggle-all="true"></table>
                        </div>
                        <div class="tab-pane fade" id="fci" role="tabpanel" aria-labelledby="fci-tab">
                            <table class="table-bordered table" id="tablefci" data-toggle="tablefci" data-show-toggle="true" data-show-refresh="true" data-show-pagination-switch="true" data-show-columns="true" data-mobile-responsive="true" data-check-on-init="true" data-advanced-search="true" data-id-table="advancedTable" data-show-print="true" data-show-columns-toggle-all="true"></table>
                        </div>
                        <div class="tab-pane fade" id="dtm" role="tabpanel" aria-labelledby="dtm-tab">
                            <table class="table-bordered table" id="tabledtm" data-toggle="tabledtm" data-show-toggle="true" data-show-refresh="true" data-show-pagination-switch="true" data-show-columns="true" data-mobile-responsive="true" data-check-on-init="true" data-advanced-search="true" data-id-table="advancedTable" data-show-print="true" data-show-columns-toggle-all="true"></table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /.container-fluid -->
</div>
<!-- End of Main Content -->
<!-- start modal -->
<div class="modal fade" id="exportModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Export Data PO hari ini</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="<?= base_url('adminpo/exportpoxb'); ?>">
                    <div class="form-group">
                        <label for="namapt">Nama Perusahaan</label>
                        <select name="namapt" id="namapt" class="js-example-responsive form-control namapt" style="width: 100%" required>
                            <option value="">~ Pilih PT ~</option>
                            <?php foreach ($pt as $p) : ?>
                                <option value="<?= $p['id_perusahaan']; ?>"><?= $p['atasnama']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label for="tgl">Tanggal</label>
                            <input type="date" class="form-control" id="tgls" name="tgls" required>
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary">Download</button></form>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<!-- modal detail po - pop up -->
<div class="modal fade" id="modalDetail" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Detail PO</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body detailx">
            </div>
            <div class="modal-footer">
                <?php if(($user['role_id'] == 7) OR ($user['role_id'] == 1)) : ?>
                <button class="btn btn-primary download"><i class="fas fa-fw fa-download"></i> Download PDF</button>
                <?php endif; ?>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<!-- Javascript -->
<script>
    $(document).ready(function() {
        $(function() {
            $('[data-toggle="tooltip"]').tooltip()
        });

        $(".addmanual").click(function() {
            window.location.href="<?= base_url('adminpo/manualPo') ?>";
        })
    });
</script>
<script>
    // tbmwk
    $(document).ready(function() {
        var lvl = "<?= $user['role_id']; ?>";
        $table = $("#tablemwk")
        $table.bootstrapTable({
            url: "<?= base_url('adminpo/getPO/1'); ?>",
            search: true,
            pagination: true,
            columns: [{
                field: 'id_po',
                title: 'ID',
                sortable: 'true'
            }, {
                field: 'tglpo',
                title: 'Tgl. PO',
                sortable: 'true'
            }, {
                field: 'tglkirim',
                title: 'Plan Kirim',
                sortable: 'true'
            }, {
                field: 'note',
                title: 'Note',
                sortable: 'true'
            }, {
                field: 'qty',
                title: 'Total QTY',
                sortable: 'true'
            }, {
                field: 'status',
                title: 'Status',
                sortable: 'true',
                formatter: sts
            }, {
                field: 'xab',
                title: 'Action',
                formatter: tombol,
                align: 'center'
            }]

        });

        function sts(value, row) {
            if (value == '0') {
                return [
                    'On Progress'
                ]
            } else if (value == '1') {
                return [
                    'Half Complete'
                ]
            } else {
                return [
                    'Complete'
                ]
            }
        }

        function tombol(value, row, index) {
            if (lvl == '7' || lvl == '1') {
                if (row.status == '0' || row.status == '1') {
                    return [
                        '<button class="btn btn-sm btn-warning lihat" data-code="' + row.id_po + '" rel="tooltip" title="Lihat detail"><span class="fas fa-fw fa-eye"></span></button> ' +
                        '<button class="btn btn-sm btn-info edit" data-code="' + row.id_po + '" rel="tooltip" title="Edit PO"><span class="fas fa-fw fa-edit"></span></button> '+
                        '<button class="btn btn-sm btn-primary refresh" data-code="' + row.id_po + '" rel="tooltip" title="Refresh Status"><span class="fas fa-fw fa-refresh"></span></button>'
                    ]
                } else {
                    return [
                        '<button class="btn btn-sm btn-warning lihat" data-code="' + row.id_po + '" rel="tooltip" title="Lihat detail"><span class="fas fa-fw fa-eye"></span></button> ' +
                        '<button class="btn btn-sm btn-info edit" rel="tooltip" title="Edit PO" disabled><span class="fas fa-fw fa-edit"></span></button>'
                    ]
                }
            } else {
                return [
                    '<button class="btn btn-sm btn-warning lihat" data-code="' + row.id_po + '" rel="tooltip" title="Lihat detail"><span class="fas fa-fw fa-eye"></span></button> ' +
                    '<button class="btn btn-sm btn-info edit" rel="tooltip" title="Edit PO" disabled><span class="fas fa-fw fa-edit"></span></button>'
                ]
            }
        }

        $('body').on('click', '#tablemwk .lihat', function() {
            var idpo = $(this).data('code');
            $.ajax({
                url: "<?= base_url('adminpo/detailpoxb'); ?>",
                method: 'post',
                data: {
                    id: idpo
                },
                success: function(data) {
                    console.log(data);
                    $("#modalDetail").modal('show');
                    $(".detailx").html(data);
                    $(".tbl_detal").bootstrapTable({
                        search: true,
                        pagination: true
                    });

                    $(".download").click(function() {
                        window.open("<?= base_url('adminpo/printpdf/'); ?>" + idpo);
                    });
                }
            });
        });
        $('body').on('click', '#tablemwk .edit', function() {
            var idpo = $(this).data('code');
            window.location.href = "<?= base_url('adminpo/editpoxb/') ?>" + idpo;
        });

        $('body').on('click', '#tablemwk .refresh', function() {
            var idpo = $(this).data('code');
            $.ajax({
                url:"<?= base_url('adminpo/refreshtable'); ?>",
                method: 'POST',
                data: {
                    id: idpo
                },
                success: function(data) {
                    console.log(data);
                    swal.fire({
                        title: 'Refresh Berhasil',
                        text: 'Tekan OK untuk kembali',
                        icon: 'success',
                        allowOutsideClick: false
                    }).then((rels)=> {
                        if(rels.isConfirmed) {
                            window.location.reload();
                        }
                    });
                }
            });
        });
    });
    // tablemwm
    $(document).ready(function() {
        var lvl = "<?= $user['role_id']; ?>";
        $table = $("#tablemwm")
        $table.bootstrapTable({
            url: "<?= base_url('adminpo/getPO/2'); ?>",
            search: true,
            pagination: true,
            columns: [{
                field: 'id_po',
                title: 'ID',
                sortable: 'true'
            }, {
                field: 'tglpo',
                title: 'Tgl. PO',
                sortable: 'true'
            }, {
                field: 'tglkirim',
                title: 'Plan Kirim',
                sortable: 'true'
            }, {
                field: 'note',
                title: 'Note',
                sortable: 'true'
            }, {
                field: 'qty',
                title: 'Total QTY'
            }, {
                field: 'status',
                title: 'Status',
                sortable: 'true',
                formatter: sts
            }, {
                field: 'xab',
                title: 'Action',
                formatter: tombol,
                align: 'center'
            }]

        });

        function sts(value, row) {
            if (value == '0') {
                return [
                    'On Progress'
                ]
            } else if (value == '1') {
                return [
                    'Half Complete'
                ]
            } else {
                return [
                    'Complete'
                ]
            }
        }

        function tombol(value, row, index) {
            if (lvl == '7' || lvl == '1') {
                if (row.status == '0' || row.status == '1') {
                    return [
                        '<button class="btn btn-sm btn-warning lihat" data-code="' + row.id_po + '" rel="tooltip" title="Lihat detail"><span class="fas fa-fw fa-eye"></span></button> ' +
                        '<button class="btn btn-sm btn-info edit" data-code="' + row.id_po + '" rel="tooltip" title="Edit PO"><span class="fas fa-fw fa-edit"></span></button> '+
                        '<button class="btn btn-sm btn-primary refresh" data-code="' + row.id_po + '" rel="tooltip" title="Refresh Status"><span class="fas fa-fw fa-refresh"></span></button>'
                    ]
                } else {
                    return [
                        '<button class="btn btn-sm btn-warning lihat" data-code="' + row.id_po + '" rel="tooltip" title="Lihat detail"><span class="fas fa-fw fa-eye"></span></button> ' +
                        '<button class="btn btn-sm btn-info edit" rel="tooltip" title="Edit PO" disabled><span class="fas fa-fw fa-edit"></span></button>'
                    ]
                }
            } else {
                return [
                    '<button class="btn btn-sm btn-warning lihat" data-code="' + row.id_po + '" rel="tooltip" title="Lihat detail"><span class="fas fa-fw fa-eye"></span></button> ' +
                    '<button class="btn btn-sm btn-info edit" rel="tooltip" title="Edit PO" disabled><span class="fas fa-fw fa-edit"></span></button>'
                ]
            }
        }

        $('body').on('click', '#tablemwm .lihat', function() {
            var idpo = $(this).data('code');
            $.ajax({
                url: "<?= base_url('adminpo/detailpoxb'); ?>",
                method: 'post',
                data: {
                    id: idpo
                },
                success: function(data) {
                    console.log(data);
                    $("#modalDetail").modal('show');
                    $(".detailx").html(data);
                    $(".tbl_detal").bootstrapTable({
                        search: true,
                        pagination: true
                    });

                    $(".download").click(function() {
                        window.open("<?= base_url('adminpo/printpdf/'); ?>" + idpo);
                    });
                }
            });
        });

        $('body').on('click', '#tablemwm .edit', function() {
            var idpo = $(this).data('code');
            window.location.href = "<?= base_url('adminpo/editpoxb/') ?>" + idpo;
        });
        $('body').on('click', '#tablemwm .refresh', function() {
            var idpo = $(this).data('code');
            $.ajax({
                url:"<?= base_url('adminpo/refreshtable'); ?>",
                method: 'POST',
                data: {
                    id: idpo
                },
                success: function(data) {
                    console.log(data);
                    swal.fire({
                        title: 'Refresh Berhasil',
                        text: 'Tekan OK untuk kembali',
                        icon: 'success',
                        allowOutsideClick: false
                    }).then((rels)=> {
                        if(rels.isConfirmed) {
                            window.location.reload();
                        }
                    });
                }
            });
        });
    });
    // bak
    $(document).ready(function() {
        var lvl = "<?= $user['role_id']; ?>";
        $table = $("#tablebak")
        $table.bootstrapTable({
            url: "<?= base_url('adminpo/getPO/3'); ?>",
            search: true,
            pagination: true,
            columns: [{
                field: 'id_po',
                title: 'ID',
                sortable: 'true'
            }, {
                field: 'tglpo',
                title: 'Tgl. PO',
                sortable: 'true'
            }, {
                field: 'tglkirim',
                title: 'Plan Kirim',
                sortable: 'true'
            }, {
                field: 'note',
                title: 'Note',
                sortable: 'true'
            }, {
                field: 'qty',
                title: 'Total QTY'
            }, {
                field: 'status',
                title: 'Status',
                sortable: 'true',
                formatter: sts
            }, {
                field: 'xab',
                title: 'Action',
                formatter: tombol,
                align: 'center'
            }]

        });

        function sts(value, row) {
            if (value == '0') {
                return [
                    'On Progress'
                ]
            } else if (value == '1') {
                return [
                    'Half Complete'
                ]
            } else {
                return [
                    'Complete'
                ]
            }
        }

        function tombol(value, row, index) {
            if (lvl == '7' || lvl == '1') {
                if (row.status == '0' || row.status == '1') {
                    return [
                        '<button class="btn btn-sm btn-warning lihat" data-code="' + row.id_po + '" rel="tooltip" title="Lihat detail"><span class="fas fa-fw fa-eye"></span></button> ' +
                        '<button class="btn btn-sm btn-info edit" data-code="' + row.id_po + '" rel="tooltip" title="Edit PO"><span class="fas fa-fw fa-edit"></span></button> '+
                        '<button class="btn btn-sm btn-primary refresh" data-code="' + row.id_po + '" rel="tooltip" title="Refresh Status"><span class="fas fa-fw fa-refresh"></span></button>'
                    ]
                } else {
                    return [
                        '<button class="btn btn-sm btn-warning lihat" data-code="' + row.id_po + '" rel="tooltip" title="Lihat detail"><span class="fas fa-fw fa-eye"></span></button> ' +
                        '<button class="btn btn-sm btn-info edit" rel="tooltip" title="Edit PO" disabled><span class="fas fa-fw fa-edit"></span></button>'
                    ]
                }
            } else {
                return [
                    '<button class="btn btn-sm btn-warning lihat" data-code="' + row.id_po + '" rel="tooltip" title="Lihat detail"><span class="fas fa-fw fa-eye"></span></button> ' +
                    '<button class="btn btn-sm btn-info edit" rel="tooltip" title="Edit PO" disabled><span class="fas fa-fw fa-edit"></span></button>'
                ]
            }
        }

        $('body').on('click', '#tablebak .lihat', function() {
            var idpo = $(this).data('code');
            $.ajax({
                url: "<?= base_url('adminpo/detailpoxb'); ?>",
                method: 'post',
                data: {
                    id: idpo
                },
                success: function(data) {
                    console.log(data);
                    $("#modalDetail").modal('show');
                    $(".detailx").html(data);
                    $(".tbl_detal").bootstrapTable({
                        search: true,
                        pagination: true
                    });
                    $(".download").click(function() {
                        window.open("<?= base_url('adminpo/printpdf/'); ?>" + idpo);
                    });
                }
            });
        });
        $('body').on('click', '#tablebak .edit', function() {
            var idpo = $(this).data('code');
            window.location.href = "<?= base_url('adminpo/editpoxb/') ?>" + idpo;
        });
        $('body').on('click', '#tablebak .refresh', function() {
            var idpo = $(this).data('code');
            $.ajax({
                url:"<?= base_url('adminpo/refreshtable'); ?>",
                method: 'POST',
                data: {
                    id: idpo
                },
                success: function(data) {
                    console.log(data);
                    swal.fire({
                        title: 'Refresh Berhasil',
                        text: 'Tekan OK untuk kembali',
                        icon: 'success',
                        allowOutsideClick: false
                    }).then((rels)=> {
                        if(rels.isConfirmed) {
                            window.location.reload();
                        }
                    });
                }
            });
        });
    });
    // tablefci
    $(document).ready(function() {
        var lvl = "<?= $user['role_id']; ?>";
        $table = $("#tablefci")
        $table.bootstrapTable({
            url: "<?= base_url('adminpo/getPO/5'); ?>",
            search: true,
            pagination: true,
            columns: [{
                field: 'id_po',
                title: 'ID',
                sortable: 'true'
            }, {
                field: 'tglpo',
                title: 'Tgl. PO',
                sortable: 'true'
            }, {
                field: 'tglkirim',
                title: 'Plan Kirim',
                sortable: 'true'
            }, {
                field: 'note',
                title: 'Note',
                sortable: 'true'
            }, {
                field: 'qty',
                title: 'Total QTY'
            }, {
                field: 'status',
                title: 'Status',
                sortable: 'true',
                formatter: sts
            }, {
                field: 'xab',
                title: 'Action',
                formatter: tombol,
                align: 'center'
            }]

        });

        function sts(value, row) {
            if (value == '0') {
                return [
                    'On Progress'
                ]
            } else if (value == '1') {
                return [
                    'Half Complete'
                ]
            } else {
                return [
                    'Complete'
                ]
            }
        }


        function tombol(value, row, index) {
            if (lvl == '7' || lvl == '1') {
                if (row.status == '0' || row.status == '1') {
                    return [
                        '<button class="btn btn-sm btn-warning lihat" data-code="' + row.id_po + '" rel="tooltip" title="Lihat detail"><span class="fas fa-fw fa-eye"></span></button> ' +
                        '<button class="btn btn-sm btn-info edit" data-code="' + row.id_po + '" rel="tooltip" title="Edit PO"><span class="fas fa-fw fa-edit"></span></button> '+
                        '<button class="btn btn-sm btn-primary refresh" data-code="' + row.id_po + '" rel="tooltip" title="Refresh Status"><span class="fas fa-fw fa-refresh"></span></button>'
                    ]
                } else {
                    return [
                        '<button class="btn btn-sm btn-warning lihat" data-code="' + row.id_po + '" rel="tooltip" title="Lihat detail"><span class="fas fa-fw fa-eye"></span></button> ' +
                        '<button class="btn btn-sm btn-info edit" rel="tooltip" title="Edit PO" disabled><span class="fas fa-fw fa-edit"></span></button>'
                    ]
                }
            } else {
                return [
                    '<button class="btn btn-sm btn-warning lihat" data-code="' + row.id_po + '" rel="tooltip" title="Lihat detail"><span class="fas fa-fw fa-eye"></span></button> ' +
                    '<button class="btn btn-sm btn-info edit" rel="tooltip" title="Edit PO" disabled><span class="fas fa-fw fa-edit"></span></button>'
                ]
            }
        }

        $('body').on('click', '#tablefci .lihat', function() {
            var idpo = $(this).data('code');
            $.ajax({
                url: "<?= base_url('adminpo/detailpoxb'); ?>",
                method: 'post',
                data: {
                    id: idpo
                },
                success: function(data) {
                    console.log(data);
                    $("#modalDetail").modal('show');
                    $(".detailx").html(data);
                    $(".tbl_detal").bootstrapTable({
                        search: true,
                        pagination: true
                    });
                     $(".download").click(function() {
                        window.open("<?= base_url('adminpo/printpdf/'); ?>" + idpo);
                    });
                }
            });
        });
        $('body').on('click', '#tablefci .edit', function() {
            var idpo = $(this).data('code');
            window.location.href = "<?= base_url('adminpo/editpoxb/') ?>" + idpo;
        });
        $('body').on('click', '#tablefci .refresh', function() {
            var idpo = $(this).data('code');
            $.ajax({
                url:"<?= base_url('adminpo/refreshtable'); ?>",
                method: 'POST',
                data: {
                    id: idpo
                },
                success: function(data) {
                    console.log(data);
                    swal.fire({
                        title: 'Refresh Berhasil',
                        text: 'Tekan OK untuk kembali',
                        icon: 'success',
                        allowOutsideClick: false
                    }).then((rels)=> {
                        if(rels.isConfirmed) {
                            window.location.reload();
                        }
                    });
                }
            });
        });
    });
    // dtm
    $(document).ready(function() {
        var lvl = "<?= $user['role_id']; ?>";
        $table = $("#tabledtm")
        $table.bootstrapTable({
            url: "<?= base_url('adminpo/getPO/4'); ?>",
            search: true,
            pagination: true,
            columns: [{
                field: 'id_po',
                title: 'ID',
                sortable: 'true'
            }, {
                field: 'tglpo',
                title: 'Tgl. PO',
                sortable: 'true'
            }, {
                field: 'tglkirim',
                title: 'Plan Kirim',
                sortable: 'true'
            }, {
                field: 'note',
                title: 'Note',
                sortable: 'true'
            }, {
                field: 'qty',
                title: 'Total QTY'
            }, {
                field: 'status',
                title: 'Status',
                sortable: 'true',
                formatter: sts
            }, {
                field: 'xab',
                title: 'Action',
                formatter: tombol,
                align: 'center'
            }]

        });

        function sts(value, row) {
            if (value == '0') {
                return [
                    'On Progress'
                ]
            } else if (value == '1') {
                return [
                    'Half Complete'
                ]
            } else {
                return [
                    'Complete'
                ]
            }
        }

        function tombol(value, row, index) {
            if (row.status == '0' || row.status == '1') {
                return [
                    '<button class="btn btn-sm btn-warning lihat" data-code="' + row.id_po + '" rel="tooltip" title="Lihat detail"><span class="fas fa-fw fa-eye"></span></button> ' +
                    '<button class="btn btn-sm btn-info edit" data-code="' + row.id_po + '" rel="tooltip" title="Edit PO"><span class="fas fa-fw fa-edit"></span></button>'
                ]
            } else {
                return [
                    '<button class="btn btn-sm btn-warning lihat" data-code="' + row.id_po + '" rel="tooltip" title="Lihat detail"><span class="fas fa-fw fa-eye"></span></button> ' +
                    '<button class="btn btn-sm btn-info edit" rel="tooltip" title="Edit PO" disabled><span class="fas fa-fw fa-edit"></span></button>'
                ]
            }
        }

        $('body').on('click', '#tabledtm .lihat', function() {
            var idpo = $(this).data('code');
            $.ajax({
                url: "<?= base_url('adminpo/detailpoxb'); ?>",
                method: 'post',
                data: {
                    id: idpo
                },
                success: function(data) {
                    console.log(data);
                    $("#modalDetail").modal('show');
                    $(".detailx").html(data);
                    $(".tbl_detal").bootstrapTable({
                        search: true,
                        pagination: true
                    });
                    $(".download").click(function() {
                        window.open("<?= base_url('adminpo/printpdf/'); ?>" + idpo);
                    });
                }
            });
        });
        $('body').on('click', '#tabledtm .edit', function() {
            var idpo = $(this).data('code');
            window.location.href = "<?= base_url('adminpo/editpoxb/') ?>" + idpo;
        });
    });
    $(document).ready(function() {
        $(".export").click(() => {
            $("#exportModal").modal('show');
        });

        $(".namapt").select2({
            placeholder: '= Pilih Perusahaan =',
            width: 'resolve',
            allowClear: 'true'
        });

        $(".tambah").click(() => {
            document.location.href = "<?= base_url('adminpo/tambahpo'); ?>";
        });
    });
</script>