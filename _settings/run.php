<?php

//메인페이지 레이아웃 지정
getDbUpdate($table['s_page'],"layout='rc-default/full.php',m_layout='rc-default/full.php",'ismain=1 and site='.$S['uid']);

include_once $g['path_core'].'function/rss.func.php';

function getRssAddslashes($s,$f)
{
	return addslashes(getRssContent($s,$f));
}

// 미디어셋 자료등록
$RSS = array();
$xmlpath2 = $g['path_tmp'].'app/'.$package_folder.'/_data/xml/mediaset.xml';
$RSS['data2'] = implode('',file($xmlpath2));

if (!$RSS['data2'])
{
  getLink('','parent.','입력하신 XML파일경로를 접근할 수 없습니다.','');
}

if (getRssAddslashes($RSS['data2'],'title') != 'KIMSQ_RB_MEDIASET')
{
  getLink('','','킴스큐Rb용 미디어셋 자료등록 XML데이터 파일이 아닙니다.','');
}

$mCount2 = 0;
$RSS['array2']= explode('<item>',$RSS['data2']);
$RSS['count2']= count($RSS['array2']);
$site		= $S['uid'];
$folder   = substr($date['today'],0,4).'/'.substr($date['today'],4,2).'/'.substr($date['today'],6,2);
$d_regis	= $date['totime'];
$up2_fserver = 0;
$up2_url = '/files/';
$mbruid = $my['uid'];
for($i = 1; $i < $RSS['count2']; $i++)
{
	$up2_uid	= getRssAddslashes($RSS['array2'][$i],'uid');
	$up2_category	= getRssAddslashes($RSS['array2'][$i],'category');
	$up2_name	= getRssAddslashes($RSS['array2'][$i],'name');
	$up2_tmpname	= $up2_name;
	$up2_size	= getRssAddslashes($RSS['array2'][$i],'size');
	$up2_width	= getRssAddslashes($RSS['array2'][$i],'width');
	$up2_height	= getRssAddslashes($RSS['array2'][$i],'height');
	$up2_caption	= getRssAddslashes($RSS['array2'][$i],'caption');
	$up2_description	= getRssAddslashes($RSS['array2'][$i],'description');
  $up2_linkurl	= getRssAddslashes($RSS['array2'][$i],'linkurl');
	$up2_date	= $date['totime'];
	$up2_folder	= $folder;
	$up2_fileExt	= strtolower(getExt($up2_name));
	$up2_fileExt	= $up2_fileExt == 'jpeg' ? 'jpg' : $up2_fileExt;
	$up2_type	= getRssAddslashes($RSS['array2'][$i],'type');
	$up2_mingid	= getDbCnt($table['s_upload'],'min(gid)','');
	$up2_gid = $up2_mingid ? $up2_mingid - 1 : 100000000;

	$QKEY = "uid,gid,category,hidden,tmpcode,site,mbruid,type,ext,fserver,url,folder,name,tmpname,size,width,height,caption,description,d_regis,d_update,linkurl,time";
	$QVAL = "'$up2_uid','$up2_gid','$up2_category','0','','$site','$mbruid','$up2_type','$up2_fileExt','$up2_fserver','$up2_url','$up2_folder','$up2_name','$up2_tmpname','$up2_size','$up2_width','$up2_height','$up2_caption','$up2_description','$d_regis','','$up2_linkurl','$up2_time'";
	getDbInsert($table['s_upload'],$QKEY,$QVAL);
  $up2_gid--;
}

//게시물 등록

$RSS = array();

$xmlpath = $g['path_tmp'].'app/'.$package_folder.'/_data/xml/bbs.xml';

$RSS['data'] = implode('',file($xmlpath));
if (!$RSS['data'])
{
  getLink('','parent.','입력하신 XML파일경로를 접근할 수 없습니다.','');
}

if (getRssAddslashes($RSS['data'],'title') != 'KIMSQ_RB_BBS')
{
  getLink('','','킴스큐Rb용 마이그레이션 XML데이터 파일이 아닙니다.','');
}

$RSS['array']= explode('<item>',$RSS['data']);
$RSS['count']= count($RSS['array']);

$str_today	= '';
$str_month	= '';
$bbsmodule	= 'bbs';
$site		= $S['uid'];
$mingid		= getDbCnt($table['bbsdata'],'min(gid)','');
$gid		= $mingid ? $mingid-1 : 100000000.00;

