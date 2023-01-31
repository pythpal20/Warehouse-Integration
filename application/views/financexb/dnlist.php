<div class="modal fade" id="seepop" tabindex="-1" aria-labelledby="seepopLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="seepopLabel">Delivery Note Detail</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body dndetail">
            </div>
            <div class="modal-footer">
                <?php if ($user['role_id'] == '8' || $user['role_id'] == '6' || $user['role_id'] == '1') : ?>
                    <button class="btn btn-primary print"><i class="fas fa-fw fa-download"></i> Download</button>
                <?php endif; ?>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<!--  -->
<div class="modal fade" id="setoran" tabindex="-1" aria-labelledby="setoranLabel" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="setoranLabel">Form Input Setoran</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?= base_url('financexb/dnlist'); ?>" method="POST">
                    <div class="form-group">
                        <label for="">ID DN</label>
                        <input type="text" name="dnid" id="dnid" class="form-control" readonly>
                        <input type="hidden" name="code" id="code" class="form-control" readonly>
                    </div>
                    <div class="form-group">
                        <label for="">Tgl. Bayar</label>
                        <input type="date" name="tglb" id="tglb" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="">Nominal Bayar</label>
                        <input type="text" name="nomb" id="nomb" class="form-control nomb">
                    </div>
                    <div class="form-group">
                        <label for="">No. Referensi</label>
                        <input type="text" name="norf" id="norf" class="form-control" placeholder="No. Surat/ Bukti TF/ Keterangan/ Dll">
                        <input type="hidden" name="nuser" id="nuser" value="<?= $user['user_nama'] ?>">
                    </div>
                    <hr>
                    <button class="btn btn-primary btn-sm simpan float-right" type="submit">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- end of modal pop-up -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h4 class="h4 mb-2 text-gray-800"><?= $title; ?></h4>
    <?= $this->session->flashdata('message'); ?>
    <div class="card">
        <div class="card-body">
            <?= form_error('dnid', '<span class="badge badge-warning"><small class="text-danger pl-3">', '</small></span>'); ?>
            <?= form_error('tglb', '<span class="badge badge-warning"><small class="text-danger pl-3">', '</small></span>'); ?>
            <?= form_error('nomb', '<span class="badge badge-warning"><small class="text-danger pl-3">', '</small></span>'); ?>
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
            <!--  -->
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
<!-- JavaScript -->
<script>
    // tablemwk
    $(document).ready(function() {
        var lev = "<?= $user['role_id']; ?>";
        $table = $("#tablemwk")
        $table.bootstrapTable({
            url: "<?= base_url('financexb/dataDN/1'); ?>",
            search: true,
            pagination: true,
            columns: [{
                field: 'id',
                title: 'No. DN'
            }, {
                field: 'date',
                title: 'Tgl. DN'
            }, {
                field: 'poxb',
                title: 'PO XB',
                sortable: 'true'
            }, {
                field: 'nomawal',
                title: 'Nominal Tagihan',
                formatter: Rupiah,
                sortable: 'true'
            }, {
                field: 'nomakhir',
                title: 'Nominal Bayar',
                formatter: function(value, row) {
                    if (value != null) {
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
                    } else {
                        return [
                            'Rp. 0'
                        ]
                    }
                },
                sortable: 'true'
            }, {
                field: 'status',
                title: 'Status',
                sortable: 'true',
                formatter: function(value) {
                    if (value == '1') {
                        return [
                            '<span class="badge badge-danger">Unpaid</span>'
                        ]
                    } else if (value == '2') {
                        return [
                            '<span class="badge badge-warning">Partially Paid</span>'
                        ]
                    } else if (value == '3') {
                        return [
                            '<span class="badge badge-success">Paid</span>'
                        ]
                    }
                }
            }, {
                field: '',
                title: 'Action',
                formatter: tombol,
                align: 'center'
            }]
        });

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

        function tombol(value, row) {
            if (lev == '6') {
                return [
                    '<button data-po="' + row.id + '" class="btn btn-sm btn-info lihat"><i class="fas fa-fw fa-eye"></i></button> ' +
                    '<button data-po="' + row.id + '" data-min="'+row.nomawal+'" data-max="'+row.nomakhir+'" class="btn btn-sm btn-primary bayar" rel="tooltip" title="Input pembayaran"><span class="fas fa-fw fa-money-bill-wave"></span></button>'
                ]
            } else {
                return [
                    '<button data-po="' + row.id + '" class="btn btn-sm btn-warning lihat"><i class="fas fa-fw fa-eye"></i></button>'
                ]
            }
        }

        $("body").on("click", "#tablemwk .lihat", function() {
            var nodn = $(this).data('po');
            $.ajax({
                url: "<?= base_url('financexb/detailDn'); ?>",
                method: 'POST',
                data: {
                    id: nodn
                },
                success: function(data) {
                    $("#seepop").modal({
                        backdrop: 'static',
                        keyboard: true,
                        show: true
                    });
                    $(".modal-body").html(data);
                    $(".print").click(() => {
                        window.location.href = "<?= base_url('financexb/printpo/'); ?>" + nodn;
                    });
                }
            });
        });
        $("body").on("click", "#tablemwk .bayar", function() {
            var nodn = $(this).data('po');
            var min = $(this).data('min');
            var max = $(this).data('max');
            function makeid(length) {
                var result = [];
                var characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
                var charactersLength = characters.length;
                for (var i = 0; i < length; i++) {
                    result.push(characters.charAt(Math.floor(Math.random() *
                        charactersLength)));
                }
                return result.join('');
            }

            var codex = makeid(8);
            document.getElementById("code").value = codex;

            $("#setoran").modal('show');
            $("#dnid").val(nodn);

            $(".nomb").keyup(function() {
                var nominal = $("#nomb").val();
                var total = parseInt(nominal) + parseInt(max);
                if(total > min) {
                    swal.fire(
                        'Galat',
                        'Nominal Melebihi tagihan, Ulangi',
                        'warning'
                    );
                    $("#nomb").val('')
                }
            });
        });
    });

    // tablemwm
    $(document).ready(function() {
        var lev = "<?= $user['role_id']; ?>";
        $table = $("#tablemwm")
        $table.bootstrapTable({
            url: "<?= base_url('financexb/dataDN/2'); ?>",
            search: true,
            pagination: true,
            columns: [{
                field: 'id',
                title: 'No. DN'
            }, {
                field: 'date',
                title: 'Tgl. DN'
            }, {
                field: 'poxb',
                title: 'PO XB',
                sortable: 'true'
            }, {
                field: 'nomawal',
                title: 'Nominal Tagihan',
                formatter: Rupiah,
                sortable: 'true'
            }, {
                field: 'nomakhir',
                title: 'Nominal Bayar',
                formatter: function(value, row) {
                    if (value != null) {
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
                    } else {
                        return [
                            'Rp. 0'
                        ]
                    }
                },
                sortable: 'true'
            }, {
                field: 'status',
                title: 'Status',
                sortable: 'true',
                formatter: function(value) {
                    if (value == '1') {
                        return [
                            '<span class="badge badge-danger">Unpaid</span>'
                        ]
                    } else if (value == '2') {
                        return [
                            '<span class="badge badge-warning">Partially Paid</span>'
                        ]
                    } else if (value == '3') {
                        return [
                            '<span class="badge badge-success">Paid</span>'
                        ]
                    }
                }
            }, {
                field: '',
                title: 'Action',
                formatter: tombol,
                align: 'center'
            }]
        });

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

        function tombol(value, row) {
            if (lev == '6') {
                return [
                    '<button data-po="' + row.id + '" class="btn btn-sm btn-info lihat"><i class="fas fa-fw fa-eye"></i></button> ' +
                    '<button data-po="' + row.id + '" data-min="'+row.nomawal+'" data-max="'+row.nomakhir+'" class="btn btn-sm btn-primary bayar" rel="tooltip" title="Input pembayaran"><span class="fas fa-fw fa-money-bill-wave"></span></button>'
                ]
            } else {
                return [
                    '<button data-po="' + row.id + '" class="btn btn-sm btn-warning lihat"><i class="fas fa-fw fa-eye"></i></button>'
                ]
            }
        }

        $("body").on("click", "#tablemwm .lihat", function() {
            var nodn = $(this).data('po');
            $.ajax({
                url: "<?= base_url('financexb/detailDn'); ?>",
                method: 'POST',
                data: {
                    id: nodn
                },
                success: function(data) {
                    $("#seepop").modal({
                        backdrop: 'static',
                        keyboard: true,
                        show: true
                    });
                    $(".modal-body").html(data);
                    $(".print").click(() => {
                        window.location.href = "<?= base_url('financexb/printpo/'); ?>" + nodn;
                    });
                }
            });
        });
        $("body").on("click", "#tablemwm .bayar", function() {
            var nodn = $(this).data('po');
            var min = $(this).data('min');
            var max = $(this).data('max');
            function makeid(length) {
                var result = [];
                var characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
                var charactersLength = characters.length;
                for (var i = 0; i < length; i++) {
                    result.push(characters.charAt(Math.floor(Math.random() *
                        charactersLength)));
                }
                return result.join('');
            }

            var codex = makeid(8);
            document.getElementById("code").value = codex;

            $("#setoran").modal('show');
            $("#dnid").val(nodn);

            $(".nomb").keyup(function() {
                var nominal = $("#nomb").val();
                var total = parseInt(nominal) + parseInt(max);
                if(total > min) {
                    swal.fire(
                        'Galat',
                        'Nominal Melebihi tagihan, Ulangi',
                        'warning'
                    );
                    $("#nomb").val('')
                }
            });
        });
    });

    // tablebak
    $(document).ready(function() {
        var lev = "<?= $user['role_id']; ?>";
        $table = $("#tablebak")
        $table.bootstrapTable({
            url: "<?= base_url('financexb/dataDN/3'); ?>",
            search: true,
            pagination: true,
            columns: [{
                field: 'id',
                title: 'No. DN'
            }, {
                field: 'date',
                title: 'Tgl. DN'
            }, {
                field: 'poxb',
                title: 'PO XB',
                sortable: 'true'
            }, {
                field: 'nomawal',
                title: 'Nominal Tagihan',
                formatter: Rupiah,
                sortable: 'true'
            }, {
                field: 'nomakhir',
                title: 'Nominal Bayar',
                formatter: function(value, row) {
                    if (value != null) {
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
                    } else {
                        return [
                            'Rp. 0'
                        ]
                    }
                },
                sortable: 'true'
            }, {
                field: 'status',
                title: 'Status',
                sortable: 'true',
                formatter: function(value) {
                    if (value == '1') {
                        return [
                            '<span class="badge badge-danger">Unpaid</span>'
                        ]
                    } else if (value == '2') {
                        return [
                            '<span class="badge badge-warning">Partially Paid</span>'
                        ]
                    } else if (value == '3') {
                        return [
                            '<span class="badge badge-success">Paid</span>'
                        ]
                    }
                }
            }, {
                field: '',
                title: 'Action',
                formatter: tombol,
                align: 'center'
            }]
        });

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

        function tombol(value, row) {
            if (lev == '6') {
                return [
                    '<button data-po="' + row.id + '" class="btn btn-sm btn-info lihat"><i class="fas fa-fw fa-eye"></i></button> ' +
                    '<button data-po="' + row.id + '" data-min="'+row.nomawal+'" data-max="'+row.nomakhir+'" class="btn btn-sm btn-primary bayar" rel="tooltip" title="Input pembayaran"><span class="fas fa-fw fa-money-bill-wave"></span></button>'
                ]
            } else {
                return [
                    '<button data-po="' + row.id + '" class="btn btn-sm btn-warning lihat"><i class="fas fa-fw fa-eye"></i></button>'
                ]
            }
        }

        $("body").on("click", "#tablebak .lihat", function() {
            var nodn = $(this).data('po');
            $.ajax({
                url: "<?= base_url('financexb/detailDn'); ?>",
                method: 'POST',
                data: {
                    id: nodn
                },
                success: function(data) {
                    $("#seepop").modal({
                        backdrop: 'static',
                        keyboard: true,
                        show: true
                    });
                    $(".modal-body").html(data);
                    $(".print").click(() => {
                        window.location.href = "<?= base_url('financexb/printpo/'); ?>" + nodn;
                    });
                }
            });
        });
        $("body").on("click", "#tablebak .bayar", function() {
            var nodn = $(this).data('po');
            var min = $(this).data('min');
            var max = $(this).data('max');
            function makeid(length) {
                var result = [];
                var characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
                var charactersLength = characters.length;
                for (var i = 0; i < length; i++) {
                    result.push(characters.charAt(Math.floor(Math.random() *
                        charactersLength)));
                }
                return result.join('');
            }

            var codex = makeid(8);
            document.getElementById("code").value = codex;

            $("#setoran").modal('show');
            $("#dnid").val(nodn);

            $(".nomb").keyup(function() {
                var nominal = $("#nomb").val();
                var total = parseInt(nominal) + parseInt(max);
                if(total > min) {
                    swal.fire(
                        'Galat',
                        'Nominal Melebihi tagihan, Ulangi',
                        'warning'
                    );
                    $("#nomb").val('')
                }
            });
        });
    });

    // tablefci
    $(document).ready(function() {
        var lev = "<?= $user['role_id']; ?>";
        $table = $("#tablefci")
        $table.bootstrapTable({
            url: "<?= base_url('financexb/dataDN/5'); ?>",
            search: true,
            pagination: true,
            columns: [{
                field: 'id',
                title: 'No. DN'
            }, {
                field: 'date',
                title: 'Tgl. DN'
            }, {
                field: 'poxb',
                title: 'PO XB',
                sortable: 'true'
            }, {
                field: 'nomawal',
                title: 'Nominal Tagihan',
                formatter: Rupiah,
                sortable: 'true'
            }, {
                field: 'nomakhir',
                title: 'Nominal Bayar',
                formatter: function(value, row) {
                    if (value != null) {
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
                    } else {
                        return [
                            'Rp. 0'
                        ]
                    }
                },
                sortable: 'true'
            }, {
                field: 'status',
                title: 'Status',
                sortable: 'true',
                formatter: function(value) {
                    if (value == '1') {
                        return [
                            '<span class="badge badge-danger">Unpaid</span>'
                        ]
                    } else if (value == '2') {
                        return [
                            '<span class="badge badge-warning">Partially Paid</span>'
                        ]
                    } else if (value == '3') {
                        return [
                            '<span class="badge badge-success">Paid</span>'
                        ]
                    }
                }
            }, {
                field: '',
                title: 'Action',
                formatter: tombol,
                align: 'center'
            }]
        });

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

        function tombol(value, row) {
            if (lev == '6') {
                return [
                    '<button data-po="' + row.id + '" class="btn btn-sm btn-info lihat"><i class="fas fa-fw fa-eye"></i></button> ' +
                    '<button data-po="' + row.id + '" data-min="'+row.nomawal+'" data-max="'+row.nomakhir+'" class="btn btn-sm btn-primary bayar" rel="tooltip" title="Input pembayaran"><span class="fas fa-fw fa-money-bill-wave"></span></button>'
                ]
            } else {
                return [
                    '<button data-po="' + row.id + '" class="btn btn-sm btn-warning lihat"><i class="fas fa-fw fa-eye"></i></button>'
                ]
            }
        }

        $("body").on("click", "#tablefci .lihat", function() {
            var nodn = $(this).data('po');
            $.ajax({
                url: "<?= base_url('financexb/detailDn'); ?>",
                method: 'POST',
                data: {
                    id: nodn
                },
                success: function(data) {
                    $("#seepop").modal({
                        backdrop: 'static',
                        keyboard: true,
                        show: true
                    });
                    $(".modal-body").html(data);
                    $(".print").click(() => {
                        window.location.href = "<?= base_url('financexb/printpo/'); ?>" + nodn;
                    });
                }
            });
        });
        $("body").on("click", "#tablefci .bayar", function() {
            var nodn = $(this).data('po');
            var min = $(this).data('min');
            var max = $(this).data('max');
            function makeid(length) {
                var result = [];
                var characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
                var charactersLength = characters.length;
                for (var i = 0; i < length; i++) {
                    result.push(characters.charAt(Math.floor(Math.random() *
                        charactersLength)));
                }
                return result.join('');
            }

            var codex = makeid(8);
            document.getElementById("code").value = codex;

            $("#setoran").modal('show');
            $("#dnid").val(nodn);

            $(".nomb").keyup(function() {
                var nominal = $("#nomb").val();
                var total = parseInt(nominal) + parseInt(max);
                if(total > min) {
                    swal.fire(
                        'Galat',
                        'Nominal Melebihi tagihan, Ulangi',
                        'warning'
                    );
                    $("#nomb").val('')
                }
            });
        });
    });

    // 
    $(document).ready(function() {
        var lev = "<?= $user['role_id']; ?>";
        $table = $("#tabledtm")
        $table.bootstrapTable({
            url: "<?= base_url('financexb/dataDN/4'); ?>",
            search: true,
            pagination: true,
            columns: [{
                field: 'id',
                title: 'No. DN'
            }, {
                field: 'date',
                title: 'Tgl. DN'
            }, {
                field: 'poxb',
                title: 'PO XB',
                sortable: 'true'
            }, {
                field: 'nomawal',
                title: 'Nominal Tagihan',
                formatter: Rupiah,
                sortable: 'true'
            }, {
                field: 'nomakhir',
                title: 'Nominal Bayar',
                formatter: function(value, row) {
                    if (value != null) {
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
                    } else {
                        return [
                            'Rp. 0'
                        ]
                    }
                },
                sortable: 'true'
            }, {
                field: 'status',
                title: 'Status',
                sortable: 'true',
                formatter: function(value) {
                    if (value == '1') {
                        return [
                            '<span class="badge badge-danger">Unpaid</span>'
                        ]
                    } else if (value == '2') {
                        return [
                            '<span class="badge badge-warning">Partially Paid</span>'
                        ]
                    } else if (value == '3') {
                        return [
                            '<span class="badge badge-success">Paid</span>'
                        ]
                    }
                }
            }, {
                field: '',
                title: 'Action',
                formatter: tombol,
                align: 'center'
            }]
        });

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

        function tombol(value, row) {
            if (lev == '6') {
                return [
                    '<button data-po="' + row.id + '" class="btn btn-sm btn-info lihat"><i class="fas fa-fw fa-eye"></i></button> ' +
                    '<button data-po="' + row.id + '" data-min="'+row.nomawal+'" data-max="'+row.nomakhir+'" class="btn btn-sm btn-primary bayar" rel="tooltip" title="Input pembayaran"><span class="fas fa-fw fa-money-bill-wave"></span></button>'
                ]
            } else {
                return [
                    '<button data-po="' + row.id + '" class="btn btn-sm btn-warning lihat"><i class="fas fa-fw fa-eye"></i></button>'
                ]
            }
        }

        $("body").on("click", "#tabledtm .lihat", function() {
            var nodn = $(this).data('po');
            $.ajax({
                url: "<?= base_url('financexb/detailDn'); ?>",
                method: 'POST',
                data: {
                    id: nodn
                },
                success: function(data) {
                    $("#seepop").modal({
                        backdrop: 'static',
                        keyboard: true,
                        show: true
                    });
                    $(".modal-body").html(data);
                    $(".print").click(() => {
                        window.location.href = "<?= base_url('financexb/printpo/'); ?>" + nodn;
                    });
                }
            });
        });
        $("body").on("click", "#tabledtm .bayar", function() {
            var nodn = $(this).data('po');
            var min = $(this).data('min');
            var max = $(this).data('max');
            function makeid(length) {
                var result = [];
                var characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
                var charactersLength = characters.length;
                for (var i = 0; i < length; i++) {
                    result.push(characters.charAt(Math.floor(Math.random() *
                        charactersLength)));
                }
                return result.join('');
            }

            var codex = makeid(8);
            document.getElementById("code").value = codex;

            $("#setoran").modal('show');
            $("#dnid").val(nodn);

            $(".nomb").keyup(function() {
                var nominal = $("#nomb").val();
                var total = parseInt(nominal) + parseInt(max);
                if(total > min) {
                    swal.fire(
                        'Galat',
                        'Nominal Melebihi tagihan, Ulangi',
                        'warning'
                    );
                    $("#nomb").val('')
                }
            });
        });
    });
</script>