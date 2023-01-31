<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h5 class="h5 mb-4 text-gray-800"><?= $title; ?></h5>
    <div class="row">
        <div class="col-lg-12">
            <div class="card border-bottom-danger">
                <h6 class="card-title card-header">Form Proses Mutasi</h6>
                <div class="card-body">
                    <form id="formApproval">
                        <?php foreach ($muts as $mt) : ?>
                            <input type="hidden" name="code" id="code" value="<?= $mt['id_mutasi'] ?>">
                            <input type="hidden" name="stas" id="stas" value="<?= $mt['status'] ?>">
                            <input type="hidden" name="mutby" id="mutby" value="<?= $mt['mutasi_by'] ?>">
                            <div class="row">
                                <div class="col-sm-4">
                                    <div class="form-group row">
                                        <label for="nuser" class="col-sm-3 col-form-label">User</label>
                                        <div class="col-sm-9">
                                            <input type="text" name="nuser" id="nuser" class="form-control" value="<?= $user['user_nama'] ?>" readonly>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="njenis" class="col-sm-3 col-form-label">Jenis Mutasi</label>
                                        <div class="col-sm-9">
                                            <input type="text" name="njenis" id="njenis" class="form-control" value="<?= $mt['jenis_mutasi'] ?>" readonly>
                                        </div>
                                    </div>
                                    <?php if ($mt["jenis_mutasi"] == 'minus') : ?>
                                        <div class="form-group row">
                                            <label for="nsource" class="col-sm-3 col-form-label">Sumber</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="nsource" id="nsource" class="form-control" value="<?= $mt['source'] ?>" readonly>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                    <?php if ($mt["jenis_mutasi"] == 'plus') : ?>
                                        <div class="form-group row">
                                            <label for="ndestination" class="col-sm-3 col-form-label">Tujuan</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="ndestination" id="ndestination" class="form-control" value="<?= $mt['destination'] ?>" readonly>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                    <?php if ($mt["jenis_mutasi"] == 'mutation') : ?>
                                        <div class="form-group row">
                                            <label for="nsource" class="col-sm-3 col-form-label">Sumber</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="nsource" id="nsource" class="form-control" value="<?= $mt['source'] ?>" readonly>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="ndestination" class="col-sm-3 col-form-label">Tujuan</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="ndestination" id="ndestination" class="form-control" value="<?= $mt['destination'] ?>" readonly>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                </div>
                                <div class="col-sm-8">
                                    <div class="form-row">
                                        <div class="form-group col-sm-4">
                                            <label for="suratjalan">Model/ SKU</label>
                                            <input type="text" name="nmodel" id="nmodel" class="form-control" value="<?= $mt['model']; ?>" readonly>
                                        </div>
                                        <div class="form-group col-sm-6">
                                            <label for="suratjalan">No. LPB/ SPB/ SJ/ Ref</label>
                                            <input type="text" name="nketerangan" id="nketerangan" class="form-control" value="<?= $mt['keterangan']; ?>" readonly>
                                        </div>
                                        <div class="form-group col-sm-2">
                                            <label for="qty">Qty Mutasi</label>
                                            <input type="number" name="qtys" id="qtys" class="form-control" value="<?= $mt['qty_mutasi']; ?>" readonly>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-sm-12">
                                            <label for="note">Note/ Keterangan</label>
                                            <textarea name="note" id="note" cols="30" rows="4" class="form-control"></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </form>

                    <button class="btn btn-warning btn-sm batal"><span class="fas fa-fw fa-arrow-left"></span> Batal</button>
                    <button class="btn btn-danger btn-sm tolak" id="tolaks"><span class="fas fa-fw fa-close"></span> Tolak</button>
                    <button class="btn btn-primary btn-sm float-right proses" id="prosess"><span class="fas fa-fw fa-check"></span> Proses</button>
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
        var sku = $("#nmodel").val();
        var jenMut = $("#njenis").val();
        var qty = $("#qtys").val();
        if(jenMut == 'minus' || jenMut == 'mutation') {
            var src = $("#nsource").val();
            $.ajax({
                url: "<?= base_url('warehouse/cekStok') ?>",
                method: 'POST',
                data: {
                    sumber: src,
                    sku: sku
                }, 
                success: function(data){
                    var supra = data-qty;
                    console.log(supra);
                    console.log(data);
                    console.log(qty);
                    if(supra < 0) {
                        swal.fire({
                            title: "Stok tidak mencukupi",
                            text: 'Stok ' + src + ' Sisa ' + data + 'pcs re-stok terlebih dahulu, perhatikan stok on Hand sebelum mutasi',
                            icon: 'warning',
                            allowOutsideClick: false,
                            showCancelButton: false
                        }).then((aerox) => {
                            if(aerox.isConfirmed) {
                                document.getElementById("prosess").setAttribute("disabled", "true");
                            }
                        });
                    }
                }
            });
        } 
    });

    $(document).ready(function() {
        var status = $("#stas").val();
        if (status == '1' || status == '2') {
            document.getElementById("tolaks").setAttribute("disabled", "true");
            document.getElementById("prosess").setAttribute("disabled", "true");
        }
        $(".batal").click(() => {
            window.location.href="<?= base_url('warehouse/mutasi') ?>"
        });
        // JIka yang dipencet adalah tombol tolak
        $(".tolak").click(function() {
            var note = $("#note").val();
            if (note == '') {
                swal.fire(
                    'Upps.. Lengkapi Form',
                    'Kolom Note/ Keterangan harus diisi',
                    'warning'
                );
            } else {
                swal.fire({
                    title: 'Tolak mutasi ini ?',
                    text: 'Pastikan anda sudah melakukan pengecekan terlebih dahulu',
                    imageUrl: "<?= base_url('assets/img/icon/question.svg'); ?>",
                    imageHeight: 150,
                    showCancelButton: true,
                    cancelButtonColor: '#3498DB',
                    confirmButtonColor: '#E74C3C',
                    confirmButtonText: 'Ya, Tolak'
                }).then((result) => {
                    if (result.isConfirmed) {
                        var form = $("#formApproval").serializeArray();
                        var act = 'tolak';
                        form.push({
                            name: 'act',
                            value: act
                        });
                        $.ajax({
                            url: "<?= base_url('warehouse/appsProc') ?>",
                            method: 'POST',
                            data: form,
                            success: function(data) {
                                console.log(data);
                                swal.fire({
                                    title: data,
                                    text: 'Tekan tombol OK untuk menutup halaman',
                                    imageUrl: "<?= base_url('assets/img/icon/completed.svg'); ?>",
                                    imageHeight: 150,
                                    showCancelButton: false,
                                    allowOutsideClick: false
                                }).then((succ) => {
                                    if (succ.isConfirmed) {
                                        window.location.href="<?= base_url('warehouse/mutasi') ?>"
                                    }
                                });
                            }
                        });
                    }
                });
            }
        });
        // jika yang dipencet adalah tombol proses
        $(".proses").click(function() {
            swal.fire({
                title: 'Approve mutasi ini ?',
                text: 'Pastikan anda sudah melakukan pengecekan terlebih dahulu',
                imageUrl: "<?= base_url('assets/img/icon/question.svg'); ?>",
                imageHeight: 150,
                showCancelButton: true,
                cancelButtonColor: '#E74C3C',
                confirmButtonColor: '#3498DB',
                confirmButtonText: 'Ya, Approve'
            }).then((res) => {
                if (res.isConfirmed) {
                    var form = $("#formApproval").serializeArray();
                    var act = 'terima';
                    form.push({
                        name: 'act',
                        value: act
                    })
                    $.ajax({
                        url: "<?= base_url('warehouse/appsProc') ?>",
                        method: 'POST',
                        data: form,
                        success: function(data) {
                            console.log(data);
                            swal.fire({
                                title: data,
                                text: 'Tekan tombol OK untuk menutup halaman',
                                imageUrl: "<?= base_url('assets/img/icon/completed.svg'); ?>",
                                imageHeight: 150,
                                showCancelButton: false,
                                allowOutsideClick: false
                            }).then((succ) => {
                                if (succ.isConfirmed) {
                                    window.location.href="<?= base_url('warehouse/mutasi') ?>"
                                }
                            });
                        }
                    });
                } else if (res.dismiss === Swal.DismissReason.cancel) {
                    window.location.href="<?= base_url('warehouse/mutasi') ?>"
                }
            });
        });
    });
</script>