<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Book</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h1>Edit Book</h1>
        <?php if (session()->has('errors')): ?>
            <div class="alert alert-danger">
                <ul>
                    <?php foreach (session('errors') as $error): ?>
                        <li><?= $error ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>
        <form action="<?= base_url('books/update/' . $book['id']) ?>" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" class="form-control" id="title" name="title" value="<?= old('title', $book['title']) ?>" required>
            </div>
            <div class="form-group">
                <label for="author">Author</label>
                <input type="text" class="form-control" id="author" name="author" value="<?= old('author', $book['author']) ?>" required>
            </div>
            <div class="form-group">
                <label for="genre">Genre</label>
                <input type="text" class="form-control" id="genre" name="genre" value="<?= old('genre', $book['genre']) ?>">
            </div>
            <div class="form-group">
                <label for="publication_year">Publication Year</label>
                <input type="number" class="form-control" id="publication_year" name="publication_year" value="<?= old('publication_year', $book['publication_year']) ?>" required>
            </div>
            <div class="form-group">
                <label for="cover_image">Cover Image</label>
                <input type="file" class="form-control-file" id="cover_image" name="cover_image">
                <?php if ($book['cover_image']): ?>
                    <img src="<?= base_url('uploads/' . $book['cover_image']) ?>" alt="Cover" style="max-width: 100px;">
                <?php endif; ?>
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
            <a href="<?= base_url('books') ?>" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</body>
</html> 