<?php
  function print_fraction_row($fraction){

    // will contain information queried from the database
    $assays = array();

    // using this to keep things in order.
    $form_assays = array("P1B", "HC", "HE", "PC", "ARE", "AP", "SA", "EF", "CA", "PA", "MRSA", "VRE", "MD", "MS", "MT", "LO");

    echo "<tr>";
      // loop through each of the assays and print the result
      foreach ($form_assays as $i) {
        print_fraction_result($fraction, $i);
      }
    echo "</tr>";

  }

  function print_fraction_result($fraction, $assay){
    echo "FRIEND?";
    if(array_key_exists($assay, $fraction)){
      $css_class = ($fraction[$assay]["result"]) ? "array-".$fraction[$assay]["result"]:"array-none";
      echo "<td class='$css_class'>A</td>";
    }else{
      echo "<td class='array-none'>A</td>";
    }

  }
?>

<style>
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

?>
<div>
  <table>
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
    print_fraction_row($variables['assay']['fraction']);

      // loop through fractions and call this

      // end loop through fractions
    ?>
  </table>
</div>