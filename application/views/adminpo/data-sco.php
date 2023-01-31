<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h4 class="h4 mb-4 text-gray-800"><?= $title; ?></h4>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item bg-gray-100">
                            <a class="nav-link active" id="mwk-tab" data-toggle="tab" href="#mwk" role="tab" aria-controls="mwk" aria-selected="true">Mutli Wahana Kencana</a>
                        </li>
                        <li class="nav-item bg-gray-200">
                            <a class="nav-link" id="mwm-tab" data-toggle="tab" href="#mwm" role="tab" aria-controls="mwm" aria-selected="false">Multi Wahana Makmur</a>
                        </li>
                        <li class="nav-item bg-gray-300">
                            <a class="nav-link" id="bak-tab" data-toggle="tab" href="#bak" role="tab" aria-controls="bak" aria-selected="false">Batavia Adimarga Kencana</a>
                        </li>
                        <li class="nav-item bg-gray-400">
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
                            <div class="table-responsive">
                                <table class="table-bordered table" id="tablemwk" data-toggle="tablemwk" data-show-toggle="true" data-show-refresh="true" data-show-pagination-switch="true" data-show-columns="true" data-mobile-responsive="true" data-check-on-init="true" data-advanced-search="true" data-id-table="advancedTable" data-show-print="true" data-show-columns-toggle-all="true"></table>
                            </div>
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
<!-- modal begin -->
<div class="modal fade" id="mco" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Detail P/ T </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="viewDetail"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<!-- end of modal -->
<script>
    // PT. MWK
    $(document).ready(function() {
        var lvl = "<?= $user['role_id'] ?>";
        $table = $("#tablemwk")
        $table.bootstrapTable({
            url: '<?= base_url('adminpo/getDatamwk/1') ?>',
            search: true,
            toolbar: '#toolbar',
            fixedColumns: true,
            fixedNumber: 1,
            pagination: true,
            columns: [{
                field: 'id',
                title: 'No. SCO',
                width: 150
            }, {
                field: 'tglorder',
                title: 'Tgl. Order',
                sortable: 'true'
            }, {
                field: 'tgldelivery',
                title: 'Tgl. Kirim',
                sortable: 'true'
            }, {
                field: 'namacust',
                title: 'Nama Customer',
                sortable: 'true',
                width: 250
            }, {
                field: 'sales',
                title: 'Sales',
                sortable: 'true'
            }, {
                field: 'id',
                title: 'Act',
                formatter: tombol
            }]
        });

        function tombol(value, row) {
            if (lvl == '1' || lvl == '7') {
                return [
                    '<button title="Lihat detail" rel="tooltip" class="btn btn-sm btn-warning lihat" data-noco="' + value + '"><i class="fas fa-fw fa-eye"></i></button> ' +
                    '<button title="Buat Po XB" rel="tooltip" class="btn btn-sm btn-primary buats" data-noco="' + value + '"><i class="fas fa-fw fa-plus"></i> PO</button>'
                ]
            } else {
                return [
                    '<button title="Lihat detail" rel="tooltip" class="btn btn-sm btn-warning lihat" data-noco="' + value + '"><i class="fas fa-fw fa-eye"></i></button> ' +
                    '<button title="Buat Po XB" rel="tooltip" class="btn btn-sm btn-primary buats" disabled><i class="fas fa-fw fa-plus"></i> PO</button>'
                ]
            }
        }

        function sts(row, value) {
            if (row == '1') {
                return [
                    '<span class="badge badge-success">PROCESS</span>'
                ]
            } else if (row == '0') {
                return [
                    '<span class="badge badge-warning">UNPROCESS</span>'
                ]
            } else if (row == '2') {
                return [
                    '<span class="badge badge-danger">CANCEL</span>'
                ]
            }
        }

        function Rupiah(value, row) {
            var sign = 1;
            if (value < 0) {
                sign = -1;
                value = -value;
            }

            let num = value.toString().includes('.') ? value.toString().split('.')[0] : value.toString();
            let len = num.toString().length;
            let result = '';
            let count = 1;

            for (let i = len - 1; i >= 0; i--) {
                result = num.toString()[i] + result;
                if (count % 3 === 0 && count !== 0 && i !== 0) {
                    result = '.' + result;
                }
                count++;
            }

            if (value.toString().includes(',')) {
                result = result + ',' + value.toString().split('.')[1];
            }
            // return result with - sign if negative
            return sign < 0 ? '-' + result : (result ? 'Rp. ' + result : '');
        }

        $('body').on('click', '#tablemwk .lihat', function() {
            var id = $(this).data('noco');
            $.ajax({
                url: "<?= base_url('adminpo/detailCo') ?>",
                method: 'post',
                data: {
                    id: id,
                    status: status
                },
                success: function(data) {
                    $("#mco").modal('show');
                    $("#viewDetail").html(data);
                }
            });

        });

        $('body').on('click', '#tablemwk .buats', function() {
            var id = $(this).data('noco');
            window.location.href = "<?= base_url('adminpo/tambahpo/') ?>" + id;
        });
    });
    // PT. bak
    $(document).ready(function() {
        var lvl = "<?= $user['role_id'] ?>";
        $table = $("#tablebak")
        $table.bootstrapTable({
            url: '<?= base_url('adminpo/getDatamwk/3') ?>',
            search: true,
            toolbar: '#toolbar',
            fixedColumns: true,
            fixedNumber: 1,
            pagination: true,
            columns: [{
                field: 'id',
                title: 'No. SCO',
                width: 150
            }, {
                field: 'tglorder',
                title: 'Tgl. Order',
                sortable: 'true'
            }, {
                field: 'tgldelivery',
                title: 'Tgl. Kirim',
                sortable: 'true'
            }, {
                field: 'namacust',
                title: 'Nama Customer',
                sortable: 'true',
                width: 250
            }, {
                field: 'sales',
                title: 'Sales',
                sortable: 'true'
            }, {
                field: 'id',
                title: 'Act',
                formatter: tombol
            }]
        });

        function tombol(value, row) {
            if (lvl == '1' || lvl == '7') {
                return [
                    '<button title="Lihat detail" rel="tooltip" class="btn btn-sm btn-warning lihat" data-noco="' + value + '"><i class="fas fa-fw fa-eye"></i></button> ' +
                    '<button title="Buat Po XB" rel="tooltip" class="btn btn-sm btn-primary buats" data-noco="' + value + '"><i class="fas fa-fw fa-plus"></i> PO</button>'
                ]
            } else {
                return [
                    '<button title="Lihat detail" rel="tooltip" class="btn btn-sm btn-warning lihat" data-noco="' + value + '"><i class="fas fa-fw fa-eye"></i></button> ' +
                    '<button title="Buat Po XB" rel="tooltip" class="btn btn-sm btn-primary buats" disabled><i class="fas fa-fw fa-plus"></i> PO</button>'
                ]
            }
        }

        function sts(row, value) {
            if (row == '1|') {
                return [
                    '<span class="badge badge-secondary">Proses</span>'
                ]
            } else if (row == '1|1') {
                return [
                    '<span class="badge badge-primary">Terkirim</span>'
                ]
            } else if (row == '1|2') {
                return [
                    '<span class="badge badge-info">Terkirim Sebagian</span>'
                ]
            } else if (row == '1|3' || row == '2|3') {
                return [
                    '<span class="badge badge-success">Complete</span>'
                ]
            } else {
                return [
                    '<span class="badge badge-danger">Cancel</span>'
                ]
            }
        }

        function Rupiah(value, row) {
            var sign = 1;
            if (value < 0) {
                sign = -1;
                value = -value;
            }

            let num = value.toString().includes('.') ? value.toString().split('.')[0] : value.toString();
            let len = num.toString().length;
            let result = '';
            let count = 1;

            for (let i = len - 1; i >= 0; i--) {
                result = num.toString()[i] + result;
                if (count % 3 === 0 && count !== 0 && i !== 0) {
                    result = '.' + result;
                }
                count++;
            }

            if (value.toString().includes(',')) {
                result = result + ',' + value.toString().split('.')[1];
            }
            // return result with - sign if negative
            return sign < 0 ? '-' + result : (result ? 'Rp. ' + result : '');
        }

        $('body').on('click', '#tablebak .lihat', function() {
            var id = $(this).data('noco');
            $.ajax({
                url: "<?= base_url('adminpo/detailCo') ?>",
                method: 'post',
                data: {
                    id: id,
                    status: status
                },
                success: function(data) {
                    $("#mco").modal('show');
                    $("#viewDetail").html(data);
                }
            });

        });
        
        $('body').on('click', '#tablebak .buats', function() {
            var id = $(this).data('noco');
            window.location.href = "<?= base_url('adminpo/tambahpo/') ?>" + id;
        });
    });
    // PT. mwm
    $(document).ready(function() {
        var lvl = "<?= $user['role_id'] ?>";
        $table = $("#tablemwm")
        $table.bootstrapTable({
            url: '<?= base_url('adminpo/getDatamwk/2') ?>',
            search: true,
            toolbar: '#toolbar',
            fixedColumns: true,
            fixedNumber: 1,
            pagination: true,
            columns: [{
                field: 'id',
                title: 'No. SCO',
                sortable: 'true',
                width: 145
            }, {
                field: 'tglorder',
                title: 'Tgl. Order',
                sortable: 'true'
            }, {
                field: 'tgldelivery',
                title: 'Tgl. Kirim',
                sortable: 'true'
            }, {
                field: 'namacust',
                title: 'Nama Customer',
                sortable: 'true',
                width: 250
            }, {
                field: 'sales',
                title: 'Sales',
                sortable: 'true'
            }, {
                field: 'id',
                title: 'Act',
                formatter: tombol
            }]
        });

        function tombol(value, row) {
            if (lvl == '1' || lvl == '7') {
                return [
                    '<button title="Lihat detail" rel="tooltip" class="btn btn-sm btn-warning lihat" data-noco="' + value + '"><i class="fas fa-fw fa-eye"></i></button> ' +
                    '<button title="Buat Po XB" rel="tooltip" class="btn btn-sm btn-primary buats" data-noco="' + value + '"><i class="fas fa-fw fa-plus"></i> PO</button>'
                ]
            } else {
                return [
                    '<button title="Lihat detail" rel="tooltip" class="btn btn-sm btn-warning lihat" data-noco="' + value + '"><i class="fas fa-fw fa-eye"></i></button> ' +
                    '<button title="Buat Po XB" rel="tooltip" class="btn btn-sm btn-primary buats" disabled><i class="fas fa-fw fa-plus"></i> PO</button>'
                ]
            }
        }

        function sts(row, value) {
            if (row == '1|') {
                return [
                    '<span class="badge badge-secondary">Proses</span>'
                ]
            } else if (row == '1|1') {
                return [
                    '<span class="badge badge-primary">Terkirim</span>'
                ]
            } else if (row == '1|2') {
                return [
                    '<span class="badge badge-info">Terkirim Sebagian</span>'
                ]
            } else if (row == '1|3' || row == '2|3') {
                return [
                    '<span class="badge badge-success">Complete</span>'
                ]
            } else {
                return [
                    '<span class="badge badge-danger">Cancel</span>'
                ]
            }
        }

        function Rupiah(value, row) {
            var sign = 1;
            if (value < 0) {
                sign = -1;
                value = -value;
            }

            let num = value.toString().includes('.') ? value.toString().split('.')[0] : value.toString();
            let len = num.toString().length;
            let result = '';
            let count = 1;

            for (let i = len - 1; i >= 0; i--) {
                result = num.toString()[i] + result;
                if (count % 3 === 0 && count !== 0 && i !== 0) {
                    result = '.' + result;
                }
                count++;
            }

            if (value.toString().includes(',')) {
                result = result + ',' + value.toString().split('.')[1];
            }
            // return result with - sign if negative
            return sign < 0 ? '-' + result : (result ? 'Rp. ' + result : '');
        }

        $('body').on('click', '#tablemwm .lihat', function() {
            var id = $(this).data('noco');
            $.ajax({
                url: "<?= base_url('adminpo/detailCo') ?>",
                method: 'post',
                data: {
                    id: id,
                    status: status
                },
                success: function(data) {
                    $("#mco").modal('show');
                    $("#viewDetail").html(data);
                }
            });

        });
        $('body').on('click', '#tablemwm .buats', function() {
            var id = $(this).data('noco');
            window.location.href = "<?= base_url('adminpo/tambahpo/') ?>" + id;
        });
    });
    // PT. FCI
    $(document).ready(function() {
        var lvl = "<?= $user['role_id'] ?>";
        $table = $("#tablefci")
        $table.bootstrapTable({
            url: '<?= base_url('adminpo/getDatamwk/5') ?>',
            search: true,
            toolbar: '#toolbar',
            fixedColumns: true,
            fixedNumber: 1,
            pagination: true,
            columns: [{
                field: 'id',
                title: 'No. SCO',
                sortable: 'true',
                width: 145
            }, {
                field: 'tglorder',
                title: 'Tgl. Order',
                sortable: 'true'
            }, {
                field: 'tgldelivery',
                title: 'Tgl. Kirim',
                sortable: 'true'
            }, {
                field: 'namacust',
                title: 'Nama Customer',
                sortable: 'true',
                width: 250
            }, {
                field: 'sales',
                title: 'Sales',
                sortable: 'true'
            }, {
                field: 'id',
                title: 'Act',
                formatter: tombol
            }]
        });

        function tombol(value, row) {
            if (lvl == '1' || lvl == '7') {
                return [
                    '<button title="Lihat detail" rel="tooltip" class="btn btn-sm btn-warning lihat" data-noco="' + value + '"><i class="fas fa-fw fa-eye"></i></button> ' +
                    '<button title="Buat Po XB" rel="tooltip" class="btn btn-sm btn-primary buats" data-noco="' + value + '"><i class="fas fa-fw fa-plus"></i> PO</button>'
                ]
            } else {
                return [
                    '<button title="Lihat detail" rel="tooltip" class="btn btn-sm btn-warning lihat" data-noco="' + value + '"><i class="fas fa-fw fa-eye"></i></button> ' +
                    '<button title="Buat Po XB" rel="tooltip" class="btn btn-sm btn-primary buats" disabled><i class="fas fa-fw fa-plus"></i> PO</button>'
                ]
            }
        }

        function sts(row, value) {
            if (row == '1') {
                return [
                    '<span class="badge badge-success">PROCESS</span>'
                ]
            } else if (row == '0') {
                return [
                    '<span class="badge badge-warning">UNPROCESS</span>'
                ]
            } else if (row == '2') {
                return [
                    '<span class="badge badge-danger">CANCEL</span>'
                ]
            }
        }

        function sts(row, value) {
            if (row == '1|') {
                return [
                    '<span class="badge badge-secondary">Proses</span>'
                ]
            } else if (row == '1|1') {
                return [
                    '<span class="badge badge-primary">Terkirim</span>'
                ]
            } else if (row == '1|2') {
                return [
                    '<span class="badge badge-info">Terkirim Sebagian</span>'
                ]
            } else if (row == '1|3' || row == '2|3') {
                return [
                    '<span class="badge badge-success">Complete</span>'
                ]
            } else {
                return [
                    '<span class="badge badge-danger">Cancel</span>'
                ]
            }
        }

        function Rupiah(value, row) {
            var sign = 1;
            if (value < 0) {
                sign = -1;
                value = -value;
            }

            let num = value.toString().includes('.') ? value.toString().split('.')[0] : value.toString();
            let len = num.toString().length;
            let result = '';
            let count = 1;

            for (let i = len - 1; i >= 0; i--) {
                result = num.toString()[i] + result;
                if (count % 3 === 0 && count !== 0 && i !== 0) {
                    result = '.' + result;
                }
                count++;
            }

            if (value.toString().includes(',')) {
                result = result + ',' + value.toString().split('.')[1];
            }
            // return result with - sign if negative
            return sign < 0 ? '-' + result : (result ? 'Rp. ' + result : '');
        }

        $('body').on('click', '#tablefci .lihat', function() {
            var id = $(this).data('noco');
            $.ajax({
                url: "<?= base_url('adminpo/detailCo') ?>",
                method: 'post',
                data: {
                    id: id,
                    status: status
                },
                success: function(data) {
                    $("#mco").modal('show');
                    $("#viewDetail").html(data);
                }
            });

        });
        $('body').on('click', '#tablefci .buats', function() {
            var id = $(this).data('noco');
            window.location.href = "<?= base_url('adminpo/tambahpo/') ?>" + id;
        });
    });
    // PT. DTM
    $(document).ready(function() {
        var lvl = "<?= $user['role_id'] ?>";
        $table = $("#tabledtm")
        $table.bootstrapTable({
            url: '<?= base_url('adminpo/getDatamwk/4') ?>',
            search: true,
            toolbar: '#toolbar',
            fixedColumns: true,
            fixedNumber: 1,
            pagination: true,
            columns: [{
                field: 'id',
                title: 'No. SCO',
                sortable: 'true',
                width: 145
            }, {
                field: 'tglorder',
                title: 'Tgl. Order',
                sortable: 'true'
            }, {
                field: 'tgldelivery',
                title: 'Tgl. Kirim',
                sortable: 'true'
            }, {
                field: 'namacust',
                title: 'Nama Customer',
                sortable: 'true',
                width: 250
            }, {
                field: 'sales',
                title: 'Sales',
                sortable: 'true'
            }, {
                field: 'id',
                title: 'Act',
                formatter: tombol
            }]
        });

        function tombol(value, row) {
            if (lvl == '1' || lvl == '7') {
                return [
                    '<button title="Lihat detail" rel="tooltip" class="btn btn-sm btn-warning lihat" data-noco="' + value + '"><i class="fas fa-fw fa-eye"></i></button> ' +
                    '<button title="Buat Po XB" rel="tooltip" class="btn btn-sm btn-primary buats" data-noco="' + value + '"><i class="fas fa-fw fa-plus"></i> PO</button>'
                ]
            } else {
                return [
                    '<button title="Lihat detail" rel="tooltip" class="btn btn-sm btn-warning lihat" data-noco="' + value + '"><i class="fas fa-fw fa-eye"></i></button> ' +
                    '<button title="Buat Po XB" rel="tooltip" class="btn btn-sm btn-primary buats" disabled><i class="fas fa-fw fa-plus"></i> PO</button>'
                ]
            }
        }

        function sts(row, value) {
            if (row == '1') {
                return [
                    '<span class="badge badge-success">PROCESS</span>'
                ]
            } else if (row == '0') {
                return [
                    '<span class="badge badge-warning">UNPROCESS</span>'
                ]
            } else if (row == '2') {
                return [
                    '<span class="badge badge-danger">CANCEL</span>'
                ]
            }
        }

        function sts(row, value) {
            if (row == '1|') {
                return [
                    '<span class="badge badge-secondary">Proses</span>'
                ]
            } else if (row == '1|1') {
                return [
                    '<span class="badge badge-primary">Terkirim</span>'
                ]
            } else if (row == '1|2') {
                return [
                    '<span class="badge badge-info">Terkirim Sebagian</span>'
                ]
            } else if (row == '1|3' || row == '2|3') {
                return [
                    '<span class="badge badge-success">Complete</span>'
                ]
            } else {
                return [
                    '<span class="badge badge-danger">Cancel</span>'
                ]
            }
        }

        function Rupiah(value, row) {
            var sign = 1;
            if (value < 0) {
                sign = -1;
                value = -value;
            }

            let num = value.toString().includes('.') ? value.toString().split('.')[0] : value.toString();
            let len = num.toString().length;
            let result = '';
            let count = 1;

            for (let i = len - 1; i >= 0; i--) {
                result = num.toString()[i] + result;
                if (count % 3 === 0 && count !== 0 && i !== 0) {
                    result = '.' + result;
                }
                count++;
            }

            if (value.toString().includes(',')) {
                result = result + ',' + value.toString().split('.')[1];
            }
            // return result with - sign if negative
            return sign < 0 ? '-' + result : (result ? 'Rp. ' + result : '');
        }

        $('body').on('click', '#tabledtm .lihat', function() {
            var id = $(this).data('noco');
            $.ajax({
                url: "<?= base_url('adminpo/detailCo') ?>",
                method: 'post',
                data: {
                    id: id,
                    status: status
                },
                success: function(data) {
                    $("#mco").modal('show');
                    $("#viewDetail").html(data);
                }
            });

        });
        $('body').on('click', '#tabledtm .buats', function() {
            var id = $(this).data('noco');
            window.location.href = "<?= base_url('adminpo/tambahpo/') ?>" + id;
        });
    });
</script>