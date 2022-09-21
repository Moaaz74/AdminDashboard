<div class="login-box">
    <h2>Group Information</h2>
    <form method="POST">
    <div class="user-box">
        <input type="text" name="GroupName" value="<?= $group->GroupName ?>">
        <label>Group Name</label>
    </div>
    <div>
        <div class="groupLabel"><label>Group Privilages</label></div>
        <div class="checkboxes">
            <?php if($privilages !== false) : foreach($privilages as $privilage): ?>
                <div>
                    <input <?php if(in_array($privilage->PrivilageId , $groupPrivilages)) {echo 'checked';} ?> type="checkbox" name="privilagesArray[]" value="<?= $privilage->PrivilageId ?>" class="checkboxData" >
                    <label><?= $privilage->PrivilageTitle ?></label>
                </div>
            <?php endforeach; ?>
            <?php else : ?>
                <div class="noPrivileges">You didn't add any privileges yet or privileges has been deleted</div>
            <?php endif?>
        </div>
    </div>
    <input class="submit" type="submit" name="submit" value="submit">
    </form>
</div>
</main>
</section>