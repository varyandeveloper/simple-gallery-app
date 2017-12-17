<?=$this->view('layouts/header') ?>
<div class="col-md-4">
    <form method="post" action="<?=\VS\Gallery\App::url('gallery/create')?>">
        <div class="form-group">
            <label class="control-label">Gallery name</label>
            <input class="form-control" type="text" name="name">
        </div>
        <button class="btn btn-primary" type="submit">Save</button>
    </form>
</div>
<?=$this->view('layouts/footer') ?>
