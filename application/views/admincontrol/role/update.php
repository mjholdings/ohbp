<div class="content-body">
    <div class="card award-level">
        <div class="card-header bg-secondary text-white d-flex justify-content-between">
            <h5><?= __('Sửa vai trò') ?></h5>
            <a id="toggle-uploader" href="<?= base_url('admincontrol/role') ?>" class="btn btn-sm btn-light">
                <?= __('Quay lại') ?>
            </a>
        </div>
        <div class="card-body">
            <form>
                <div class="form-content">
                    <div class="mb-3">
                        <label class="form-label">
                            <?= __('Tên') ?>
                            <span class="field-description" data-bs-toggle="tooltip" title="<?= __('Tên') ?>"></span>
                        </label>
                        <div class="input-group">
                            <input type="text" class="form-control" name="name" value="<?= $role['name'] ?>" placeholder="<?= __('Tên') ?>">
                        </div>
                        <p class="error-message"></p>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">
                            <?= __('Vai trò') ?>
                            <span class="field-description" data-bs-toggle="tooltip" title="<?= __('Vai trò') ?>"></span>
                        </label>
                        <div class="input-group">
                            <input type="text" class="form-control" name="role" value="<?= $role['role'] ?>" placeholder="<?= __('Vai trò') ?>">
                        </div>
                        <p class="error-message"></p>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">
                            <?= __('Danh sách quyền') ?>
                            <span class="field-description" data-bs-toggle="tooltip" title="<?= __('Phân quyền') ?>"></span>
                        </label>
                        <div class="row">
                            <?php
                            $assigned_permissions = explode(',', $role['ids_permission']);
                            foreach ($permissions as $permission) :
                            ?> <div class="input-group mb-2">
                                    <input type="checkbox" name="permissions[]" value="<?php echo $permission['id']; ?>" <?php echo in_array($permission['id'], $assigned_permissions) ? 'checked' : ''; ?> />

                                    <label style="margin-left: 5px;" for="permissions[]"><?php echo $permission['name']; ?></label><br />

                                </div>

                            <?php endforeach; ?>

                            <p class="error-message"></p>
                        </div>
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
                                window.location = '<?= base_url("admincontrol/role") ?>';
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