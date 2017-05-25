<h2><?php echo $title; ?></h2>
 
<table border='1' cellpadding='4'>
    <tr>
        <td><strong>Name</strong></td>
        <td><strong>Action</strong></td>
    </tr>
<?php if (is_array($users) || is_object($users)): ?>
<?php foreach ($users as $users_item): ?>

        <tr>
            <td><?php echo $users_item['name']; ?></td>
            <td>
                <a href="<?php echo site_url('users/'.$users_item['id']); ?>">View</a>
            </td>
        </tr>
<?php endforeach; ?>
<?php endif; ?>
</table>