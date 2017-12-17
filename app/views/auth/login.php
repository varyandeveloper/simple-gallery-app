<?=$this->view('layouts/header') ?>
    <div class="col-md-4">
        <form method="post" action="<?=\VS\Gallery\App::url('auth/login')?>">
            <div class="form-group">
                <label class="control-label">Your name</label>
                <input class="form-control" type="text" name="name">
            </div>
            <button class="btn btn-primary" type="submit">Login</button>
        </form>
    </div>
<?=$this->view('layouts/footer') ?>
