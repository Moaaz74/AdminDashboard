<div class="container mt-3">
    <form method="POST">
        <div class="mb-3 mt-3">
            <label class="labelName">Group Name :</label>
            <input type="text" class="form-control"   name="GroupName">
        </div>
        <div class="groupLabel"><label>Group Privilages :</label></div>
        <?php if($privilages !== false) : foreach($privilages as $privilage): ?>
            <div class="form-check">
                <input type="checkbox" name="privilagesArray[]" value="<?= $privilage->PrivilageId ?>" class="form-check-input" >
                <label class="form-check-label"><?= $privilage->PrivilageTitle ?></label>
            </div>
            <?php endforeach; ?>
            <?php else : ?>
                <div class="noPrivileges">You didn't add any privileges yet</div>
            <?php endif?>
        <button type="submit" name="submit" class="btn btn-primary">Submit</button>
    </form>
</div>

</main>
</section>