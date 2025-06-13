<?= $this->extend('layout/default') ?>

<?= $this->section('content') ?>
<div class="container-fluid mt-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Books</h1>
        <a href="<?= base_url('books/create') ?>" class="btn btn-primary">Add New Book</a>
    </div>

    <?php if (session()->has('message')): ?>
        <div class="alert alert-success">
            <?= session('message') ?>
        </div>
    <?php endif; ?>

    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Author</th>
                    <th>Genre</th>
                    <th>Publication Year</th>
                    <th>Cover Image</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($books as $book): ?>
                    <tr>
                        <td><?= esc($book['title']) ?></td>
                        <td><?= esc($book['author']) ?></td>
                        <td><?= esc($book['genre']) ?></td>
                        <td><?= esc($book['publication_year']) ?></td>
                        <td>
                            <?php if (!empty($book['image_path'])): ?>
                                <img src="<?= base_url('uploads/' . $book['image_path']) ?>" alt="Cover" style="max-width: 80px; max-height: 100px; border-radius: 6px; box-shadow: 0 2px 8px rgba(0,0,0,0.08);">
                            <?php else: ?>
                                <span class="text-muted">No Image</span>
                            <?php endif; ?>
                        </td>
                        <td>
                            <a href="<?= base_url('books/edit/' . $book['id']) ?>" class="btn btn-sm btn-warning">Edit</a>
                            <form action="<?= base_url('books/delete/' . $book['id']) ?>" method="post" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this book?');">
                                <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
<?= $this->endSection() ?> 