<?php if ($award_level_status) { ?>

    <?php if ($award_level_status) { ?>
        <div class="content-body">
            <div class="card award-level">
                <div class="card-header bg-secondary text-white d-flex justify-content-between">
                    <h5><?= __('admin.award_level') ?></h5>
                    <a id="toggle-uploader" href="<?= base_url('admincontrol/award_level') ?>" class="btn btn-sm btn-light">
                        <?= __('admin.back') ?>
                    </a>
                </div>
                <div class="card-body">
                    <form>
                        <div class="form-content">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">
                                        <?= __('admin.level_number') ?>
                                        <span class="field-description" data-bs-toggle="tooltip" title="<?= __('admin.award_level_level_number_desc') ?>">
                                        </span>
                                    </label>
                                    <input type="text" class="form-control" name="level_number" value="<?= $award_level['level_number'] ?>" placeholder="<?= __('admin.level_number') ?>">
                                    <p class="error-message"></p>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">
                                        <?= __('admin.jump_level') ?>
                                        <span class="field-description <?= ($award_level['jump_level'] == '0') ? 'd-none' : '' ?>" data-bs-toggle="tooltip" title="<?= __('admin.award_level_jump_level_desc') ?>"></span>
                                        <span class="field-description default-level-description <?= ($award_level['jump_level'] == '0') ? '' : 'd-none' ?>" data-bs-toggle="tooltip" title="<?= __('admin.award_level_jump_default_level_desc') ?>"></span>
                                    </label>
                                    <select class="form-select" name="jump_level">
                                        <option value=''><?= __('admin.choose_jump_level') ?></option>
                                        <option <?= ($award_level['jump_level'] == '0') ? 'selected' : '' ?> value="0"><?= __('admin.default') ?></option>
                                        <?php foreach ($award_levels as $key => $value) : ?>
                                            <?php $class = ($value['id'] == $award_level['jump_level']) ? 'selected' : '' ?>
                                            <option <?= $class ?> value="<?= $value['id'] ?>"><?= $value['level_number'] ?></option>
                                        <?php endforeach ?>
                                    </select>
                                    <p class="error-message"></p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3 mb-3">
                                    <label class="form-label">
                                        <?= __('Thu nhập (thưởng và nhảy cấp)') ?>
                                        <span class="field-description" data-bs-toggle="tooltip" title="<?= __('Thu nhập tối thiểu yêu cầu để thưởng và nhảy cấp') ?>"></span>
                                    </label>
                                    <div class="input-group">
                                        <span class="input-group-text refer-reg-symball"><?= $CurrencySymbol ?></span>
                                        <input type="number" class="form-control" name="minimum_earning" min="0" step="0.01" value="<?= $award_level['minimum_earning'] ?>" placeholder="<?= __('admin.minimum_earning') ?>">
                                    </div>
                                    <p class="error-message"></p>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label class="form-label">
                                        <?= __('Tuyển tối thiểu (yêu cầu nhảy cấp)') ?>
                                        <span class="field-description" data-bs-toggle="tooltip" title="<?= __('Tuyển dụng tối thiểu') ?>"></span>
                                    </label>
                                    <div class="input-group">
                                        <input type="number" class="form-control" name="recruitment_number" min="0" step="1" value="<?= $award_level['recruitment_number'] ?>" placeholder="<?= __('Tuyển dụng tối thiểu') ?>">
                                    </div>
                                    <p class="error-message"></p>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label class="form-label">
                                        <?= __('Cấp tuyển (yêu cầu nhảy cấp)') ?>
                                        <span class="field-description" data-bs-toggle="tooltip" title="<?= __('Cấp tuyển yêu cầu để nhảy cấp') ?>"></span>
                                    </label>
                                    <div class="input-group">
                                        <input type="number" class="form-control" name="recruitment_level" min="0" step="1" value="<?= $award_level['recruitment_level'] ?>" placeholder="<?= __('Cấp tuyển yêu cầu') ?>">
                                    </div>
                                    <p class="error-message"></p>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label class="form-label">
                                        <?= __('Hưởng đồng chia') ?>
                                        <span class="field-description" data-bs-toggle="tooltip" title="<?= __('Hưởng đồng chia') ?>"></span>
                                    </label>
                                    <div class="input-group">
                                        <input type="number" class="form-control" name="shared_comission_rate" min="0" step="0.01" value="<?= $award_level['shared_comission_rate'] ?>" placeholder="<?= __('Hưởng đồng chia') ?>">
                                    </div>
                                    <p class="error-message"></p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3 mb-3">
                                    <label class="form-label">
                                        <?= __('Hoa hồng cá nhân hưởng') ?>
                                        <span class="field-description" data-bs-toggle="tooltip" title="<?= __('admin.award_level_sale_comission_rate_desc') ?>"></span>
                                    </label>
                                    <div class="input-group">
                                        <span class="input-group-text refer-reg-symball">%</span>
                                        <input type="number" class="form-control" name="sale_comission_rate" min="0" step="0.01" value="<?= $award_level['sale_comission_rate'] ?>" placeholder="<?= __('admin.sale_comission_rate') ?>">
                                    </div>
                                    <p class="error-message"></p>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label class="form-label">
                                        <?= __('Hoa hồng doanh thu trực tiếp') ?>
                                        <span class="field-description" data-bs-toggle="tooltip" title="<?= __('Hoa hồng trực tiếp') ?>"></span>
                                    </label>
                                    <div class="input-group">
                                        <span class="input-group-text refer-reg-symball">%</span>
                                        <input type="number" class="form-control" name="sale_comission_direct" min="0" step="0.01" value="<?= $award_level['sale_comission_direct'] ?>" placeholder="<?= __('Hoa hồng trực tiếp') ?>">
                                    </div>
                                    <p class="error-message"></p>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label class="form-label">
                                        <?= __('Hoa hồng doanh thu gián tiếp') ?>
                                        <span class="field-description" data-bs-toggle="tooltip" title="<?= __('Hoa hồng gián tiếp') ?>"></span>
                                    </label>
                                    <div class="input-group">
                                        <span class="input-group-text refer-reg-symball">%</span>
                                        <input type="number" class="form-control" name="sale_comission_indirect" min="0" step="0.01" value="<?= $award_level['sale_comission_indirect'] ?>" placeholder="<?= __('Hoa hồng gián tiếp') ?>">
                                    </div>
                                    <p class="error-message"></p>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label class="form-label">
                                        <?= __('admin.bonus') ?>
                                        <span class="field-description" data-bs-toggle="tooltip" title="<?= __('admin.award_level_bonus_desc') ?>"></span>
                                    </label>
                                    <div class="input-group">
                                        <span class="input-group-text refer-reg-symball"><?= $CurrencySymbol ?></span>
                                        <input type="number" class="form-control" name="bonus" min="0" step="0.01" value="<?= $award_level['bonus'] ?>" placeholder="<?= __('admin.bonus') ?>">
                                    </div>
                                    <p class="error-message"></p>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">
                                    <?= __('admin.set_default') ?>
                                    <span class="field-description" data-bs-toggle="tooltip" title="<?= __('admin.award_level_default_desc') ?>"></span>
                                </label>
                                <input type="checkbox" class="form-check-input" name="default_registration_level" <?= ($award_level['default_registration_level']) ? 'checked' : '' ?> value="1">
                                <p class="error-message"></p>
                            </div>
                        </div>
                        <div class="d-flex justify-content-center">
                            <button type="submit" class="btn btn-primary me-3"><?= __('admin.save') ?></button>
                            <button type="submit" class="btn btn-primary" data-redirect='true'><?= __('admin.save_and_close') ?></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    <?php } ?>


    <script type="text/javascript">
        $("button[type='submit']").on('click', function(e) {
            e.preventDefault();
            $this = $(this);
            let form = $this.parents('form');
            let url = form.attr('action');

            $.ajax({
                type: 'POST',
                dataType: 'json',
                data: form.serialize(),
                success: function(result) {
                    $("input").removeClass('error');
                    $(".error-message").text('');

                    if (result.validation) {
                        $.each(result.validation, function(key, value) {
                            $("input[name='" + key + "']").addClass('error');
                            $("input[name='" + key + "']").siblings('.error-message').text(value);
                            showPrintMessage(value, 'error');
                        })
                    } else {
                        if (result.status) {
                            showPrintMessage(result.message, 'success');
                            let redirect = $this.data('redirect');
                            if (redirect) {
                                setTimeout(function() {
                                    window.location = '<?= base_url("admincontrol/award_level") ?>';
                                }, 1000);
                            }
                        } else {
                            showPrintMessage(result.message, 'error');
                        }
                    }
                },
            });
        })

        $("select[name='jump_level']").on('change', function() {
            let value = $(this).val();
            if (value == '0') {
                $(this).siblings('label').find('.field-description').addClass('d-none');
                $(this).siblings('label').find('.field-description.default-level-description').removeClass('d-none');
            } else {
                $(this).siblings('label').find('.field-description').removeClass('d-none');
                $(this).siblings('label').find('.field-description.default-level-description').addClass('d-none');
            }
        })
    </script>

<?php } else { ?>
    <div>
        <h4 class="notification_on_pages">
            <span class="badge bg-secondary"><?= __('admin.award_level_module_is_off') ?>
                <a href="<?= base_url('admincontrol/addons') ?>">
                    <?= __('admin.admin_click_here_to_activate') ?>
                </a>
            </span>
        </h4>
    </div>
<?php } ?>