<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Mon planning</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <h1>Planning de la semaine</h1>

  <div class="planning">
    <!-- Ligne d'en-tête -->
    <div class="entete"></div>
    <div class="entete">Lundi</div>
    <div class="entete">Mardi</div>
    <div class="entete">Mercredi</div>
    <div class="entete">Jeudi</div>
    <div class="entete">Vendredi</div>

    <!-- Les heures -->
    <div class="heure" style="grid-row: 2;">8h</div>
    <div class="heure" style="grid-row: 3;">9h</div>
    <div class="heure" style="grid-row: 4;">10h</div>
    <div class="heure" style="grid-row: 5;">11h</div>

    <!-- Les créneaux -->
    <div class="creneaux" style="grid-column: 2; grid-row: 3 / 5;">Analyse</div>
    <div class="creneaux" style="grid-column: 4; grid-row: 2 / 4;">Opération</div>
  </div>
</body>
</html>
