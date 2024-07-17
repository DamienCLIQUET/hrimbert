<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8" />
        <title>Cron tarif Rimbert</title>
		<link rel="icon" href="../Images/favicon.ico"/>
    </head>
	<body>
		<?php
			//CONNEXION
			$user = "DCLIQUET";
			$pass = "DAMIEN76";
			try{
				$base = new PDO('mysql:host=localhost; dbname=etsrimbert', $user, $pass);
			} catch(exception $e) {
				die('Erreur '.$e->getMessage());
			}
			$base->exec("SET CHARACTER SET utf8");
			$server = "Driver={Client Access ODBC Driver (32-bit)};System=176.124.42.74;DBQ=MELPRO;Uid=".$user.";Pwd=".$pass.";";
			$conn = odbc_connect($server,$user,$pass);
			if ($conn) {
                // PRIX ACHAT
                $requeteCDEENT = odbc_exec($conn,"SELECT TARNET.CODART, TARNET.PRNEUR, FICART.FOURNA, FICART.UNIVTE, UNIPRI.COEFUP
				FROM TARNET
                LEFT JOIN FICART
                ON FICART.REFART = TARNET.CODART
                LEFT JOIN UNIPRI
                ON UNIPRI.CODUPR = FICART.UNIPRI
				WHERE TARNET.CLIENT = 'AA145'
				ORDER BY TARNET.CODART, TARNET.DEBAA, TARNET.DEBMM, TARNET.DEBJJ");
				$i_articles = 1;
				while ((odbc_fetch_row($requeteCDEENT, $i_articles)) !== false) {
                    echo $REFART = trim(odbc_result($requeteCDEENT, "CODART"));
                    echo "<br>";
                    $achat = 100 * trim(odbc_result($requeteCDEENT, "PRNEUR"));
                    $fournisseur = trim(odbc_result($requeteCDEENT, "FOURNA"));
                    $unite = trim(odbc_result($requeteCDEENT, "UNIVTE"));
                    $coef = trim(odbc_result($requeteCDEENT, "COEFUP"));
                    if ($coef > 0) {
                        $achat = $achat / $coef;
                        // TARIF PUBLIC
                        $public = 0;
                        $requeteTARBAS = odbc_exec($conn,"SELECT TARBAS.PRIEUR
                        FROM TARBAS
                        WHERE TARBAS.ARTTAR = '".$REFART."'
                        ORDER BY TARBAS.DEBAA DESC, TARBAS.DEBMM DESC, TARBAS.DEBJJ DESC
                        LIMIT 1");
                        if (trim(odbc_result($requeteTARBAS, "PRIEUR")) == null) {
                            $public = $achat * 2;
                        } else {
                            $public = 100 * trim(odbc_result($requeteTARBAS, "PRIEUR"));
                        }
                        if ($fournisseur != '365000' && $fournisseur != '149000' && $fournisseur != '139000' && $public < $achat * 2) {
                            $public = $achat * 2;
                        }
                        $public = $public / $coef;
                        // MAJ BASE
                        $retour = $base->query("INSERT INTO melpro_tarifs (REFART, public, achat, unite)
                        VALUES ('".$REFART."', '".$public."', '".$achat."', '".$unite."')
                        ON DUPLICATE KEY UPDATE public = '".$public."', achat = '".$achat."', unite = '".$unite."'");
                        $i_articles++;
                    } else {
                        echo "erreur";
                    }
                }
                odbc_close($conn);
			} else {
				//echo "Connexion échouée.";
			}
		?>
    </body>
</html>