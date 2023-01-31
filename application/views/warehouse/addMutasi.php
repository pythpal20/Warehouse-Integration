<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h4 class="h4 mb-4 text-gray-800"><?= $title; ?></h4>
    <form action="<?= base_url('warehouse/mutasiBaru'); ?>" method="POST">
        <input type="hidden" name="code" id="code" readonly>
        <div class="row">
            <!-- form header -->
            <div class="col-md-5">
                <div class="row">
                    <div class="col-md-12">
                        <?= $this->session->flashdata('message'); ?>
                        <?= form_error('pickticket', '<small class="text-danger pl-3">', '</small>'); ?>
                        <div class="card border-left-primary">
                            <h6 class="card-title card-header">Mutasi Baru</h6>
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="">User</label>
                                    <input type="text" name="uname" id="uname" value="<?= $user['user_nama']; ?>" class="form-control" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="sku">Model</label>
                                    <select name="mods" id="mods" class="form-control mods" style="width: 100%; height:fit-content">
                                        <option value=""></option>
                                        <?php foreach ($sku as $sk) : ?>
                                            <option value="<?= $sk['model']; ?>"><?= $sk['model']; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                    <?= form_error('mods', '<small class="text-danger pl-3">', '</small>'); ?>
                                </div>
                                <div class="form-group">
                                    <label for="">Jenis Mutasi</label>
                                    <select name="jmutasi" id="jmutasi" class="form-control jmutasi">
                                        <option value=""></option>
                                        <option value="plus">Penambahan Stok</option>
                                        <option value="minus">Pengurangan Stok</option>
                                        <option value="mutation">Perpindahan Stok</option>
                                    </select>
                                    <?= form_error('jmutasi', '<small class="text-danger pl-3">', '</small>'); ?>
                                </div>
                                <div class="form-group" id="gdg_asal">
                                    <label for="">Gudang asal</label>
                                    <select name="gasal" id="gasal" class="form-control gasal">
                                        <option value=""></option>
                                        <?php foreach ($gdg as $g) : ?>
                                            <option value="<?= $g['kode_gudang']; ?>"><?= $g['locator'] ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="form-group" id="gdg_tujuan">
                                    <label for="">Gudang Tujuan</label>
                                    <select name="gtujuan" id="gtujuan" class="form-control gtujuan">
                                        <option value=""></option>
                                        <?php foreach ($gdg as $g) : ?>
                                            <option value="<?= $g['kode_gudang']; ?>"><?= $g['locator'] ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="form-group" id="nosj">
                                    <label for="">No. Surat jalan/ Keterangan</label>
                                    <!--<select name="pickticket" id="pickticket" class="form-control pickticket">-->
                                    <!--    <option value=""></option>-->
                                    <!--    <?php foreach ($sj as $s) : ?>-->
                                    <!--        <option value="<?= $s['no_sh'] . " - " . $s['customer_nama']; ?>">-->
                                    <!--            <?= $s['no_sh'] . " - " . $s['customer_nama']; ?></option>-->
                                    <!--    <?php endforeach; ?>-->
                                    <!--</select>-->
                                    <textarea name="pickticket" id="pickticket" class="form-control pickticket" placeholder="Masukkan No PT/ PTs/ No. Surat Jalan/ Keterangan"></textarea>
                                </div>
                                <div class="form-group" id="lpb">
                                    <label for="">No. LPB/ SPB/ Referensi</label>
                                    <input type="text" name="nlpb" id="nlpb" class="form-control nlpb" placeholder="NO. LPB/ SPB/ Surat Jalan XB/ Referensi">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- form-detail -->
            <div class="col-md-7">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card border-left-danger">
                            <div class="card-body">
                                <div class="form-group row" id="stok1">
                                    <label for="g75" class="col-sm-3 col-form-label">Stok G-75</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="qtys" id="stokg75" placeholder="0" disabled="">
                                    </div>
                                </div>
                                <div class="form-group row" id="stok2">
                                    <label for="a50" class="col-sm-3 col-form-label">Stok A-50</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="qtys" id="stoka50" placeholder="0" disabled="">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-5 mt-3" id="dStok">
                        <div class="card border-left-info">
                            <h6 class="card-header card-title">Detail Stok</h6>
                            <div class="card-body">
                                <table class="table-condensed table-borderless table-striped" width="100%">
                                    <tr>
                                        <td>Stok G-75</td>
                                        <td><span class="fas fa-fw fa-arrow-right"></span></td>
                                        <td>
                                            <span id="stokdarig75"></span>
                                            <input type="hidden" name="iGudang75" id="iGudang75">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Stok A-50</td>
                                        <td><span class="fas fa-fw fa-arrow-right"></span></td>
                                        <td>
                                            <span id="stokdaria50"></span>
                                            <input type="hidden" name="iGudang50" id="iGudang50" class="form-control-sm" readonly>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-7 mt-3" id="rStok">
                        <div class="card border-left-success">
                            <h6 class="card-header card-title">Result Simulation</h6>
                            <div class="card-body">
                                <div class="col-sm-12">
                                    G-75 <i class="fas fa-fw fa-arrow-right"></i> <span id="gudang75"></span><br>
                                    A-50 <i class="fas fa-fw fa-arrow-right"></i> <span id="gudang50"></span><br>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 mt-3">
                        <div class="card border-left-warning">
                            <div class="card-body">
                                <span class="btn btn-warning reset" id="reset"><i class="fas fa-fw fa-refresh"></i> Reset</span>
                                <span class="btn btn-danger batal" id="batal"><i class="fas fa-fw fa-close"></i> Batal</span>
                                <button type="submit" class="btn btn-primary simpan float-right"><span class="fas fa-fw fa-save"></span> Simpan</button>
                            </div>
                            <div class="card-footer">
                                <small><em>Silahkan reset jika form error</em></small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
