$(function() {

	$('#drawer-close').tap(function() {
		$('#drawer-left').drawer('hide')
	});

	//검색 모달이 열렸을때
	$('#modal-search').on('shown.rc.modal', function () {
		setTimeout(function() {
			$('#search-input').val('').focus();
		}, 300);

		$('#search-input').autocomplete({
      lookup: function (query, done) {

         $.getJSON(rooturl+"/?m=tag&a=searchtag", {q: query}, function(res){
             var sg_tag = [];
             var data_arr = res.taglist.split(',');//console.log(data.usernames);
             $.each(data_arr,function(key,tag){
                 var tagData = tag.split('|');
                 var keyword = tagData[0];
                 var hit = tagData[1];
                 sg_tag.push({"value":keyword,"data":hit});
             });
             var result = {
                 suggestions: sg_tag
             };
              done(result);
         });
     },
        onSelect: function (suggestion) {
					if ($('#search-input').val().length >= 1) {
			      $( "#modal-search-form" ).submit();
			    }
        }
    });
	})

	// 검색버튼과 검색어 초기화 버튼 동적 출력
  $('#search-input').on('keyup', function(event) {
    var modal = $('#modal-search')
    modal.find('[data-role="keyword-reset"]').addClass("hidden"); // 검색어 초기화 버튼 숨김
    modal.find("#drawer-search-footer").addClass('hidden') //검색풋터(검색버튼 포함) 숨김
    if ($(this).val().length >= 2) {
      modal.find('[data-role="keyword-reset"]').removeClass("hidden");
    }
  });

	// 검색어 입력필드 초기화
  $('[data-act="keyword-reset"]').tap(function(){
    var modal = $('#modal-search')
    modal.find("#search-input").val('').autocomplete('clear'); // 입력필드 초기화
    setTimeout(function(){
      modal.find("#search-input").focus(); // 입력필드 포커싱
      modal.find('[data-role="keyword-reset"]').addClass("hidden"); // 검색어 초기화 버튼 숨김
    }, 10);
  });

	// 검색모달이 닫혔을때
  $('#modal-search').on('hidden.rc.modal', function () {
		var modal = $(this)
    $('#search-input').autocomplete('clear');
		$('.autocomplete-suggestions').remove();
    modal.find('[data-role="keyword-reset"]').addClass("hidden"); // 검색어 초기화 버튼 숨김'
  })


	$('#modal-login-form').submit( function(event){
		$(this).find('.js-submit').attr("disabled",true);
		setTimeout(function(){
			var f = document.getElementById("modal-login-form");
			getIframeForAction(f);
			f.submit();
		}, 500);
		event.preventDefault();
		event.stopPropagation();
		}
	);

	// 메뉴 내용보기 모달
	$('#modal-menu-view').on('shown.rc.modal', function (event) {
		var button = $(event.relatedTarget)
		var src = button.data('src')
		var type = button.data('type')
		var uid = button.data('uid')
		var caption = button.data('caption')
		var modal = $(this)
		modal.find('.content .cover').css('background-image','url('+src+')')
		modal.find('[data-role="caption"]').text(caption)
		modal.find('[data-role="article"]').loader({  //  로더 출력
			position:   "inside"
		});
		$.post(rooturl+'/?r='+raccount+'&m=site&a=get_postData',{
			 uid : uid,
			 _mtype : type
		},function(response){
			 modal.find('[data-role="article"]').loader("hide");
			 var result = $.parseJSON(response);
			 var article=result.article;
			 modal.find('[name="uid"]').val(uid);
			 modal.find('[data-role="article"]').html(article);
			 modal.find('.mejs-player').mediaelementplayer(); // http://www.mediaelementjs.com/

			 setTimeout(function(){
				 modal.find('[data-role="article"] img').captionjs({
	         'class_name'      : 'captionjs captionjs-default img-fluid', // Class name for each <figure>
	         'schema'          : true,        // Use schema.org markup (i.e., itemtype, itemprop)
	         'debug_mode'      : false,       // Output debug info to the JS console
	         'force_dimensions': true,        // Force the dimensions in case they cannot be detected (e.g., image is not yet painted to viewport)
	         'is_responsive'   : false,       // Ensure the figure and image change size when in responsive layout. Requires a container to control responsiveness!
	         'inherit_styles'  : false        // Have the caption.js container inherit box-model properties from the original image
	 	    });
			 }, 300);
		});

		$('#modal-menu-view').on('hidden.rc.modal', function () {
		  var modal = $(this)
			modal.find('[data-role="article"]').html('');
		})

	})

  putCookieAlert('site_login_result') // 로그인/로그아웃 알림 메시지 출력

});
