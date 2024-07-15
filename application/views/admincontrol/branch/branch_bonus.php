<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header bg-secondary text-white d-flex justify-content-between align-items-center">
                <h5><?= __('Cài đặt Thưởng') ?></h5>
                <div>
                    <a id="toggle-uploader" href="<?= base_url('admincontrol/create_branch' . '?ref=branch_bonus') ?>" class="btn btn-light"><?= __("admin.add_new") ?></a>
                </div>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-striped text-center">
                        <thead>
                            <tr>
                                <th><?= __('Tên') ?></th>
                                <th><?= __('Doanh số Yêu cầu') ?></th>
                                <th><?= __('Doanh số Tổng Yêu cầu') ?></th>
                                <th><?= __('Thưởng Hoa hồng (%)') ?></th>
                                <th><?= __('Thưởng cứng (đ)') ?></th>
                                <th>#</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($branch as $key => $value) { ?>
                                <tr>
                                    <td><?= $value['name'] ?></td>
                                    <td><?= c_format($value['con_revenue_branch']); ?></td>
                                    <td><?= c_format($value['con_revenue_branch_total']); ?></td>
                                    <td><?= $value['sale_commission_rate'] . '%'; ?></td>
                                    <td><?= c_format($value['sale_commission_fixed']) . 'đ'; ?></td>

                                    <td>
                                        <a href="<?= base_url('admincontrol/update_branch/' . $value['id'] . '?ref=branch_bonus') ?>" class="btn btn-sm btn-primary">
                                            <i class="bi bi-pencil"></i>
                                        </a>

                                        <a href="<?= base_url('admincontrol/delete_branch/' . $value['id'] . '?ref=branch_bonus') ?>" class="btn btn-sm btn-danger btn-delete">
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