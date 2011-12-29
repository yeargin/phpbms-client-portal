<div class="float:right;">
	<h1 style="text-align:right;"><?php echo ($record->type); ?></h1>
</div>
<div class="row print">
	<div class="span4">
		<img src="<?php echo $this->config->item('application_logo'); ?>" alt="Logo" />
	</div>
	<div class="span4">
		<p>
			<?php echo ($settings['company_name']); ?><br />
			<?php echo ($settings['company_address']); ?><br />
			<?php echo ($settings['company_csz']); ?>
		</p>
	</div>
</div>

<div class="row print">&nbsp;</div>

<table class="invoiceHeader">
	<tr>
			<th>Bill To:</th>
			<th>Ship To:</th>
	</tr>
	<tr>		
		<td>
				<strong><?php echo ($record->client->company); ?></strong><br />
				<?php echo ($record->address1); ?><br />
				<?php if ($record->address2 != ''): ?><?php echo ($record->address2); ?><br /><?php endif; ?>
				<?php echo ($record->city); ?> <?php echo ($record->state); ?> &nbsp;&nbsp;&nbsp;<?php echo ($record->postalcode); ?><br />
				<?php echo ($record->country); ?><br />
		</td>				 
		<td>
				<strong><?php echo ($record->shiptoname) ? $record->shiptoname : '(Primary Contact)'; ?></strong><br />
				<?php echo ($record->shiptoaddress1); ?><br />
				<?php if ($record->shiptoaddress2 != ''): ?><?php echo ($record->shiptoaddress2); ?><br /><?php endif; ?>
				<?php echo ($record->shiptocity); ?> <?php echo ($record->shiptostate); ?> &nbsp;&nbsp;&nbsp;<?php echo ($record->shiptopostalcode); ?><br />
				<?php echo ($record->shiptocountry); ?><br />
			</td>
	</tr>
</table>

&nbsp;<br />

<table class="invoiceHeader">
	<tr>
			<th><?php echo ($record->type); ?> #</th>
			<th>PO #</th>
			<th>Schedule</th>
			<th>Payment Terms</th>
	</tr>
	<tr>
			<td><?php echo ($record->id); ?></td>
			<td><?php echo ($record->ponumber); ?></td>
			<td>
					<?php if ($record->orderdate != ''): ?><strong>Order:</strong> <?php echo date('F j, Y', strtotime($record->orderdate)); ?><br /><?php endif; ?>
					<?php if ($record->invoicedate != ''): ?><strong>Invoice:</strong> <?php echo date('F j, Y', strtotime($record->invoicedate)); ?><br /><?php endif; ?>
					<?php if ($record->requireddate != ''): ?><strong>Require:</strong> <?php echo date('F j, Y', strtotime($record->requireddate)); ?><?php endif; ?>
			</td>
			<td><?php echo ($record->paymentmethod); ?></td>
	</tr>
</table>

&nbsp;<br />

<?php if ($record->type != 'Invoice'): ?>

<p class="alert-message info">
	<strong><u>This is not an invoice</u>.</strong> No payment is due at this time.
</p>

<?php endif; ?>

<table class="invoiceItems">
	<thead>
	<tr>
			<th>Description</th>
			<th>Unit Price</th>
			<th>Qty</th>
			<th>Extended</th>
	</tr>
	</thead>
	<tbody>
	<?php foreach ($record->lineitems as $lineitem): ?>
	<tr>
			<td>
					<strong><?php echo ($lineitem->partname); ?></strong> <small>(<?php echo ($lineitem->partnumber); ?>)</small> <br />
					<?php echo ($lineitem->lineitem_memo); ?>
			</td>
			<td class="decimal"><?php echo format_money($lineitem->unitprice); ?></td>
			<td><?php echo ($lineitem->quantity); ?> <?php echo ($lineitem->unitofmeasure); ?></td>
			<td class="decimal"><?php echo format_money($lineitem->unitprice*$lineitem->quantity); ?></td>
	</tr>
	<?php endforeach; ?>
	</tbody>

	<?php if ($record->type == 'Invoice'): $rowspan = 6; else: $rowspan = 5; endif; ?>
	<tfoot>
	<tr>
			<td colspan="1" rowspan="<?php echo ($rowspan); ?>">
				<p><strong>Status:</strong> <?php echo ($record->invoicestatus); ?> <?php echo date('F j, Y', strtotime($record->statusdate)); ?></p>
				<p><?php echo ($record->printedinstructions); ?></p>
				<p>&nbsp;</p>
				<p>&nbsp;</p>
				<p>
					<?php if ($record->amountdue > 0 && $record->type == 'Invoice'): ?>
					<a href="<?php echo site_url('payment'); ?>?payment_ref=<?php echo ($record->id); ?>&amp;payment_amount=<?php echo ($record->amountdue); ?>" class="btn primary">Pay Online</a>
					<?php endif; ?>
					<?php if ($has_pdf): ?>
					<a href="<?php echo site_url('history/pdf'); ?>?invoice_id=<?php echo ($record->id); ?>" class="btn secondary">Download PDF</a>
					<?php endif; ?>
				</p>
			</td>
			<td colspan="2" style="text-align:right;"><strong>Discount</strong></td>
			<td class="decimal"><?php echo format_money($record->discountamount); ?></td>
	</tr>
	<tr>
			<td colspan="2" style="text-align:right;"><strong>Subtotal</strong></td>
			<td class="decimal"><?php echo format_money($record->totaltni); ?></td>
	</tr>
	<tr>
			<td colspan="2" style="text-align:right;"><strong>Tax</strong></td>
			<td class="decimal"><?php echo format_money($record->tax); ?></td>
	</tr>
	<tr>
			<td colspan="2" style="text-align:right;"><strong>Shipping</strong></td>
			<td class="decimal"><?php echo format_money($record->shipping); ?></td>
	</tr>
	<tr>
			<td colspan="2" style="text-align:right;"><strong>Total</strong></td>
			<td class="decimal"><?php echo format_money($record->totalti); ?></td>
	</tr>
<?php if ($record->type == 'Invoice'): ?>
	<tr>
			<td colspan="2" style="text-align:right;"><strong>Due</strong></td>
			<td class="decimal"><?php echo format_money($record->amountdue); ?></td>
	</tr>
<?php endif; ?>		 
	</tfoot>
</table>