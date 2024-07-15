<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header bg-secondary text-white d-flex justify-content-between align-items-center">
                <h5><?= __('Chi nhánh') ?></h5>
                <div>
                    <a id="toggle-uploader" href="<?= base_url('admincontrol/create_branch' . '?ref=branch') ?>" class="btn btn-light"><?= __("admin.add_new") ?></a>
                </div>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-striped text-center">
                        <thead>
                            <tr>
                                <th><?= __('ID') ?></th>
                                <th><?= __('Tên chi nhánh') ?></th>
                                <th><?= __('Địa chỉ') ?></th>
                                <th><?= __('Số điện thoại') ?></th>
                                <th><?= __('Hành động') ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($branch as $key => $value) { ?>
                                <tr>
                                    <td><?= $value['id'] ?></td>
                                    <td align="left"><?= $value['name']; ?></td>
                                    <td align="left"><?= $value['address']; ?></td>
                                    <td><?= $value['phone']; ?></td>
                                    <td>
                                        <a href="<?= base_url('admincontrol/update_branch/' . $value['id'] . '?ref=branch') ?>" class="btn btn-sm btn-primary">
                                            <i class="bi bi-pencil"></i>
                                        </a>

                                        <a href="<?= base_url('admincontrol/delete_branch/' . $value['id'] . '?ref=branch') ?>" class="btn btn-sm btn-danger btn-delete">
                                            <i class="bi bi-trash"></i>
                                        </a>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card-footer">
                <ul class="pagination justify-content-end">
                    <?= $pagination ?>
                </ul>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(".btn-delete").off('click').on('click', function(e) {
        e.preventDefault();
        var proceed = confirm('<?= __("admin.sure_delete") ?>');
        if (proceed) {
            let url = $(this).attr('href');
            $.ajax({
                url: url,
                type: 'POST',
                dataType: 'json',
                success: function(result) {
                    if (result.status) {
                        location.reload();
                    } else {
                        Swal.fire({
                            icon: 'error',
                            html: result.message,
                        });
                        showPrintMessage(result.message, 'error');
                    }
                },
            });
        }
    });
</script>