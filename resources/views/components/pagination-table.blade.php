<div class="d-flex justify-content-between">
    <p class="lead">
        Menampilkan {{ $model->firstItem() }} / {{ $model->lastItem() }} dari {{ $model->total() }} data
    </p>
    {{ $model->links() }}
</div>