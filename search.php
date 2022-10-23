<?php

include_once("includes/Header.php");
?>


<div class="textboxContainer">
    <input type="text" class="searchInput" placeholder="search for something">
</div>

<div class="results"></div>

<script>
$(function() {

    let username = '<?php echo $userLoggedIn; ?>';
    let timer;

    $(".searchInput").keyup(function() {
        clearTimeout(timer);


        timer = setTimeout(function() {
            let val = $(".searchInput").val();
            console.log();
        }, 500);
    })

})
</script>