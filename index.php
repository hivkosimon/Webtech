<?php
require 'dbconnect.php';
require 'functions.php';
?>

    <html>
    <head>
        <title>Šimon Hivko Evidencia dochadzky</title>
        <meta charset="utf-8">
        <meta name="author" content="Šimon Hivko">
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
        <style>
            h1{
                margin-top: 20px;
                text-align: center;
                color: white;
                font-size: 40px;
            }
            body{
                background: url(trava.jpg) scroll;
            }
            form{
                margin-left: 35%;
            }
            button{
                margin-left: 10%;
            }
            table{
                margin-left: 10%;
                background-color: black;
                font-size: 17px;
            }

            table, th, td {
                text-align: center;
                border-width:1.5px;
                border-style:solid;
            }
            td{
                cursor:pointer;
                background-color: white;
            }
            th {
                background-color: darkgray;
            }
            
            .meno_pracovnika{
                cursor:pointer;
                background-color: darkgray;
            }

            .PN{
                background-color: red;

            }
            .OCR{
                background-color: green;

            }
            .sluzobna_cesta{
                background-color: blue;

            }
            .dovolenka{
                background-color: yellow;

            }
            .plan_dovolenky {
                background-color: magenta ;

            }
            .vikend{
                background-color:darkgray;
            }

            .modal {
                display: none;
                position: fixed;
                z-index: 1;
                padding-top:50px;
                left: 0px;
                top: 0px;
                width: 100%;
                height: 100%;
                overflow: auto;
                background-color: black;
                opacity: 0.97;
            }

            .close {
                color: white;
                position: absolute;
                top: 10px;
                left: 25px;
                font-size: 35px;
                font-weight: bold;
                cursor:pointer;
            }
            .nastav{
                opacity: 10;
            }


        </style>

    </head>
    <body>

            <?php
            $dbh = connect_to_db();
            $people = fetchPracovnik($dbh);
            $dochadzka = fetchDochadzka($dbh);

           //print_r($dochadzka);
           //print_r($people);
            //echo $dochadzka[0]->getRok();

            ?>




            <div>

            <div>
                <h1>Dochadzka</h1>
            </div>


                <form action="index.php" method="GET">
                    <select name="mesiac" id="mesiac" size="1">
                        <option label="mesiac">Mesiac</option>
                        <option value="1" label="1" <?php echo ($_GET['mesiac']==1?'selected':'');?>>Január</option>
                        <option value="2" label="2" <?php echo ($_GET['mesiac']==2?'selected':'');?>>Február</option>
                        <option value="3" label="3" <?php echo ($_GET['mesiac']==3?'selected':'');?>>Marec</option>
                        <option value="4" label="4" <?php echo ($_GET['mesiac']==4?'selected':'');?>>Apríl</option>
                        <option value="5" label="5" <?php echo ($_GET['mesiac']==5?'selected':'');?>>Máj</option>
                        <option value="6" label="6" <?php echo ($_GET['mesiac']==6?'selected':'');?>>Jún</option>
                        <option value="7" label="7" <?php echo ($_GET['mesiac']==7?'selected':'');?>>Júl</option>
                        <option value="8" label="8" <?php echo ($_GET['mesiac']==8?'selected':'');?>>August</option>
                        <option value="9" label="9" <?php echo ($_GET['mesiac']==9?'selected':'');?>>September</option>
                        <option value="10" label="10" <?php echo ($_GET['mesiac']==10?'selected':'');?>>Október</option>
                        <option value="11" label="11" <?php echo ($_GET['mesiac']==11?'selected':'');?>>November</option>
                        <option value="12" label="12" <?php echo ($_GET['mesiac']==12?'selected':'');?>>December</option>
                    </select>

                    <input type="text" id="rok" name="rok" maxlength="4" minlength="4" placeholder="Rok" value='<?php echo (isset($_GET['rok'])?$_GET['rok']:'');?>'>





                    <select name="nepritomnost" id="nepritomnost" size="1">
                        <option label="nepritomnost">Typ Nepritomnosti</option>
                        <option value="PN" label="PN"<?php echo ($_GET['nepritomnost']=='PN'?'selected':'');?>>PN</option>
                        <option value="OCR" label="OCR"<?php echo ($_GET['nepritomnost']=='OCR'?'selected':'');?>>OCR</option>
                        <option value="sluzobna_cesta" label="sluzobna_cesta"<?php echo ($_GET['nepritomnost']=='sluzobna_cesta'?'selected':'');?>>Služobná cesta</option>
                        <option value="dovolenka" label="dovolenka"<?php echo ($_GET['nepritomnost']=='dovolenka'?'selected':'');?>>Dovolenka</option>
                        <option value="plan_dovoenky" label="plan_dovoenky"<?php echo ($_GET['nepritomnost']=='plan_dovoenky'?'selected':'');?>>Planovaná dovoenka</option>
                    </select>
                    <input type="submit" name="potvrdenie" id="button" value="Potvrdiť">
                </form>

                <button>Edituj</button>
                <br></br>

                <?php
                if(isset($_GET["potvrdenie"])) {
                    // form submitted, now we can look at the data that came through
                    // the value inside the brackets comes from the name attribute of the input field. (just like submit above)
                    $rok = $_GET["rok"];
                    $mesiac = $_GET["mesiac"];
                    $nepritomnost = $_GET["nepritomnost"];
                    $pocetDniMesiaca=cal_days_in_month(CAL_GREGORIAN,$mesiac,$rok);

                    // Now you can do whatever with this variable.
                }

                ?>

                <div >

                <table>
                    <tr>
                        <th>Deň</th>
                        <?php for($i=1;$i<=$pocetDniMesiaca;$i++){
                            echo "<th> $i</th>";
                        }
                    ?>
                    </tr>

                    <tr>
                        <th>Meno a Priezvisko</th>
                    <?php for($x=1;$x<=$pocetDniMesiaca;$x++){
                        $jd=gregoriantojd($mesiac,$x,$rok);
                        $nazovDna = jddayofweek($jd,2);
                        if($nazovDna=="Sat"||$nazovDna=="Sun"){
                            echo "<th class='vikend'> $nazovDna</th>";
                        }else{
                        echo "<th> $nazovDna</th>";}
                    }
                    ?>
                    </tr>

                <?php
                foreach ($people as $clovek) {
                    echo "<tr>";


                    echo "<th class='meno_pracovnika'>" . $clovek->getMeno() . " " . $clovek->getPriezvisko() . "</th>";
                    for ($y = 1; $y <=$pocetDniMesiaca; $y++) {
                        $nasiel_som = 0;
                        foreach ($dochadzka as $zaznam) {

                            if (($zaznam->getIdPracovnik() == $clovek->getId()) && ($zaznam->getMesiac() == $mesiac) && ($zaznam->getRok() == $rok) && ($zaznam->getDen() == $y)) {

                                $nasiel_som = 1;

                                switch ($zaznam->getIdNepritomnost()) {
                                    case "1":
                                        echo "<td class='PN used'> PN </td>";
                                        break;
                                    case "2":
                                        echo "<td class='OCR used'> OCR</td>";
                                        break;
                                    case "3":
                                        echo "<td class='sluzobna_cesta used'> SC</td>";
                                        break;
                                    case "4":
                                        echo "<td class='dovolenka used'> DOV </td>";
                                     break;
                                    case "5":
                                        echo "<td class='plan_dovolenky used'> PD</td>";
                                        break;
                                }

                            }
                            //else{
                            // echo "<td>  aaaa  </td>";}
                        }
                        if ($nasiel_som == 0) {
                            $jd=gregoriantojd($mesiac,$y,$rok);
                            $nazovDna = jddayofweek($jd,2);
                            if($nazovDna=="Sat"||$nazovDna=="Sun"){
                            echo "<td class='vikend'>".$y ."</td>";}
                            else {echo "<td>   </td>";}

                        }
                    }
                    echo "</tr>";
                } ?>
                </table>



            </div>

                <div id ="myModal" class="modal">
                    <h1>Nastavenie pre konkretneho zamestananca</h1>
                <span class="close">&times;</span>
                <div id="modal-content" class="modal-content">
                    <form class="nastav">

                        <input type="text" id="denPracovnik" name="denPracovnik" maxlength="2" minlength="1" placeholder="Deň" value='<?php echo (isset($_GET['denPracovnik'])?$_GET['denPracovnik']:'');?>'>
                        <br>
                        <select name="mesiacPracovnik" id="mesiacPracovnik" size="1">
                            <option label="mesiacPracovnik">Mesiac</option>
                            <option value="1" label="1" <?php echo ($_GET['mesiacPracovnik']==1?'selected':'');?>>Január</option>
                            <option value="2" label="2" <?php echo ($_GET['mesiacPracovnik']==2?'selected':'');?>>Február</option>
                            <option value="3" label="3" <?php echo ($_GET['mesiacPracovnik']==3?'selected':'');?>>Marec</option>
                            <option value="4" label="4" <?php echo ($_GET['mesiacPracovnik']==4?'selected':'');?>>Apríl</option>
                            <option value="5" label="5" <?php echo ($_GET['mesiacPracovnik']==5?'selected':'');?>>Máj</option>
                            <option value="6" label="6" <?php echo ($_GET['mesiacPracovnik']==6?'selected':'');?>>Jún</option>
                            <option value="7" label="7" <?php echo ($_GET['mesiacPracovnik']==7?'selected':'');?>>Júl</option>
                            <option value="8" label="8" <?php echo ($_GET['mesiacPracovnik']==8?'selected':'');?>>August</option>
                            <option value="9" label="9" <?php echo ($_GET['mesiacPracovnik']==9?'selected':'');?>>September</option>
                            <option value="10" label="10" <?php echo ($_GET['mesiacPracovnik']==10?'selected':'');?>>Október</option>
                            <option value="11" label="11" <?php echo ($_GET['mesiacPracovnik']==11?'selected':'');?>>November</option>
                            <option value="12" label="12" <?php echo ($_GET['mesiacPracovnik']==12?'selected':'');?>>December</option>
                        </select>
                    <br>
                    <input type="text" id="rokPracovnik" name="rokPracovnik" maxlength="4" minlength="4" placeholder="Rok" value='<?php echo (isset($_GET['rokPracovnik'])?$_GET['rokPracovnik']:'');?>'>
                    <br>

                    <select name="nepritomnostpracovnik" id="nepritomnostpracovnik" size="1">
                        <option label="nepritomnostpracovnik">Typ Nepritomnosti</option>
                        <option value="PN" label="PN"<?php echo ($_GET['nepritomnostpracovnik']=='PN'?'selected':'');?>>PN</option>
                        <option value="OCR" label="OCR"<?php echo ($_GET['nepritomnostpracovnik']=='OCR'?'selected':'');?>>OCR</option>
                        <option value="sluzobna_cesta" label="sluzobna_cesta"<?php echo ($_GET['nepritomnostpracovnik']=='sluzobna_cesta'?'selected':'');?>>Služobná cesta</option>
                        <option value="dovolenka" label="dovolenka"<?php echo ($_GET['nepritomnostpracovnik']=='dovolenka'?'selected':'');?>>Dovolenka</option>
                        <option value="plan_dovoenky" label="plan_dovoenky"<?php echo ($_GET['nepritomnostpracovnik']=='plan_dovoenky'?'selected':'');?>>Planovaná dovoenka</option>
                    </select>
                    <br>
                    <input type="submit" name="save" id="save" value="Ulozit">

                    </form>

                    </div>



                </div>


            </div>



            <script type="application/javascript">
                var n = $("#nepritomnost").val();
                console.log(n);

                $("button").click(function() {

                    $('td').click(function () {
                        var maTrieduUs = $(this).hasClass("used");
                        var maTrieduVik = $(this).hasClass("vikend");

                        console.log("used "+maTrieduUs);
                        console.log(" vikend "+maTrieduVik);

                        if ((maTrieduUs== false)&&(maTrieduVik== false)) {

                            if (n == "PN") {
                                $(this).attr("class", "PN used");
                            }
                            if (n == "OCR") {
                                $(this).attr("class", "ORC used");
                            }
                            if (n == "sluzobna_cesta") {
                                $(this).attr("class", "sluzobna_cesta used");
                            }
                            if (n == "dovolenka") {
                                $(this).attr("class", "dovolenka used");
                            }
                            if (n == "plan_dovoenky") {
                                $(this).attr("class", "plan_dovolenky used");
                            }


                            var col = this.cellIndex;
                            var tr = $(this).closest('tr');
                            var row = tr.index();


                            //console.log(row + " " + col);

                            var m = $("#mesiac").val();


                            console.log(m);
                            var y = $("#rok").val();

                            var idnepritomnost;
                            if (n == "PN") {
                                idnepritomnost = 1;
                            }
                            if (n == "OCR") {
                                idnepritomnost = 2;
                            }
                            if (n == "sluzobna_cesta") {
                                idnepritomnost = 3;
                            }
                            if (n == "dovolenka") {
                                idnepritomnost = 4;
                            }
                            if (n == "plan_dovoenky") {
                                idnepritomnost = 5;
                            }
                            console.log(idnepritomnost);

                            var data = [row, col, y, m, idnepritomnost];


                            $.post("server.php", {
                                "row": row,
                                "col": col,
                                "year": y,
                                "month": m,
                                "idnepr": idnepritomnost
                            }, function (data, status) {
                                console.log(status);
                                console.log(data);
                                $(".result").html(data);
                            });
                        }
                    });

                    $('td').dblclick(function () {
                        var maTrieduUs = $(this).hasClass("used");
                        var maTrieduVik = $(this).hasClass("vikend");

                        console.log(maTriedu);

                        if ((maTrieduUs== true)&&(maTrieduVik== false)) {

                            $(this).removeAttr("class");
                            var col = this.cellIndex;
                            var tr = $(this).closest('tr');
                            var row = tr.index();


                            //console.log(row + " " + col);

                            var m = $("#mesiacP").val();


                            console.log(m);
                            var y = $("#rok").val();

                            var idnepritomnost;
                            if (n == "PN") {
                                idnepritomnost = 1;
                            }
                            if (n == "OCR") {
                                idnepritomnost = 2;
                            }
                            if (n == "sluzobna_cesta") {
                                idnepritomnost = 3;
                            }
                            if (n == "dovolenka") {
                                idnepritomnost = 4;
                            }
                            if (n == "plan_dovoenky") {
                                idnepritomnost = 5;
                            }
                            console.log(idnepritomnost);

                            var data = [row, col, y, m, idnepritomnost];


                            $.post("delete.php", {
                                "row": row,
                                "col": col,
                                "year": y,
                                "month": m,
                                "idnepr": idnepritomnost
                            }, function (data, status) {
                                console.log(status);
                                console.log(data);
                                $(".result").html(data);
                            });
                        }

                    });

                });

                $('.meno_pracovnika').click(function() {

                        $(".modal").css('display','block');

                        $('.close').click(function(){
                               $(".modal").css('display','none');
                        });

                    var nPracovnik = $("#nepritomnostpracovnik").val();
                    console.log(nPracovnik);

                    var col = this.cellIndex;
                    var tr = $(this).closest('tr');
                    var row = tr.index();

                    console.log(row);


                    var m = $("#mesiacPracovnik").val();


                    console.log(m);
                    var y = $("#rokPracovnik").val();

                    var idnepritomnostprac;
                    if (nPracovnik == "PN") {
                        idnepritomnostprac = 1;
                    }
                    if (nPracovnik == "OCR") {
                        idnepritomnostprac = 2;
                    }
                    if (nPracovnik == "sluzobna_cesta") {
                        idnepritomnostprac = 3;
                    }
                    if (nPracovnik == "dovolenka") {
                        idnepritomnostprac = 4;
                    }
                    if (nPracovnik == "plan_dovoenky") {
                        idnepritomnostprac = 5;
                    }
                    console.log(idnepritomnostprac);

                    var data = [row, col, y, m, idnepritomnostprac];

                    $("#save").click(function() {
                        $.post("server.php", {
                            "row": row,
                            "col": col,
                            "year": y,
                            "month": m,
                            "idnepr": idnepritomnostprac
                        }, function (data, status) {
                            console.log(status);
                            console.log(data);
                            $(".result").html(data);
                        });
                    });
                });





            </script>

    </body>
    </html>
