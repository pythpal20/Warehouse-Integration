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
                    <h5 class="card-title">Form create PO</h5><small class="card-subtitle">Form Purchase Order - Manual</small>
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
                        <hr>
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
                                            <select name="namapt" id="namapt" class="form-control namapt">
                                                <option value="">~ Pilih PT ~</option>
                                                <?php foreach ($pt->result() as $p) : ?>
                                                    <option value="<?= $p->id_perusahaan ?>"><?= $p->atasnama ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="">No. SCO</label>
                                            <input type="text" name="sco" id="sco" value="Non-SCO" class="form-control" readonly>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-4">
                                            <label for="Delivery Required">Delivery Required</label>
                                            <input type="date" name="tglkrm" id="tglkrm" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-row">
                                        <div class="form-group col-md-12">
                                            <label for="keteragan">Keterangan</label>
                                            <textarea name="keterangan" id="keterangan" cols="35" rows="4" class="form-control"></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <hr>
                    </div>
                    <!-- form detail item -->
                    <div id="box2" class="formDetail">
                        <form id="form1" class="mt-3">
                            <div class="card">
                                <h6 class="card-header card-title">Item-1</h6>
                                <div class="card-body">
                                    <div class="form-row">
                                        <div class="form-group col-md-5">
                                            <label for="">SKU/ Description</label>
                                            <select name="sku" id="model1" class="form-control model1">
                                                <option value="">~ Pilih SKU ~</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-2">
                                            <label for="qty">QTY</label>
                                            <input type="text" name="qty" id="qty1" class="form-control qty1" placeholder="0">
                                        </div>
                                        <div class="form-group col-md-2">
                                            <label for="harga">Harga</label>
                                            <input type="text" name="harga" id="harga1" class="form-control harga1" placeholder="0">
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="harga">Amount</label>
                                            <input type="text" name="amount" id="amount1" class="form-control amount1" placeholder="0" readonly>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="" id="tbl_1">
                        <button class="btn btn-secondary mt-2 batal" id="batal"><span class="fa fa-close"></span> BATAL</button>
                        <button class="btn btn-primary simpan float-right mt-2" id="sippan"><span class="fas fa-fw fa-save"></span> SAVE</button>
                        <button class="btn btn-danger tambah float-right mt-2 mr-2" id="tabbah"><span class="fa fa-plus-circle"></span> SKU</button>
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
        $('.model1').select2({
            allowClear: true,
            ajax: {
                url: "<?= base_url('adminpo/cariSku') ?>",
                type: 'post',
                dataType: 'json',
                delay: 250,
                data: function(params) {
                    return {
                        searchSku: params.term // search term
                    };
                },
                processResults: function(response) {
                    // console.log(response);
                    return {
                        results: response
                    };
                },
                cache: true
            }
        });

        $("#model1").change(() => {
            var sku = $("#model1").val();
            var qty = $("#qty1").val();
            $.ajax({
                url: "<?= base_url('adminpo/cariHarga') ?>",
                method: 'POST',
                dataType: 'JSON',
                data: {
                    sku: sku
                },
                success: function(data) {
                    $("#harga1").val(data);

                    if (qty == '' || isNaN(qty)) {
                        qty = 0;
                    }
                    amount = parseInt(qty) * parseInt(data);

                    $("#amount1").val(amount);
                    // console.log(data)
                }
            });
        });
        $("#harga1").keyup(() => {
            var qty = $("#qty1").val();
            var harga = $("#harga1").val();
            if (qty == '' || isNaN(qty)) {
                qty = 0;
            }
            amount = parseInt(qty) * parseInt(harga);
            $("#amount1").val(amount);
        });

        $("#qty1").keyup(() => {
            var qty = $("#qty1").val();
            var harga = $("#harga1").val();

            if (harga == '' || isNaN(harga)) {
                harga = 0;
            }

            amount = parseInt(qty) * parseInt(harga);

            $("#amount1").val(amount);
        });

        var index = 1;
        $(".tambah").click(() => {
            index++;
            var form = "form" + index;
            var model = "model" + index;
            var qty = "qty" + index;
            var harga = "harga" + index;
            var amount = "amount" + index;
            $(".formDetail").append('<form id="' + (form) + '" class="mt-3 formsx">' +
                '<div class="card">' +
                '<h6 class="card-header card-title">Item-' + index + '</h6><div class="card-body"><div class="form-row">' +
                '<div class="form-group col-md-5"> <label for="">SKU/ Description</label> <select name="sku" id="' + (model) + '" class="form-control model' + index + '"><option value="">~ Pilih SKU ~</option></select></div>' +
                '<div class="form-group col-md-2"><label for="qty">QTY</label><input type="text" name="qty" id="' + (qty) + '" class="form-control qty' + index + '" placeholder="0"> </div>' +
                '<div class="form-group col-md-2"><label for="harga">Harga</label><input type="text" name="harga" id="' + (harga) + '" class="form-control harga' + index + '" placeholder="0"> </div>' +
                '<div class="form-group col-md-3"><label for="harga">Amount</label><input type="text" name="amount" id="' + (amount) + '" class="form-control amount' + index + '" placeholder="0" readonly></div>' +
                '</div></div></div>' +
                '</form>'
            );

            $('.model' + index).select2({
                allowClear: true,
                ajax: {
                    url: "<?= base_url('adminpo/cariSku') ?>",
                    type: 'post',
                    dataType: 'json',
                    delay: 250,
                    data: function(params) {
                        return {
                            searchSku: params.term // search term
                        };
                    },
                    processResults: function(response) {
                        // console.log(response);
                        return {
                            results: response
                        };
                    },
                    cache: true
                }
            });

            $("#model" + index).change(() => {
                var sku = $("#model" + index).val();
                var qty = $("#qty" + index).val();
                $.ajax({
                    url: "<?= base_url('adminpo/cariHarga') ?>",
                    method: 'POST',
                    dataType: 'JSON',
                    data: {
                        sku: sku
                    },
                    success: function(data) {
                        $("#harga" + index).val(data);

                        if (qty == '' || isNaN(qty)) {
                            qty = 0;
                        }
                        amount = parseInt(qty) * parseInt(data);

                        $("#amount" + index).val(amount);
                        // console.log(data)
                    }
                });
            });
            $("#harga" + index).keyup(() => {
                var qty = $("#qty" + index).val();
                var harga = $("#harga" + index).val();
                if (qty == '' || isNaN(qty)) {
                    qty = 0;
                }
                amount = parseInt(qty) * parseInt(harga);
                $("#amount" + index).val(amount);
            });

            $("#qty" + index).keyup(() => {
                var qty = $("#qty" + index).val();
                var harga = $("#harga" + index).val();

                if (harga == '' || isNaN(harga)) {
                    harga = 0;
                }

                amount = parseInt(qty) * parseInt(harga);

                $("#amount" + index).val(amount);
            });
        });

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