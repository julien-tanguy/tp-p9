<?php 
$months = array(1 => 'janvier',2 => 'fevrier',3 => 'mars',4 => 'avril',5 => 'mai',6 => 'juin',7 => 'juillet',8 => 'août',9 => 'septembre',10 => 'octobre',11 => 'novembre',12 => 'decembre');
$days = array('lundi', 'mardi', 'mercredi', 'jeudi', 'vendredi', 'samedi', 'dimanche');
if (isset($_POST['month']) && isset($_POST['year'])) {  
    $monthSelect = $_POST['month'];
    $yearSelect = $_POST['year'];
}else {
    $monthSelect = date('n');
    $yearSelect = date('Y');
}

// timestamp premier jour du mois
$firstDay = mktime(0, 0, 1, $monthSelect, 1, $yearSelect);
//timestamp dernier jour du mois
$lastDay = mktime(0, 0, 0, $monthSelect + 1, 1, $yearSelect);
// numéro du premier jour du mois
$numberFirstDay = date('N', $firstDay);
//nombre de jours dans le mois
$numbersDays = cal_days_in_month(CAL_GREGORIAN, $monthSelect, $yearSelect);
//nbr de jours avant le premier jour du mois
$daysBeforeMonth = $numberFirstDay -1;
//nbr de jours apres le dernier jour du mois
$daysAfterMonth = 7 - date('N', mktime(0, 0, 0, $monthSelect, $numbersDays, $yearSelect));
//nbr de case necessaire par mois
$monthCase = $numbersDays + $daysBeforeMonth + $daysAfterMonth;
//jour de départ du mois sélectionné
$startDate = $firstDay - ($daysBeforeMonth) * (24 * 60 * 60);
?>
<!DOCTYPE html>
<html lang="fr" dir="ltr">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous" />
        <link style="text/css" rel="stylesheet" href="css/style.css" />
        <title>php tp-p9</title>
    </head>
    <body>
        <div class="formulaire container">
            <div class="row text-center justify-content-center">
                <h1 class="col-12">calendrier : <?= $monthSelect . '/' . $yearSelect; ?></h1>
                <form method="POST" action="index.php">
                    <select name="month">
                        <?php 
                        foreach($months as $monthKeys => $month){ 
                            ?><option value="<?php echo $monthKeys ?>"><?= $month; ?></option><?php
                        } ?>
                    </select>
                    <select name ="year">
                        <?php for($year = 1970; $year <= 2070; $year++) {
                            ?><option><?= $year ?></option>
                        <?php } ?>
                    </select>
                    <input class="btn btn-primary" type="submit" id="button" value="rechercher" />
                </form>
            </div>
        </div>
        <div class="calendar container">
            <div class="row justify-content-center">
                <table>
                    <thead>
                        <tr>
                            <?php 
                                foreach($days as $day){ 
                                    ?><th class="bg bg-primary"><?php echo $day; ?></th><?php
                            } ?>
                        </tr>
                    </thead>
                    <tbody>
                    <tr><?php for ($days = 1; $days <= $monthCase; $days++) {
                                $date = $startDate + ($days -1)*(24 * 60 * 60);
                                if ($days % 7 == 0) {
                                    if(($date < $firstDay) || ($date > $lastDay))  {
                                        ?><td class="bg bg-secondary" style="color: #4f4f52;"><?= date('j', $date) ?></td></tr><?php
                                    }else {
                                        ?><td><?= date('j', $date) ?></td></tr><?php
                                    }
                                }else {
                                    if(($date < $firstDay) || ($date > $lastDay)) {
                                        ?><td class="bg bg-secondary" style="color: #4f4f52;"><?= date('j', $date) ?></td><?php
                                    }else {
                                        ?><td><?= date('j', $date) ?></td><?php
                                    }
                                }
                            } ?>
                    </tbody>
                </table>
            </div>
        </div>
        

      
            

    

        
        




    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    </body>
</html>