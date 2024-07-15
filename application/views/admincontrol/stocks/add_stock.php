<script type="text/javascript">
    var tel_input = false;
</script>

<link rel="stylesheet" href="<?= base_url('assets/plugins/tel/css/intlTelInput.css') ?>?v=<?= av() ?>">
<script src="<?= base_url('assets/plugins/tel/js/intlTelInput.js') ?>"></script>

<form id="addClientForm" method="post" action="" enctype="multipart/form-data">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header bg-secondary text-white d-flex justify-content-between">
                    <h5><?= __('admin.page_title_addstock') ?></h5>
                    <button id="toggle-uploader" class="btn btn-light" type="submit"><?= __('admin.save') ?></button>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label class="control-label"><?= __('admin.branch_name') ?></label>
                        <select name="parent_id" class="form-control">
                            <option value="">-- <?= __('admin.none') ?> --</option>
                            <?php foreach ($categories as $key => $value) { ?>
                                <option value="<?= $value['id'] ?>" <?php echo ($category['parent_id'] == $value['id']) ? 'selected' : ''; ?>> <?= $value['parent_id'] == 0 ? '' : '-'; ?> <?= $value['name'] ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="control-label"><?= __('admin.product_name') ?></label>
                        <select name="parent_id" class="form-control">
                            <option value="">-- <?= __('admin.none') ?> --</option>
                            <?php foreach ($categories as $key => $value) { ?>
                                <option value="<?= $value['id'] ?>" <?php echo ($category['parent_id'] == $value['id']) ? 'selected' : ''; ?>> <?= $value['parent_id'] == 0 ? '' : '-'; ?> <?= $value['name'] ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="mb-3 row">
                        <div class="form-group">
                            <label class="col-form-label"><?= __('admin.product_price') ?></label>
                            <div>
                                <input placeholder="<?= __('admin.enter_your_product_price') ?>" name="product_price" class="form-control" value="<?php echo $product->product_price; ?>" type="number">
                            </div>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <div class="form-group">
                            <label class="col-form-label"><?= __('admin.stock_quantity') ?></label>
                            <div>
                                <input placeholder="<?= __('admin.enter_import_product_quantity') ?>" name="stock_quantity" class="form-control" value="<?php echo $product->product_price; ?>" type="number">
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</form>

<script type="text/javascript">
    $(document).ready(function() {
        window.tel_inputphone = intlTelInput(document.querySelector("#phone"), {
            initialCountry: "auto",
            utilsScript: "<?= base_url('/assets/plugins/tel/js/utils.js?1562189064761') ?>",
            separateDialCode: true,
            geoIpLookup: function(success, failure) {
                $.get("https://ipinfo.io", function() {}, "jsonp").always(function(resp) {
                    var countryCode = (resp && resp.country) ? resp.country : "US";
                    success(countryCode);
                });
            },
        });
    });
    $(document).ready(function() {
        $("#addClientForm").submit(function(e) {
            $this = $(this);

            var is_valid = 0;
            var need_valid = 0;

            $(".tel_input").each(function() {

                let this_is_valid = true;
                $(this).parents(".form-group").removeClass("has-error");
                $(this).parents(".form-group").find(".text-danger").remove();

                if (window["tel_input" + $(this).attr('id')]) {

                    var errorMap = ['<?= __('user.invalid_number') ?>', '<?= __('user.invalid_country_code') ?>', '<?= __('user.too_short') ?>', '<?= __('user.too_long') ?>', '<?= __('user.invalid_number') ?>'];
                    var errorInnerHTML = '';
                    if ($(this).val().trim()) {
                        need_valid++;
                        if (window["tel_input" + $(this).attr('id')].isValidNumber()) {

                            window["tel_input" + $(this).attr('id')].setNumber($(this).val().trim());

                            is_valid++;
                            this_is_valid = true;
                        } else {
                            var errorCode = window["tel_input" + $(this).attr('id')].getValidationError();
                            errorInnerHTML = errorMap[errorCode];
                            this_is_valid = false;
                        }
                    } else {
                        if ($(this).attr('required') !== undefined) {
                            need_valid++;
                            this_is_valid = false;
                            errorInnerHTML = 'The Mobile Number field is required.';
                        }
                    }

                    if (!this_is_valid) {
                        $(this).parents(".form-group").addClass("has-error");
                        $(this).parents(".form-group").find('> div').after("<span class='text-danger'>" + errorInnerHTML + "</span>");

                    }
                }
            });
            if (is_valid == 1) {
                $(".tel_input").each(function() {
                    if ($(this).val().trim() && window["tel_input" + $(this).attr('id')].isValidNumber()) {
                        country_id = window["tel_input" + $(this).attr('id')].getSelectedCountryData().dialCode;

                        $("#countrycode").val(country_id);
                    }
                });
                return true;
            } else {
                return false;
            }


        });
    });
</script>

<script type="text/javascript">
    function isNumberKey(evt) {
        var charCode = (evt.which) ? evt.which : event.keyCode;
        if (charCode != 46 && charCode != 45 && charCode > 31 &&
            (charCode < 48 || charCode > 57))
            return false;

        return true;
    }
    renderStateAndCart('<?= $client->ucountry ?>');
    $("#country").change(function() {
        renderStateAndCart($(this).val())
    });

    function renderStateAndCart(countryCode) {
        $.ajax({
            url: '<?= base_url('admincontrol/getState') ?>',
            type: 'POST',

            data: {
                country_id: countryCode,
                isId: true
            },
            beforeSend: function() {
                $('[name="state"]').prop("disabled", true);
            },
            complete: function() {
                $('[name="state"]').prop("disabled", false);
            },
            success: function(html) {

                $('[name="state"]').html(html);
                if ('<?= $client->state ?>' != "")
                    $('[name="state"]').val('<?= $client->state ?>')
            },
        });
    }
</script>