<?= $this->extend('layout') ?>

<?= $this->section('content') ?>


<?php if(session()->getFlashdata('success')): ?>
    <div class="alert alert-success success"><?= session()->getFlashdata('success') ?></div>
<?php endif; ?>

<div class="d-flex justify-content-between mb-3">
<a href="<?= base_url('products/create') ?>" class="btn btn-success mb-3">Add New Product</a>
<a href="<?= base_url('logout') ?>" class="btn btn-danger mb-3"> logout </a>
</div>


<table id="products-table" class="display nowrap" style="width:100%">
    <thead>
        <tr>
            <th>ID</th>
            <th>Product Name</th>
            <th>Description</th>
            <th>Price</th>
            <th>Category</th>
            <th>Image</th>
            <th>Actions</th>
        </tr>
    </thead>
</table>

<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
$(document).ready(function() {
    $('#products-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: "<?= base_url('products/getProducts') ?>",
            type: 'POST',
        },
        columns: [
            { data: 0 },
            { data: 1 },
            { data: 2 },
            { data: 3 },
            { data: 4 },
            { data: 5, orderable: false, searchable: false },
            { data: 6, orderable: false, searchable: false },
        ],
        dom: 'Bfrtip',
        buttons: ['colvis'],
        responsive: true,
    });
});

setInterval(() => {
    $('.success').hide();
}, 3000);
</script>
<?= $this->endSection() ?>
