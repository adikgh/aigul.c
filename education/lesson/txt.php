<div class="lsb_i" data-number="<?=$sql['number']?>" data-type="<?=$sql['type']?>">
   <div class="lsb_ic">
      <?php if ($sql['type_name']): ?>
         <div class="lsb_ih"><?=$sql['type_name']?>:</div>
      <?php endif ?>
      <div class="prd_txt <?=($sql['type'] == 'txt_warning'?'prd_txt_warning':'')?>">
         <?php if ($sql['type'] == 'txt_warning'): ?>
            <i class="fal fa-exclamation-circle"></i>
         <?php endif ?>
         <?=$sql['txt']?>
      </div>
   </div>
</div>