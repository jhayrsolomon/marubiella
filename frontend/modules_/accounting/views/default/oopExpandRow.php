<div class="row">
    <div class="col-lg-12">
        <div class="col-lg-3">
            <label for="fund">Fund Cluster</label>
            <div id="fund">
                <?= $fund; ?>
            </div>
        </div>
        <div class="col-lg-3">
            <label for="type">Income Type</label>
            <div id="type">
                <?= $type; ?>
            </div>
        </div>
    </div>
</div>
<table class="table table-responsive" style="font-size: 12px;">
    <thead>
        <th width="25%" >Request Reference Number</th>
        <!--<th>Fund Cluster</th>
        <th>Collection Type</th>-->
        <th width="25%" >Total Amount</th>
        <th width="25%" >Balance</th>
        <th width="25%" >Status</th>
    </thead>
    <tbody>
        <?php
        if(count($dataProvider)) {
            foreach($dataProvider as $item) {
        ?>
                <tr>
                    <td><?= $item->request->requestRefNum ?></td>
                    <!--<td>?= $item->fund->fund_name ?></td>
                    <td>?= $item->collectiontype->collection_name ?></td>-->
                    <td><?= number_format($item->amount, 2) ?></td>
                    <td><?= number_format($item->balance, 2) ?></td>
                    <td><?= $item->status->description ?></td>
                </tr>
        <?php } } ?>
    </tbody>
</table>