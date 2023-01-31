<!-- modal -->
<div class="modal fade" id="modalMutasi" tabindex="-1" aria-labelledby="modalMutasiLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalMutasiLabel">Detail Mutasi</h5>
                <button type="button" class="btn-sm btn-danger close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="detailMutasi"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<!-- modal export -->
<div class="modal fade" id="exportModal" tabindex="-1" aria-labelledby="exportModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exportModalLabel">Export Data Mutasi</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?= base_url('warehouse/exportMutasi') ?>" method="post">
                    <div class="form-group">
                        <label for="">Locator Gudang</label>
                        <select name="locator" id="locator" class="form-control">
                            <option value="">~ Pilih Gudang ~</option>
                            <option value="stok_g75">Gudang Garuda 75</option>
                            <option value="stok_a50">Gudang Arjuna 50</option>
                        </select>
                        <div class="form-row">
                            <div class="form-group col-sm-6">
                                <label for="">Tanggal Awal</label>
                                <input type="date" name="tglawal" id="tglawal" class="form-control">
                            </div>
                            <div class="form-group col-sm-6">
                                <label for="">Tanggal Akhir</label>
                                <input type="date" name="tglakhir" id="tglakhir" class="form-control">
                            </div>
                        </div>
                    </div>
                
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary">Proses</button></form>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<!-- tambahan css -->
<style>
    #toolbar {
        margin: 0;
    }
</style>
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h4 class="h4 mb-4 text-gray-800"><?= $title; ?></h4>
    <div class="card mb-3 border-left-primary">
        <div class="card-body">
            <?php if ($user['role_id'] == '2' || $user['role_id'] == '1' || $user['role_id'] == '3') : ?>
                <div id="toolbar">
                    <button class="btn btn-secondary tambah" data-toggle="tooltip" title="Tambah mutasi baru"><span class="fas fa-fw fa-plus"></span> Mutasi</button>
                    <button class="btn btn-primary sekaligus" data-toggle="tooltip" title="Tambah mutasi baru"><span class="fas fa-fw fa-plus"></span> Mutasi Sekaligus</button>
                    <button class="btn btn-success export" data-toggle="tooltip" title="Export mutasi barang"><span class="fas fa-fw fa-file-export"></span> Export</button>
                </div>
            <?php endif; ?>
            <?php if($user['role_id'] == '11') { ?>
                <div id="toolbar">
                    <button class="btn btn-success export" data-toggle="tooltip" title="Export mutasi barang"><span class="fas fa-fw fa-file-export"></span> Export</button>
                </div>
            <?php } ?>
            <table id="tb_mutasi" class="table table-bordered tb_mutasi table-hover" data-show-toggle="true" data-show-refresh="true" data-show-pagination-switch="true" data-show-columns="true" data-mobile-responsive="true" data-check-on-init="true" data-advanced-search="true" data-id-table="advancedTable"></table>
        </div>
    </div>
