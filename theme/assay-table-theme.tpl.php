<?php
  function print_fraction_row($fraction){

    // query the inhibitors, or whatever they're called.
    $result = db_select('labobject_assay_assay', 'a')
        ->fields('a', array('abbreviation', 'name'))
        ->execute();

    var_dump($result);
    echo "<tr>";
    echo "</tr>";
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
  print_r ($variables['assay']);
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
      // really this theme should be taking in a list of fractions instead of just one

      // loop through fractions and call this
        print_fraction_row($variables['assay']['fraction']);

      // end loop through fractions
    ?>
  </table>
</div>