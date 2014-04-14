<style>
  .assay-table{
    width: 100%;
    border : none;
  }
  .assay-hit{
    background-color: red;
  }

  .assay-strong{
    background-color: yellow;
  }

  .assay-medium{
    background-color: orange;
  }

  .assay-low{
    background-color: #808080;
  }

  .assay-none{
    background-color: white;
  }

  .assay-inactive{
    background-color: white;
  }
</style>

<?php
  function print_fraction_row($fraction) {

    // will contain information queried from the database
    $assays = array();

    // using this to keep things in order.
    $form_assays = array("P1B", "HC", "HE", "PC", "ARE", "AP", "SA", "EF", "CA", "PA", "MRSA", "VRE", "MD", "MS", "MT", "LO");

    echo "<tr>";
      echo "<td>{$fraction['labid']}</td>";
      echo "<td>{$fraction['weight']}</td>";

    // loop through each of the assays and print the result
      foreach ($form_assays as $i) {
        print_fraction_result($fraction, $i);
      }
    echo "</tr>";

  }

  function print_fraction_result($fraction, $assay) {
    if(array_key_exists($assay, $fraction["fraction"])){
      $css_class = ($fraction["fraction"][$assay]["result"]) ? "assay-".$fraction["fraction"][$assay]["result"]:"assay-none";
      echo "<td class='$css_class'></td>";
    }else{
      echo "<td class='assay-none'></td>";
    }

  }
?>


<?php

?>
<div>
  <table class="assay-table">
    <thead>
      <tr>
        <th>ID</th>
        <th>Weight</th>
        <th>P1B</th>
        <th>HC</th>
        <th>HE</th>
        <th>PC</th>
        <th>ARE</th>
        <th>AP</th>
        <th>SA</th>
        <th>EF</th>
        <th>CA</th>
        <th>PA</th>
        <th>MRSA</th>
        <th>VRE</th>
        <th>MD</th>
        <th>MS</th>
        <th>MT</th>
        <th>LO</th>
      </tr>
    </thead>

    <?php
    print_fraction_row($variables['assay']);

      // loop through fractions and call this

      // end loop through fractions
    ?>
  </table>
</div>