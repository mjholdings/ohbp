    <div class="content-body">
        <div class="card award-level">
            <div class="card-header bg-secondary text-white d-flex justify-content-between">
                <h5><?= __('Thêm chi nhánh') ?></h5>
                <a id="toggle-uploader" href="<?= base_url('admincontrol/branch') ?>" class="btn btn-sm btn-light">
                    <?= __('Quay lại') ?>
                </a>
            </div>
            <div class="card-body">
                <form>
                    <div class="form-content">
                        <div class="mb-3">
                            <label class="form-label">
                                <?= __('Tên chi nhánh') ?>
                                <span class="field-description" data-bs-toggle="tooltip" title="<?= __('Tên chi nhánh') ?>"></span>
                            </label>
                            <div class="input-group">
                                <input type="text" class="form-control" name="name" id="name" placeholder="<?= __('Tên chi nhánh') ?>">
                                <input type="hidden" class="form-control" name="is_default" id="is_default" value="0">
                            </div>
                            <p class="error-message"></p>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">
                                <?= __('Địa chỉ') ?>
                                <span class="field-description" data-bs-toggle="tooltip" title="<?= __('Địa chỉ') ?>"></span>
                            </label>
                            <div class="input-group">
                                <textarea class="form-control" id="address" name="address" rows="3" cols="40" placeholder="<?= __('Địa chỉ chi nhánh') ?>"></textarea>
                            </div>
                            <p class="error-message"></p>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">
                                <?= __('Số điện thoại') ?>
                                <span class="field-description" data-bs-toggle="tooltip" title="<?= __('Điện thoại chi nhánh') ?>"></span>
                            </label>
                            <div class="input-group">
                                <span class="input-group-text refer-reg-symball"><?= $CurrencySymbol ?></span>
                                <input type="text" class="form-control" name="phone" id="phone" placeholder="<?= __('admin.phone') ?>">
                            </div>
                            <p class="error-message"></p>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">
                                <?= __('Vị trí - Google Map') ?>
                                <span class="field-description" data-bs-toggle="tooltip" title="<?= __('Vị trí của Google Map') ?>"></span>
                            </label>
                            <div class="input-group">
                                <textarea class="form-control" id="location" name="location" rows="3" cols="40" placeholder="<?= __('Vị trí của Google Map') ?>"></textarea>
                            </div>
                            <p class="error-message"></p>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3"> <label class="form-label">
                                    <?= __('Doanh thu chi nhánh') ?>
                                    <span class="field-description" data-bs-toggle="tooltip" title="<?= __('Doanh thu chi nhánh yêu cầu') ?>"></span>
                                </label>
                                <div class="input-group">
                                    <span class="input-group-text refer-reg-symball"><?= $CurrencySymbol ?></span>
                                    <input type="number" class="form-control" name="con_revenue_branch" min="0" step="0.01" placeholder="<?= __('Nhập doanh thu chi nhánh yêu cầu') ?>">
                                </div>
                                <p class="error-message"></p>
                            </div>
                            <div class="col-md-6 mb-3"> <label class="form-label">
                                    <?= __('Doanh thu tổng cộng') ?>
                                    <span class="field-description" data-bs-toggle="tooltip" title="<?= __('Tổng doanh thu chi nhánh yêu cầu') ?>"></span>
                                </label>
                                <div class="input-group">
                                    <span class="input-group-text refer-reg-symball"><?= $CurrencySymbol ?></span>
                                    <input type="number" class="form-control" name="con_revenue_branch_total" min="0" step="0.01" placeholder="<?= __('Nhập tổng doanh thu nhánh yêu cầu') ?>">
                                </div>
                                <p class="error-message"></p>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">
                                    <?= __('Thưởng Hoa hồng') ?>
                                    <span class="field-description" data-bs-toggle="tooltip" title="<?= __('Thưởng Hoa hồng') ?>"></span>
                                </label>
                                <div class="input-group">
                                    <span class="input-group-text refer-reg-symball">%</span>
                                    <input type="number" class="form-control" name="sale_commission_rate" min="0" step="0.01" placeholder="<?= __('Thưởng Hoa hồng') ?>">
                                </div>
                                <p class="error-message"></p>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">
                                    <?= __('Thưởng cứng') ?>
                                    <span class="field-description" data-bs-toggle="tooltip" title="<?= __('Thưởng cứng') ?>"></span>
                                </label>
                                <div class="input-group">
                                    <span class="input-group-text refer-reg-symball">%</span>
                                    <input type="number" class="form-control" name="sale_commission_fixed" min="0" step="1" placeholder="<?= __('Thưởng cứng') ?>">
                                </div>
                                <p class="error-message"></p>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex justify-content-center">
                        <button type="submit" class="btn btn-primary me-3"><?= __('admin.save') ?></button>
                        <button type="submit" class="btn btn-primary" data-redirect='true'><?= __('admin.save_and_close') ?></button>
                    </div>
            </div>

            </form>
        </div>
    </div>
    </div>
    <?php
    $ref = $this->input->get('ref'); // Lấy giá trị ref từ URL  
    ?>
    <script type="text/javascript">
        $("button[type='submit']").on('click', function(e) {
            e.preventDefault();

            $this = $(this);
            let form = $(this).parents('form');
            let url = form.attr('action');

            $.ajax({
                type: 'POST',
                dataType: 'json',
                data: form.serialize(),
                success: function(result) {
                    $("input,select").removeClass('error');
                    $(".error-message").text('');

                    if (result.validation) {
                        $.each(result.validation, function(key, value) {
                            $("[name='" + key + "']").addClass('error');
                            $("[name='" + key + "']").siblings('.error-message').text(value);
                            showPrintMessage(value, 'error');
                        })
                    } else {
                        if (result.status) {
                            showPrintMessage(result.message, 'success');

                            let redirect = $this.data('redirect');
                            if (redirect) {
                                setTimeout(function() {
                                    window.location = '<?= base_url("admincontrol/" . $ref) ?>';
                                }, 1000);
                            }
                        } else {
                            showPrintMessage(result.message, 'error');
                        }

                    }
                },
            });
        })
    </script>