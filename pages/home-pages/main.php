<?php getImport('swiper','css/swiper','4.1.0','css')?>
<style media="screen">

#slider .mask {
  position: relative;
  display: block;
}
#slider .mask:before {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background-image: -moz-linear-gradient(top,rgba(0,0,0,.05),rgba(0,0,0,.6));
  background-image: -o-linear-gradient(top,rgba(0,0,0,.05),rgba(0,0,0,.6));
  background-image: linear-gradient(to bottom,rgba(0,0,0,.05),rgba(0,0,0,.6));
  content: '';
}
#slider .caption {
  position: absolute;
  width: 80%;
  bottom: 0;
  padding-left: 1rem;
  color: #fff
}
#slider .caption h1 {
  margin-bottom: .7rem;
  font-size: 1.3rem
}
#slider .caption p {
  margin-bottom: 0.3rem;
  font-size: .7rem;
  letter-spacing: -0.0625rem;
  color: #ddd

}
.swiper-pagination-fraction{
  color: #fff;
  font-size: 0.75rem;
  text-align: right;
  padding-right: 1rem
}

/*Auto Slides Per View*/
.swiper-container.auto .swiper-slide {
  width: 80%;
  height: auto;
}
</style>

<div class="container">
  <div class="row">

    <div class="col-sm-6">
      <?php
      include_once $g['path_module'].'mediaset/function.php';
      $d['layout']['_slide'] = getArrayString($d['layout']['front_slide']);
      ?>
      <?php if($d['layout']['_slide']['count']):?>
      <div class="swiper-container animated fadeInDown mt-sm-2" id="slider">
        <div class="swiper-wrapper">
          <?php $_i=0;foreach($d['layout']['_slide']['data'] as $_tmp['uid']):?>
          <?php $_tmp['m']=getUidData($table['s_upload'],$_tmp['uid'])?>
          <div class="swiper-slide" role="button">
            <a class="mask" href="<?php echo $_tmp['m']['linkurl']?>"<?php if($_tmp['m']['linkto']=='3'):?> target="_blank"<?php endif?>>
              <img src="<?php echo getMediaLink($_tmp['m'],1,'830x400')?>" class="img-fluid" alt="<?php echo $_tmp['m']['alt']?>">
              <span class="caption">
                <p><?php echo $_tmp['m']['description']?></p>
                <h1><?php echo $_tmp['m']['caption']?></h1>
              </span>
            </a>
          </div>
          <?php $_i++;endforeach?>
        </div>
        <!-- If we need pagination -->
        <div class="swiper-pagination"></div>
      </div>
      <?php endif?>

      <nav class="nav nav-table my-2 bg-white animated fadeInUp delay-1">
        <?php getWidget('rc-default/nav-table',array('startmenu'=>'quick','row'=>'4'))?>
      </nav>

      <div class="animated fadeInUp delay-1">
        <?php getWidget('rc-default/bbs-list-01',array('bid'=>'notice','theme'=>'_mobile/rc-default','limit'=>'3','title'=>'올림픽 소식','link'=> RW('c=cscenter/notice')))?>
      </div>

      <!-- 광고 -->
      <div class="animated fadeInUp delay-2">
        <?php getWidget('rc-default/banner-01',array('background'=>'#efefef','limit'=>'1'))?>
      </div>

      <?php getWidget('rc-default/bbs-gallery-01',array('bid'=>'pr','theme'=>'_mobile/rc-default','limit'=>'2','title'=>'언론보도','link'=>RW('c=info/pr'),))?>

    </div><!-- /.col-sm-6 -->
    <div class="col-sm-6">

      <section class="mt-2 animated fadeInDown">
        <?php getWidget('rc-default/menu-gallery-swiper01',array('title'=>'주요 제품','startmenu'=>'product'))?>
      </section>

      <section class="mt-2 bg-white animated fadeInUp delay-1">
        <?php getWidget('rc-default/bbs-media-01',array('bid'=>'bank','theme'=>'_mobile/rc-default','limit'=>'3','title'=>'자료실','link'=>RW('c=cscenter/bank')))?>
      </section>

    </div><!-- /.col-sm-6 -->

  </div><!-- /.row -->
</div><!-- /.container -->

<?php getImport('swiper','js/swiper.min','4.1.0','js')?>

<script type="text/javascript">
$(function () {

  // 메인 슬라이더
  var swiper = new Swiper('#slider', {
      centeredSlides: true,
      autoplay: {
        delay: 2500,
        disableOnInteraction: false,
      },
      pagination: {
        el: '.swiper-pagination',
        type: 'fraction',
      }
    });

    // 주요제품
    var swiper = new Swiper('#product', {
      slidesPerView: 'auto',
      spaceBetween: 5
    });

})
</script>
