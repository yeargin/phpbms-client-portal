<h2>Your Profile</h2>
<table class="profile">  
    <tr>
        <th>Contact:</th>
        <td><?php echo ($clientinfo->firstname . ' ' . $clientinfo->lastname); ?></td>
    </tr>
    <tr>
        <th>Company Name:</th>
        <td><?php echo ($clientinfo->company); ?></td>
    </tr>
    <tr>
        <th>Home:</th>
        <td><?php echo ($clientinfo->homephone); ?></td>
    </tr>
    <tr>
        <th>Work:</th>
        <td><?php echo ($clientinfo->workphone); ?></td>
    </tr>
    <tr>
        <th>Mobile:</th>
        <td><?php echo ($clientinfo->mobilephone); ?></td>
    </tr>
    <tr>
        <th>Fax:</th>
        <td><?php echo ($clientinfo->fax); ?></td>
    </tr>
    <tr>
        <th>Other:</th>
        <td><?php echo ($clientinfo->otherphone); ?></td>
    </tr>
    <tr>
        <th>E-mail Address:</th>
        <td><?php echo ($clientinfo->email); ?></td>
    </tr>
    <tr>
        <th>Web Site URL:</th>
        <td><?php echo ($clientinfo->webaddress); ?></td>
    </tr>
    <tr>
        <th>Postal Address:</th>
        <td><?php echo ($clientinfo->address1); ?><br />
            <?php echo ($clientinfo->address2); ?><br />
            <?php echo ($clientinfo->city); ?> <?php echo ($clientinfo->state); ?> <?php echo ($clientinfo->postalcode); ?><br />
            <?php echo ($clientinfo->country); ?></td>
    </tr>
</table>

<p>
	<small>Last Updated: <?php echo date('F j, Y', strtotime($clientinfo->modifieddate)); ?></small>
</p>