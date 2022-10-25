<?php

require_once("includes/Header.php");

?>

<div class="settingsContainer column">

    <div class="formSection">

        <form method="POST">

            <h2>User details</h2>

            <input type="text" name="firstName" placeholder="First name">
            <input type="text" name="lastName" placeholder="Last name">
            <input type="email" name="email" placeholder="Email">

            <input type="submit" name="saveDetailsButton" value="Save">

        </form>

    </div>

    <div class="formSection">

        <form method="POST">

            <h2>Update password</h2>

            <input type="password" name="oldPassword" placeholder="Old password">
            <input type="password" name="newPassword" placeholder="New password">
            <input type="password" name="newPassword2" placeholder="Confirm password">

            <input type="submit" name="savePasswordButton" value="Save">

        </form>

    </div>
</div>