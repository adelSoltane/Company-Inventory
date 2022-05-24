<?php include 'header.php'; ?>

<?php include '../admin/server_materiel.php'; 

?>

<h1>Mon Matériel</h1>
    <table>
      <thead>
        <tr>
        <form action="materiel_directeur.php" method="GET">
  <input type="text" style="display: inline-block; width: 80%; margin-left: 100px; position: relative; margin-top: 20px;" class="form-control" placeholder="Rechercher un matériel ..." name="motCleF" value="<?php echo ($mc) ?>"/>
        </form>
          <th>Libellé</th>
          <th>Date</th>
          <th>Model</th>
          <th>Marque</th>
          <th>Garantie</th>
          <th>Inventaire</th>
          <th>Fournisseur</th>
          
        

        </tr>
      </thead>
      <tbody>
        <?php while ($row = mysqli_fetch_array($propre)) { ?>
          <tr>
          <td><?php echo $row['libelle']; ?></td>
          <td><?php echo $row['date_acquis']; ?></td>
          <td><?php echo $row['model']; ?></td>
          <td><?php echo $row['marque']; ?></td>
          <td><?php echo $row['garantie']; ?></td>
          <td><?php echo $row['code']; ?></td>
          <td><?php echo $row['fournisseur']; ?></td>
          
        
        </tr>
        

        <?php } ?>
        
      </tbody>
    </table>

    

<?php include 'footer.php'; ?>