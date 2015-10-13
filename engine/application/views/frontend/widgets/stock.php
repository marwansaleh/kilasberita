<div class="widget">
    <div class="inner">
        <?php if ($rates): ?>
        <div role="tabpanel" class="tabbable"> <!-- Only required for left/right tabs -->
            <ul class="nav nav-tabs" id="tab-stocks">
                <?php foreach ($rates as $index=>$rate): ?>
                <li role="presentation" <?php echo $index==0?'class="first-child active"':''; ?>>
                    <a aria-controls="tab_<?php echo $rate->bank; ?>" role="tab" data-toggle="tab" href="#tab_<?php echo $rate->bank; ?>">
                        <div class="inner-tab"><?php echo strtoupper($rate->bank); ?></div>
                    </a>
                </li>
                <?php endforeach; ?>
            </ul>
            <div class="tab-content">
                <?php foreach ($rates as $index=>$rate): ?>
                <div role="tabpanel" id="#tab_<?php echo $rate->bank; ?>" class="tab-pane<?php echo $index==0?' active':''; ?>">
                    <div class="nicescroll" style="height:280px;overflow:hidden;">
                        <table role="table" class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Kurs <?php echo $rate->bank; ?></th>
                                    <th class="text-right">Jual</th>
                                    <th class="text-right">Beli</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($rate->rates as $cur): ?>
                                <tr>
                                    <td><?php echo strtoupper($cur->name); ?></td>
                                    <td class="text-right"><?php echo number_format($cur->sell,2,',','.'); ?></td>
                                    <td class="text-right"><?php echo number_format($cur->buy,2,',','.'); ?></td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
        <?php endif;?>
    </div>
</div>