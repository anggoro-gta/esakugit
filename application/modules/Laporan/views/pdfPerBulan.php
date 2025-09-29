<!doctype html>
<html>
    <head>
        <title>Laporan Per Bulan</title>
    </head>
    <body>
        <div class="responsive">
            <table width="100%" style="font-size:11pt">
                <tr>
                    <th colspan="33">Laporan Data Kegiatan</th> 
                </tr>
                <tr>
                    <th colspan="33"><?=$judul;?></th> 
                </tr>
                <tr><td colspan="33">&nbsp;</td></tr>
            </table>
            <table border="1" cellspacing="0" width="100%" style="font-size:10px">
                <thead>
                    <tr>
                        <th style="vertical-align: middle;" rowspan="2" width="4%">No</th>
                        <th style="vertical-align: middle;" rowspan="2">Nama SDM</th>
                        <th style="text-align: center;" colspan="31">Tanggal</th>
                    </tr>
                    <tr>
                        <th>1</th><th>2</th><th>3</th><th>4</th><th>5</th><th>6</th><th>7</th><th>8</th><th>9</th><th>10</th>
                        <th>11</th><th>12</th><th>13</th><th>14</th><th>15</th><th>16</th><th>17</th><th>18</th><th>19</th><th>20</th>
                        <th>21</th><th>22</th><th>23</th><th>24</th><th>25</th><th>26</th><th>27</th><th>28</th><th>29</th><th>30</th>
                        <th>31</th>
                    </tr>
                </thead>  
                <tbody>
                    <?php $no=1; foreach ((array)$namaSDM as $val): ?>
                        <tr>
                            <td style="text-align: center;"><?=$no++?></td>
                            <td><?=$val->nama_sdm?></td>
                            <?php for ($i=1; $i <= 31; $i++) { ?>
                                <?php
                                    if(isset($hasil[$val->fk_sdm_id])){
                                        echo "<td style='text-align: center;'>";
                                        foreach ($hasil[$val->fk_sdm_id] as $dtl) {
                                            if($dtl->tgl==$i){
                                                if($dtl->fk_kegiatan_orang_id==1){
                                                    echo "<div style='background-color:red;'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div>";
                                                }
                                                if($dtl->fk_kegiatan_orang_id==2){
                                                    echo "<div style='background-color:green;'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div>";
                                                }
                                                if($dtl->fk_kegiatan_orang_id==3){
                                                    echo "<div style='background-color:blue;'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div>";
                                                }
                                                if($dtl->fk_kegiatan_orang_id==4){
                                                    echo "<div style='background-color:yellow;'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div>";
                                                }
                                            }
                                        }
                                         echo "</td>";                                                            
                                    }else{
                                        echo "<td></td>";
                                    }
                                ?>
                            <?php } ?>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <br>
            <div class="col-md-6">                    
                <table cellspacing="0" width="30%" style="font-size:10px">
                    <tr>
                        <td style="text-align: right"><b>DL</b></td>
                        <td style="text-align: center" ><b>:</b></td>
                        <td style="color: red"><b>Merah</b></td>
                        <td style="text-align: right"><b>DD</b></td>
                        <td style="text-align: center"><b>:</b></td>
                        <td style="color: green"><b>Hijau</b></td>
                    </tr>
                    <tr>
                        <td style="text-align: right"><b>Rapat</b></td>
                        <td style="text-align: center" ><b>:</b></td>
                        <td style="color: blue"><b>Biru</b></td>
                        <td style="text-align: right"><b>Lembur</b></td>
                        <td style="text-align: center"><b>:</b></td>
                        <td style="color: yellow"><b>Kuning</b></td>
                    </tr>
                </table>
            </div>
        </div>
    </body>
</html>