<!-- modal -->
<div class="modal fade" id="detailBL" tabindex="-1" aria-labelledby="detailBLlabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="detailBLlabel">Detail SKU BL</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                
            </div>
            <div class="modal-footer">
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
    <div class="card mb-3 border-left-danger">
        <p class="card-header card-subtitle">List Surat Jalan - Complete dari MKITS</p>
        <div class="card-body">
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
<!-- /.container-fluid -->
</div>
<!-- End of Main Content -->
<!-- javaScript -->
<script>
    $(document).ready(function() {
        var rolex = "<?= $user['role_id'] ?>";
        // alert(rolex)
        $table = $("#tablemwk")
        $table.bootstrapTable({
            url: "<?= base_url('deliverynote/getbl/1'); ?>",
            search: true,
            pagination: true,
            columns: [{
                field: 'nobl',
                title: 'No. BL'
            }, {
                field: 'customer',
                title: 'Customer'
            }, {
                field: 'dd',
                title: 'Delivery Date'
            }, {
                field: 'kenek',
                title: 'Kenek'
            }, {
                field: '',
                title: 'Action',
                formatter: tombol,
                align: 'center'
            }]
        });

        function tombol(value, row) {
            if(rolex == 7 || rolex == 3 ) {
                return [
                    '<button data-po="' + row.nobl + '" class="btn btn-sm btn-warning lihat"><i class="fas fa-fw fa-eye"></i></button> ' +
                    '<button data-po="' + row.nobl + '" class="btn btn-sm btn-primary buat"><i class="fas fa-fw fa-plus"></i> DN</button>'
                ]
            } else {
                return [
                    '<button data-po="' + row.nobl + '" class="btn btn-sm btn-warning lihat"><i class="fas fa-fw fa-eye"></i></button> ' +
                    '<button class="btn btn-sm btn-primary buat" disabled><i class="fas fa-fw fa-plus"></i> DN</button>'
                ]
            }
        }
        $("body").on("click", "#tablemwk .lihat", function() {
            var nobl = $(this).data('po');
            $.ajax({
                url: "<?= base_url('deliverynote/detailbL'); ?>",
                method: 'POST',
                data: {
                    id: nobl
                },
                success: function(data) {
                    $("#detailBL").modal({
                        backdrop: 'static',
                        keyboard: true,
                        show: true
                    });
                    $(".modal-body").html(data);
                }
            });
        });

        $("body").on("click", "#tablemwk .buat", function(){
            var idpo = $(this).data('po');
            window.location.href="<?= base_url('deliverynote/makedn/'); ?>" + idpo;
        });
    });
    $(document).ready(function() {
        var rolex = "<?= $user['role_id'] ?>";
        $table = $("#tablemwm")
        $table.bootstrapTable({
            url: "<?= base_url('deliverynote/getbl/2'); ?>",
            search: true,
            pagination: true,
            columns: [{
                field: 'nobl',
                title: 'No. BL'
            }, {
                field: 'customer',
                title: 'Customer'
            }, {
                field: 'dd',
                title: 'Delivery Date'
            }, {
                field: 'kenek',
                title: 'Kenek'
            }, {
                field: '',
                title: 'Action',
                formatter: tombol,
                align: 'center'
            }]
        });

        function tombol(value, row) {
            if(rolex == 7 || rolex == 3 ) {
                return [
                    '<button data-po="' + row.nobl + '" class="btn btn-sm btn-warning lihat"><i class="fas fa-fw fa-eye"></i></button> ' +
                    '<button data-po="' + row.nobl + '" class="btn btn-sm btn-primary buat"><i class="fas fa-fw fa-plus"></i> DN</button>'
                ]
            } else {
                return [
                    '<button data-po="' + row.nobl + '" class="btn btn-sm btn-warning lihat"><i class="fas fa-fw fa-eye"></i></button> ' +
                    '<button class="btn btn-sm btn-primary buat" disabled><i class="fas fa-fw fa-plus"></i> DN</button>'
                ]
            }
        }
        $("body").on("click", "#tablemwm .lihat", function() {
            var nobl = $(this).data('po');
            $.ajax({
                url: "<?= base_url('deliverynote/detailbL'); ?>",
                method: 'POST',
                data: {
                    id: nobl
                },
                success: function(data) {
                    $("#detailBL").modal({
                        backdrop: 'static',
                        keyboard: true,
                        show: true
                    });
                    $(".modal-body").html(data);
                }
            });
        });
        $("body").on("click", "#tablemwm .buat", function(){
            var idpo = $(this).data('po');
            window.location.href="<?= base_url('deliverynote/makedn/'); ?>" + idpo;
        });
    });
    $(document).ready(function() {
        var rolex = "<?= $user['role_id'] ?>";
        $table = $("#tablebak")
        $table.bootstrapTable({
            url: "<?= base_url('deliverynote/getbl/3'); ?>",
            search: true,
            pagination: true,
            columns: [{
                field: 'nobl',
                title: 'No. BL'
            }, {
                field: 'customer',
                title: 'Customer'
            }, {
                field: 'dd',
                title: 'Delivery Date'
            }, {
                field: 'kenek',
                title: 'Kenek'
            }, {
                field: '',
                title: 'Action',
                formatter: tombol,
                align: 'center'
            }]
        });

        function tombol(value, row) {
            if(rolex == 7 || rolex == 3 ) {
                return [
                    '<button data-po="' + row.nobl + '" class="btn btn-sm btn-warning lihat"><i class="fas fa-fw fa-eye"></i></button> ' +
                    '<button data-po="' + row.nobl + '" class="btn btn-sm btn-primary buat"><i class="fas fa-fw fa-plus"></i> DN</button>'
                ]
            } else {
                return [
                    '<button data-po="' + row.nobl + '" class="btn btn-sm btn-warning lihat"><i class="fas fa-fw fa-eye"></i></button> ' +
                    '<button class="btn btn-sm btn-primary buat" disabled><i class="fas fa-fw fa-plus"></i> DN</button>'
                ]
            }
        }
        $("body").on("click", "#tablebak .lihat", function() {
            var nobl = $(this).data('po');
            $.ajax({
                url: "<?= base_url('deliverynote/detailbL'); ?>",
                method: 'POST',
                data: {
                    id: nobl
                },
                success: function(data) {
                    $("#detailBL").modal({
                        backdrop: 'static',
                        keyboard: true,
                        show: true
                    });
                    $(".modal-body").html(data);
                }
            });
        });
        $("body").on("click", "#tablebak .buat", function(){
            var idpo = $(this).data('po');
            window.location.href="<?= base_url('deliverynote/makedn/'); ?>" + idpo;
        });
    });
    $(document).ready(function() {
        var rolex = "<?= $user['role_id'] ?>";
        $table = $("#tablefci")
        $table.bootstrapTable({
            url: "<?= base_url('deliverynote/getbl/5'); ?>",
            search: true,
            pagination: true,
            columns: [{
                field: 'nobl',
                title: 'No. BL'
            }, {
                field: 'customer',
                title: 'Customer'
            }, {
                field: 'dd',
                title: 'Delivery Date'
            }, {
                field: 'kenek',
                title: 'Kenek'
            }, {
                field: '',
                title: 'Action',
                formatter: tombol,
                align: 'center'
            }]
        });

        function tombol(value, row) {
            if(rolex == 7 || rolex == 3 ) {
                return [
                    '<button data-po="' + row.nobl + '" class="btn btn-sm btn-warning lihat"><i class="fas fa-fw fa-eye"></i></button> ' +
                    '<button data-po="' + row.nobl + '" class="btn btn-sm btn-primary buat"><i class="fas fa-fw fa-plus"></i> DN</button>'
                ]
            } else {
                return [
                    '<button data-po="' + row.nobl + '" class="btn btn-sm btn-warning lihat"><i class="fas fa-fw fa-eye"></i></button> ' +
                    '<button class="btn btn-sm btn-primary buat" disabled><i class="fas fa-fw fa-plus"></i> DN</button>'
                ]
            }
        }
        $("body").on("click", "#tablefci .lihat", function() {
            var nobl = $(this).data('po');
            $.ajax({
                url: "<?= base_url('deliverynote/detailbL'); ?>",
                method: 'POST',
                data: {
                    id: nobl
                },
                success: function(data) {
                    $("#detailBL").modal({
                        backdrop: 'static',
                        keyboard: true,
                        show: true
                    });
                    $(".modal-body").html(data);
                }
            });
        });

        $("body").on("click", "#tablefci .buat", function(){
            var idpo = $(this).data('po');
            window.location.href="<?= base_url('deliverynote/makedn/'); ?>" + idpo;
        });
    });
    $(document).ready(function() {
        var rolex = "<?= $user['role_id'] ?>";
        $table = $("#tabledtm")
        $table.bootstrapTable({
            url: "<?= base_url('deliverynote/getbl/4'); ?>",
            search: true,
            pagination: true,
            columns: [{
                field: 'nobl',
                title: 'No. BL'
            }, {
                field: 'customer',
                title: 'Customer'
            }, {
                field: 'dd',
                title: 'Delivery Date'
            }, {
                field: 'kenek',
                title: 'Kenek'
            }, {
                field: '',
                title: 'Action',
                formatter: tombol,
                align: 'center'
            }]
        });

        function tombol(value, row) {
            if(rolex == 7 || rolex == 3 ) {
                return [
                    '<button data-po="' + row.nobl + '" class="btn btn-sm btn-warning lihat"><i class="fas fa-fw fa-eye"></i></button> ' +
                    '<button data-po="' + row.nobl + '" class="btn btn-sm btn-primary buat"><i class="fas fa-fw fa-plus"></i> DN</button>'
                ]
            } else {
                return [
                    '<button data-po="' + row.nobl + '" class="btn btn-sm btn-warning lihat"><i class="fas fa-fw fa-eye"></i></button> ' +
                    '<button class="btn btn-sm btn-primary buat" disabled><i class="fas fa-fw fa-plus"></i> DN</button>'
                ]
            }
        }

        $("body").on("click", "#tabledtm .lihat", function() {
            var nobl = $(this).data('po');
            $.ajax({
                url: "<?= base_url('deliverynote/detailbL'); ?>",
                method: 'POST',
                data: {
                    id: nobl
                },
                success: function(data) {
                    $("#detailBL").modal({
                        backdrop: 'static',
                        keyboard: true,
                        show: true
                    });
                    $(".modal-body").html(data);
                }
            });
        });

        $("body").on("click", "#tabledtm .buat", function(){
            var idpo = $(this).data('po');
            window.location.href="<?= base_url('deliverynote/makedn/'); ?>" + idpo;
        });
    });
    $(document).ready(function() {

    });
</script>