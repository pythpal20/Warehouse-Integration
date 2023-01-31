<?php
$idpt = $poheader['id_perusahaan'];
$dibuat = explode(" ",$poheader["created_by"])[0];

$pt = $this->db->get_where('tb_perusahaan', ['id_perusahaan' => $idpt])->row_array();

$pathimage = encode_img_base64('./assets/img/mkc.png');

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

$html = '';
$html .='<style>
    .teks{
        font-size: 0.865em;
    }
    .keatas {
        vertical-align: top;
    }
</style>';
$html .= '<table width="100%" style="border-collapse: collapse; border: 1px solid black;">
    <tr>
        <td rowspan="2" width="25%"><div class="keatas"><img src="' . $pathimage . '" height="50px"></div></td>
        <th class="text-center" width="45%" style="vertical-align: top;"><h4>' . $pt["atasnama"] . '</h4></th>
        <td width="30%" colspan="2"></td>
    </tr>
    <tr>
        <th class="text-center" style="vertical-align: bottom;"><u>PURCHASE ORDER</u></th>
        <td colspan="2"></td>
    </tr>
    <tr class="teks">
        <td>
            <div style="margin-left: 5px">To :<br/>
			<b>PT. KALIBARU</b><br/>
			Jl. Arjuna No. 50<br/>
			Bandung 40172<br/>
			Indonesia</div>
		</td>
		<td></td>
		<td style="vertical-align: top;">
			PO No.<br><br>
			Date
		</td>
		<td style="vertical-align: top;">
			: ' . $poheader["po_id"] . '<br><br>
			: ' . $poheader["po_date"] . '
		</td>
	</tr>
</table>
<br>
<table style="border: 1px solid black; border-collapse: collapse;" width="100%" class="teks" border="1">
	<thead>
        <tr>
            <th>NO.</th>
            <th>DESCRIPTION</th>
            <th>QTY</th>
            <th>PRICE/UNIT</th>
            <th>AMOUNT</th>
		</tr>
	</thead>
    <tbody>';
        $no=1;
        foreach($podetail->result() as $dt){
            $html .='<tr>
            <td>' . $no++ . '</td>
			<td>'. $dt->sku_xb.'</td>
			<td>' . $dt->qty_po . '</td>
			<td>Rp. '. number_format($dt->price, 0, ".", "."). '</td>
			<td>Rp. '. number_format($dt->amount, 0,".", ".") .'</td>
        </tr>';
        }
    $html .='<tr>
    <td colspan="4">Sub Total</td>
    <th style="text-align:left;">Rp. ' . number_format($sums['amount'], 0, ".", ".") . '</th>
    </tr>
    <tr>
        <td colspan="4">PPN 11%</td>
        <th style="text-align:left;">Rp. ' . number_format($sums['tax'], 0, ".", ".") . '</th>
	</tr>
    <tr>
        <td colspan="4">TOTAL</td>
        <th style="text-align:left;">Rp. ' . number_format($sums['tax'] + $sums['amount'], 0, ".", ".") . '</th>
	</tr>
    </tbody></table>
    <br>
    <table style="width: 100%; border-collapse: collapse; border: 1px solid black">
        <tr>
            <td>Delivery To</td>
            <td>: ' . $pt["atasnama"] . '</td>
        </tr>
        <tr>
            <td>Keterangan</td>
            <td>: ' . $poheader["po_note"] . '</td>
        </tr>
        <tr>
            <td>Delivery Required</td>
            <td>: ' . $poheader["po_delivery_date"] . '</td>
        </tr>
    </table><br>
    <table width="100%" style="border: 1px solid black; border-collapse: collapse" border="1" class="teks">
        <tr style="text-align: center">
            <th width="15%">Acknowledge by</th>
            <th border="0" rowspan="3"></th>
            <th width="15%">Acknowledge by</th>
            <th width="15%">Acknowledge by</th>
            <th width="14%">Acknowledge by</th>
            <th width="14%">Acknowledge by</th>
            <th width="14%">Dibuat</th>
        </tr>
        <tr>
            <td style="height: 75px;"></td>
            <td style="height: 75px;"></td>
            <td style="height: 75px;"></td>
            <td style="height: 75px;"></td>
            <td style="height: 75px;"></td>
            <td style="height: 75px;"></td>
		</tr>
        <tr style="text-align: center">
            <td>David Suganda</td>
            <td>'.$poheader["acknowlege2"].'</td>
            <td>'.$poheader["acknowlege3"].'</td>
            <td>'.$poheader["acknowlege4"].'</td>
            <td>'.$poheader["acknowlege5"].'</td>
            <td>'.$dibuat.'</td>
        </tr>
    </table>';
echo $html;