for($i = 1; $i < $RSS['count']; $i++)
{
  $bbsid		= getRssAddslashes($RSS['array'][$i],'bid');
	$B = getDbData($table['bbslist'],'id="'.$bbsid.'"','uid');
  $bbsuid		= $B['uid'];
  $depth		= 0;
  $parentmbr	= 0;
  $display	= 1;
  $hidden		= 0;
  $notice		= 0;
  $name		= $my['name'];
  $nic		= $my['nic'];
  $mbrid		= $my['id'];
  $mbruid		= $my['uid'];
  $category	= getRssAddslashes($RSS['array'][$i],'category');
  $subject	= getRssAddslashes($RSS['array'][$i],'subject');
  $content	= getRssAddslashes($RSS['array'][$i],'content');
  $html		= getRssAddslashes($RSS['array'][$i],'html');
  $tag		= getRssAddslashes($RSS['array'][$i],'tag');
	$upload = getRssAddslashes($RSS['array'][$i],'upload');
  $hit		= 1;
  $d_regis	= $date['totime'];
  $d_modify	= '';
  $today		= substr($d_regis,0,8);
  $month		= substr($today,0,6);

	$xupload = '';
	$up_cync = '';

  if ($upload)
  {
    $up_fserver = 0;
    $up_url = '/files/bbs/';
    $up_caption	= $subject;
    $upfiles = explode('|',$upload);
    $folder   = substr($date['today'],0,4).'/'.substr($date['today'],4,2).'/'.substr($date['today'],6,2);
    foreach($upfiles as $val)
    {
      if (!$val) continue;
      $valexp		= explode(',',$val);
      $up_name	= $valexp[0];
      $up_tmpname	= $up_name;
      $up_size	= $valexp[1];
      $up_width	= $valexp[2];
      $up_height	= $valexp[3];
      $up_down	= 1;
      $up_date	= $date['totime'];
      $up_folder	= $folder;
      $up_fileExt	= strtolower(getExt($up_name));
      $up_fileExt	= $up_fileExt == 'jpeg' ? 'jpg' : $up_fileExt;
      $up_type	= getFileType($up_fileExt);
      $up_mingid	= getDbCnt($table['s_upload'],'min(gid)','');
      $up_gid = $up_mingid ? $up_mingid - 1 : 100000000;
      $QKEY = "gid,hidden,tmpcode,site,mbruid,type,ext,fserver,url,folder,name,tmpname,thumbname,size,width,height,caption,down,d_regis,d_update,sync";
      $QVAL = "'$up_gid','0','','$site','$mbruid','$up_type','$up_fileExt','$up_fserver','$up_url','$up_folder','$up_name','$up_tmpname','$up_thumbname','$up_size','$up_width','$up_height','$up_caption','$up_down','$d_regis','','$up_sync'";
      getDbInsert($table['s_upload'],$QKEY,$QVAL);
      $up_lastuid = getDbCnt($table['s_upload'],'max(uid)','');
      $xupload .= '['.$up_lastuid.']';
      if ($up_gid == 100000000) db_query("OPTIMIZE TABLE ".$table['s_upload'],$DB_CONNECT);
    }
  }

	if ($tag)
  {
    $uptags = explode(',',$tag);
    foreach($uptags as $val)
    {
      $keyword	= $val;
      $QKEY = "site,date,keyword,hit";
      $QVAL = "'$site','$today','$keyword','1'";
      getDbInsert($table['s_tag'],$QKEY,$QVAL);
      db_query("OPTIMIZE TABLE ".$table['s_tag'],$DB_CONNECT);
    }
  }

  $QKEY = "site,gid,bbs,bbsid,depth,parentmbr,display,hidden,notice,name,nic,mbruid,id,pw,category,subject,content,html,tag,";
  $QKEY.= "hit,down,comment,oneline,trackback,score1,score2,singo,point1,point2,point3,point4,d_regis,d_modify,d_comment,d_trackback,upload,ip,agent,sns,likes,featured_img,location,pin,adddata";
  $QVAL = "'$site','$gid','$bbsuid','$bbsid','$depth','$parentmbr','$display','$hidden','$notice','$name','$nic','$mbruid','$mbrid','$pw','$category','$subject','$content','$html','$tag',";
  $QVAL.= "'$hit','$down','$comment','$oneline','$trackback','$score1','$score2','$singo','0','0','0','0','$d_regis','$d_modify','$d_comment','$d_trackback','$xupload','$ip','$agent','','$likes','$up_lastuid','$location','$pin','$adddata'";
  getDbInsert($table[$bbsmodule.'data'],$QKEY,$QVAL);
  $LASTUID = getDbCnt($table[$bbsmodule.'data'],'max(uid)','');
  getDbInsert($table[$bbsmodule.'idx'],'site,notice,bbs,gid',"'$site','$notice','$bbsuid','$gid'");
  getDbUpdate($table[$bbsmodule.'list'],"num_r=num_r+1,d_last='".$d_regis."'",'uid='.$bbsuid);

	if(!getDbRows($table[$bbsmodule.'month'],"date='".$month."' and site=".$site.' and bbs='.$bbsuid))
  {
    getDbInsert($table[$bbsmodule.'month'],'date,site,bbs,num',"'".$month."','".$site."','".$bbsuid."','1'");
  }
  else {
    getDbUpdate($table[$bbsmodule.'month'],'num=num+1',"date='".$month."' and site=".$site.' and bbs='.$bbsuid);
  }
  if(!getDbRows($table[$bbsmodule.'day'],"date='".$today."' and site=".$site.' and bbs='.$bbsuid))
  {
    getDbInsert($table[$bbsmodule.'day'],'date,site,bbs,num',"'".$today."','".$site."','".$bbsuid."','1'");
  }
  else {
    getDbUpdate($table[$bbsmodule.'day'],'num=num+1',"date='".$today."' and site=".$site.' and bbs='.$bbsuid);
  }

  if ($gid == 100000000.00)
  {
    db_query("OPTIMIZE TABLE ".$table[$bbsmodule.'idx'],$DB_CONNECT);
    db_query("OPTIMIZE TABLE ".$table[$bbsmodule.'data'],$DB_CONNECT);
    db_query("OPTIMIZE TABLE ".$table[$bbsmodule.'month'],$DB_CONNECT);
    db_query("OPTIMIZE TABLE ".$table[$bbsmodule.'day'],$DB_CONNECT);
  }
  $gid--;
}



