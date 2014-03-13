	/*
	*
	*
	*/
	
var $j = jQuery.noConflict();
$j(function() {
	var myhref,qsbtt;

	// base function
	
	//get IE version
	function ieVersion(){
		var rv = -1; // Return value assumes failure.
		if (navigator.appName == 'Microsoft Internet Explorer'){
			var ua = navigator.userAgent;
			var re  = new RegExp("MSIE ([0-9]{1,}[\.0-9]{0,})");
			if (re.exec(ua) != null)
				rv = parseFloat( RegExp.$1 );
		}
		return rv;
	}

	//read href attr in a tag
	function readHref(){
		var mypath = arguments[0];
		var patt = /\/[^\/]{0,}$/ig;
		if(mypath[mypath.length-1]=="/"){
			mypath = mypath.substring(0,mypath.length-1);
			return (mypath.match(patt)+"/");
		}
		return mypath.match(patt);
	}


	//string trim
	function strTrim(){
		return arguments[0].replace(/^\s+|\s+$/g,"");
	}

	function _qsJnit(){
	

		
		var selectorObj = arguments[0];
			//selector chon tat ca cac li chua san pham tren luoi
		var listprod = $j(selectorObj.itemClass);
		var qsImg;
		var mypath = 'quickshop/index/view';
		if(MP.QuickShop.BASE_URL.indexOf('index.php') == -1){
			mypath = 'index.php/quickshop/index/view';
		}
		var baseUrl = MP.QuickShop.BASE_URL + mypath;
		
		var _qsHref = "<a id=\"em_quickshop_handler\" href=\"#\" style=\"visibility:hidden;position:absolute;top:0;left:0;z-index:1000\"><span class='site_btn quickview_btn'>Quick View</span></a>";
		$j(document.body).append(_qsHref);
		
		var qsHandlerImg = $j('#em_quickshop_handler img');

		$j.each(listprod, function(index, value) { 
			var reloadurl = baseUrl;
			
			//get reload url
			myhref = $j(value).children(selectorObj.aClass );
			var prodHref = readHref(myhref.attr('href'))[0];
			prodHref[0] == "\/" ? prodHref = prodHref.substring(1,prodHref.length) : prodHref;
			prodHref=strTrim(prodHref);
			
			reloadurl = baseUrl+"/path/"+prodHref;	
			version = ieVersion();	
			if(version < 8.0 && version > -1){
				reloadurl = baseUrl+"/path"+prodHref;
			}
			//end reload url

			
			$j(selectorObj.imgClass, this).bind('mouseover', function() {
				var o = $j(this).offset();
				$j('#em_quickshop_handler').attr('href',reloadurl).show()
					.css({
						'top': o.top+($j(this).height() + 110 - qsHandlerImg.height())/2+'px',
						'left': o.left+($j(this).width() - 85 - qsHandlerImg.width())/2+'px',
						'visibility': 'visible'
					});
			});
			$j(value).bind('mouseout', function() {
				$j('#em_quickshop_handler').hide();
			});
		});

		//fix bug image disapper when hover
		$j('#em_quickshop_handler')
			.bind('mouseover', function() {
				$j(this).show();
				//$j(".div_name span").hide();
			})
			.bind('click', function() {
				$j(this).hide();
				//$j(".div_name span").show();				
			});
		//insert quickshop popup
		
		$j('#em_quickshop_handler').fancybox({
				'width'				: MP.QuickShop.QS_FRM_WIDTH,
				'height'			: MP.QuickShop.QS_FRM_HEIGHT,
				'autoScale'			: false,
				'padding'			: 0,
				'margin'			: 0,
				//'transitionIn'		: 'none',
				//'transitionOut'		: 'none',
				'type'				: 'iframe',
				onComplete: function() { 
					$j.fancybox.showActivity();
					$j('#fancybox-frame').unbind('load');
					$j('#fancybox-frame').bind('load', function() {
						$j.fancybox.hideActivity();
					});
				}
		});		
	}

	//end base function

	_qsJnit({
		itemClass : '.productImgDivWrap p.showImg', //selector for each items in catalog product list,use to insert quickshop image
		aClass : 'a.vMiddle', //selector for each a tag in product items,give us href for one product
		imgClass: '.vMiddle' //class for quickshop href
	});
});


