<div class="buttonContainer">
    <a class="addButton" href="/usersgroups/add">  
    <i class='bx bx-plus'></i> Add New Group
    </a>
</div>
<div class="board">
<table class="table table-striped table-bordered table-hover table-striped table-dark table-responsive" >
    <thead>
        <tr>
            <td>Group Name</td>
            <td class="lastHead">Control</td>
        </tr>
    </thead>
    <tbody>
        <?php if(false !== $groups): foreach ($groups as $group): ?>
            <tr>
            <td class="firstBody"><?= $group->GroupName ?></td>
            <td class="lastBody">
                <a href="/usersgroups/edit/<?= $group->GroupId ?>" class="edit"><i class='bx bxs-edit icon'></i></a>
                <a href="/usersgroups/delete/<?= $group->GroupId ?>" class="delete"><i class='bx bxs-trash-alt icon'></i></a>
            </td>
        </tr> 
        <?php endforeach ?>
        <?php else : ?>
            <td last colspan="6"><p> Sorry , There is no Groups to list</p></td>
        <?php endif; ?>
        
    </tbody>
</table>
</div>
</main>
</section>