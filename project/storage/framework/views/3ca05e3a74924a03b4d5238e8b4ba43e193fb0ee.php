
<li class="list-group-item d-flex justify-content-between font-weight-bold"><?php echo translate('Created at :'); ?><span><?php echo e($offer->created_at->format('d M Y')); ?></span></li>
<li class="list-group-item d-flex justify-content-between font-weight-bold"><?php echo translate('Rate :'); ?><span class="text-primary"><?php echo e(amount($offer->crypto->rate).' '.$offer->fiat->code.'/'.$offer->crypto->code); ?></span></li>

<li class="list-group-item d-flex justify-content-between font-weight-bold"><?php echo translate('Minimum Limit :'); ?><span class="font-weight-bold"><?php echo e(amount($offer->minimum)); ?> <?php echo e($offer->fiat->code); ?></span></li>

<li class="list-group-item d-flex justify-content-between font-weight-bold"><?php echo translate('Maximum Limit :'); ?><span class="font-weight-bold"><?php echo e(amount($offer->maximum)); ?> <?php echo e($offer->fiat->code); ?></span></li>

<li class="list-group-item">
    <div class="form-group">
        <h6 class=""><?php echo translate('Offer Terms'); ?></h6>
        <textarea class="form-control" disabled rows="5"><?php echo translate($offer->offer_terms); ?></textarea>
    </div>
</li>
<li class="list-group-item">
    <div class="form-group">
        <h6 class=""><?php echo translate('Trade Instructions'); ?></h6>
        <textarea class="form-control" disabled rows="5"><?php echo translate($offer->trade_instructions); ?></textarea>
    </div>
</li>
<?php /**PATH /home/xnettrading/public_html/project/resources/views/admin/offer/offer_details.blade.php ENDPATH**/ ?>