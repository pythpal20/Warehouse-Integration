<div class="modal fade" id="popupConf" tabindex="-1" aria-labelledby="popupConfLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="popupConfLabel">Konfirmasi Delivery Note ?</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="formConfirm">
                    <div class="form-group">
                        <label for="nodn">Delivery Note ID</label>
                        <input type="text" id="dnid" name="dnid" class="form-control" readonly>
                        <input type="hidden" name="nopox" id="nopox">
                    </div>
                    <div class="form-group">
                        <label for="noref">No. Ref/ Surat Jalan/ etc.</label>
                        <textarea name="noref" id="noref" cols="30" rows="3" class="form-control"></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary sippan"><span class="fas fa-fw fa-save"></span> Save</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<!--  -->
<div class="modal fade" id="popBl" tabindex="-1" aria-labelledby="popBlLable" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="popBlLable">Detail BL</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="detailBL"></div>
            </div>
        </div>
    </div>
</div>  
<!---->
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
                <!-- Finance MK/ XB || IT administrator -->
                <?php if ($user['role_id'] == '8' || $user['role_id'] == '6' || $user['role_id'] == '1' || $user['role_id'] == '11' || $user['role_id'] == '7') : ?>
                    <button class="btn btn-primary print"><i class="fas fa-fw fa-download"></i> Download</button>
                <?php endif; ?>
                <!-- admin gudang -->
                <?php if ($user['role_id'] == '3') : ?>
                    <button class="btn btn-primary unduh"><i class="fas fa-fw fa-download"></i> Download</button>
                <?php endif; ?>
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
    <div class="card">
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
<!-- javascript -->
<script>
    // table mwk
    $(document).ready(function() {
        var lev = "<?= $user['role_id']; ?>";
        $table = $("#tablemwk")
        $table.bootstrapTable({
            url: "<?= base_url('deliverynote/getDataDN/1'); ?>",
            search: true,
            pagination: true,
            columns: [{
                field: 'id',
                title: 'No. DN'
            }, {
                field: 'date',
                title: 'Tgl. DN',
                sortable: 'true'
            }, {
                field: 'bl',
                title: 'No. BL', 
                formatter: function(value) {
                    return [
                        '<a class="lihatBL" data-bls="' + value + '">' + value + '</a>'
                    ]
                }
            }, {
                field: 'cust',
                title: 'End User'
            }, {
                field: '',
                title: 'Action',
                formatter: tombol,
                align: 'center'
            }]
        });

        function tombol(value, row) {
            if (lev == '8' || lev == '1') {
                return [
                    '<button data-po="' + row.id + '" class="btn btn-sm btn-warning lihat"><i class="fas fa-fw fa-eye"></i></button> ' +
                    '<button data-po="' + row.id + '" data-pox="' + row.poxb + '" class="btn btn-sm btn-primary approve"><i class="fas fa-fw fa-check"></i></button>'
                ]
            } else {
                return [
                    '<button data-po="' + row.id + '" class="btn btn-sm btn-warning lihat"><i class="fas fa-fw fa-eye"></i></button> ' +
                    '<button class="btn btn-sm btn-primary disabled"><i class="fas fa-fw fa-check"></i></button>'
                ]
            }
        }
        
        $("body").on("click", "#tablemwk .lihatBL", function() {
            var nobl = $(this).attr('data-bls');
            $.ajax({
                url: "<?= base_url('deliverynote/detailbL'); ?>",
                method: 'POST',
                data: {
                    id: nobl
                }, 
                success: function(data) {
                    $("#popBl").modal({
                        backdrop: 'static',
                        keyboard: true,
                        show: true
                    });
                    $("#detailBL").html(data);
                }
            });
        });
        
        $("body").on("click", "#tablemwk .lihat", function() {
            var nodn = $(this).data('po');
            $.ajax({
                url: "<?= base_url('deliverynote/detailDn'); ?>",
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
                    $(".dndetail").html(data);
                    $(".print").click(() => {
                        window.location.href = "<?= base_url('deliverynote/printpo/'); ?>" + nodn;
                    });
                    $(".unduh").click(() => {
                        window.location.href = "<?= base_url('deliverynote/unduhpo/'); ?>" + nodn;
                    });
                }
            });
        });

        $("body").on("click", "#tablemwk .approve", function() {
            var nodn = $(this).data('po');
            var poxb = $(this).data('pox');
            swal.fire({
                title: 'Konfirmasi Delivery Note',
                text: 'Aksi ini akan merubah status DN menjadi Complete, Lakukan pengecekan terlebih dahulu',
                icon: 'warning',
                showCancelButton: true,
                cancelButtonColor: '#FA8072',
                confirmButtonColor: '#20B2AA',
                allowOutsideClick: false
            }).then((result) => {
                if (result.isConfirmed) {
                    // $("#popupConf").modal('show');
                    $("#dnid").val(nodn);
                    $("#nopox").val(poxb);

                    $.ajax({
                        url: "<?= base_url('deliverynote/confirmdn'); ?>",
                        method: 'POST',
                        data: {
                            dnid: nodn,
                            nopox: poxb
                        },
                        success: function(data) {
                            console.log(data);
                            swal.fire({
                                title: 'Berhasil',
                                text: 'Terimakasih sudah Konfirmasi DN',
                                icon: 'success'
                            }).then((res) => {
                                if (res.isConfirmed) {
                                    window.location.reload();
                                }
                            });
                        }
                    });
                }
            });
        });
    });
    // table MWM
    $(document).ready(function() {
        var lev = "<?= $user['role_id']; ?>";
        $table = $("#tablemwm")
        $table.bootstrapTable({
            url: "<?= base_url('deliverynote/getDataDN/2'); ?>",
            search: true,
            pagination: true,
            columns: [{
                field: 'id',
                title: 'No. DN'
            }, {
                field: 'date',
                title: 'Tgl. DN'
            }, {
                field: 'bl',
                title: 'No. BL',
                formatter: function(value) {
                    return [
                        '<a class="lihatBL" data-bls="' + value + '">' + value + '</a>'
                    ]
                }
            }, {
                field: 'cust',
                title: 'End User'
            }, {
                field: '',
                title: 'Action',
                formatter: tombol,
                align: 'center'
            }]
        });

        function tombol(value, row) {
            if (lev == '8' || lev == '1') {
                return [
                    '<button data-po="' + row.id + '" class="btn btn-sm btn-warning lihat"><i class="fas fa-fw fa-eye"></i></button> ' +
                    '<button data-po="' + row.id + '" data-pox="' + row.poxb + '" class="btn btn-sm btn-primary approve"><i class="fas fa-fw fa-check"></i></button>'
                ]
            } else {
                return [
                    '<button data-po="' + row.id + '" class="btn btn-sm btn-warning lihat"><i class="fas fa-fw fa-eye"></i></button> ' +
                    '<button class="btn btn-sm btn-primary disabled"><i class="fas fa-fw fa-check"></i></button>'
                ]
            }
        }
        
        $("body").on("click", "#tablemwm .lihatBL", function() {
            var nobl = $(this).attr('data-bls');
            $.ajax({
                url: "<?= base_url('deliverynote/detailbL'); ?>",
                method: 'POST',
                data: {
                    id: nobl
                }, 
                success: function(data) {
                    $("#popBl").modal({
                        backdrop: 'static',
                        keyboard: true,
                        show: true
                    });
                    $("#detailBL").html(data);
                }
            });
        });
        
        $("body").on("click", "#tablemwm .lihat", function() {
            var nodn = $(this).data('po');
            $.ajax({
                url: "<?= base_url('deliverynote/detailDn'); ?>",
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
                    $(".dndetail").html(data);
                    $(".print").click(() => {
                        window.location.href = "<?= base_url('deliverynote/printpo/'); ?>" + nodn;
                    });
                    $(".unduh").click(() => {
                        window.location.href = "<?= base_url('deliverynote/unduhpo/'); ?>" + nodn;
                    });
                }
            });
        });
        $("body").on("click", "#tablemwm .approve", function() {
            var nodn = $(this).data('po');
            var poxb = $(this).data('pox');
            swal.fire({
                title: 'Konfirmasi Delivery Note',
                text: 'Aksi ini akan merubah status DN menjadi Complete, Lakukan pengecekan terlebih dahulu',
                icon: 'warning',
                showCancelButton: true,
                cancelButtonColor: '#FA8072',
                confirmButtonColor: '#20B2AA',
                allowOutsideClick: false
            }).then((result) => {
                if (result.isConfirmed) {
                    // $("#popupConf").modal('show');
                    $("#dnid").val(nodn);
                    $("#nopox").val(poxb);

                    $.ajax({
                        url: "<?= base_url('deliverynote/confirmdn'); ?>",
                        method: 'POST',
                        data: {
                            dnid: nodn,
                            nopox: poxb
                        },
                        success: function(data) {
                            console.log(data);
                            swal.fire({
                                title: 'Berhasil',
                                text: 'Terimakasih sudah Konfirmasi DN',
                                icon: 'success'
                            }).then((res) => {
                                if (res.isConfirmed) {
                                    window.location.reload();
                                }
                            });
                        }
                    });
                }
            });
        });
    });
    // table BAK
    $(document).ready(function() {
        var lev = "<?= $user['role_id']; ?>";
        $table = $("#tablebak")
        $table.bootstrapTable({
            url: "<?= base_url('deliverynote/getDataDN/3'); ?>",
            search: true,
            pagination: true,
            columns: [{
                field: 'id',
                title: 'No. DN'
            }, {
                field: 'date',
                title: 'Tgl. DN'
            }, {
                field: 'bl',
                title: 'No. BL',
                formatter: function(value) {
                    return [
                        '<a class="lihatBL" data-bls="' + value + '">' + value + '</a>'
                    ]
                }
            }, {
                field: 'cust',
                title: 'End User'
            }, {
                field: '',
                title: 'Action',
                formatter: tombol,
                align: 'center'
            }]
        });

        function tombol(value, row) {
            if (lev == '8' || lev == '1') {
                return [
                    '<button data-po="' + row.id + '" class="btn btn-sm btn-warning lihat"><i class="fas fa-fw fa-eye"></i></button> ' +
                    '<button data-po="' + row.id + '" data-pox="' + row.poxb + '" class="btn btn-sm btn-primary approve"><i class="fas fa-fw fa-check"></i></button>'
                ]
            } else {
                return [
                    '<button data-po="' + row.id + '" class="btn btn-sm btn-warning lihat"><i class="fas fa-fw fa-eye"></i></button> ' +
                    '<button class="btn btn-sm btn-primary disabled"><i class="fas fa-fw fa-check"></i></button>'
                ]
            }
        }
        
        $("body").on("click", "#tablebak .lihatBL", function() {
            var nobl = $(this).attr('data-bls');
            $.ajax({
                url: "<?= base_url('deliverynote/detailbL'); ?>",
                method: 'POST',
                data: {
                    id: nobl
                }, 
                success: function(data) {
                    $("#popBl").modal({
                        backdrop: 'static',
                        keyboard: true,
                        show: true
                    });
                    $("#detailBL").html(data);
                }
            });
        });
        
        $("body").on("click", "#tablebak .lihat", function() {
            var nodn = $(this).data('po');
            $.ajax({
                url: "<?= base_url('deliverynote/detailDn'); ?>",
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
                    $(".dndetail").html(data);
                    $(".print").click(() => {
                        window.location.href = "<?= base_url('deliverynote/printpo/'); ?>" + nodn;
                    });
                    $(".unduh").click(() => {
                        window.location.href = "<?= base_url('deliverynote/unduhpo/'); ?>" + nodn;
                    });
                }
            });
        });
        $("body").on("click", "#tablebak .approve", function() {
            var nodn = $(this).data('po');
            var poxb = $(this).data('pox');
            swal.fire({
                title: 'Konfirmasi Delivery Note',
                text: 'Aksi ini akan merubah status DN menjadi Complete, Lakukan pengecekan terlebih dahulu',
                icon: 'warning',
                showCancelButton: true,
                cancelButtonColor: '#FA8072',
                confirmButtonColor: '#20B2AA',
                allowOutsideClick: false
            }).then((result) => {
                if (result.isConfirmed) {
                    // $("#popupConf").modal('show');
                    $("#dnid").val(nodn);
                    $("#nopox").val(poxb);
                    $.ajax({
                        url: "<?= base_url('deliverynote/confirmdn'); ?>",
                        method: 'POST',
                        data: {
                            dnid: nodn,
                            nopox: poxb
                        },
                        success: function(data) {
                            console.log(data);
                            swal.fire({
                                title: 'Berhasil',
                                text: 'Terimakasih sudah Konfirmasi DN',
                                icon: 'success'
                            }).then((res) => {
                                if (res.isConfirmed) {
                                    window.location.reload();
                                }
                            });
                        }
                    });
                }
            });
        });
    });
    // table FCI
    $(document).ready(function() {
        var lev = "<?= $user['role_id']; ?>";
        $table = $("#tablefci")
        $table.bootstrapTable({
            url: "<?= base_url('deliverynote/getDataDN/5'); ?>",
            search: true,
            pagination: true,
            columns: [{
                field: 'id',
                title: 'No. DN'
            }, {
                field: 'date',
                title: 'Tgl. DN'
            }, {
                field: 'bl',
                title: 'No. BL',
                formatter: function(value) {
                    return [
                        '<a class="lihatBL" data-bls="' + value + '">' + value + '</a>'
                    ]
                }
            }, {
                field: 'cust',
                title: 'End User'
            }, {
                field: '',
                title: 'Action',
                formatter: tombol,
                align: 'center'
            }]
        });

        function tombol(value, row) {
            if (lev == '8' || lev == '1') {
                return [
                    '<button data-po="' + row.id + '" class="btn btn-sm btn-warning lihat"><i class="fas fa-fw fa-eye"></i></button> ' +
                    '<button data-po="' + row.id + '" data-pox="' + row.poxb + '" class="btn btn-sm btn-primary approve"><i class="fas fa-fw fa-check"></i></button>'
                ]
            } else {
                return [
                    '<button data-po="' + row.id + '" class="btn btn-sm btn-warning lihat"><i class="fas fa-fw fa-eye"></i></button> ' +
                    '<button class="btn btn-sm btn-primary disabled"><i class="fas fa-fw fa-check"></i></button>'
                ]
            }
        }
        
        $("body").on("click", "#tablefci .lihatBL", function() {
            var nobl = $(this).attr('data-bls');
            $.ajax({
                url: "<?= base_url('deliverynote/detailbL'); ?>",
                method: 'POST',
                data: {
                    id: nobl
                }, 
                success: function(data) {
                    $("#popBl").modal({
                        backdrop: 'static',
                        keyboard: true,
                        show: true
                    });
                    $("#detailBL").html(data);
                }
            });
        });
        
        $("body").on("click", "#tablefci .lihat", function() {
            var nodn = $(this).data('po');
            $.ajax({
                url: "<?= base_url('deliverynote/detailDn'); ?>",
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
                    $(".dndetail").html(data);
                    $(".print").click(() => {
                        window.location.href = "<?= base_url('deliverynote/printpo/'); ?>" + nodn;
                    });
                    $(".unduh").click(() => {
                        window.location.href = "<?= base_url('deliverynote/unduhpo/'); ?>" + nodn;
                    });
                }
            });
        });

        $("body").on("click", "#tablefci .approve", function() {
            var poxb = $(this).data('pox');
            var nodn = $(this).data('po');
            swal.fire({
                title: 'Konfirmasi Delivery Note',
                text: 'Aksi ini akan merubah status DN menjadi Complete, Lakukan pengecekan terlebih dahulu',
                icon: 'warning',
                showCancelButton: true,
                cancelButtonColor: '#FA8072',
                confirmButtonColor: '#20B2AA',
                allowOutsideClick: false
            }).then((result) => {
                if (result.isConfirmed) {
                    // $("#popupConf").modal('show');
                    $("#dnid").val(nodn);
                    $("#nopox").val(poxb);
                    $.ajax({
                        url: "<?= base_url('deliverynote/confirmdn'); ?>",
                        method: 'POST',
                        data: {
                            dnid: nodn,
                            nopox: poxb
                        },
                        success: function(data) {
                            console.log(data);
                            swal.fire({
                                title: 'Berhasil',
                                text: 'Terimakasih sudah Konfirmasi DN',
                                icon: 'success'
                            }).then((res) => {
                                if (res.isConfirmed) {
                                    window.location.reload();
                                }
                            });
                        }
                    });
                }
            });
        });
    });
    // table DTM
    $(document).ready(function() {
        var lev = "<?= $user['role_id']; ?>";
        $table = $("#tabledtm")
        $table.bootstrapTable({
            url: "<?= base_url('deliverynote/getDataDN/4'); ?>",
            search: true,
            pagination: true,
            columns: [{
                field: 'id',
                title: 'No. DN'
            }, {
                field: 'date',
                title: 'Tgl. DN'
            }, {
                field: 'bl',
                title: 'No. BL',
                formatter: function(value) {
                    return [
                        '<a class="lihatBL" data-bls="' + value + '">' + value + '</a>'
                    ]
                }
            }, {
                field: 'cust',
                title: 'End User'
            }, {
                field: '',
                title: 'Action',
                formatter: tombol,
                align: 'center'
            }]
        });

        function tombol(value, row) {
            if (lev == '8' || lev == '1') {
                return [
                    '<button data-po="' + row.id + '" class="btn btn-sm btn-warning lihat"><i class="fas fa-fw fa-eye"></i></button> ' +
                    '<button data-po="' + row.id + '" data-pox="' + row.poxb + '" class="btn btn-sm btn-primary approve"><i class="fas fa-fw fa-check"></i></button>'
                ]
            } else {
                return [
                    '<button data-po="' + row.id + '" class="btn btn-sm btn-warning lihat"><i class="fas fa-fw fa-eye"></i></button> ' +
                    '<button class="btn btn-sm btn-primary disabled"><i class="fas fa-fw fa-check"></i></button>'
                ]
            }
        }
        
        $("body").on("click", "#tabledtm .lihatBL", function() {
            var nobl = $(this).attr('data-bls');
            $.ajax({
                url: "<?= base_url('deliverynote/detailbL'); ?>",
                method: 'POST',
                data: {
                    id: nobl
                }, 
                success: function(data) {
                    $("#popBl").modal({
                        backdrop: 'static',
                        keyboard: true,
                        show: true
                    });
                    $("#detailBL").html(data);
                }
            });
        });

        $("body").on("click", "#tabledtm .lihat", function() {
            var nodn = $(this).data('po');
            $.ajax({
                url: "<?= base_url('deliverynote/detailDn'); ?>",
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
                    $(".dndetail").html(data);
                    $(".print").click(() => {
                        window.location.href = "<?= base_url('deliverynote/printpo/'); ?>" + nodn;
                    });
                    $(".unduh").click(() => {
                        window.location.href = "<?= base_url('deliverynote/unduhpo/'); ?>" + nodn;
                    });
                }
            });
        });

        $("body").on("click", "#tabledtm .approve", function() {
            var nodn = $(this).data('po');
            var poxb = $(this).data('pox');
            swal.fire({
                title: 'Konfirmasi Delivery Note',
                text: 'Aksi ini akan merubah status DN menjadi Complete, Lakukan pengecekan terlebih dahulu',
                icon: 'warning',
                showCancelButton: true,
                cancelButtonColor: '#FA8072',
                confirmButtonColor: '#20B2AA',
                allowOutsideClick: false
            }).then((result) => {
                if (result.isConfirmed) {
                    // $("#popupConf").modal('show');
                    $("#dnid").val(nodn);
                    $("#nopox").val(poxb);
                    $.ajax({
                        url: "<?= base_url('deliverynote/confirmdn'); ?>",
                        method: 'POST',
                        data: {
                            dnid: nodn,
                            nopox: poxb
                        },
                        success: function(data) {
                            console.log(data);
                            swal.fire({
                                title: 'Berhasil',
                                text: 'Terimakasih sudah Konfirmasi DN',
                                icon: 'success'
                            }).then((res) => {
                                if (res.isConfirmed) {
                                    window.location.reload();
                                }
                            });
                        }
                    });
                }
            });
        });
    });
</script>