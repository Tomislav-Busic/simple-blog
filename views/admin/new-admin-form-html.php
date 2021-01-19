<?php
if ( isset($adminFormMessage) === false ) {
    $adminFormMessage = "";
}

return "<form method='post' action='admin.php?page=users'>
    <fieldset>
        <legend>Create new admin user</legend>
        <label>e-mail</label>
        <input type='text' name='email' required/>
        <label>password</label>
        <input type='password' name='password' required />
        <input type='submit' value='create user' name='new-admin' />   
    </fieldset>
    <p id='admin-form-message'>$adminFormMessage</p> 
</form>";