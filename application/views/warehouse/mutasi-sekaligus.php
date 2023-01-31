<div class="modal inmodal" id="insert" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content animated bounceInRight">
            <div class="modal-body">
                <label>Menyimpan Data . . . <small>Silahkan tunggu sampai proses selesai</small></label>
                <div class="progress">
                    <div class="progress-bar progress-bar-striped progress-bar-animated progress-bar-info" style="width: 100%" role="progressbar" aria-valuenow="100%" aria-valuemin="0" aria-valuemax="100">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h4 class="h4 mb-4 text-gray-800"><?= $title; ?></h4>
    <div class="row">
        <div class="col-lg-12" id="boxHeader">
            <div class="form-Header">
                <div class="card border-left-primary">
                    <div class="card-header">
                        <h5 class="card-title">Form info mutasi stok</h5>
                    </div>
                    <div class="card-body">
                        <!-- <form id="formHeader"> -->
                        <div class="form-row">
                            <input type="hidden" name="uname" id="uname" value="<?= $user['user_nama']; ?>" class="form-control" readonly>
                            <div class="form-group col-md-3">
                                <label for="">Jenis Mutasi</label>
                                <select name="jmutasi" id="jmutasi" class="form-control jmutasi">
                                    <option value=""></option>
                                    <option value="plus">Penambahan Stok</option>
                                    <option value="minus">Pengurangan Stok</option>
                                    <option value="mutation">Perpindahan Stok</option>
                                </select>
                            </div>
                            <div class="form-group col-md-3" id="gdg_asal">
                                <label for="">Gudang asal</label>
                                <select name="gasal" id="gasal" class="form-control gasal">
                                    <option value=""></option>
                                    <?php foreach ($gdg as $g) : ?>
                                        <option value="<?= $g['kode_gudang']; ?>"><?= $g['locator'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="form-group col-md-3" id="gdg_tujuan">
                                <label for="">Gudang Tujuan</label>
                                <select name="gtujuan" id="gtujuan" class="form-control gtujuan">
                                    <option value=""></option>
                                    <?php foreach ($gdg as $g) : ?>
                                        <option value="<?= $g['kode_gudang']; ?>"><?= $g['locator'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="form-group col-md-12" id="nosj">
                                <label for="">No. Surat jalan/ Keterangan</label>
                                <textarea name="pickticket" id="pickticket" class="form-control pickticket" placeholder="Masukkan No PT/ PTs/ No. Surat Jalan/ Keterangan"></textarea>
                            </div>
                            <div class="form-group col-md-12" id="lpb">
                                <label for="">No. LPB/ SPB/ Referensi</label>
                                <input type="text" name="nlpb" id="nlpb" class="form-control nlpb" placeholder="NO. LPB/ SPB/ Surat Jalan XB/ Referensi">
                            </div>
                        </div>
                        <!-- </form> -->
                        <span class="btn btn-warning btn-sm reset" id="reset"><i class="fas fa-fw fa-refresh"></i> Reset</span>
                        <button class="btn btn-danger btn-sm float-right see" id="see"><i class="fa fa-eye"></i> Detail Item</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-12 mt-2" id="boxDetail">
            <div class="card border-left-danger">
                <div class="card-header">
                    <h5 class="card-title">Form detail sku</h5>
                </div>
                <div class="card-body">
                    <div class="formFooter">
                        <form id="form1">
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label for="">SKU-1</label>
                                    <input type="hidden" name="code" class="form-control codex1" id="codex1">
                                    <select name="mods" id="mods1" class="form-control mods1" style="width: 100%; height:fit-content">
                                        <option value=""></option>
                                        <?php foreach ($sku as $sk) : ?>
                                            <option value="<?= $sk['model']; ?>"><?= $sk['model']; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="form-group col-md-2">
                                    <label>G-75</label>
                                    <input type="number" class="form-control stokg751" name="qtys" id="stokg751" placeholder="0" disabled="">
                                </div>
                                <div class="form-group col-md-2">
                                    <label>A-50</label>
                                    <input type="number" class="form-control stoka501" name="qtys" id="stoka501" placeholder="0" disabled="">
                                </div>
                                <div class="form-group col-md-2">
                                    <label for="">Stok G-75</label>
                                    <input type="text" id="stokdarig751" class="form-control" readonly>
                                    <input type="hidden" name="iGudang751" id="iGudang751">
                                </div>
                                <div class="form-group col-md-2">
                                    <label for="">Stok A-50</label>
                                    <input type="text" id="stokdaria501" class="form-control" readonly>
                                    <input type="hidden" name="iGudang501" id="iGudang501">
                                </div>
                            </div>
                        </form>
                    </div>
                    <button class="btn btn-danger btn-sm batal"><span class="fa fa-close"></span> Batal</button>
                    <button class="btn btn-info btn-sm tambah"><span class="fa fa-plus"></span> SKU</button>
                    <button class="btn btn-primary btn-sm simpan float-right"><span class="fa fa-save"></span> Simpan</button>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /.container-fluid -->
</div>
<!-- End of Main Content -->
<!-- javaSript -->
<script>
    $(document).ready(function() {
        $.get("<?= base_url('warehouse/getPT'); ?>", function(data) {
            $("#pickticket").typeahead({
                source: data
            })
        })
    });
    $(document).ready(function() {
        $("#boxDetail").hide();
        $(".batal").click(() => {
            window.history.back();
        });
        $(".see").click(() => {
            $("#boxDetail").show();
        });
        $(".reset").click(() => {
            window.location.reload();
        });
        $(".jmutasi").select2({
            allowClear: true,
            placeholder: 'Pilih Jenis Mutasi'
        });
        $(".gasal").select2({
            allowClear: true,
            placeholder: 'Pilih gudang asal'
        });
        $(".gtujuan").select2({
            allowClear: true,
            placeholder: 'Pilih gudang tujuan'
        });

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

        var codex = makeid(10);
        document.getElementById("codex1").value = codex;

        $(".mods1").select2({
            allowClear: true,
            placeholder: '~ Pilih SKU ~',
            width: 'resolve'
        });

    });

    $(document).ready(function() {
        $("#nosj").hide();
        $("#gdg_asal").hide();
        $("#gdg_tujuan").hide();
        $("#lpb").hide();
        $("#dStok").hide();
        $("#rStok").hide();
        $("#see").hide();
        // funsi changes model/ sku

        $("#mods1").change(function() {
            var sku = $("#mods1").val();

            $.ajax({
                method: 'POST',
                url: "<?= base_url('warehouse/getStoks'); ?>",
                dataType: 'json',
                data: {
                    id: sku
                },
                success: function(data) {

                    var reslt = data;
                    var stok_75 = reslt.stok75;
                    var stok_50 = reslt.stok50;

                    $("#stokdarig751").val(stok_75);
                    $("#stokdaria501").val(stok_50);
                    $("#iGudang751").val(stok_75);
                    $("#iGudang501").val(stok_50);
                }
            });
        });
        // funsi change jenis mutasi
        $("#jmutasi").change(function() {

            $("#see").show();

            var jmut = $("#jmutasi").val();
            var asal = $("#gasal").val();
            var tujuan = $("#gtujuan").val();
            // variable dari database
            var istok_g75 = $("#iGudang751").val();
            var istok_a50 = $("#iGudang501").val();
            // variabel dari form input
            var fstok_g75 = $("#stokg751").val();
            var fstok_a50 = $("#stoka501").val();

            var hgudang75 = 0; //hasil perhitungan database danegan form
            var hgudang50 = 0;
            if (fstok_a50 == '' || isNaN(fstok_a50)) {
                fstok_a50 = 0;
            }
            if (fstok_g75 == '' || isNaN(fstok_g75)) {
                fstok_g75 = 0;
            }

            if (jmut == 'plus') {
                $("#nosj").hide();
                $("#gdg_asal").hide();
                $("#gdg_tujuan").show();
                $("#lpb").show();

                document.getElementById("gtujuan").setAttribute("required", "true"); //jika jenis mutasi plus -> gudang tujuan wajib disi
                document.getElementById("nlpb").setAttribute("required", "true");

                document.getElementById("pickticket").setAttribute("disabled", "true");
                document.getElementById("gasal").setAttribute("disabled", "true");
                var x = 0;
            } else if (jmut == 'minus') {
                $("#nosj").show();
                $("#gdg_asal").show();
                $("#gdg_tujuan").hide();
                $("#lpb").hide();

                document.getElementById("gasal").setAttribute("required", "true");
                document.getElementById("pickticket").setAttribute("required", "true");

                document.getElementById("gtujuan").setAttribute("disabled", "true");
                document.getElementById("nlpb").setAttribute("disabled", "true");
                var x = 1;
            } else if (jmut == 'mutation') {
                $("#nosj").hide();
                $("#gdg_asal").show();
                $("#gdg_tujuan").show();
                $("#lpb").show();

                document.getElementById("gasal").setAttribute("required", "true");
                document.getElementById("gtujuan").setAttribute("required", "true");
                document.getElementById("nlpb").setAttribute("required", "true");

                document.getElementById("pickticket").setAttribute("disabled", "true");
                var x = 2;
            } else {
                $("#nosj").hide();
                $("#gdg_asal").hide();
                $("#gdg_tujuan").hide();
                $("#lpb").hide();
            }
        });

        $("#stoka501").keyup(() => {
            var jmut = $("#jmutasi").val();
            var asal = $("#gasal").val();
            var tujuan = $("#gtujuan").val();
            // variable dari database
            var istok_g75 = $("#iGudang751").val();
            var istok_a50 = $("#iGudang501").val();
            // variabel dari form input
            var fstok_g75 = $("#stokg751").val();
            var fstok_a50 = $("#stoka501").val();

            var hgudang75 = 0; //hasil perhitungan database danegan form
            var hgudang50 = 0;
            if (fstok_a50 == '' || isNaN(fstok_a50)) {
                fstok_a50 = 0;
            }
            if (fstok_g75 == '' || isNaN(fstok_g75)) {
                fstok_g75 = 0;
            }

            // case dengan jenis mutasi
            if (jmut == 'plus') {
                var x = 0;
            } else if (jmut == 'minus') {
                var x = 1;
            } else if (jmut == 'mutation') {
                var x = 2;
            }
            // rumus ala-ala
            switch (x) {
                case 0:
                    hgudang75 = parseInt(istok_g75) + parseInt(fstok_g75);
                    hgudang50 = parseInt(istok_a50) + parseInt(fstok_a50);

                    break;
                case 1:
                    hgudang75 = parseInt(istok_g75) - parseInt(fstok_g75);
                    hgudang50 = parseInt(istok_a50) - parseInt(fstok_a50);
                    if (hgudang50 < 0) {
                        swal.fire(
                            'Stok Gudang A-50 Kurang',
                            'Periksa menu mutasi untuk cek penambahan stok yang belum diapproval',
                            'warning'
                        );
                        $("#stoka501").val("0");
                    }
                    break;
                case 2:
                    if (asal == 'a50' && tujuan == 'g75') {
                        hgudang75 = parseInt(istok_g75) - parseInt(fstok_g75);
                        hgudang50 = parseInt(istok_a50) - parseInt(fstok_a50);
                        if (hgudang50 < 0) {
                            swal.fire(
                                'Stok Gudang A-50 Kurang',
                                'Periksa menu mutasi untuk cek penambahan stok yang belum diapproval',
                                'warning'
                            );
                            $("#stoka501").val("0");
                        }
                    }
            }
        });

        $("#stokg751").keyup(() => {
            var jmut = $("#jmutasi").val();
            var asal = $("#gasal").val();
            var tujuan = $("#gtujuan").val();
            // variable dari database
            var istok_g75 = $("#iGudang751").val();
            var istok_a50 = $("#iGudang501").val();
            // variabel dari form input
            var fstok_g75 = $("#stokg751").val();
            var fstok_a50 = $("#stoka501").val();

            var hgudang75 = 0; //hasil perhitungan database danegan form
            var hgudang50 = 0;
            if (fstok_a50 == '' || isNaN(fstok_a50)) {
                fstok_a50 = 0;
            }
            if (fstok_g75 == '' || isNaN(fstok_g75)) {
                fstok_g75 = 0;
            }

            // case dengan jenis mutasi
            if (jmut == 'plus') {
                var x = 0;
            } else if (jmut == 'minus') {
                var x = 1;
            } else if (jmut == 'mutation') {
                var x = 2;
            }
            // rumus ala-ala
            switch (x) {
                case 0:
                    hgudang75 = parseInt(istok_g75) + parseInt(fstok_g75);
                    hgudang50 = parseInt(istok_a50) + parseInt(fstok_a50);

                    break;
                case 1:
                    hgudang75 = parseInt(istok_g75) - parseInt(fstok_g75);
                    hgudang50 = parseInt(istok_a50) - parseInt(fstok_a50);

                    if (hgudang75 < 0) {
                        swal.fire(
                            'Stok Gudang G-75 Kurang',
                            'Periksa menu mutasi untuk cek penambahan stok yang belum diapproval',
                            'warning'
                        );
                        $("#stokg751").val("0");
                    }
                    break;
                case 2:
                    if (asal == 'g75' && tujuan == 'a50') {
                        hgudang75 = parseInt(istok_g75) - parseInt(fstok_g75);
                        hgudang50 = parseInt(istok_a50) + parseInt(fstok_g75);
                        if (hgudang75 < 0) {
                            swal.fire(
                                'Stok Gudang G-75 Kurang',
                                'Periksa menu mutasi untuk cek penambahan stok yang belum diapproval',
                                'warning'
                            );
                            $("#stokg751").val("0");
                        }
                    }
            }
        });
    });
    $(document).ready(function() {
        $("#gtujuan").change(() => {
            var jmutasi = $("#jmutasi").val();
            var tujuan = $("#gtujuan").val();
            if (jmutasi == 'plus' && tujuan == 'g75') {
                $('#stoka501').prop('disabled', true);
                $('#stokg751').prop('disabled', false);

                $('#stoka501').val('');

            } else if (jmutasi == 'plus' && tujuan == 'a50') {
                $('#stoka501').prop('disabled', false);
                $('#stokg751').prop('disabled', true);

                $('#stokg751').val('');
            }

        });

        $("#gasal").change(() => {
            var jmutasi = $("#jmutasi").val();
            var asal = $("#gasal").val();
            if (jmutasi == 'minus' && asal == 'g75') {
                $('#stoka501').prop('disabled', true);
                $('#stokg751').prop('disabled', false);
            } else if (jmutasi == 'minus' && asal == 'a50') {
                $('#stoka501').prop('disabled', false);
                $('#stokg751').prop('disabled', true);
            } else if (jmutasi == 'mutation' && asal == 'a50') {
                $('#stoka501').prop('disabled', false);
                $('#stokg751').prop('disabled', true);
            } else if (jmutasi == 'mutation' && asal == 'g75') {
                $('#stoka501').prop('disabled', true);
                $('#stokg751').prop('disabled', false);
            }
        });

        var index = 1;
        $(".tambah").click(() => {
            index++;
            var form = "form" + index;
            var codex = "codex" + index;
            var mods = "mods" + index;
            var stokg75 = "stokg75" + index;
            var stoka50 = "stoka50" + index;
            var stokdarig75 = "stokdarig75" + index;
            var iGudang75 = "iGudang75" + index;
            var stokdaria50 = "stokdaria50" + index;
            var iGudang50 = "iGudang50" + index;
            $(".formFooter").append('<form id="' + (form) + '"><div class="form-row">' +
                '<div class="form-group col-md-4">' +
                '<label for="">SKU-' + index + '</label>' +
                '<input type="hidden" name="code" class="form-control codex' + index + '" id="' + (codex) + '">' +
                '<select name="mods" id="' + (mods) + '" class="form-control mods' + index + '" style="width: 100%; height:fit-content">' +
                '<option value=""></option>' +
                '<?php foreach ($sku as $sk) : ?>' +
                '<option value="<?= $sk['model']; ?>"><?= $sk['model']; ?></option>' +
                '<?php endforeach; ?>' +
                '</select>' +
                '</div>' +
                '<div class="form-group col-md-2">' +
                '<label>G-75</label>' +
                '<input type="number" class="form-control stokg75' + index + '" name="qtys" id="' + (stokg75) + '" placeholder="0" disabled="">' +
                '</div>' +
                '<div class="form-group col-md-2">' +
                '<label>A-50</label>' +
                '<input type="number" class="form-control stoka50' + index + '" name="qtys" id="' + (stoka50) + '" placeholder="0" disabled="">' +
                '</div>' +
                '<div class="form-group col-md-2">' +
                '<label for="">Stok G-75</label>' +
                '<input type="text" id="' + (stokdarig75) + '" class="form-control" readonly>' +
                '<input type="hidden" name="iGudang751" id="' + (iGudang75) + '">' +
                '</div>' +
                '<div class="form-group col-md-2">' +
                '<label for="">Stok A-50</label>' +
                '<input type="text" id="' + (stokdaria50) + '" class="form-control" readonly>' +
                '<input type="hidden" name="iGudang501" id="' + (iGudang50) + '">' +
                '</div>' +
                '</div></form>'
            );

            var jmutasi = $("#jmutasi").val();
            var tujuan = $("#gtujuan").val();
            var asal = $("#gasal").val();

            if (jmutasi == 'plus' && tujuan == 'g75') {
                $('#stoka50' + index).prop('disabled', true);
                $('#stokg75' + index).prop('disabled', false);

                $('#stoka50' + index).val('');

            } else if (jmutasi == 'plus' && tujuan == 'a50') {
                $('#stoka50' + index).prop('disabled', false);
                $('#stokg75' + index).prop('disabled', true);

                $('#stokg75' + index).val('');
            }

            if (jmutasi == 'minus' && asal == 'g75') {
                $('#stoka50' + index).prop('disabled', true);
                $('#stokg75' + index).prop('disabled', false);
            } else if (jmutasi == 'minus' && asal == 'a50') {
                $('#stoka50' + index).prop('disabled', false);
                $('#stokg75' + index).prop('disabled', true);
            } else if (jmutasi == 'mutation' && asal == 'a50') {
                $('#stoka50' + index).prop('disabled', false);
                $('#stokg75' + index).prop('disabled', true);
            } else if (jmutasi == 'mutation' && asal == 'g75') {
                $('#stoka50' + index).prop('disabled', true);
                $('#stokg75' + index).prop('disabled', false);
            }

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

            var codexs = makeid(10);
            document.getElementById("codex" + index).value = codexs;

            $(".mods" + index).select2({
                allowClear: true,
                placeholder: '~ Pilih SKU ~',
                width: 'resolve'
            });

            $("#mods" + index).change(function() {
                var sku = $("#mods" + index).val();

                $.ajax({
                    method: 'POST',
                    url: "<?= base_url('warehouse/getStoks'); ?>",
                    dataType: 'json',
                    data: {
                        id: sku
                    },
                    success: function(data) {

                        var reslt = data;
                        var stok_75 = reslt.stok75;
                        var stok_50 = reslt.stok50;

                        $("#stokdarig75" + index).val(stok_75);
                        $("#stokdaria50" + index).val(stok_50);
                        $("#iGudang75" + index).val(stok_75);
                        $("#iGudang50" + index).val(stok_50);
                    }
                });
            });

            var istok_g75 = $("#iGudang75" + index).val();
            var istok_a50 = $("#iGudang50" + index).val();
            // variabel dari form input
            var fstok_g75 = $("#stokg75" + index).val();
            var fstok_a50 = $("#stoka50" + index).val();

            var hgudang75 = 0; //hasil perhitungan database danegan form
            var hgudang50 = 0;
            if (fstok_a50 == '' || isNaN(fstok_a50)) {
                fstok_a50 = 0;
            }
            if (fstok_g75 == '' || isNaN(fstok_g75)) {
                fstok_g75 = 0;
            }

            if (jmutasi == 'plus') {
                var x = 0;
            } else if (jmutasi == 'minus') {
                var x = 1;
            } else if (jmutasi == 'mutation') {
                var x = 2;
            }

            $("#stoka50" + index).keyup(() => {
                var jmut = $("#jmutasi").val();
                var asal = $("#gasal").val();
                var tujuan = $("#gtujuan").val();
                // variable dari database
                var istok_g75 = $("#iGudang75" + index).val();
                var istok_a50 = $("#iGudang50" + index).val();
                // variabel dari form input
                var fstok_g75 = $("#stokg75" + index).val();
                var fstok_a50 = $("#stoka50" + index).val();

                var hgudang75 = 0; //hasil perhitungan database danegan form
                var hgudang50 = 0;
                if (fstok_a50 == '' || isNaN(fstok_a50)) {
                    fstok_a50 = 0;
                }
                if (fstok_g75 == '' || isNaN(fstok_g75)) {
                    fstok_g75 = 0;
                }

                // case dengan jenis mutasi
                if (jmut == 'plus') {
                    var x = 0;
                } else if (jmut == 'minus') {
                    var x = 1;
                } else if (jmut == 'mutation') {
                    var x = 2;
                }
                // rumus ala-ala
                switch (x) {
                    case 0:
                        hgudang75 = parseInt(istok_g75) + parseInt(fstok_g75);
                        hgudang50 = parseInt(istok_a50) + parseInt(fstok_a50);

                        break;
                    case 1:
                        hgudang75 = parseInt(istok_g75) - parseInt(fstok_g75);
                        hgudang50 = parseInt(istok_a50) - parseInt(fstok_a50);
                        if (hgudang50 < 0) {
                            swal.fire(
                                'Stok Gudang A-50 Kurang',
                                'Periksa menu mutasi untuk cek penambahan stok yang belum diapproval',
                                'warning'
                            );
                            $("#stoka50" + i).val("0");
                        }
                        break;
                    case 2:
                        if (asal == 'a50' && tujuan == 'g75') {
                            hgudang75 = parseInt(istok_g75) - parseInt(fstok_g75);
                            hgudang50 = parseInt(istok_a50) - parseInt(fstok_a50);
                            if (hgudang50 < 0) {
                                swal.fire(
                                    'Stok Gudang A-50 Kurang',
                                    'Periksa menu mutasi untuk cek penambahan stok yang belum diapproval',
                                    'warning'
                                );
                                $("#stoka50" + i).val("0");
                            }
                        }
                }
            });

            $("#stokg75" + index).keyup(() => {
                var jmut = $("#jmutasi").val();
                var asal = $("#gasal").val();
                var tujuan = $("#gtujuan").val();
                // variable dari database
                var istok_g75 = $("#iGudang75" + index).val();
                var istok_a50 = $("#iGudang50" + index).val();
                // variabel dari form input
                var fstok_g75 = $("#stokg75" + index).val();
                var fstok_a50 = $("#stoka50" + index).val();

                var hgudang75 = 0; //hasil perhitungan database danegan form
                var hgudang50 = 0;
                if (fstok_a50 == '' || isNaN(fstok_a50)) {
                    fstok_a50 = 0;
                }
                if (fstok_g75 == '' || isNaN(fstok_g75)) {
                    fstok_g75 = 0;
                }

                // case dengan jenis mutasi
                if (jmut == 'plus') {
                    var x = 0;
                } else if (jmut == 'minus') {
                    var x = 1;
                } else if (jmut == 'mutation') {
                    var x = 2;
                }
                // rumus ala-ala
                switch (x) {
                    case 0:
                        hgudang75 = parseInt(istok_g75) + parseInt(fstok_g75);
                        hgudang50 = parseInt(istok_a50) + parseInt(fstok_a50);

                        break;
                    case 1:
                        hgudang75 = parseInt(istok_g75) - parseInt(fstok_g75);
                        hgudang50 = parseInt(istok_a50) - parseInt(fstok_a50);

                        if (hgudang75 < 0) {
                            swal.fire(
                                'Stok Gudang G-75 Kurang',
                                'Periksa menu mutasi untuk cek penambahan stok yang belum diapproval',
                                'warning'
                            );
                            $("#stokg75" + index).val("0");
                        }
                        break;
                    case 2:
                        if (asal == 'g75' && tujuan == 'a50') {
                            hgudang75 = parseInt(istok_g75) - parseInt(fstok_g75);
                            hgudang50 = parseInt(istok_a50) + parseInt(fstok_g75);
                            if (hgudang75 < 0) {
                                swal.fire(
                                    'Stok Gudang G-75 Kurang',
                                    'Periksa menu mutasi untuk cek penambahan stok yang belum diapproval',
                                    'warning'
                                );
                                $("#stokg75" + index).val("0");
                            }
                        }
                }
            });
        });

        $(".simpan").click(() => {
            var user = $("#uname").val();
            var jmutasi = $("#jmutasi").val();
            if (jmutasi == 'plus') {
                var inputan = $("#gtujuan").val();
                var isiaan = $("#nlpb").val();
            } else if (jmutasi == 'minus') {
                var inputan = $("#gasal").val();
                var isiaan = $("#pickticket").val();
            } else if (jmutasi == 'mutation') {
                var inputan = $("#gtujuan").val() + $("#gasal").val();
                var isiaan = $("#nlpb").val();
            }

            if (user == '' || jmutasi == '' || inputan == '') {
                swal.fire(
                    'Opps...',
                    'Isi Form dengan lengkap!',
                    'warning'
                );
            } else {
                swal.fire({
                    title: "Yakin simpan mutasi ?",
                    text: 'Pastikan jumlah dan SKU sudah sesuai',
                    icon: 'question',
                    confirmButtonText: 'Simpan',
                    cancelButtonText: 'Batal',
                    showCancelButton: true,
                    allowOutsideClick: false
                }).then((rxking) => {
                    if (rxking.isConfirmed) {
                        var gasal = $("#gasal").val();
                        var gtujuan = $("#gtujuan").val();
                        var pickticket = $("#pickticket").val();
                        var nlpb = $("#nlpb").val();
                        for (var i = 1; i <= index; i++) {
                            var form = $("#form" + (i)).serializeArray();
                            form.push({
                                name: 'uname',
                                value: user
                            });
                            form.push({
                                name: 'jmutasi',
                                value: jmutasi
                            });
                            form.push({
                                name: 'gasal',
                                value: gasal
                            });
                            form.push({
                                name: 'gtujuan',
                                value: gtujuan
                            });
                            form.push({
                                name: 'pickticket',
                                value: pickticket
                            });
                            form.push({
                                name: 'nlpb',
                                value: nlpb
                            });

                            $.ajax({
                                url: "<?= base_url('warehouse/simpanMutasi') ?>",
                                method: 'POST',
                                data: form,
                                success: function(data) {
                                    console.log(data);
                                }
                            });
                        }
                    }
                });
            }
            $(document).ajaxStart(function() {
                $("#insert").modal({
                    backdrop: 'static',
                    keyboard: true,
                    show: true
                });
            }).ajaxStop(function() {
                $("#insert").modal('hide');
                swal.fire({
                    title: "Berhasil",
                    text: "Data mutasi disimpan untuk diapproval",
                    icon: 'success',
                    showCancelButton: false,
                    allowOutsideClick: false
                }).then((vario) => {
                    if(vario.isConfirmed) {
                        window.location.href="<?= base_url('warehouse/mutasi') ?>";
                    }
                })
            });
        });
    });
</script>