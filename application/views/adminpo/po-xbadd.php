<!-- modal -->
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
<!-- style tambahan -->
<style>
    .teks::-webkit-input-placeholder {
        font-style: italic;
        color: darkgoldenrod;
    }
</style>
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h4 class="h4 mb-4 text-gray-800"><?= $title; ?></h4>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Form create PO</h5><small class="card-subtitle">Form permintaan penambahan stok Gudang 75</small>
                </div>
                <div class="card-body">
                    <div id="approveForm" class="box0">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Acknowledge 2</label>
                                    <input type="text" name="ack2" id="ack2" class="form-control teks" placeholder="wajib diisi">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Acknowledge 3</label>
                                    <input type="text" name="ack3" id="ack3" class="form-control teks" placeholder="wajib diisi">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Acknowledge 4</label>
                                    <input type="text" name="ack4" id="ack4" class="form-control teks" placeholder="wajib diisi">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Acknowledge 5</label>
                                    <input type="text" name="ack5" id="ack5" class="form-control teks" placeholder="wajib diisi">
                                </div>
                            </div>
                        </div>
                        <button id="next" class="btn btn-primary next1 float-right">NEXT <span class="fas fa-fw fa-angles-right"></span></button>
                    </div>
                    <!-- form header -->
                    <div id="box1" class="mt-3">
                        <form id="formHeader">
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="form-row">
                                        <div class="form-group col-md-8">
                                            <input type="hidden" name="nuser" id="nuser" value="<?= $user['user_nama']; ?>">
                                            <label for="deliverto">Delivery to</label>
                                            <input type="text" name="npts" id="npts" class="form-control" value="<?= $header['atasnama']; ?>" disabled>
                                            <input type="hidden" name="namapt" id="namapt" class="form-control" value="<?= $header['id_perusahaan']; ?>">
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="">No. SCO</label>
                                            <input type="text" name="sco" id="sco" value="<?= $header['noso'] ?>" class="form-control" readonly>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-4">
                                            <label for="Tgl. PO">Tgl. PO</label>
                                            <input type="text" name="tglpo" id="tglpo" class="form-control" value="<?= date('Y-m-d') ?>" readonly>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="Delivery Required">Delivery Required</label>
                                            <input type="date" name="tglkrm" id="tglkrm" class="form-control" value="<?= date('Y-m-d',  strtotime("+2 day", strtotime(date("Y-m-d")))); ?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-row">
                                        <div class="form-group col-md-12">
                                            <label for="keteragan">Keterangan</label>
                                            <textarea name="keterangan" id="keterangan" cols="35" rows="4" class="form-control"><?= $header['customer_nama']; ?></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <button class="btn btn-warning back1"><span class="fas fa-fw fa-angles-left"></span> BACK</button>
                        <button id="next" class="btn btn-primary next2 float-right">NEXT <span class="fas fa-fw fa-angles-right"></span></button>
                    </div>
                    <!-- form detail item -->
                    <div id="box2" class="formDetail">
                        <?php
                        $no = 1;
                        foreach ($detail as $d) {
                            $bil = $this->db->get_where('tb_bom', ['sku_mk' => $d['model']])->result_array();
                            if ($bil) {
                                foreach ($bil as $b) {
                                    $amounts = $d['qty'] * $b['harga'];
                        ?>
                                    <form id="form<?= $no ?>" class="mt-3 formsx">
                                        <div class="card">
                                            <h6 class="card-header card-title">Item-<?= $no; ?></h6>
                                            <div class="card-body">
                                                <div class="form-row">
                                                    <div class="form-group col-md-5">
                                                        <label for="">SKU/ Description</label>
                                                        <input type="hidden" name="sku" id="sku<?= $no ?>" class="form-control" value="<?= $b['id']; ?>">
                                                        <input type="text" name="model" id="model<?= $no; ?>" class="form-control" value="<?= $b['sku_xb']; ?>" disabled>
                                                    </div>
                                                    <div class="form-group col-md-2">
                                                        <label for="qty">QTY</label>
                                                        <input type="text" name="qty" id="qty<?= $no ?>" class="form-control qty<?= $no ?>" value="<?= $d['qty'] ?>">
                                                    </div>
                                                    <div class="form-group col-md-2">
                                                        <label for="harga">Harga</label>
                                                        <input type="text" name="harga" id="harga<?= $no ?>" class="form-control harga<?= $no ?>" value="<?= $b['harga'] ?>">
                                                    </div>
                                                    <div class="form-group col-md-3">
                                                        <label for="harga">Amount</label>
                                                        <input type="text" name="amount" id="amount<?= $no ?>" class="form-control amount<?= $no ?>" value="<?= $amounts ?>">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                        <?php
                                    $no++;
                                }
                            } else {
                                echo '<b>' . $d["model"] . '</b> ini tidak terdaftar dalam Bill OF Material<br>';
                            }
                        };  ?>
                        <br>
                    </div>
                    <input type="hidden" id="noms" value="<?= $no ?>">
                    <div class="" id="tbl_1">
                        <button class="btn btn-sm btn-warning back2 mt-2"><span class="fas fa-fw fa-angles-left"></span> BACK</button>
                        <button class="btn btn-sm btn-success simpan float-right mt-2" id="sippan"><span class="fas fa-fw fa-save"></span> SAVE</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /.container-fluid -->
