<!DOCTYPE html>

<head>
    <title>BIDANG PERINDUSTRIAN KAB </title>
    <link rel="stylesheet" href="style_pkl.css" type="text/css" />

    <link rel="icon" href="gambar/icon.png" type="image/x-icon" />
</head>

<body background="gambar/photograph_img2.jpg">
    <div id="wrapper">
        <div id="headeratas" align="left">
            <br>
            <div align="right">

            </div>
        </div>


        <div id="header">

        </div>

        <div id="headerbawah">
            <marquee align="right" bgcolor="#CCCC99"> Selamat Datang Di Sistem Informasi Pendaftaran Pelatihan Bidang Industri IKAHH Kabupaten </marquee>
        </div>


        <div id="inner">
            <div id="inner2">
                <div id="menu">
                    <nav>
                        <ul type="disc">
                            <li><a href="index.php">Home</a></li>
                            <li><a href="?page=form_pendaftaran">Tata Cara Pendaftaran</a></li>
                            <li><a href="?page=kontak">Kontak</a></li>
                            <li><a href="?page=pengumuman">Pengumuman</a></li>
                            <li><a href="login.php">Login</a></li>

                        </ul>
                    </nav>
                </div>

                <div class="cleaner"></div>

                <div id="content">
                    <p>
                        <?php
                        require_once "bukafile.php";
                        ?>
                    </p>
                </div>
                <div id="footer">
                    Copyright @ Jogja Smart Indotama Bidang Industri IKAHH 2021
                </div>

                <div style="float:left" ;height:15px;width:100%">
                </div>


            </div>
        </div>

</body>

</html>