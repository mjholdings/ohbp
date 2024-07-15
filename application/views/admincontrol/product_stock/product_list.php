<?php
$db = &get_instance();
$userdetails = $db->userdetails();
$pro_setting = $this->Product_model->getSettings('productsetting');
$vendor_setting = $this->Product_model->getSettings('vendor');
?>

<?php foreach ($productlist as $product) { ?>
	<?php
	$productLink = base_url('store/' . base64_encode($userdetails['id']) . '/product/' . $product['product_slug']);
	?>
	<tr>
		<td class="text-center">
			<input name="product[]" class="list-checkbox" type="checkbox" id="check<?php echo $product['product_id']; ?>" value="<?php echo $product['product_id']; ?>" onclick="checkonly(this,'check<?php echo $product['product_id']; ?>')">
			<?php if ($product['product_type'] == 'downloadable') { ?>
				<img src="<?= base_url('assets/images/download.png') ?>" width="20px" class='d-block'>
			<?php } ?>
		</td>
		<td>
			<div class="tooltip-copy">
				<img width="50px" height="50px" src="<?php echo base_url('assets/images/product/upload/thumb/' . $product['product_featured_image']) ?>"><br>
			</div>
		</td>
		<td class="white-space-normal">
			<div class="tooltip-copy">
				<span><?php echo $product['product_name']; ?></span>
				<div> <small>
						<a target="_blank" href="<?= $productLink . '?preview=1' ?>"><?= __('admin.public_page') ?></a>
					</small></div>
			</div>
		</td>
		<?php 
			$total_quantity = $this->Product_model->getTotalStockQuantity($product['product_id']);
		?>
		<td class="txt-cntr"><?php echo $total_quantity > 0 ? $total_quantity: __('Hết hàng'); ?></td>
		<td class="txt-cntr"><?php echo c_format($product['product_price']); ?></td>
		<td class="txt-cntr"><?php echo $product['product_sku']; ?></td>

		<td class="txt-cntr">
			<span class="badge bg-success text-light fs-6"> <?= $product['cat_name'] ?? 'Không xác định' ?> </span>
		</td>		
		<td class="txt-cntr">
			<a class="btn btn-primary" href="" onclick="return confirmpopup('<?= base_url(); ?>admincontrol/stock_updateproduct/<?php echo $product['product_id']; ?>','Có phải bạn muốn nhập [<?= $product['product_name'] ?>] vào Kho không?');" href="<?php echo base_url(); ?>admincontrol/updateproduct/<?php echo $product['product_id']; ?>">
				<i class="fa fa-edit cursors" aria-hidden="true"></i>
			</a>
			<a class="btn btn-danger delete-product" type="button" data-id="<?= $product['product_id'] ?>"> <i class="fa fa-trash"></i> </a>
		</td>
	</tr>
<?php } ?>