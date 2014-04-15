<?php
/**
 * @file fraction-table-theme.tpl.php
 *  Creating the fraction assay table via a template because that seemed the easiest.
 *  This template has a couple of functions to help me do that, although perhaps
 *  the should be moved to another location
 */

/**
 * One of the methods used in create a table row for a fraction. This
 * method makes sure that the assays are handled in the right order and
 * prints out the name and weight of the assay.
 *
 * @param $fraction
 * An islandora fraction object
 */
function print_fraction_row($fraction) {


  // this contains the assay abbreviations in the order we'd like
  // them to appear on the form.
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

/**
 * Given an assay and a fraction, it will find the result of that assay on that fraction
 * and then print out the appropriately coloured column
 *
 * @param $fraction
 *  An islandora fraction object.
 * @param $assay
 *  The assay result we want to print out on the fraction.
 */
function print_fraction_result($fraction, $assay) {

  if (array_key_exists("fraction", $fraction)){
    if (array_key_exists($assay, $fraction["fraction"])){
      $css_class = ($fraction["fraction"][$assay]["result"]) ? "assay-".$fraction["fraction"][$assay]["result"]:"assay-none";
      if ($css_class == "assay-inactive"){
        echo "<td class='$css_class'>I</td>";
      }else{
        echo "<td class='$css_class'></td>";
      }
    }else{
      echo "<td class='assay-none'>N</td>";
    }
  }else{
    echo "<td class='assay-none'>N</td>";
  }

}
?>
<style>

  .assay-table td{
    padding: 0px;
    width: 10px;
    font-size: 12px;
  }
  .assay-table th{
    font-weight: bold;
    width: 10px;
    font-size: 12px;

    padding: 0px;
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

<div>
  <div>
    <table class="assay-table">
      <tr>
        <td><strong>Color Codes</strong></td>
        <td class="assay-hit">Hit</td>
        <td class="assay-strong">Strong</td>
        <td class="assay-medium">Medium</td>
        <td class="assay-low">Low</td>
        <td class="assay-inactive">Inactive (I)</td>
        <td class="assay-none">None (N)</td>
      </tr>
    </table>
  </div>
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

    foreach ($variables['fractions'] as $fraction) {
      print_fraction_row($fraction);
    }

    ?>
  </table>
</div>