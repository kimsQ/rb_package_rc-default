<?php
$d['package']['name'] = 'RC 기본형 for KimsQ Rb 2.2.0'; //패키지명
$d['package']['siteid'] = 'home'; //이 패키지를 압축한 사이트아이디
$d['package']['layout'] = 'rc-default/default.php'; //이 패키지를 압축한 사이트의 레이아웃
$d['package']['layout_mobile'] = 'rc-default/default.php'; //이 패키지를 압축한 사이트의 레이아웃(모바일 전용 - 미사용시 공백)
$d['package']['rewrite'] = '1'; //이 패키지를 압축한 사이트의 고유주소(Permalink)설정 (미사용시 공백)

/*****************************************************************************
실행옵션 :: $d['package']['execute'][] = array('실행파일','내용','체크박스초기값');
*****************************************************************************/

$d['package']['execute'][] = array('DM','기존의 메뉴를 모두 삭제합니다.','checked');
$d['package']['execute'][] = array('CM','이 패키지에 필요한 메뉴를 생성합니다.','checked');
$d['package']['execute'][] = array('DP','기존의 페이지를 모두 삭제합니다.','checked');
$d['package']['execute'][] = array('CP','이 패키지에 필요한 페이지를 생성합니다.','checked');
$d['package']['execute'][] = array('CBBS','이 패키지에 필요한 게시판을 생성합니다.','checked');
$d['package']['execute'][] = array('CBBS','이 패키지에 필요한 샘플 데이터를 추가합니다.','checked');
?>
