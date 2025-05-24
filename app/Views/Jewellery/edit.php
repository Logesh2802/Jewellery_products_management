<?= $this->extend('layout') ?>

<?= $this->section('content') ?>

<h2>Edit Product</h2>

<?php if(session()->getFlashdata('errors')): ?>
    <div class="alert alert-danger">
        <ul>
            <?php foreach(session()->getFlashdata('errors') as $error): ?>
                <li><?= esc($error) ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
<?php endif; ?>

<form action="<?= base_url('products/update/'.$product['id']) ?>" method="post" enctype="multipart/form-data">
    <?= csrf_field() ?>
    <div class="mb-3">
        <label for="product_name" class="form-label">Product Name</label>
        <input type="text" name="product_name" id="product_name" class="form-control" value="<?= old('product_name', $product['product_name']) ?>" required>
    </div>
    <div class="mb-3">
        <label for="description" class="form-label">Description</label>
        <textarea name="description" id="description" class="form-control"><?= old('description', $product['description']) ?></textarea>
    </div>
    <div class="mb-3">
        <label for="price" class="form-label">Price (INR)</label>
        <input type="number" step="0.01" name="price" id="price" class="form-control" value="<?= old('price', $product['price']) ?>" required>
    </div>
    <div class="mb-3">
        <label for="category" class="form-label">Category</label>
        <select name="category" id="category" class="form-select" required>
            <option value="">-- Select Category --</option>
            <?php foreach($categories as $cat): ?>
                <option value="<?= esc($cat) ?>" <?= (old('category', $product['category']) == $cat) ? 'selected' : '' ?>><?= esc($cat) ?></option>
            <?php endforeach; ?>
        </select>
    </div>
    <div class="mb-3">
        <label class="form-label">Current Image</label><br>
        <?php if($product['image']): ?>
            <img src="<?= base_url('uploads/'.$product['image']) ?>" width="150" alt="Product Image" />
        <?php else: ?>
            No Image Uploaded
        <?php endif; ?>
    </div>
    <div class="mb-3">
        <label for="image" class="form-label">Change Image (optional, max 2MB)</label>
        <input type="file" name="image" id="image" class="form-control" accept="image/*">
    </div>
    <button type="submit" class="btn btn-primary">Update Product</button>
    <a href="<?= base_url('products') ?>" class="btn btn-secondary">Cancel</a>
</form>

<?= $this->endSection() ?>
