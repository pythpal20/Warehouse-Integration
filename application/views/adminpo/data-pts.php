<div class="modal fade" id="mco" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title text-white" id="staticBackdropLabel">Detail PTS</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="viewDetail"></div>
            </div>
            <div class="modal-footer bg-primary">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<!-- end of modal -->
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h4 class="h4 mb-4 text-gray-800"><?= $title; ?></h4><small>Pick Ticket Sample - Aktual (MKTIS)</small>
    <div class="card mb-3 border-left-danger">
        <div class="card-body">
            <table id="tb_pts" data-toggle="tb_pts" data-show-toggle="true" data-show-refresh="true" data-show-pagination-switch="true" data-show-columns="true" data-mobile-responsive="true" data-check-on-init="true" data-advanced-search="true" data-id-table="tb_pts" data-show-print="true" data-show-columns-toggle-all="true">

            </table>
        </div>
    </div>
</div>
<!-- /.container-fluid -->
</div>
<!-- End of Main Content -->
<script>
    $(document).ready(function() {
        var lvl = "<?= $user['role_id'] ?>";
        var $table = $("#tb_pts")
        $table.bootstrapTable({
            url: '<?= base_url('adminpo/get_ptsActual'); ?>',
            pagination: true,
            search: true,
            columns: [{
                field: 'no',
                title: '#'
            }, {
                field: 'id',
                title: 'No. PTS',
                sortable: 'true'
            }, {
                field: 'customer',
                title: 'Nama Customer'
            }, {
                field: 'tglcreate',
                title: 'Tgl. Request'
            }, {
                field: 'tglambil',
                title: 'Tgl. Plan Ambil'
            }, {
                field: 'status',
                title: 'Status',
                sortable: 'true',
                formatter: function(value) {
                    if (value == '2') {
                        return [
                            'Tidak Kembali'
                        ]
                    } else if (value == '1') {
                        return [
                            'Kembali'
                        ]
                    }
                }
            }, {
                field: 'id',
                title: 'Action',
                formatter: function(value) {
                    if (lvl == '1' || lvl == '7') {
                        return [
                            '<button class="btn btn-warning btn-sm lihat" data-pts="' + value + '" rel="tooltip" title="Lihat detail"><i class="fas fa-fw fa-eye"></i></button> ' +
                            '<button class="btn btn-primary btn-sm makepo" data-pts="' + value + '" rel="tooltip" title="Buatkan PO XB"><i class="fas fa-fw fa-plus"></i> PO</button>'
                        ]
                    } else {
                        return [
                            '<button class="btn btn-warning btn-sm lihat" data-pts="' + value + '" rel="tooltip" title="Lihat detail"><i class="fas fa-fw fa-eye"></i></button> ' +
                            '<button class="btn btn-primary btn-sm" rel="tooltip" title="Buatkan PO XB" disabled><i class="fas fa-fw fa-plus"></i> PO</button>'
                        ]
                    }
                }
            }]
        });

        $('body').on('click', '#tb_pts .lihat', function() {
            var id = $(this).data('pts');
            $.ajax({
                url: "<?= base_url('adminpo/detailPts') ?>",
                method: 'POST',
                data: {
                    id: id
                },
                success: function(data) {
                    $("#mco").modal('show');
                    $("#viewDetail").html(data);
                    $(".tbdetail").bootstrapTable({
                        search: 'true',
                        pagination: 'true',
                        toggle: 'true',
                        pageSize: 5
                    });
                }
            });
        });

        $('body').on('click', '#tb_pts .makepo',function(){
            var id = $(this).data('pts');
            window.location.href = "<?= base_url('adminpo/tambahpo_pts/') ?>" + id; 
        });
    });
</script>