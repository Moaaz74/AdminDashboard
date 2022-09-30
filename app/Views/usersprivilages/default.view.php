

<div class="buttonContainer">
    <a  class="addButton" href="/usersprivilages/add">  
    <i class='bx bx-plus'></i> Add New Privilage
    </a>
</div>
<div class="board">
<table class="table table-striped table-bordered table-hover table-striped table-dark table-responsive">
    <thead>
        <tr>
            <td>Privilage Name</td>
            <td class="lastHead">Control</td>
        </tr>
    </thead>
    <tbody>
        <?php if(false !== $privilages): foreach ($privilages as $privilage): ?>
            <tr>
            <td class="firstBody"><?= $privilage->PrivilageTitle ?></td>
            <td class="lastBody">
                <a href="/usersprivilages/edit/<?= $privilage->PrivilageId ?>" class="edit"><i class='bx bxs-edit icon'></i></a>
                <a href="/usersprivilages/delete/<?= $privilage->PrivilageId ?>"  class="delete"><i class='bx bxs-trash-alt icon'></i></a>
            </td>
        </tr> 
        <?php endforeach ?>
        <?php else : ?>
            <td last colspan="6"><p> Sorry , There is no Privilages to list</p></td>
        <?php endif; ?>
        
    </tbody>
</table>
</div>
</main>
</section>