</div>
<!-- /.container-fluid -->
</div>
<!-- End of Main Content -->
<script>
    $(document).ready(() => {
        var jol = "<?= $user['job_location']; ?>";
        var role = "<?= $user['role_id']; ?>";

        $(function() {
            $('[data-toggle="tooltip"]').tooltip()
            $('[rel="tooltip"]').tooltip()
        });

        $table = $("#tb_mutasi")
        $table.bootstrapTable({
            url: "<?= base_url('warehouse/iMutation'); ?>",
            toolbar: '#toolbar',
            pagination: true,
            search: true,
            columns: [{
                field: 'model',
                title: 'SKU',
                sortable: 'true'
            }, {
                field: 'jenis',
                title: 'Jenis Mutasi',
                sortable: 'true',
                formatter: mutation
            }, {
                field: 'qty',
                title: 'Qty. Mutasi',
                sortable: 'true'
            }, {
                field: 'ket',
                title: 'Keterangan',
                sortable: 'true'
            }, {
                field: 'mutasiby',
                title: 'Dibuat Oleh',
                formatter: function(value) {
                    return [
                        value.split(" ")[0]
                    ]
                }
            }, {
                field: 'status',
                title: 'Status',
                sortable: 'true',
                formatter: status
            }, {
                field: 'tgl',
                title: 'Tgl Buat',
                sortable: 'true'
            }, {
                field: 'id',
                title: 'Act.',
                formatter: tombol,
                align: 'center'
            }]
        });

        function status(row, value, index) {

            if (row == '0') {
                return [
                    '<span class="badge badge-info">Pending</span>'
                ]
            } else if (row === '1') {
                return [
                    '<span class="badge badge-success">Approved</span>'
                ]
            } else {
                return [
                    '<span class="badeg badge-danger">Cancel</span>'
                ]
            }
        }

        function mutation(value, row) {
            if (value == 'minus') {
                return [
                    '(-) Stok'
                ]
            } else if (value == 'plus') {
                return [
                    '(+) Stok'
                ]
            } else if (value == 'mutation') {
                return [
                    'Mutasi'
                ]
            }
        }

        function tombol(value, row, index) {
            var srcs = row.source;
            var dest = row.tujuan;
            var sts = row.jenis;
            var iStatus = row.status;
            if (sts == 'plus' && role == '2') { //jika penambahan barang
                if (iStatus == '1' || iStatus == '2') {
                    return [
                        '<button class="btn btn-sm btn-success lihats" rel="tooltip" title="View Detail" data-code="' + value + '"><i class="fas fa-fw fa-eye"></i></button> ' +
                        '<button class="btn btn-sm btn-primary approve" id="approve" rel="tooltip" title="Konfirm Penambahan Barang" disabled><i class="fas fa-fw fa-check"></i></button>'
                    ]
                } else {
                    return [
                        '<button class="btn btn-sm btn-success lihats" rel="tooltip" title="View Detail" data-code="' + value + '"><i class="fas fa-fw fa-eye"></i></button> ' +
                        '<button class="btn btn-sm btn-primary approve" id="approve" rel="tooltip" title="Konfirm Penambahan Barang" data-code="' + value + '" data-qty="' + row.qty + '"><i class="fas fa-fw fa-check"></i></button>'
                    ]
                }
            } else if (sts == 'minus' && role == '2') { //jika pengurangan barang
                if (iStatus == '0') {
                    return [
                        '<button class="btn btn-sm btn-success lihats" rel="tooltip" title="View Detail" data-code="' + value + '"><i class="fas fa-fw fa-eye"></i></button> ' +
                        '<button class="btn btn-sm btn-primary approve" id="approve" rel="tooltip" title="Konfirm Pengurangan Barang" data-code="' + value + '" data-qty="' + row.qty + '"><i class="fas fa-fw fa-check"></i></button>'
                    ]
                } else {
                    return [
                        '<button class="btn btn-sm btn-success lihats" rel="tooltip" title="View Detail" data-code="' + value + '"><i class="fas fa-fw fa-eye"></i></button> ' +
                        '<button class="btn btn-sm btn-primary approve" id="approve" rel="tooltip" title="Konfirm Pengurangan Barang" disabled><i class="fas fa-fw fa-check"></i></button>'
                    ]
                }
            } else if (sts == 'mutation') { //jika perpindahan barang cek lagi sumber dan tujuan
                if (dest == 'g75' && jol == 'g75') { //jika yang menerima barang adalah gudang 75 maka yang confirm adalah admin gudang 75
                    if (iStatus == '0') {
                        return [
                            '<button class="btn btn-sm btn-success lihats" rel="tooltip" title="View Detail" data-code="' + value + '"><i class="fas fa-fw fa-eye"></i></button> ' +
                            '<button class="btn btn-sm btn-primary approve" id="approve" rel="tooltip" title="Konfirm Terima Barang" data-code="' + value + '" data-qty="' + row.qty + '"><i class="fas fa-fw fa-check"></i></button>'
                        ]
                    } else {
                        return [
                            '<button class="btn btn-sm btn-success lihats" rel="tooltip" title="View Detail" data-code="' + value + '"><i class="fas fa-fw fa-eye"></i></button> ' +
                            '<button class="btn btn-sm btn-primary approve" id="approve" rel="tooltip" title="Konfirm Terima Barang" disabled><i class="fas fa-fw fa-check"></i></button>'
                        ]
                    }
                } else if (dest == 'a50' && jol == 'a50') { //jika yang menerima barang adalah gudang A50 maka yg confirm adalah admin gudang A50
                    if (iStatus == '0') {
                        return [
                            '<button class="btn btn-sm btn-success lihats" rel="tooltip" title="View Detail" data-code="' + value + '"><i class="fas fa-fw fa-eye"></i></button> ' +
                            '<button class="btn btn-sm btn-primary approve" id="approve" rel="tooltip" title="Konfirm Terima Barang" data-code="' + value + '" data-qty="' + row.qty + '"><i class="fas fa-fw fa-check"></i></button>'
                        ]
                    } else {
                        return [
                            '<button class="btn btn-sm btn-success lihats" rel="tooltip" title="View Detail" data-code="' + value + '"><i class="fas fa-fw fa-eye"></i></button> ' +
                            '<button class="btn btn-sm btn-primary approve" id="approve" rel="tooltip" title="Konfirm Terima Barang" disabled><i class="fas fa-fw fa-check"></i></button>'
                        ]
                    }
                } else {
                    return [
                        '<button class="btn btn-sm btn-success lihats" rel="tooltip" title="View Detail" data-code="' + value + '"><i class="fas fa-fw fa-eye"></i></button>'
                    ]
                }
            } else {
                return [
                    '<button class="btn btn-sm btn-success lihats" rel="tooltip" title="View Detail" data-code="' + value + '"><i class="fas fa-fw fa-eye"></i></button>'
                ]
            }

        }

        $('body').on('click', '#tb_mutasi .lihats', function() {
            var id = $(this).data('code');
            $.ajax({
                url: "<?= base_url('warehouse/detailMutasi') ?>",
                method: 'POST',
                data: {
                    id: id
                },
                success: function(data) {
                    $("#modalMutasi").modal({
                        backdrop: 'static',
                        show: true,
                        keyboard: false
                    });
                    $("#detailMutasi").html(data);
                }
            });
        });
        $('body').on('click', '#tb_mutasi .approve', function() {
            var id = $(this).data('code');
            window.location.href = "<?= base_url('warehouse/apm/'); ?>" + id;
        });

        $(".tambah").click(() => {
            window.location.href = "<?= base_url('warehouse/mutasiBaru'); ?>";
        });
        $(".sekaligus").click(() => {
            window.location.href = "<?= base_url('warehouse/atatime'); ?>";
        });
        
        $(".export").click(() => {
            $("#exportModal").modal({
                backdrop: 'static',
                keyboard: false
            });
        })
    });
</script>