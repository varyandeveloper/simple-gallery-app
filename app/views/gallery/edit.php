<?=$this->view('layouts/header') ?>
<div class="col-md-4">
    <form method="post" action="<?=\VS\Gallery\App::url('gallery/update/'.$gallery->id)?>">
        <div class="form-group">
            <label class="control-label">Gallery name</label>
            <input class="form-control" type="text" name="name" value="<?=$gallery->name?>">
        </div>
        <a href="<?=\VS\Gallery\App::url('gallery')?>" class="btn btn-default">Cancel</a>
        <button class="btn btn-primary" type="submit">Update</button>
    </form>
</div>
<?=$this->view('layouts/footer') ?>
