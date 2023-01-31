<?php
$perusahaan = $this->db->get_where('tb_perusahaan', ['id_perusahaan' => $header['id_perusahaan']])->row_array();
?>
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
                                    <input type="text" name="ack2" id="ack2" class="form-control teks" placeholder="wajib diisi" value="<?= $header['acknowlege2'] ?>">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Acknowledge 3</label>
                                    <input type="text" name="ack3" id="ack3" class="form-control teks" placeholder="wajib diisi" value="<?= $header['acknowlege3'] ?>">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Acknowledge 4</label>
                                    <input type="text" name="ack4" id="ack4" class="form-control teks" placeholder="wajib diisi" value="<?= $header['acknowlege4'] ?>">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Acknowledge 5</label>
                                    <input type="text" name="ack5" id="ack5" class="form-control teks" placeholder="wajib diisi" value="<?= $header['acknowlege5'] ?>">
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
                                            <input type="hidden" name="idpo" id="idpo" value="<?= $header['po_id']; ?>">
                                            <label for="deliverto">Delivery to</label>
                                            <input type="text" name="npts" id="npts" class="form-control" value="<?= $perusahaan['atasnama']; ?>" disabled>
                                            <input type="hidden" name="namapt" id="namapt" class="form-control" value="<?= $header['id_perusahaan']; ?>">
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="">No. SCO</label>
                                            <input type="text" name="sco" id="sco" value="<?= $header['noso'] ?>" class="form-control">
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-4">
                                            <label for="Tgl. PO">Tgl. PO</label>
                                            <input type="text" name="tglpo" id="tglpo" class="form-control" value="<?= $header['po_date'] ?>" readonly>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="Delivery Required">Delivery Required</label>
                                            <input type="date" name="tglkrm" id="tglkrm" class="form-control" value="<?= $header['po_delivery_date'] ?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-row">
                                        <div class="form-group col-md-12">
                                            <label for="keteragan">Keterangan</label>
                                            <textarea name="keterangan" id="keterangan" cols="35" rows="4" class="form-control"><?= $header['po_note']; ?></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <hr>
                    </div>
                    <!-- form detail item -->
                    <div id="box2" class="formDetail">
                        <?php
                        $no = 1;
                        foreach ($details->result() as $d) {
                        ?>
                            <form id="form<?= $no ?>" class="mt-3 formsx">
                                <div class="card">
                                    <h6 class="card-header card-title">Item-<?= $no; ?></h6>
                                    <div class="card-body">
                                        <div class="form-row">
                                            <div class="form-group col-md-5">
                                                <label for="">SKU/ Description</label>
                                                <input type="hidden" name="iditem" id="iditem" value="<?= $d->id ?>">
                                                <input type="hidden" name="sku" id="sku<?= $no ?>" class="form-control" value="<?= $d->id_bom; ?>">
                                                <input type="text" name="model" id="model<?= $no; ?>" class="form-control" value="<?= $d->sku_xb; ?>" disabled>
                                            </div>
                                            <div class="form-group col-md-2">
                                                <label for="qty">QTY</label>
                                                <input type="text" name="qty" id="qty<?= $no ?>" class="form-control qty<?= $no ?>" value="<?= $d->qty_po; ?>">
                                            </div>
                                            <div class="form-group col-md-2">
                                                <label for="harga">Harga</label>
                                                <input type="text" name="harga" id="harga<?= $no ?>" class="form-control harga<?= $no ?>" value="<?= $d->price ?>">
                                            </div>
                                            <div class="form-group col-md-3">
                                                <label for="harga">Amount</label>
                                                <input type="text" name="amount" id="amount<?= $no ?>" class="form-control amount<?= $no ?>" value="<?= $d->amount ?>">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        <?php
                            $no++;
                        }
                        ?>
                    </div>
                    <input type="hidden" id="jums" value="<?= $jums ?>">
                    <div class="" id="tbl_1">
                        <button class="btn btn-primary simpan float-right mt-2" id="sippan"><span class="fas fa-fw fa-save"></span> SAVE</button>
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
        var index = $("#jums").val();
        for (let i = 1; i <= index; i++) {
            $("#qty" + i).keyup(function() {
                var harga = $("#harga" + i).val();
                var qty = $("#qty" + i).val();

                amount = parseInt(qty) * parseInt(harga);

                if (!isNaN(amount)) {
                    $("#amount" + i).val(amount);
                } else {
                    $("#amount" + i).val('0');
                }
            });

            $("#harga" + i).keyup(function() {
                var harga = $("#harga" + i).val();
                var qty = $("#qty" + i).val();

                amount = parseInt(qty) * parseInt(harga);

                if (!isNaN(amount)) {
                    $("#amount" + i).val(amount);
                } else {
                    $("#amount" + i).val('0');
                }
            });
        }

        $(".simpan").click(() => {
            swal.fire({
                title: "Update POXB ini ?",
                text: 'Klik OK untuk melanjutkan, Cancel untuk kembali ke Form',
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#3CB371',
                cancelButtonColor: '#FF6347'
            }).then((resul) => {
                if (resul.isConfirmed) {
                    var formHeader = $("#formHeader").serializeArray();
                    var ack_2 = $("#ack2").val();
                    var ack_3 = $("#ack3").val();
                    var ack_4 = $("#ack4").val();
                    var ack_5 = $("#ack5").val();
                    var noso = $("#sco").val();
                    formHeader.push({
                        name: 'ack2',
                        value: ack_2
                    });
                    formHeader.push({
                        name: 'ack3',
                        value: ack_3
                    });
                    formHeader.push({
                        name: 'ack4',
                        value: ack_4
                    });
                    formHeader.push({
                        name: 'ack5',
                        value: ack_5
                    });
                    if (ack_2 == '' || ack_3 == '' || ack_4 == '' || ack_5 == '' || noso == '') {
                        swal.fire(
                            'Kolom tidak boleh kosong',
                            'ulangi',
                            'warning'
                        )
                    } else {
                        $.ajax({
                            url: "<?= base_url('adminpo/saveEdit'); ?>",
                            method: 'POST',
                            data: formHeader,
                            success: function(data) {
                                console.log(data);
                                var idpo = $("#idpo").val();
                                for (var i = 1; i <= index; i++) {
                                    var form = $("#form" + (i)).serializeArray();
                                    form.push({
                                        name: 'idpo',
                                        value: idpo
                                    });
                                    $.ajax({
                                        url: "<?= base_url('adminpo/saveEdit_dtl') ?>",
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
                }
            });
        });
        $(document).ajaxStart(function() {
            $("#insert").modal({
                backdrop: 'static',
                keyboard: true,
                show: true
            });
        }).ajaxStop(function() {
            $("#insert").modal('hide');
            swal.fire({
                title: 'Good Job',
                text: 'Revisi PO XB Berhasil',
                imageUrl: "<?= base_url('assets/img/icon/happy_feeling.svg'); ?>",
                imageHeight: 150
            }).then((rsult)=> {
                if(rsult.isConfirmed) {
                    window.location.href= "<?= base_url('adminpo/poxb') ?>";
                }
            });
        });
    });
</script>