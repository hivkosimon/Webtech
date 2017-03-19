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
    </head>
    <body>

            <?php
            $dbh = connect_to_db();
            $people = fetchPracovnik($dbh);
            $dochadzka = fetchDochadzka($dbh);
            $meno = $people[1];

                print_r($meno);

           // print_r($dochadzka);
//             print_r($people);

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


                    <br>


                    <select name="nepritomnost" id="nepritomnost" size="1">
                        <option selected value="nepritomnost" label="Nepritomnost">Typ Nepritomnosti</option>
                        <option value="PN" label="PN">PN</option>
                        <option value="OCR" label="OCR">OCR</option>
                        <option value="sluzobna_cesta" label="sluzobna_cesta">Služobná cesta</option>
                        <option value="dovolenka" label="dovolenka">Dovolenka</option>
                        <option value="plan_dovoenky" label="plan_dovoenky">Planovaná dovoenka</option>
                    </select>
                    <input type="submit" name="potvrdenie" id="button" value="Potvrdiť">                    
                </form>

                <?php
                if(isset($_GET["potvrdenie"])) {
                    echo $mesiac;
                    echo  $rok;
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

                <table border="solid">
                    <tr>
                        <th>Meno a Priezvisko</th>
                        <?php for($i=1;$i<=$pocetDniMesiaca;$i++){
                            echo "<td> $i</td>";
                        }
                    ?>
                    </tr>

                    <tr>
                        <th>Den</th>
                    <?php for($x=1;$x<=$pocetDniMesiaca;$x++){
                        $jd=gregoriantojd($mesiac,$x,$rok);
                        $nazovDna = jddayofweek($jd,2);
                        echo "<td> $nazovDna</td>";
                    }
                    ?>
                    </tr>

                <?php
                foreach ($people as $clovek) :
  //                     echo '<pre>';
  //                   print_r($people);
  //                   echo '</pre>';
                ?>
                    <tr>
                        <td> <?php echo $clovek->meno . " " .  $clovek->priezvisko;?></td>
                            <?php for($y=1;$y<$pocetDniMesiaca;$y++){
                                echo "<td>    </td>";
                            }

                            ?>
                    </tr>
                <?php endforeach?>
                </table>

            </div>


            </div>



            <script type="application/javascript">

                $('td').click(function() {
                    $(this).css('backgroundColor', 'red');

                    var col = this.cellIndex;
                    var tr = $(this).closest('tr');
                    var row = tr.index();


                    console.log(row + " " + col);
                    var data = [col, row];
                    
                    var m = $("#mesiac").val();
                    var y = $("#rok").val();

                    $.post( "server.php", {"colum":col, "row":row, "month":m, "year":y }, function( data , status) {
                       console.log(status);
                       console.log(data);
                        $( ".result" ).html( data );
                    });

                });

            </script>

    </body>
    </html>
