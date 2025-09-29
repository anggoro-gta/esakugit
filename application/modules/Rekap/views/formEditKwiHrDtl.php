<section class="content-header">
    <div class="content">
        <div class="col-md-12">
            <div class="judul">Edit Nama Narasumber / Moderator</div>
            <h1>
                <a href="<?=base_url()?>Rekap/updateNarsum/<?=$id_rekap?>" class="btn btn-sm btn-primary"><i class="glyphicon glyphicon-list-alt"></i> Tabel Data</a>
            </h1>
        </div>
    </div>
</section>
<section class="content_section">
    <div class="content_spacer">
        <div class="content">
            <div class="box col-md-12">
                <div class="box-inner">
                    <div class="box-header well">
                        <h2></h2>
                    </div>
                    <div class="box-content">
                        <form class="form-horizontal" style="font-size: 10pt" action="<?php echo base_url();?>Rekap/saveNamaNarsum" method="post" enctype="multipart/form-data" autocomplete='off'>
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th class="text-center" style="vertical-align: middle" rowspan="2" width="50px">No</th>
                                        <th class="text-center" style="vertical-align: middle" rowspan="2" width="30%">Nama</th>
                                        <th class="text-center" style="vertical-align: middle" rowspan="2" width="30%">No Rekening</th>
                                        <th class="text-center" style="vertical-align: middle" rowspan="2" width="15%">Nama Bank</th>
                                        <th class="text-center" style="vertical-align: middle" rowspan="2" width="30%">NPWP</th>
                                        <th class="text-center" style="vertical-align: middle" rowspan="2">Jabatan dlm Kegiatan</th>
                                        <th class="text-center" colspan="5">Jumlah Penerima</th>
                                        <th class="text-center" colspan="2">PPh 21</th>
                                        <th class="text-center" style="vertical-align: middle" rowspan="2">Jumlah Diterima</th>
                                    </tr>
                                    <tr>
                                        <th class="text-center">Nominal</th>
                                        <th class="text-center" width="80px">Persen</th>
                                        <th class="text-center">Sub Total</th>
                                        <th class="text-center" width="70px">Kali</th>
                                        <th class="text-center">Total</th>
                                        <th class="text-center" width="70px">%</th>
                                        <th class="text-center">Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no=1;?>
                                    <?php foreach((array)$arrKwitansiHRDetail as $val) :?>
                                        <tr>
                                            <td class="text-center"><?php echo $no++;?></td>
                                            <td>
                                                <input type="text" class="form-control" name="listNamaNarsum[<?=$val['id']?>]" value="<?=$val['nama']?>" required>
                                            </td>
                                            <td>
                                                <input type="text" class="form-control" name="listRekeningNarsum[<?=$val['id']?>]" value="<?=$val['no_rekening_narsum']?>" required>
                                            </td>
                                            <td>
                                                <input type="text" class="form-control" name="listBankNarsum[<?=$val['id']?>]" value="<?=$val['nama_bank_narsum']?>" required>
                                            </td>
                                            <td>
                                                <input type="text" class="form-control" name="listNpwpNarsum[<?=$val['id']?>]" value="<?=$val['npwp_narsum']?>">
                                            </td>
                                            <td><?=$val['jabatan_kegiatan']?></td>
                                            <td class="text-right"><?=number_format($val['nominal_bruto'])?></td>
                                            <td class="text-center"><?=$val['persen_kali']?></td>
                                            <td class="text-center"><?=number_format($val['sub_total_bruto'])?></td>
                                            <td class="text-center"><?=$val['jml_kali']?></td>
                                                <?php $totBruto = $val['sub_total_bruto']*$val['jml_kali'];?>
                                            <td class="text-right"><?=number_format($totBruto)?></td>
                                            <td class="text-center"><?=$val['pajak_persen']?></td>
                                                <?php $totPjkPph = ($totBruto*$val['pajak_persen'])/100;?>
                                            <td class="text-right"><?=number_format($totPjkPph)?></td>
                                            <td class="text-right"><?=number_format($totBruto-$totPjkPph)?></td>
                                        </tr>
                                    <?php endforeach;?>
                                </tbody>
                            </table>
                            <input type="hidden" name="idRekap" value="<?=$id_rekap?>">
                            <div class="form-group">
                                <div class="col-md-12"></div>
                                <div class="col-md-10" align="center">
                                <button id="submit" type="submit" class="btn btn-sm btn-success"><i class="glyphicon glyphicon-hdd"></i> Update</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>