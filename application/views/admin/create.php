<h2><?php echo $title; ?></h2>
 
<?php echo validation_errors(); ?>
 
<?php echo form_open('admin/create'); ?>    
    <table>
        <tr>
            <td><label for="id">id</label></td>
            <td><input type="input" name="id" size="20" /></td>
        </tr>
        <tr>
            <td><label for="username">username</label></td>
            <td><input type="input" name="username" size="30" /></td>
        </tr>
        <tr>
            <td><label for="name">name</label></td>
            <td><input type="input" name="name" size="20" /></td>
        </tr>
        <tr>
            <td><label for="address">address</label></td>
            <td><textarea name="address" rows="10" cols="40"></textarea></td>
        </tr>
        <tr>
            <td><label for="birthday">birthday</label></td>
            <td><input type="date" name="birthday" size="20" /></td>
        </tr>
        <tr>
            <td><label for="password">password</label></td>
            <td><input type="password" name="password" size="20" /></td>
        </tr>
        <tr>
            <td></tu>
            <td><input type="submit" name="submit" value="create user" /></td>
        </tr>
    </table>    
</form>