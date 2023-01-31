<?php
error_reporting(0);
$pathimage = encode_img_base64('./assets/img/system/mkc3.png');
$tandatangan = encode_img_base64('./assets/img/assign/' . $header["confirmed_by"] . '.png');

function encode_img_base64($img_path = false, $img_type = 'png')
{
    if ($img_path) {
        //convert image into Binary data
        $img_data = fopen($img_path, 'rb');
        $img_size = filesize($img_path);
        $binary_image = fread($img_data, $img_size);
        fclose($img_data);

        $img_src = "data:image/" . $img_type . ";base64," . str_replace("\n", "", base64_encode($binary_image));

        return $img_src;
    }

    return false;
}

if ($header['dn_status'] == '0') {
    $status = 'Draft';
} else {
    $status = 'Complete';
}
?>
<style>
    .acak {
        text-align: left;
    }

    th,
    td {
        padding: 6px;
    }
</style>
<table style="border: 1px solid black; border-collapse:collapse" border="1" width="100%">
    <tr class="acak">
        <th width="20%" rowspan="3"><img src="<?= $pathimage ?>" width="225px"></th>
        <th width="55%" rowspan="2">
            <h2 style="text-align: center">Delivery Note</h2>
        </th>
        <th colspan="2" width="25%"><?= $status ?></th>
    </tr>
    <tr>
        <th class="acak">Tgl. DN</th>
        <th class="acak"><?= date("d/m/Y", $header["dn_create_date"]) ?></th>
    </tr>
    <tr>
        <th><?= $header["atasnama"] ?></th>
        <th class="acak">No PO</th>
        <th class="acak" style="font-size: 0.850em;"><?= $header["id_poxb"] ?></th>
    </tr>
</table>
<br>
<table width="100%" rules="rows" style="border: 1px solid black; border-collapse:collapse;">
    <tr>
        <th class="acak">Supplier</th>
        <th>:</th>
        <th class="acak">PT. Kalibaru</th>
        <td></td>
        <th class="acak">Delivery Note No. </th>
        <th>:</th>
        <th class="acak"><?= $header["dn_id"] ?></th>
    </tr>
    <tr>
        <th class="acak">No. Surat Jalan</th>
        <th>:</th>
        <th class="acak"><?= $header["no_bl"]; ?></th>
        <td></td>
        <th class="acak">Customer</th>
        <th>:</th>
        <th class="acak"><?= $header["enduser"] ?></th>
    </tr>
    <tr>
        <th class="acak">Tgl. Kirim</th>
        <th>:</th>
        <th class="acak"><?= $header["tgl_kirim"]; ?></th>
        <td></td>
        <th class="acak">No SJ (Kalibaru)</th>
        <th>:</th>
        <th class="acak"><?= $header["no_sj"] ?></th>
    </tr>
</table>
<br>
<table width="100%" style="border: 1px solid black; border-collapse:collapse;" rules="cols">
    <thead>
        <tr style="border-bottom:1px solid black;">
            <th class="acak">Deskripsi</th>
            <th>Qty</th>
            <th>Price</th>
            <th>Amount</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($detail as $d) { ?>
            <tr>
                <td><?= $d["sku_xb"] . " - " . $d["note"]; ?></td>
                <td style="text-align: center;"><?= number_format($d["qty"], 0, ".", ".") ?></td>
                <td style="text-align: center;">Rp. <?= number_format($d["item_price"], 0, ".", ".") ?></td>
                <td style="text-align: right;">Rp. <?= number_format($d["amount"], 0, ".", ".") ?></td>
            </tr>
        <?php } ?>
    </tbody>
    <tfoot>
        <tr style="border-top: 1px solid black;">
            <th style="text-align: left;">Total</th>
            <th><?= number_format($sums["qty"], 0, ".", ".") ?></th>
            <th>Rp. <?= number_format($sums["item_price"], 0, ".", ".") ?></th>
            <th style="text-align: right;">Rp. <?= number_format($sums["amount"], 0, ".", ".") ?></th>
        </tr>
        <tr style="border-top: 1px solid black;">
            <th style="text-align: left;">Tax</th>
            <th style="text-align: right" colspan="3">Rp. <?= number_format($sums["item_tax"], 0, ".", ".") ?></th>
        </tr>
        <tr style="border-top: 1px solid black;">
             <th style="text-align: left;">Grand Total</th>
             <th style="text-align: right" colspan="3">Rp. <?= number_format($sums["item_tax"] + $sums["amount"], 0, ".", ".") ?></th>
        </tr>
    </tfoot>
</table>
<br>
<footer>
    <table width="100%" style="border: 1px solid black; border-collapse: collapse" border="1">
        <tr>
            <th width="25%" style="text-align: center; border-left:1px">Acknowledge By</th>
            <th width="25%" style="text-align: center; border-left:1px">Acknowledge By</th>
            <th width="25%" style="text-align: center; border-left:1px">Approved By</th>
            <th width="25%" style="text-align: center; border-left:1px">Issued By</th>
        </tr>
        <tr>
            <th style="height: 75px;"></th>
            <th style="height: 75px;"></th>
            <th style="height: 75px; text-align: center"><img src="<?= $tandatangan; ?>" width="75px"></th>
            <td style="height: 75px;"></td>
        </tr>
        <tr>
            <th>( L.Barata )</th>
            <th>( Mirahwati )</th>
            <th>(<?= $header["confirmed_by"] ?>)</th>
            <th>(<?= $header["dn_issued_by"] ?>)</th>
        </tr>
        <tr>
            <td>Tgl. </td>
            <td>Tgl. </td>
            <td>Tgl. <?= date("d/m/Y", $header["confirmed_date"]) ?></td>
            <td>Tgl. <?= date("d/m/Y", $header['dn_create_date']) ?></td>
        </tr>
    </table>
</footer>