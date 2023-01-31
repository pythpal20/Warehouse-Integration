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
<?php
error_reporting(0);
$no_co  = $header['No_Co'];
$noso   = $header['noso'];
$poxb   = $this->db->get_where('tb_poheader', ['noso' => $noso])->row_array();
$npt    = explode("-", $no_co)[0];

$nmpt   = $this->db->get_where('tb_perusahaan', ['nama_pt' => $npt])->row_array();
?>
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h4 class="h4 mb-4 text-gray-800"><?= $title; ?></h4>
    <div class="card mb-3" style="border-top-color: CadetBlue; border-top-width: 3px;">
        <h5 class="card-header card-title">Form New DN</h5>
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <form id="formHeader">
                        <input type="hidden" name="uname" id="uname" value="<?= $user['user_nama']; ?>">
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="namapt">Nama PT</label>
                                <input type="text" name="namapt" id="namapt" value="<?= $nmpt['atasnama'] ?>" class="form-control" disabled>
                                <input type="hidden" name="idpt" id="idpt" value="<?= $nmpt['id_perusahaan'] ?>">
                                <input type="hidden" name="xpt" id="xpt" value="<?= $nmpt['nama_pt'] ?>">
                            </div>
                            <div class="form-group col-md-3">
                                <label for="nobl">No BL/ Surat Jalan</label>
                                <input type="text" class="form-control" name="nobl" id="nobl" value="<?= str_replace("CO", "BL", $no_co); ?>" readonly>
                            </div>
                            <div class="form-group col-md-2">
                                <label for="tglkirim">Tgl. Terkirim</label>
                                <input type="text" name="tglkirim" id="tglkirim" class="form-control" value="<?= date_format(date_create($header['tgl_delivery']), "Y-m-d"); ?>" readonly>
                            </div>
                            <div class="form-group col-md-3">
                                <label for="enduser">No. PO-XB</label>
                                <input type="text" name="poxb" id="poxb" class="form-control" value="<?= $poxb['po_id']; ?>" readonly>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="enduser">End-User</label>
                                <input type="text" name="enduser" id="enduser" class="form-control" value="<?= $header['customer_nama']; ?>" readonly>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="surjat">Surat Jalan (XB)</label>
                                <input type="text" name="surjat" id="surjat" class="form-control">
                            </div>
                        </div>
                    </form>
                </div>
                <hr>
                <div class="col-md-12">
                    <div class="colDetail">
                        <?php
                        $no = 1;
                        foreach ($sku as $s) {
                            $bil = $this->db->get_where('tb_bom', ['sku_mk' => $s['model']])->result_array();
                            if ($bil) {
                                foreach ($bil as $b) {
                                    $amounts = $s['qty_kirim'] * $b['harga'];

                        ?>
                                    <form id="form<?= $no ?>" class="formsx">
                                        <div class="card border-left-info mt-3">
                                            <p class="card-header card-subtitle">Item-<?= $no; ?></p>

                                            <div class="card-body">
                                                <div class="form-row">
                                                    <div class="form-group col-sm-3">
                                                        <label for="skus">SKU</label>
                                                        <input type="text" name="model" id="model<?= $no; ?>" class="form-control" value="<?= $b['sku_xb']; ?>">
                                                        <input type="hidden" name="skus" id="skus<?= $no; ?>" class="form-control" value="<?= $b['id']; ?>">
                                                    </div>
                                                    <div class="form-group col-sm-2">
                                                        <label for="skus">Qty</label>
                                                        <input type="text" name="qty" id="qty<?= $no; ?>" class="form-control" value="<?= $s['qty_kirim']; ?>">
                                                    </div>
                                                    <div class="form-group col-sm-2">
                                                        <label for="skus">Price/unit</label>
                                                        <input type="password" name="prc" id="prc<?= $no; ?>" class="form-control" value="<?= $b['harga']; ?>" readonly>
                                                    </div>
                                                    <div class="form-group col-sm-2">
                                                        <label for="skus">Amount</label>
                                                        <input type="password" name="amt" id="amt<?= $no; ?>" class="form-control" value="<?= $amounts; ?>" readonly>
                                                    </div>
                                                    <div class="form-group col-sm-3">
                                                        <label for="ket">Keterangan</label>
                                                        <input type="text" name="ket" id="ket<?= $no ?>" class="form-control" value="<?= $b['keterangan']; ?>">
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </form>
                        <?php
                                    $no++;
                                }
                            } else {
                                echo '<b>' . $s["model"] . '</b> ini tidak terdaftar dalam Bill OF Material<br>';
                            }
                        };  ?>

                        <input type="hidden" id="noms" value="<?= $no ?>">
                        <div id="tbls" data-toggle="tooltip">
                            <button id="sippan" class="btn btn-sm btn-primary mt-3 float-right sippan"><i class="fas fa-fw fa-save"></i>| SAVE</button>
                            <button class="btn btn-sm mt-3 btn-danger batal"><i class="fas fa-fw fa-close"></i>| CANCEL</button>
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
<!-- JavaScript -->
<script>
    $(document).ready(() => {
        var xxx = $("#poxb").val();
        if(xxx == '') {
            swal.fire({
                title: 'P/T Ini belum ada Po XB nya!',
                text: 'P/T ini adalah Pickticket sebelum system, tidak bisa dibuat jadi DN',
                icon: 'warning',
                allowOutsideClick: false,
                confirmButtonColor: '#16A085',
                confirmButtonText: 'Ok, Baiklah'
            }).then((rxs)=>{
                if(rxs.isConfirmed){
                    window.history.back();
                }
            });
        }
    });
    
    $(document).ready(function() {
        $(function() {
            $('[data-toggle="tooltip"]').tooltip()
            $('[rel="tooltip"]').tooltip()
        })
    });
    $(document).ready(function() {
        /**
         * tombol batal akan mendirect kita kembali ke halaman sebelumnya
         */
        $(".batal").click(() => {
            swal.fire({
                title: 'Batalkan ?',
                text: 'Anda akan kembali kehalaman sebelumnya',
                imageUrl: "<?= base_url('assets/img/icon/happy_feeling.svg'); ?>",
                imageHeight: 150,
                showCancelButton: true,
                cancelButtonColor: '#40E0D0',
                confirmButtonColor: '#FA8072'
            }).then((creslt) => {
                if (creslt.isConfirmed) {
                    window.history.back();
                }
            });
        })

        var index = $("#noms").val() - 1;
        for (let i = 1; i <= index; i++) {
            $("#qty" + i).keyup(() => {
                var harga = $("#prc" + i).val();
                var qty = $("#qty" + i).val();

                amount = parseInt(qty) * parseInt(harga);

                $("#amt" + i).val(amount);
            });
        }

        $(".sippan").click(() => {
            swal.fire({
                title: 'Terbitkan DN?',
                text: 'No DN akan dibuat saat anda klik OK',
                imageUrl: "<?= base_url('assets/img/icon/question.svg'); ?>",
                imageHeight: 150,
                showCancelButton: true,
                cancelButtonColor: '#FA8072',
                confirmButtonColor: '#40E0D0'
            }).then((result) => {
                if (result.isConfirmed) {
                    var formx = $("#formHeader").serializeArray();
                    $.ajax({
                        url: "<?= base_url('deliverynote/createDns'); ?>",
                        method: 'POST',
                        data: formx,
                        success: function(data) {
                            var idn = data;
                            for (var i = 1; i <= index; i++) {
                                var form = $("#form" + (i)).serializeArray();
                                form.push({
                                    name: 'idpo',
                                    value: idn
                                });
                                form.push({
                                    name: 'urutan',
                                    value: i
                                });
                                $.ajax({
                                    url: "<?= base_url('deliverynote/dn_detail') ?>",
                                    method: 'POST',
                                    data: form,
                                    success: function(data) {

                                    }
                                });
                            }
                        }
                    });
                }
            });
        });

        var a = $(".formsx").serializeArray();
        /**
         * Jika sku dalam surat jalan tidak ada dalam table tb_bom (bill of material)
         * maka tombol komplit BL akan mengubah status_DN di table mkits menjadi 2 atau 1
         * sehingga BL tersebut tidak muncul lagi di menu  Picktiket Done
         */
        if (a == '') {
            $("#tbls").append(
                '<button class="btn btn-sm btn-warning completes mt-3"><i class="fas fa-fw fa-check"></i>| Complete BL</button>'
            );

            document.getElementById("sippan").setAttribute('disabled', 'true');

            $(".completes").click(() => {
                var formx = $("#formHeader").serializeArray();
                $.ajax({
                    url: "<?= base_url('deliverynote/completBL') ?>",
                    method: 'POST',
                    data: formx,
                    success: function(data) {
                        console.log(data)
                    }
                });
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
                title: 'Berhasil',
                text: 'DN Berhasil diterbitkan',
                icon: 'success',
            }).then((rels) => {
                if (rels.isConfirmed) {
                    window.location.href = "<?= base_url('deliverynote/pickticket') ?>";
                }
            });
        });
    });
</script>