// 미디어셋 업로드용 오늘 폴더 생성
$package_path = $g['path_tmp'].'/app/'.$package_folder;
$dataFolder = $package_path.'/_data/mediaset' ;
$filesFolder = $package_path.'/files' ;
$todayFolder   = substr($date['today'],0,4).'/'.substr($date['today'],4,2).'/'.substr($date['today'],6,2);

$savePath1  = $filesFolder.'/'.substr($date['today'],0,4);
$savePath2  = $savePath1.'/'.substr($date['today'],4,2);
$savePath3  = $savePath2.'/'.substr($date['today'],6,2);

$saveFolder = $filesFolder.'/'.$todayFolder;

if(!is_dir($saveFolder)){

  for ($i = 1; $i < 4; $i++)
  {
      if (!is_dir(${'savePath'.$i}))
     {
       mkdir(${'savePath'.$i},0707);
       @chmod(${'savePath'.$i},0707);
     }
  }
}

// 미디어셋 파일이동
@rename($dataFolder,$saveFolder);


//게시판 업로드 폴더 생성
$dataFolder = $package_path.'/_data/bbs' ;
$saveDir_bbs = $filesFolder.'/bbs';

// 업로드 디렉토리 없는 경우 추가
if(!is_dir($saveDir_bbs)){
  mkdir($saveDir_bbs,0707);
  @chmod($saveDir_bbs,0707);
}
$savePath1_bbs  = $saveDir_bbs.'/'.substr($date['today'],0,4);
$savePath2_bbs  = $savePath1_bbs.'/'.substr($date['today'],4,2);
$savePath3_bbs  = $savePath2_bbs.'/'.substr($date['today'],6,2);
$saveFolder_bbs = $saveDir_bbs.'/'.$todayFolder ;

if(!is_dir($saveFolder_bbs)){
  for ($i = 1; $i < 4; $i++)
  {
     if (!is_dir(${'savePath'.$i.'_bbs'}))
     {
       mkdir(${'savePath'.$i.'_bbs'},0707);
       @chmod(${'savePath'.$i.'_bbs'},0707);
     }
  }
}

// 게시판 첨부 파일이동
@rename($dataFolder,$saveFolder_bbs);

DirDelete($g['path_tmp'].'app/'.$package_folder.'/_data');

?>
