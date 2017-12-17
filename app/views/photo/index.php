<?= $this->view('layouts/header') ?>
<h2 class="page-heading">Photos list fro gallery <span class="text-primary"><?= $gallery->name ?></span></h2>
<?php if (!empty($photos)): ?>
    <div class="row">
        <div class="col-md-12">
            <?php foreach ($photos as $photo): ?>
                <div class="col-md-3">
                    <a href="<?= \VS\Gallery\App::url('photo/show/' . $photo->id) ?>">
                        <img class="img img-responsive img-thumbnail" src="<?= \VS\Gallery\App::url($photo->path) ?>">
                    </a>
                    <?php if (isset($_SESSION['user_role']) && $_SESSION['user_role'] === 'editor'): ?>
                        <form method="post" action="<?= \VS\Gallery\App::url('photo/remove/' . $photo->id) ?>">
                            <input type="hidden" name="gallery_id" value="<?= $gallery->id ?>">
                            <button class="btn btn-danger">delete</button>
                        </form>
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
<?php else: ?>
    <h4 class="text-danger">No photos for this gallery</h4>
<?php endif; ?>
<div class="row well-sm">
    <div class="col-md-2">
        <a href="<?= \VS\Gallery\App::url('gallery') ?>" class="btn btn-sm btn-primary">Back to the list</a>
    </div>
    <?php if(isset($_SESSION['user_role']) && $_SESSION['user_role'] === 'editor'): ?>
    <div class="col-md-4">
        <form action="<?= \VS\Gallery\App::url('photo/upload') ?>" class="form-horizontal" method="post"
              enctype="multipart/form-data">
            <div class="form-group">
                <input type="hidden" name="gallery_id" value="<?= $gallery->id ?>">
                <label class="control-label">Upload new image</label>
                <input class="form-control" type="file" name="photo">
            </div>
            <button type="submit">Upload</button>
        </form>
    </div>
    <?php endif; ?>
</div>
<?= $this->view('layouts/footer') ?>
