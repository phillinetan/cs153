<h2><?php echo $title; ?></h2>
 
<?php echo validation_errors(); ?>
 
<?php echo form_open('admin/edit/'.$users_item['id']); ?>
    <table>
        <tr>
            <td><label for="name">Name</label></td>
            <td><input type="input" name="name" size="50" value="<?php echo $users_item['name'] ?>" /></td>
        </tr>
        <tr>
            <td><label for="address">Address</label></td>
            <td><textarea name="address" rows="10" cols="40"><?php echo $users_item['address'] ?></textarea></td>
        </tr>
        <tr>
            <td><label for="birthday">Birthday</label></td>
            <td><input type="input" name="birthday" size="50" value="<?php echo $users_item['birthday'] ?>" /></td>
        </tr>
        <tr>
            <td></td>
            <td><input type="submit" name="submit" value="Edit users item" /></td>
        </tr>
    </table>
</form>