</div>
<!-- End of Main Content -->
<script>
    $(document).ready(function() {
        var a = $(".formsx").serializeArray();
        if (a == '') {
            $("#tbl_1").append(
                '<button class="btn btn-sm btn-info completes mt-2"><i class="fas fa-fw fa-check"></i>| Complete SCO</button>'
            );

            document.getElementById("sippan").setAttribute('disabled', 'true');

            $(".completes").click(() => {
                var formx = $("#formHeader").serializeArray();
                $.ajax({
                    url: "<?= base_url('adminpo/completesco') ?>",
                    method: 'POST',
                    data: formx,
                    success: function(data) {
                        swal.fire({
                            title: 'PO Status Complete',
                            text: 'SCO tidak akan muncul ditable lagi',
                            icon: 'success'
                        }).then((rsk)=> {
                            if(rsk.isConfirmed){
                                window.location.href="<?= base_url('adminpo') ?>";
                            }
                        });
                    }
                });
            });
        }
        
        $("#box1").hide();
        $("#box2").hide();
        $("#tbl_1").hide();
        $(".next1").click(function() {
            var act1 = $("#ack2").val();
            var act2 = $("#ack3").val();
            var act3 = $("#ack4").val();
            var act4 = $("#ack5").val();

            if (act1 == '' || act2 == '' || act3 == '' || act4 == '') {
                swal.fire(
                    'Galat',
                    'Semua kolom Acknowledge 2-5 harus terisi',
                    'warning'
                );
            } else {
                $("#approveForm").hide();
                $("#box1").show();
            }
        });

        $(".next2").click(function() {
            var namapt = $("#namapt").val();
            var tglpo = $("#tglpo").val();
            var tglkrm = $("#tglkrm").val();
            var keterangan = $("#keterangan").val();
            var sco = $("#sco").val();
            if (namapt == '' || tglpo == '' || tglkrm == '' || keterangan == '' || sco == '') {
                swal.fire(
                    'Galat',
                    'Semua kolom dalam Form wajib diisi',
                    'warning'
                );
            } else {
                $("#box1").hide();
                $("#box2").show();
                $("#tbl_1").show();
            }
        });

        $(".back2").click(function() {
            $("#box1").show();
            $("#box2").hide();
            $("#tbl_1").hide();
        });
        $(".back1").click(function() {
            $("#box1").hide();
            $("#approveForm").show();
        });
    });
    
    $(document).ready(function() {
        var index = $("#noms").val() - 1;

        for (let i = 1; i <= index; i++) {
            //select2 style di field sku
            $(".sku" + i).select2({
                allowClear: true,
                placeholder: 'SKU XB | SKU MK'
            });
            //ketika sku di ganti maka harga diambil dari ajax
            $("#sku" + i).change(function() {
                var sku = $("#sku" + i).val();
                $.ajax({
                    url: "<?= base_url('adminpo/getSkuXb') ?>",
                    method: 'POST',
                    dataType: "json",
                    data: {
                        id: sku
                    },
                    success: function(data) {
                        var dump = data;
                        $("#harga" + i).val(dump.harga);
                    }
                });
            });
            //rumus perhitungan qty x harga -> ketika yang di input adalah qty
            $("#qty" + i).keyup(function() {
                var harga = $("#harga" + i).val();
                var qty = $("#qty" + i).val();

                amount = parseInt(qty) * parseInt(harga);

                $("#amount" + i).val(amount);
            });

            $("#harga" + i).keyup(function() {
                var harga = $("#harga" + i).val();
                var qty = $("#qty" + i).val();

                amount = parseInt(qty) * parseInt(harga);

                $("#amount" + i).val(amount);
            });
        }

        $(".simpan").click(() => {
            swal.fire({
                title: 'Simpan ?',
                text: 'Dengan klik OK anda setuju untuk simpan PO ini',
                imageUrl: "<?= base_url('assets/img/icon/question.svg'); ?>",
                imageHeight: 150,
                showCancelButton: true,
                cancelButtonColor: '#FF4500',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    var FormHeader = $("#formHeader").serializeArray();
                    var ack2 = $("#ack2").val();
                    var ack3 = $("#ack3").val();
                    var ack4 = $("#ack4").val();
                    var ack5 = $("#ack5").val();
                    FormHeader.push({
                        name: 'ack2',
                        value: ack2
                    });
                    FormHeader.push({
                        name: 'ack3',
                        value: ack3
                    });
                    FormHeader.push({
                        name: 'ack4',
                        value: ack4
                    });
                    FormHeader.push({
                        name: 'ack5',
                        value: ack5
                    });
                    $.ajax({
                        url: "<?= base_url('adminpo/saveHeader'); ?>",
                        method: 'post',
                        data: FormHeader,
                        success: function(data) {
                            console.log(data);
                            var idpo = data;
                            for (var i = 1; i <= index; i++) {
                                var form = $("#form" + (i)).serializeArray();
                                form.push({
                                    name: 'idpo',
                                    value: idpo
                                });
                                form.push({
                                    name: 'nourut',
                                    value: i
                                });

                                $.ajax({
                                    url: "<?= base_url('adminpo/saveDetail') ?>",
                                    method: 'post',
                                    data: form,
                                    success: function(data) {
                                        console.log(data)
                                    }
                                });
                            }
                            swal.fire({
                                title: 'Berhasil',
                                text: 'Data tersimpan, Terimakasih',
                                icon: 'success',
                                showCancelButton: false,
                                confirmButtonText: 'Ok, Thanks'
                            }).then((resl) => {
                                if (resl.isConfirmed) {
                                    window.location.href = "<?= base_url('adminpo/poxb'); ?>";
                                }

                            });
                        }
                    });
                } else if (result.dismiss === Swal.DismissReason.cancel) {
                    swal.fire(
                        'Batal',
                        'data tidak disimpan',
                        'warning'
                    );
                }
            });
            $(document).ajaxStart(function() {
                $("#insert").modal({
                    backdrop: 'static',
                    keyboard: true,
                    show: true
                });
            }).ajaxStop(function() {
                $("#insert").modal('hide');
            });
        });
    });
</script>