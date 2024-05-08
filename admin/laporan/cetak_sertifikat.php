<?php
include '../../koneksi.php';
$id = $_POST['id'];
$query = mysqli_query($CON, "SELECT tb_pendaftaran.nama_peserta, tb_jenispelatihan.nama_pelatihan, tb_pelatihan.jadwal from tb_pendaftaran inner join tb_pelatihan on tb_pendaftaran.id_pelatihan=tb_pelatihan.id_pelatihan inner join tb_jenispelatihan on tb_pelatihan.id_jenispelatihan=tb_jenispelatihan.id_jenispelatihan where tb_pendaftaran.id_peserta = '$id'");
$data = mysqli_fetch_array($query);
//$update = mysqli_query($CON, "UPDATE `tb_kehadiran` SET `presensi` = 'diterbitkan' WHERE `tb_kehadiran`.`id_peserta` = '$id'")
?>
<!DOCTYPE html>
<html>

<head>
  <meta http-equiv=Content-Type content="text/html; charset=windows-1252">
  <meta name=Generator content="Microsoft Word 15 (filtered)">
  <style>
    <!--
    /* Font Definitions */
    @font-face {
      font-family: "Cambria Math";
      panose-1: 2 4 5 3 5 4 6 3 2 4;
    }

    @font-face {
      font-family: Calibri;
      panose-1: 2 15 5 2 2 2 4 3 2 4;
    }

    @font-face {
      font-family: "Lucida Calligraphy";
      panose-1: 3 1 1 1 1 1 1 1 1 1;
    }

    @font-face {
      font-family: "Adobe Myungjo Std M";
      panose-1: 2 2 6 0 0 0 0 0 0 0;
    }

    @font-face {
      font-family: "\@Adobe Myungjo Std M";
    }

    /* Style Definitions */
    p.MsoNormal,
    li.MsoNormal,
    div.MsoNormal {
      margin-top: 0cm;
      margin-right: 0cm;
      margin-bottom: 8.0pt;
      margin-left: 0cm;
      line-height: 107%;
      font-size: 11.0pt;
      font-family: "Calibri", sans-serif;
    }

    p.MsoHeader,
    li.MsoHeader,
    div.MsoHeader {
      mso-style-link: "Header Char";
      margin: 0cm;
      margin-bottom: .0001pt;
      font-size: 11.0pt;
      font-family: "Calibri", sans-serif;
    }

    p.MsoFooter,
    li.MsoFooter,
    div.MsoFooter {
      mso-style-link: "Footer Char";
      margin: 0cm;
      margin-bottom: .0001pt;
      font-size: 11.0pt;
      font-family: "Calibri", sans-serif;
    }

    span.HeaderChar {
      mso-style-name: "Header Char";
      mso-style-link: Header;
    }

    span.FooterChar {
      mso-style-name: "Footer Char";
      mso-style-link: Footer;
    }

    .MsoChpDefault {
      font-family: "Calibri", sans-serif;
    }

    .MsoPapDefault {
      margin-bottom: 8.0pt;
      line-height: 107%;
    }

    /* Page Definitions */
    @page WordSection1 {
      size: 841.9pt 595.3pt;
      margin: 72.0pt 72.0pt 72.0pt 72.0pt;
    }

    div.WordSection1 {
      page: WordSection1;
    }
    -->
  </style>

</head>

