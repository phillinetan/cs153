<h2><?php echo $title; ?></h2>
 
<table border='1' cellpadding='4'>
    <tr>
        <td><strong>ID</strong></td>
        <td><strong>Actions</strong></td>
    </tr>
<?php if (is_array($users) || is_object($users)): ?>
<?php foreach ($users as $users_item): ?>

        <tr>
            <td><?php echo $users_item['id']; ?></td>
            <td>
                <a href="<?php echo site_url('admin/'.$users_item['id']); ?>">View</a> | 
                <a href="<?php echo site_url('admin/edit/'.$users_item['id']); ?>">Edit</a> | 
                <a href="<?php echo site_url('admin/delete/'.$users_item['id']); ?>" onClick="return confirm('Are you sure you want to delete?')">Delete</a>
            </td>
        </tr>
<?php endforeach; ?>
<?php endif; ?>
</table>