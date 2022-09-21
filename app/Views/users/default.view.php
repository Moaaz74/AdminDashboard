
<div class="buttonContainer">
    <a  class="addButton" href="/users/add">  
    <i class='bx bx-plus'></i> Add New User
    </a>
</div>
<div class="board">
<table width="100%">
    <thead>
        <tr>
            <td class="firstHead">Username</td>
            <td>Group Name</td>
            <td>Email</td>
            <td>Subscription Date</td>
            <td>Last Login</td>
            <td class="lastHead">Control</td>
        </tr>
    </thead>
    <tbody>
        <?php if(false !== $users): foreach ($users as $user): ?>
            <tr>
            <td class="firstBody"><?= $user->Username ?></td>
            <td>dummy group</td>
            <td><?= $user->Email ?></td>
            <td><?= $user->SubscriptionDate ?></td>
            <td><?= $user->LastLogin ?></td>
            <td class="lastBody">
                <a href="/users/edit/<?= $user->UserId ?>" class="edit"><i class='bx bxs-edit icon'></i></a>
                <a href="/users/delete/<?= $user->UserId ?>" class="delete"><i class='bx bxs-trash-alt icon'></i></a>
            </td>
        </tr> 
        <?php endforeach ?>
        <?php else : ?>
            <td last colspan="6"><p> Sorry , There is no Users to list</p></td>
        <?php endif; ?>
        
    </tbody>
</table>
</div>
</main>
</section>