<table class="table table-colored-header">
    <thead>
    <tr>
        <th>Client</th>
        <th style="width: 15%">Date</th>
        <th style="width: 12%">Balance</th>
        <th style="width: 12%">NETT</th>
        <th style="width: 12%">GST</th>
        <th style="width: 12%">Gross</th>
    </tr>
    </thead>
    <tbody>
    <?php
    if(count($client)>0){
        foreach($client as $k=>$v){
            ?>
            <tr>
                <td style="text-align: left">
                    <?php echo $v->CompanyName;?>
                </td>
                <td>
                    <?php echo $v->max_date?>
                </td>
                <td>
                    <?php echo $v->balance?>
                </td>
                <td>
                    <?php echo $v->gst?>
                </td>
                <td>
                    <?php echo $v->nett?>
                </td>
                <td>
                    <?php echo $v->gross?>
                </td>
            </tr>
        <?php
        }
    }
    ?>
    <tr style="font-weight: bold">
        <td colspan="2" style="text-align: right;">Total</td>
        <td>
            <?php
            echo '$ '.number_format($total_balance,2,'.',',');
            ?>
        </td>
        <td>
            <?php
            echo '$ '.number_format($total_gst,2,'.',',');
            ?>
        </td>
        <td>
            <?php
            echo '$ '.number_format($total_nett,2,'.',',');
            ?>
        </td>
        <td>
            <?php
            echo '$ '.number_format($total_gross,2,'.',',');
            ?>
        </td>
    </tr>
    <tr>
        <td colspan="6" style="text-align: left;border: none;">
            <a href="#" class="btn btn-sm btn-primary">Print PDF</a>
        </td>
    </tr>
    </tbody>
</table>