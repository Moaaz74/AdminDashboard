

<div class="container mt-3">
    <form method="POST">
        <div class="input-group">
            <span class="input-group-text">@</span>
            <input type="text" class="form-control"   name="Username" placeholder="Enter Username" required>
        </div>
        <div class="input-group">
            <input type="password" class="form-control"   name="Password" placeholder="Enter Password" required>
        </div>
        <div class="input-group">
            <input type="email" class="form-control"  name="Email" placeholder="Enter Eamil" required>
            <span class="input-group-text">@example.com</span>
        </div>
        <div class="input-group">
            <input type="number" class="form-control"   name="PhoneNumber" placeholder="Enter Phone Number" required>
        </div>
        <div>
            <select class="form-select" required name="GroupId">
                <option value="">Select Group</option>
                <?php if($groups !== false) : foreach($groups as $group): ?>
                    <option value="<?= $group->GroupId ?>"><?= $group->GroupName ?></option>
                <?php endforeach;endif ?>
            </select>
        </div>
        <button type="submit" name="submit" class="btn btn-primary">Submit</button>
    </form>
</div>

</main>
</section>