<!-- /.container-fluid -->
</div>
<!-- End of Main Content -->
<!-- javaSript -->
<script>
    // $(document).ready(function() {
        
    // });
    $(document).ready(function() {
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
        document.getElementById("code").value = codex;


        $(".batal").click(() => {
            window.history.back();
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
        // $(".pickticket").select2({
        //     allowClear: true,
        //     placeholder: '~ Pilih No surat jalan ~'
        // });
        $(".mods").select2({
            allowClear: true,
            placeholder: '~ Pilih SKU ~',
            width: 'resolve'
        });

    });
    
    $(document).ready(function() {
        $.get("<?= base_url('warehouse/getPT'); ?>", function(data) {
            $("#pickticket").typeahead({
                source: data
            })
        })
    });
    
    $(document).ready(function() {
        $("#nosj").hide();
        $("#gdg_asal").hide();
        $("#gdg_tujuan").hide();
        $("#lpb").hide();
        $("#dStok").hide();
        $("#rStok").hide();

        // funsi changes model/ sku

        $("#mods").change(function() {
            var sku = $("#mods").val();
            if (sku == '') {
                $("#dStok").hide();
                $("#rStok").hide();
            } else {
                $("#dStok").show();
                $("#rStok").show();
            }
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

                    document.getElementById("stokdarig75").innerHTML = stok_75;
                    document.getElementById("stokdaria50").innerHTML = stok_50;
                    $("#iGudang75").val(stok_75);
                    $("#iGudang50").val(stok_50);
                }
            });
        });
        // funsi change jenis mutasi
        $("#jmutasi").change(function() {
            var jmut = $("#jmutasi").val();
            var asal = $("#gasal").val();
            var tujuan = $("#gtujuan").val();
            // variable dari database
            var istok_g75 = $("#iGudang75").val();
            var istok_a50 = $("#iGudang50").val();
            // variabel dari form input
            var fstok_g75 = $("#stokg75").val();
            var fstok_a50 = $("#stoka50").val();

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

            switch (x) {
                case 0:
                    hgudang75 = parseInt(istok_g75) + parseInt(fstok_g75);
                    hgudang50 = parseInt(istok_a50) + parseInt(fstok_a50);
                    document.getElementById("gudang50").textContent = istok_a50 + ' + ' + fstok_a50 + ' = ' + hgudang50;
                    document.getElementById("gudang75").textContent = istok_g75 + ' + ' + fstok_g75 + ' = ' + hgudang75;
                    break;
                case 1:
                    hgudang75 = parseInt(istok_g75) - parseInt(fstok_g75);
                    hgudang50 = parseInt(istok_a50) - parseInt(fstok_a50);
                    document.getElementById("gudang50").textContent = istok_a50 + ' - ' + fstok_a50 + ' = ' + hgudang50;
                    document.getElementById("gudang75").textContent = istok_g75 + ' - ' + fstok_g75 + ' = ' + hgudang75;
                    break;

            }
        });

        $("#stoka50").keyup(() => {
            var jmut = $("#jmutasi").val();
            var asal = $("#gasal").val();
            var tujuan = $("#gtujuan").val();
            // variable dari database
            var istok_g75 = $("#iGudang75").val();
            var istok_a50 = $("#iGudang50").val();
            // variabel dari form input
            var fstok_g75 = $("#stokg75").val();
            var fstok_a50 = $("#stoka50").val();

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
                    document.getElementById("gudang50").textContent = istok_a50 + ' + ' + fstok_a50 + ' = ' + hgudang50;
                    document.getElementById("gudang75").textContent = istok_g75 + ' + ' + fstok_g75 + ' = ' + hgudang75;
                    break;
                case 1:
                    hgudang75 = parseInt(istok_g75) - parseInt(fstok_g75);
                    hgudang50 = parseInt(istok_a50) - parseInt(fstok_a50);
                    if((hgudang50 >= 0)) {
                        document.getElementById("gudang50").textContent = istok_a50 + ' - ' + fstok_a50 + ' = ' + hgudang50;
                        document.getElementById("gudang75").textContent = istok_g75 + ' - ' + fstok_g75 + ' = ' + hgudang75;
                    } else {
                        swal.fire(
                            'Stok Gudang A-50 Kurang',
                            'Periksa menu mutasi untuk cek penambahan stok yang belum diapproval',
                            'warning'
                        );
                        $("#stoka50").val("0");
                    }
                    break;
                case 2:
                    if (asal == 'a50' && tujuan == 'g75') {
                        hgudang75 = parseInt(istok_g75) - parseInt(fstok_g75);
                        hgudang50 = parseInt(istok_a50) - parseInt(fstok_a50);
                        if(hgudang50 >= 0) {
                            document.getElementById("gudang50").textContent = istok_a50 + ' - ' + fstok_a50 + ' = ' + hgudang50;
                            document.getElementById("gudang75").textContent = istok_g75 + ' + ' + fstok_a50 + ' = ' + hgudang75;
                        } else {
                            swal.fire(
                                'Stok Gudang A-50 Kurang',
                                'Periksa menu mutasi untuk cek penambahan stok yang belum diapproval',
                                'warning'
                            );
                            $("#stoka50").val("0");
                        }
                    } 
            }
        });

        $("#stokg75").keyup(() => {
            var jmut = $("#jmutasi").val();
            var asal = $("#gasal").val();
            var tujuan = $("#gtujuan").val();
            // variable dari database
            var istok_g75 = $("#iGudang75").val();
            var istok_a50 = $("#iGudang50").val();
            // variabel dari form input
            var fstok_g75 = $("#stokg75").val();
            var fstok_a50 = $("#stoka50").val();

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
                    document.getElementById("gudang50").textContent = istok_a50 + ' + ' + fstok_a50 + ' = ' + hgudang50;
                    document.getElementById("gudang75").textContent = istok_g75 + ' + ' + fstok_g75 + ' = ' + hgudang75;
                    break;
                case 1:
                    hgudang75 = parseInt(istok_g75) - parseInt(fstok_g75);
                    hgudang50 = parseInt(istok_a50) - parseInt(fstok_a50);
                    if((hgudang75 >= 0) ) {
                        document.getElementById("gudang50").textContent = istok_a50 + ' - ' + fstok_a50 + ' = ' + hgudang50;
                        document.getElementById("gudang75").textContent = istok_g75 + ' - ' + fstok_g75 + ' = ' + hgudang75;
                    } else {
                        swal.fire(
                            'Stok Gudang G-75 Kurang',
                            'Periksa menu mutasi untuk cek penambahan stok yang belum diapproval',
                            'warning'
                        );
                        $("#stokg75").val("0");
                    }
                    break;
                case 2:
                    if (asal == 'g75' && tujuan == 'a50') {
                        hgudang75 = parseInt(istok_g75) - parseInt(fstok_g75);
                        hgudang50 = parseInt(istok_a50) + parseInt(fstok_g75);
                        if(hgudang75 >= 0 ) {
                            document.getElementById("gudang50").textContent = istok_a50 + ' + ' + fstok_g75 + ' = ' + hgudang50;
                            document.getElementById("gudang75").textContent = istok_g75 + ' - ' + fstok_g75 + ' = ' + hgudang75;
                        } else {
                            swal.fire(
                                'Stok Gudang G-75 Kurang',
                                'Periksa menu mutasi untuk cek penambahan stok yang belum diapproval',
                                'warning'
                            );
                            $("#stokg75").val("0");
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
                $('#stoka50').prop('disabled', true);
                $('#stokg75').prop('disabled', false);

                $('#stoka50').val('');
                // alert("true");
            } else if (jmutasi == 'plus' && tujuan == 'a50') {
                $('#stoka50').prop('disabled', false);
                $('#stokg75').prop('disabled', true);

                $('#stokg75').val('');
            }

        });

        $("#gasal").change(() => {
            var jmutasi = $("#jmutasi").val();
            var asal = $("#gasal").val();
            if (jmutasi == 'minus' && asal == 'g75') {
                $('#stoka50').prop('disabled', true);
                $('#stokg75').prop('disabled', false);
            } else if (jmutasi == 'minus' && asal == 'a50') {
                $('#stoka50').prop('disabled', false);
                $('#stokg75').prop('disabled', true);
            } else if (jmutasi == 'mutation' && asal == 'a50') {
                $('#stoka50').prop('disabled', false);
                $('#stokg75').prop('disabled', true);
            } else if (jmutasi == 'mutation' && asal == 'g75') {
                $('#stoka50').prop('disabled', true);
                $('#stokg75').prop('disabled', false);
            }
        });
    });
</script>
<script>
    $(document).ready(function(){
       swal.fire(
            'Notes',
            'Pastikan stok tidak 0 atau inputan tidak lebih besar dari jumlah stok Saat mutasi atau pengurangan ',
            'warning'
        ); 
    });
</script>