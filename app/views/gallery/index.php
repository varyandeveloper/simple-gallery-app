<?= $this->view('layouts/header') ?>
<h2 class="page-heading">Galleries list</h2>
<ul class="col-md-4 list-group">
    <?php foreach ($galleries as $gallery): ?>
        <form method="post" action="<?= \VS\Gallery\App::url('gallery/remove/' . $gallery->id) ?>" id="gallery_<?=$gallery->id?>"></form>
        <li class="list-group-item">
            <a title="View photos for gallery <?= $gallery->name ?>"
               href="<?= \VS\Gallery\App::url('photo?galleryId=' . $gallery->id) ?>">
                <?= $gallery->name ?>
            </a>
            <?php if(isset($_SESSION['user_role']) && $_SESSION['user_role'] === 'editor'): ?>
                <a class="btn btn-sm btn-warning" href="<?= \VS\Gallery\App::url('gallery/edit/' . $gallery->id) ?>">edit</a>
                <button form="gallery_<?=$gallery->id?>" class="btn btn-sm btn-danger">delete</button>
            <?php endif; ?>
        </li>
    <?php endforeach; ?>
</ul>
<?= $this->view('layouts/footer') ?>
