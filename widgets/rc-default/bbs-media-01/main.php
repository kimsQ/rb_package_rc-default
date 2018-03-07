<?php
$g['url_widget_skin'] = $g['s'].'/modules/bbs/themes/'.$wdgvar['theme'];
$g['dir_widget_skin'] = $g['path_module'].'/bbs/themes/'.$wdgvar['theme'].'/';
$B = getDbData($table['bbslist'],'id="'.$wdgvar['bid'].'"','uid');
?>
<link href="<?php echo $g['url_widget_skin'] ?>/_main.css" rel="stylesheet">
<script src="<?php echo $g['url_widget_skin'] ?>/_main.js"></script>


<ul class="table-view table-view-full">

  <?php $_RCD=getDbArray($table['bbsdata'],($wdgvar['bid']?'bbs='.$B['uid'].' and ':'').'display=1 and site='.$_HS['uid'],'*','gid','asc',$wdgvar['limit'],1)?>
  <?php while($_R=db_fetch_array($_RCD)):?>
  <?php $_thumbimg=getUploadImage($_R['upload'],$_R['d_regis'],$_R['content'],'jpg|jpeg')?>
  <?php $_thumbimg=$_thumbimg?$_thumbimg:$g['img_core'].'/blank.gif'?>
  <?php $_link=getBbsPostLink($_R)?>

  <li class="table-view-cell media">
    <a role="button" id="item-<?php echo $_R['uid'] ?>"
      href="#modal-bbs-view" data-toggle="modal"
      data-theme="<?php echo $wdgvar['theme'] ?>"
      data-bid="<?php echo $wdgvar['bid'] ?>"
      data-uid="<?php echo $_R['uid'] ?>"
      data-url="<?php echo getBbsPostLink($_R)?>"
      data-cat="<?php echo $_R['category'] ?>"
      data-title="<?php echo $wdgvar['title']?>"
      data-subject="<?php echo $_R['subject'] ?>">
      <img class="media-object pull-left" src="<?php echo getPreviewResize(getUpImageSrc($_R),'262x164') ?>" style="width: 131px">
      <div class="media-body">
         <?php echo $_R['subject']?>
        <p><?php echo $_R['category']?></p>
      </div>
    </a>
  </li>
  <?php endwhile?>

</ul>
