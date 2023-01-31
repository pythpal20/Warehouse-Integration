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
    <div class="row">
        <div class="col-lg-12">
            <div class="card border-left-primary">
                <div class="card-header">
                    <h5 class="card-title">Table Data Barang dan Stok</h5>
                </div>
                <div class="card-body">
                    <!-- bootstrap-table -->
                    <?php if($user['role_id'] == '2' || $user['role_id'] == '1') : ?>
                    <div id="toolbar">
                        <button class="btn btn-secondary tambah" data-toggle="tooltip" title="Tambah Produk baru">+ New Item</button>
                    </div>
                    <?php endif; ?>
                    <table id="tb_barang" class="tb_barang table table-bordered" data-show-toggle="true" data-show-refresh="true" data-show-pagination-switch="true" data-show-columns="true" data-mobile-responsive="true" data-check-on-init="true" data-advanced-search="true" data-id-table="advancedTable">

                    </table>
                </div>
                <div class="card-footer">
                    <small><em>Data Stok barang berdasarkan data fisik - mutasi yang belum selesai</em></small><br>
                    <small>SOH75 = Stok On Hand (perhitungan stok gudang 75 - mutasi yang belum complete</small><br>
                    <small>SOH50 = Stok On Hand (perhitungan stok gudang 50 - mutasi yang belum complete</small>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /.container-fluid -->
</div>
<!-- End of Main Content -->
<div class="modal fade" id="detailModal" tabindex="-1" aria-labelledby="detailModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="detailModalLabel">Detail Barang</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body ">
                <div id="viewDetail"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>
<!-- javascript -->
<script>
    $(document).ready(() => {
        $(function() {
            $('[data-toggle="tooltip"]').tooltip()
            $('[rel="tooltip"]').tooltip()
        })

        $(".tambah").click(() => {
            document.location.href = "<?= base_url('warehouse/addItem') ?>";
        });
    });
    $(document).ready(() => {
        var lev = "<?= $user['role_id']; ?>";
        $("#tb_barang").bootstrapTable({
            url: "<?= base_url('warehouse/stockList'); ?>",
            toolbar: '#toolbar',
            pagination: true,
            search: true,
            columns: [{
                field: 'model',
                title: 'Model/ SKU',
                sortable: 'true'
            }, {
                field: 'a',
                title: 'SOH75',
                sortable: true,
                align: 'right',
                formatter: function(value, row, index) {
                    var stoks75 = row.stok75;
                    var min75 = row.minus_75;
                    var plus75 = row.plus_75;
                    var a50to75 = row.a50_to_g75;
                    var g75to50 = row.g75_to_a50;

                    soh75 = parseInt(stoks75) - parseInt(min75) + parseInt(plus75) - parseInt(g75to50) + parseInt(a50to75);
                    return [
                        soh75
                    ]
                }
            }, {
                field: 'b',
                title: 'SOH50',
                sortable: 'true',
                align: 'right',
                formatter: function(value, row, index) {
                    var stoks50 = row.stok50;
                    var min50 = row.minus50;
                    var plus50 = row.plus_50;
                    var a50to75 = row.a50_to_g75;
                    var g75to50 = row.g75_to_a50;

                    soh50 = parseInt(stoks50) - parseInt(min50) + parseInt(plus50) - parseInt(a50to75) + parseInt(g75to50);
                    return [
                        soh50
                    ]
                }
            }, {
                field: 'stok75',
                title: 'Stok 75',
                sortable: true
            }, {
                field: 'stok50',
                title: 'Stok 50',
                sortable: true
            }, {
                field: 'id',
                title: 'Aksi',
                align: 'center',
                formatter: function(value, row) {
                    if (lev == '3') {
                        return [
                            '<button class="btn btn-info lihat btn-sm" data-code="' + value + '" rel="tooltip" title="Lihat detail"><span class="fas fa-fw fa-eye"></span></button> ' +
                            '<button class="btn btn-sm btn-danger history" data-code="' + value + '"><span class="fas fa-fw fa-clock"></span></button>'
                        ]
                    } else {
                        return [
                            '<button class="btn btn-info lihat btn-sm" data-code="' + value + '" rel="tooltip" title="Lihat detail"><span class="fas fa-fw fa-eye"></span></button> ' +
                            '<button class="btn btn-sm btn-danger history" data-code="' + value + '"><span class="fas fa-fw fa-clock"></span></button>'
                        ]
                    }
                }
            }]
        });

        $('body').on('click', '#tb_barang .lihat', function() {
            // alert('ada')
            var id = $(this).data('code');
            $.ajax({
                method: 'POST',
                url: "<?= base_url('warehouse/detailBarang') ?>",
                data: {
                    id: id
                },
                success: function(data) {
                    $("#detailModal").modal({
                        backdrop: 'static',
                        keyboard: true,
                        show: true
                    });
                    $('#viewDetail').html(data);
                    $(".tableM").bootstrapTable({
                        search: true,
                        pagination: true
                    });
                }
            });
        });

        $('body').on('click', '#tb_barang .history', function(){
            var id = $(this).data('code');
            window.location.href="<?= base_url('warehouse/historyBarang/') ?>" + id;
        });
    });
</script>