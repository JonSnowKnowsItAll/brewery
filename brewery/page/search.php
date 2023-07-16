<h1>Patientensuche</h1>
<?php
if (isset($_POST['speichern']))
{
    if (isset($_POST['searchPat']))
    {
        try
        {
            $patient = "%" . $_POST['searchPat'] . "%"; // adding % to the parameter for LIKE clause
            $myArray = array($patient); // This will be bound to ?

            $stmtPat2 = 'SELECT kun_firma "Kundenname" FROM kunde WHERE kun_firma LIKE ?'; // Corrected SQL query


            $result = makeStatement($stmtPat2, $myArray);


            $count = $result->rowCount();

            if ($count == 0)
            {
                echo '<h6 style="color: indianred">Anzahl der Suchergebnisse: '.$count.'</h6><br>';
                ?>
                <form method="post">
                    <button class="btn btn-outline-secondary" type="submit" name="back">zurück</button>
                </form>
                <?php

            }
            else
            {
                echo '<h6>Else: Anzahl der Suchergebnisse: '.$count.'</h6><br>';
                makeTableArray($stmtPat2, $myArray);
                ?>
                <form method="post">
                    <button class="btn btn-outline-secondary" type="submit" name="back">zurück</button>
                    <button class="btn btn-outline-primary" type="submit" name="speichernHugo">speichern</button>
                </form>
                <?php
            }
        }
        catch (Exception $e)
        {
            echo 'Fehler bei der Patientensuche: '.$e->getCode().': '.$e->getMessage();
        }
    }
}
elseif (isset($_POST['speichernHugo'])) {
    $query = 'select * from getraenk_typ';
    makeTable($query);  
}
else
{
    ?>
    <form method="post">
    <div class="row">
        <div class="col-12">
            <input class="form-control" type="text" name="searchPat" placeholder="zB Coca Cola, Bier in Masse:">
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-4">
            <button class="btn btn-outline-success" type="submit" name="speichern">Suche</button>
            <button class="btn btn-outline-secondary" type="submit" name="abbrechen">abbrechen</button>
        </div>
    </div>
</form>
<?php
}