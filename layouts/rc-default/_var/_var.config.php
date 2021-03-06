<?php
if(!defined('__KIMS__')) exit;

//***********************************************************************************
// 여기에 이 레이아웃에서 사용할 변수들을 정의합니다.
// 변수 작성법은 매뉴얼을 참고하세요.
//***********************************************************************************

$d['layout']['show'] = true; // 관리패널에 레이아웃 관리탭을 보여주기
$d['layout']['date'] = false;  // 데이트픽커 사용

//***********************************************************************************
// 설정배열
//***********************************************************************************

$d['layout']['dom'] = array(

	/* 헤더 */
	'header' => array(
		'헤더',
		'',
		array(
			array('title','input','사이트 제목',''),
		),
	),

	/* 프론트 */
	'front' => array(
		'메인 페이지',
		'프론트(메인화면)에 출력할 콘텐츠를 설정합니다. 미디어셋을 이용해서 프론트를 꾸며주세요.',
		array(
			array('slide','mediaset','메인 슬라이더',''),
			array('quick','input','퀵메뉴',''),
			array('banner01','mediaset','배너광고1',''),
			array('product','textarea','주요 제품','2'),
		),
	),

	/* 도움말 */
	'help' => array(
		'도움말',
		'이 레이아웃은 Rb2 에서 제공하는 모바일 심플 레이아웃입니다.',
		array(

		),
	),
);

//***********************************************************************************
?>