<body lang=EN-ID>

  <div class=WordSection>
    <p class=MsoNormal align=center style='text-align:center'><span lang=IN style='font-size:20.0pt;line-height:107%;font-family:"Times New Roman",serif'>PEMERINTAH
        KABUPATEN </span></p>

    <p class=MsoNormal align=center style='text-align:center'><span lang=IN style='font-size:20.0pt;line-height:107%;font-family:"Times New Roman",serif'>DINAS
        PERINDUSTRIAN, KOPERASI DAN UMKM</span></p>
    <center><img height=130 src=".png"></center>
    <hr><br>

    <p class=MsoNormal align=center style='text-align:center'><span lang=IN style='font-size:28.0pt;line-height:107%;font-family:"Lucida Calligraphy"'>SERTIFIKAT</span></p>

    <p class=MsoNormal align=center style='text-align:center'><span lang=IN style='font-size:12.0pt;line-height:107%;font-family:"Times New Roman",serif'>DIBERIKAN
        KEPADA:</span></p>

    <p class=MsoNormal align=center style='text-align:center'><span lang=IN style='font-size:24.0pt;line-height:107%;font-family:"Times New Roman",serif'><?php echo $data['nama_peserta']; ?></span></p>

    <p class=MsoNormal align=center style='text-align:center'><span lang=IN style='font-size:12.0pt;line-height:107%;font-family:"Times New Roman",serif'>SEBAGAI PESERTA</span></p>

    <p class=MsoNormal align=center style='text-align:center'><span lang=IN style='font-size:24.0pt;line-height:107%;font-family:"Lucida Calligraphy",serif'><?php echo $data['nama_pelatihan']; ?></span></p>

    <p class=MsoNormal align=center style='text-align:center'><span lang=IN style='font-size:14.0pt;line-height:107%;font-family:"Times New Roman",serif'>PADA
        PENYELENGGARAAN PELATIHAN WIRAUSAHA </span></p>

    <p class=MsoNormal align=center style='text-align:center'><span lang=IN style='font-size:14.0pt;line-height:107%;font-family:"Times New Roman",serif'>YANG
        DILAKSANAKAN PADA TANGGAL <?php $jadwal = date("d F Y", strtotime($data['jadwal']));
                                  echo $jadwal; ?> s/d <?php $jd = date("d F Y", strtotime($data['jadwal']) + (60 * 60 * 24 * 5));
                                                        echo $jd; ?></span></p>

    <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
text-align:center'><span lang=IN style='font-size:12.0pt;line-height:107%;
font-family:"Times New Roman",serif'>&nbsp;</span></p>

    <p class=MsoNormal align=center style='margin-top:0cm;margin-right:0cm;
margin-bottom:0cm;margin-left:324.0pt;margin-bottom:.0001pt;text-align:center'><span lang=IN style='font-size:12.0pt;line-height:107%;font-family:"Times New Roman",serif'>,<?php
                                                                                                                                                                            echo date('d F Y');
                                                                                                                                                                            ?></span></p>

    <p class=MsoNormal align=center style='margin-top:0cm;margin-right:0cm;
margin-bottom:0cm;margin-left:324.0pt;margin-bottom:.0001pt;text-align:center'><span lang=IN style='font-size:12.0pt;line-height:107%;font-family:"Times New Roman",serif'>KEPALA
        DINAS PERINDUSTRIAN,</span></p>

    <p class=MsoNormal align=center style='margin-top:0cm;margin-right:0cm;
margin-bottom:0cm;margin-left:324.0pt;margin-bottom:.0001pt;text-align:center'><span lang=IN style='font-size:12.0pt;line-height:107%;font-family:"Times New Roman",serif'>KOPERASI
        DAN UMKM</span></p>

    <p class=MsoNormal align=center style='text-align:center'><span lang=IN style='font-size:14.0pt;line-height:107%;font-family:"Times New Roman",serif'>&nbsp;</span></p>

    <p class=MsoNormal align=center style='text-align:center'><span lang=IN style='font-size:14.0pt;line-height:107%;font-family:"Times New Roman",serif'>&nbsp;</span></p>

    <p class=MsoNormal align=center style='margin-top:0cm;margin-right:0cm;
margin-bottom:0cm;margin-left:324.0pt;margin-bottom:.0001pt;text-align:center'><span lang=IN style='font-size:14.0pt;line-height:107%;font-family:"Times New Roman",serif'><?php $lihat = mysqli_query($CON, "SELECT * from tb_user where status = 'kadin'");
                                                                                                                                                                            $d = mysqli_fetch_array($lihat);
                                                                                                                                                                            echo $d['nama']; ?></span></p>

    <p class=MsoNormal align=center style='margin-top:0cm;margin-right:0cm;
margin-bottom:0cm;margin-left:324.0pt;margin-bottom:.0001pt;text-align:center'><span lang=IN style='font-size:12.0pt;line-height:107%;font-family:"Times New Roman",serif'>NIK.<?php echo $d['nik'] ?></span></p>

  </div>
  <script>
    window.print();
  </script>
</body>

</html>