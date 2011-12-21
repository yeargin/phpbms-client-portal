<h2>Accounts Receivable Ledger</h2>
<?php if (count($aritems) > 0): ?>
<table class="invoices">
<thead>
<tr>
  <th>Status</th>
	<th>Related</th>
  <th>Amount</th>
  <th>Paid</th>
	<th>30/60/90</th>
	<th>Remaining</th>
	<th></th>
</tr>
</thead>
<tbody>
<?php foreach ($aritems as $item): ?>
<tr>
  <td><?php echo ucwords($item->status); ?></th>
  <td><a href="<?php echo site_url('history/detail'); ?>?invoice_id=<?php echo ($item->invoice_id); ?>"><?php echo ($item->invoice_id); ?></td>
  <td class="decimal"><?php echo format_money($item->amount); ?></td>
  <td class="decimal"><?php echo format_money($item->paid); ?></td>
	<td>
		<?php if ($item->aged1 == 0): ?>
		<span class="label default">Current</span>
		<?php endif; ?>
		<?php if ($item->aged1 != 0): ?>
		<span class="label warning">30 Days</span>
		<?php endif; ?>
		<?php if ($item->aged2 != 0): ?>
		<span class="label important">60 Days</span>
		<?php endif; ?>
		<?php if ($item->aged3 != 0): ?>
		<span class="label important">90+ Days</span>
		<?php endif; ?>
	</td>
  <td class="decimal"><?php echo format_money($item->amount - $item->paid); ?></td>
	<td><?php if ($item->amount - $item->paid > 0): ?> <a href="<?php echo site_url('payment'); ?>?payment_ref=<?php echo ($item->invoice_id); ?>&amp;payment_amount=<?php echo ($item->amount - $item->paid); ?>" class="btn primary small">Pay Online</a><?php endif; ?></td>
</tr>
<?php foreach ($aritem_transactions[$item->id] as $transaction): ?>
<tr style="background-color:#F9F9F9;">
	<td colspan="2" class="decimal"><?php echo date('F j, Y', strtotime($transaction->receiptdate)); ?></td>
	<td class="decimal"><?php echo ucwords($transaction->receipt_status); ?></td>
	<td class="decimal"><?php echo format_money($transaction->applied); ?></td>
	<td colspan="3"><?php echo ($transaction->paymentmethod ? $transaction->paymentmethod : $transaction->paymentother ); ?></td>
</tr>
<?php endforeach; ?>
<?php endforeach; ?>
</tbody>
</table>

<p><small>Last Updated: <?php echo date('F j, Y', $lastupdate); ?></small></p>

<?php else: ?>

<div class="alert-message block-message">
	<p>Your account history is empty.</p>
</div>

<?php endif; ?>