<?php
    $homeLink = ROOT . "/index.php";
?>

<div class = "home-link-container">
    <h2 class = "home-link">
        <?php
            if (isset($homeLink)) echo "<a href='$homeLink'>ARHIVA REVISTE VECHI</a>";
            else echo "ARHIVA REVISTE VECHI";
        ?>
    </h2>
    <h2 class = "quick-search" style = "position:absolute; top: 0px; right: 0px" >
        <a href = "<?php echo ARHIVA . "/quick-search.php" ?> ">Quick Links</a>
    </h2>
</div>