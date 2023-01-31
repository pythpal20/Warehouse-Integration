<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h4 class="h4 mb-4 text-gray-800"><?= $title; ?></h4>
    <div class="card mb-3">
        <h5 class="card-header card-title">Edit Material</h5>
        <div class="row no-gutters">
            <div class="col-md-12">
                <div class="card-body">
                    <form action="<?= base_url('bofmat/editBom'); ?>" method="POST">
                        <?php foreach ($bom as $b): ?>
                        <div class="row">
                            <div class="col-sm-4">
                                <input type="hidden" id="code" name="code" value="<?=$b['id']; ?>">
                                
                                <div class="form-group">
                                    <label for="skumk">SKU MK</label>
                                    <select name="skua" id="skua" class="form-control skua">
                                        <option value="<?=$b['sku_mk']; ?>"><?=$b['sku_mk']; ?></option>
                                    </select>
                                    <?= form_error('skua', '<small class="text-danger pl-3">', '</small>'); ?>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label for="skub">SKU XB</label>
                                    <input type="text" id="skub" name="skub" class="form-control skub" placeholder="nama sku xb" value="<?= $b['sku_xb']; ?>">
                                    <?= form_error('skub', '<small class="text-danger pl-3">', '</small>'); ?>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label for="harga">Harga (Rp.)</label>
                                    <input type="number" name="harga" id="harga" class="form-control" placeholder="harga barang" value="<?= $b['harga']; ?>">
                                    <?= form_error('harga', '<small class="text-danger pl-3">', '</small>'); ?>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-7">
                                <div class="form-group">
                                    <label for="harga">Keterangan</label>
                                    <textarea name="keterangan" id="keterangan" rows="5" class="form-control"><?= $b['keterangan']; ?></textarea>
                                </div>
                            </div>
                        </div>
                        <?php endforeach; ?>
                        <button class="btn btn-info btn-rounded mb-3">Simpan</button>
                    </form>
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
        $("#skua").select2({
            placeholder: 'Search SKU or Barcode',
            allowClear: true,
            ajax: {
                url: '<?= base_url('bofmat/getsku'); ?>',
                type: 'POST',
                dataType: 'json',
                delay: 250,
                data: function(params) {
                    return {
                        searchNama: params.term // search term
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
    });
</script>