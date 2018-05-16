
    <thead>
    <tr>
        <th colspan="2">Personeelsfeesten</th>
        <th></th>
        <th></th>
    </tr>
    </thead>
    <tbody>

    <?php
    foreach($personeelsfeesten as $pf) {
        echo "<tr>";
        echo "<td>";
        echo date_format($pf->datum, "d/m/Y");
        echo "</td>";
        echo "<td>";
        ?>
        <p class="verwijderPf" id="<?php echo $pf->id; ?>">Verwijder</p>
        <?php
        echo "</td>";
        echo "<td>";
        echo anchor('personeelsfeest_aanmaken/wijzigPF/' . $pf->id, 'Wijzig');
        echo "</td>";
        echo "</tr>";
    }
    ?>
    </tbody>
