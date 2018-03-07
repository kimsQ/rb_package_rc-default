<?php
include_once $g['path_module'].'mediaset/function.php';
$d['layout']['_banner01'] = getArrayString($d['layout']['front_banner01']);
?>
<div style="background: <?php echo $wdgvar['background']?>;">
  <?php $_i=0;foreach($d['layout']['_banner01']['data'] as $_tmp['uid']):?>
  <?php $_tmp['m']=getUidData($table['s_upload'],$_tmp['uid'])?>
  <a href="<?php echo $_tmp['m']['linkurl']?>" <?php if($_tmp['m']['linkto']=='3'):?> target="_blank"<?php endif?>>
    <img class="img-fluid" src="<?php echo getMediaLink($_tmp['m'],1,'640x200')?>" alt="">
  </a>
  <?php $_i++;endforeach?>
</div>
