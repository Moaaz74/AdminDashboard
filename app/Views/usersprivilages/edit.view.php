<div class="login-box">
    <h2>Privilage Information</h2>
    <form method="POST">
    <div class="mb-3 mt-3">
        <label>Privilege Name</label>
        <input type="text" class="form-control" name="PrivilageTitle" value="<?= $privilage->PrivilageTitle ?>" required>
    </div>
    <div class="mb-3">
        <label >Privilege</label>
        <input type="text" class="form-control" name="Privilage" value="<?= $privilage->Privilage ?>" required>
    </div>
    <button type="submit" name="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
    
</main>
</section>