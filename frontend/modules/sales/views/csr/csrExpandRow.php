<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="col-lg-6">
                <label for="fund">Address</label>
                <div id="fund">
                </div>
            </div>
            <div class="col-lg-6">
                <label for="type">Landmark</label>
                <div id="type">
                </div>
            </div>
        </div>
    </div>
    <table class="table table-responsive" style="font-size: 12px;">
        <thead>
            <tr>
                <th class="text-center" width="10%">Date</th>
                <th class="text-center" width="15%">Products</th>
                <th class="text-center" width="10%">Qty</th>
                <th class="text-center" width="10%">Price</th>
                <th class="text-center" width="20%">Name</th>
                <th class="text-center" width="15%">Contact</th>
                <th class="text-center" width="20%">Remark(s)</th>
            </tr>
        </thead>
        <tbody class="text-center">
            <?php
                echo "<tr>
                    <td class='text-center'>".date('Y-m-d', strtotime($salesModel->date_created))."</td>
                    <td>";
                    foreach($product as $p){
                        echo $p->product_name.'<br>';
                    }
                    echo "</td>
                    <td>";
                    foreach($productSales as $q){
                        echo $q->quantity.'<br>';
                    }
                    echo "</td>
                    <td>";
                    foreach($productSales as $a){
                        echo number_format($a->collectible_amount, 2, '.', ',').'<br>';
                    }
                    echo "</td>
                    <td>".$customerName."</td>
                    <td>".$customerContact."</td>
                    <td>".'OSR: '.$salesModel->osr_remark.'<br>CSR: '.$salesModel->csr_remark.'<br>Encoder: '.$salesModel->dispatcher_remark."</td>
                </tr>";
            ?>
        </tbody>
    </table>
</div>