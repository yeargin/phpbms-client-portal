<h2>Account History</h2>

<?php if (count($quotes) > 0): ?>
<h3>Quotes</h3>
<table class="invoices">
<thead>
<tr>
  <th>Quote #</th>
  <th>Date</th>
  <th>Total</th>
</tr>
</thead>
<tbody>
<?php foreach ($quotes as $item): ?>
<tr>
  <td><a href="<?php echo site_url('history/detail'); ?>?invoice_id=<?php echo ($item->id); ?>"><?php echo ($item->id); ?></td>
  <td><?php echo date('F j, Y', strtotime($item->orderdate)); ?></td>
  <td class="decimal">$<?php echo number_format($item->totalti,2); ?></td>
</tr>
<?php endforeach; ?>
</tbody>
</table>
<?php endif; ?>


<?php if (count($orders) > 0): ?>
<h3>Orders</h3>
<table class="invoices">
<thead>
<tr>
  <th>Order #</th>
  <th>Date</th>
  <th>PO #</th>
  <th>Total</th>
</tr>
</thead>
<tbody>
<?php foreach ($orders as $item): ?>
<tr>
	<td><a href="<?php echo site_url('history/detail'); ?>?invoice_id=<?php echo ($item->id); ?>"><?php echo ($item->id); ?></td>
  <td><?php echo date('F j, Y', strtotime($item->orderdate)); ?></td>
  <td><?php echo ($item->ponumber); ?></th>
  <td class="decimal">$<?php echo number_format($item->totalti,2); ?></td>
</tr>
<?php endforeach; ?>
</tbody>
</table>
<?php endif; ?>


<?php if (count($invoices) > 0): ?>
<h3>Invoices</h3>
<table class="invoices">
<thead>
<tr>
  <th>Invoice #</th>
  <th>Date</th>
  <th>PO #</th>
  <th>Invoiced</th>
  <th>Amount Due</th>
	<th></th>
</tr>
</thead>
<tbody>
<?php $totalti = 0; $amountpaid = 0; ?>
<?php foreach ($invoices as $item): ?>
<tr>
	<td><a href="<?php echo site_url('history/detail'); ?>?invoice_id=<?php echo ($item->id); ?>"><?php echo ($item->id); ?></td>
	<td><?php echo date('F j, Y', strtotime($item->orderdate)); ?></td>
	<td><?php echo ($item->ponumber); ?></th>
	<td class="decimal">$<?php echo number_format($item->totalti,2); ?></td>
	<td class="decimal">$<?php echo number_format($item->totalti - $item->amountpaid,2); ?></td>
	<td><?php if (($item->totalti - $item->amountpaid) > 0): ?><a href="<?php echo site_url('payment'); ?>?payment_ref=<?php echo ($item->id); ?>&amp;payment_amount=<?php echo ($item->totalti - $item->amountpaid); ?>" class="btn primary small">Pay Online</a><?php endif; ?></td>
	<?php $totalti += $item->totalti; $amountpaid += $item->amountpaid; ?>
</tr>
<?php endforeach; ?>
</tbody>
<tfoot>
	<th colspan="3" style="text-align:right;">Total</th>
	<td class="decimal">$<?php echo number_format($totalti,2); ?></td>
	<td class="decimal">$<?php echo number_format($totalti - $amountpaid,2); ?></td>
	<td></td>
</tfoot>
</table>
<?php endif; ?>

<?php if (count($quotes) == 0 && count($orders) == 0 && count($invoices) == 0): ?>
<div class="alert-message block-message">
	<p>Your account history is empty.</p>
</div>
<?php else: ?>
<p>
	<small>Last Updated: <?php echo date('F j, Y', $lastupdate); ?></small>
</p>
<?php endif; ?>