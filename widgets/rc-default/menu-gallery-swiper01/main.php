<?php
include_once $g['path_module'].'mediaset/function.php';
$d['layout']['_product'] = getArrayString($d['layout']['front_product']);
?>
<?php if($d['layout']['_product']['count']):?>
<div class="widget widget-2">
  <header>
    <h3><?php echo $wdgvar['title']?></h3>

    <?php if ($wdgvar['link']): ?>
    <a href="<?php echo $wdgvar['link']?>">
      더보기
      <i class="fa fa-angle-right" aria-hidden="true"></i>
    </a>
    <?php endif; ?>
  </header>
  <div class="swiper-container auto pl-2" id="product">
    <div class="swiper-wrapper">

      <div class="swiper-slide">
        <div class="card-deck">

          <?php $_i=0;foreach($d['layout']['_product']['data'] as $_val):$_i++?>
          <?php $_M=getDbData($table['s_menu'],'id="'.$_val.'"','*'); ?>
          <?php $_U=getUidData($table['s_upload'],$_M['featured_img'])?>
          <div class="card" role="button"
            data-toggle="modal" data-target="#modal-menu-view"
            data-uid="<?php echo $_M['uid'] ?>"
            data-type="menu"
            data-url="<?php echo RW('c='.$wdgvar['startmenu'].'/'.$_val)?>"
            data-src="<?php echo $_M['featured_img']?getMediaLink($_U,2,'600x300'):''?>"
            data-title="<?php echo $_M['name'] ?>"
            data-caption="<?php echo $_U['caption'] ?>">
            <img class="card-img-top img-fluid" src="<?php echo $_M['featured_img']?getMediaLink($_U,2,'288x162'):$g['img_core'].'/svg/smile.svg'?>" alt="">
            <div class="card-block">
              <p class="card-text"><span class="text-primary"><?php echo $_M['name'] ?></span> <?php echo $_U['caption'] ?></p>
            </div>
          </div>
          <?php if(!($_i%2)):?></div></div><div class="swiper-slide" role="button"><div class="card-deck"><?php endif?>
          <?php endforeach?>

        </div>
      </div>

    </div>
  </div>
</div>

<?php endif?>
