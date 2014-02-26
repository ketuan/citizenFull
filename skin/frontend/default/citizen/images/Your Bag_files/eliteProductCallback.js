function cbImageMainChange() {
    /*params: this.large_prefix, this.main_prefix, this.img_path, this.promo_path*/
    if (this.large_prefix && this.main_prefix && this.img_path) {
        var _zoom = $('a#zoomArea');
        var _parent = _zoom.parent();
        var _img = $('img#mainImage');
        var _html = '';
        var _zoomA = document.createElement('A');
		var _zoomIMG = document.createElement('IMG');
		if (_zoom.length >= 0) {
            _zoomA.href = this.large_prefix + this.img_path;
			_zoomA.className = _zoom[0].className;
			_zoomA.title = _zoom[0].title;
			_zoomA.id = _zoom[0].id;
			_zoomA.rel = _zoom[0].rel;
			if (_img.length >= 0) {
				_zoomIMG.src = this.main_prefix + this.img_path;
				_zoomIMG.width = _img[0].width;
				_zoomIMG.height = _img[0].height;
				_zoomIMG.id = _img[0].id;
				_zoomIMG.alt = _img[0].alt;
				_zoomA.appendChild(_zoomIMG);
			}
			/*
			_html += '<a';
            for (var attr = 0; attr < _zoom[0].attributes.length; attr++) if (_zoom[0].attributes[attr].nodeName != 'href') _html += ' ' + _zoom[0].attributes[attr].nodeName + '="' + _zoom[0].attributes[attr].value + '"';
            _html += ' href="' + this.large_prefix + this.img_path + '">';

            if (_img.length >= 0) {
                _html += '<img';
                for (var attr = 0; attr < _img[0].attributes.length; attr++) if (_img[0].attributes[attr].nodeName != 'src') _html += ' ' + _img[0].attributes[attr].nodeName + '="' + _img[0].attributes[attr].value + '"';
                _html += ' src="' + this.main_prefix + this.img_path + '"/>';
            }
            _html += '</a>';
			*/
        }
        $("#zoomArea").remove();
		_parent.append(_zoomA);
		//_parent.append(_html);
		
        if (this.promo_path && this.promo_path.replace(/ /g, '') != '') $("#mainPromo > img").attr("src", this.promo_path).attr("style", "display:block !important");
        else $("#mainPromo > img").attr("style", "display:none !important")

        $('#zoomArea').jqzoom({ zoomType: 'standard', lens: true, preloadImages: false, alwaysOn: false });
        $('#zoomArea').lightBox({ fixedNavigation: false });
    }
}

function cbThumbsInit() {
	$("#alternativeImages").SlidingShow({controllers: $("#alternativeImagesControllers")});
}

function cbVariantChange(){
	if (this.variant) {
		if (this.variant.pf_id && this.variant.pf_id.replace(/ /g,'')!='')document.getElementById('prod_pfId').innerHTML = this.variant.pf_id;
		/*294949 » start*/
		if (this.variant.description && this.variant.description.replace(/ /g,'')!='')document.getElementById('prod_descr').innerHTML = this.variant.description;
		/*294949 » end*/
	}
}

function cbVariantLoad(){
	if (this.variants && this.options) {
		var _cc = false;
		for (var v in this.variants){
			var _variant = 	this.variants[v];
			if (_variant["option3"].replace(/ /g,'')=='' && _variant["option2"].indexOf('X')>0 && _variant["option2"].indexOf('/')<0){
				var _options = _variant["option2"].split('X');
				if (_options.length=2){
					if (this.orders && this.orders["option2"]){
						for (var o=0;o<this.orders["option2"].length;o++){
							var _order = this.orders["option2"][o];
							if (_order == _variant["option2"]){
								this.orders["option2"][o] = _options[0];
								break;
							}
						}
						if (!this.orders["option3"])this.orders["option3"]=new Array();
						var _ord = true
						for (var o=0;o<this.orders["option3"].length;o++){
							if (this.orders["option3"][o].toString()==_options[1].toString()){
								_ord=false;
								break;
							}
						}
						if (_ord) this.orders["option3"][this.orders["option3"].length] = _options[1];
						this.orders["option3"].sort(function(a,b){return a - b;});
					}
					_variant["option2"] = _options[0];
					_variant["option3"] = _options[1];
					_cc = true;
				}
			}
		}
		if (_cc && this.options["option2"] && !this.options["option3"]){
			var _dom = document.createElement('INPUT');
			if (_dom.hasAttribute){
				_dom.setAttribute('ref','list');
				_dom.setAttribute('type','hidden');
				_dom.setAttribute('name','sku_option3');
				_dom.setAttribute('id','sku_option3');
			} else {
				_dom.ref = 'list';
				_dom.type = 'hidden';
				_dom.name = 'sku_option3';
				_dom.id = 'sku_option3';
			}
			var _tit = document.createElement('LI');
			_tit.className = 'cont-label fw-bold fs-medium row';
			_tit.innerHTML = 'Select Length:';
			var _parent = this.options["option2"].dom.parentNode;
			_parent.parentNode.insertBefore(_tit,_parent.nextSibling);
			var _cont = document.createElement('LI');
			_cont.className = 'cont-sizeblock row';
			_parent.parentNode.insertBefore(_cont,_tit.nextSibling);
			_cont.appendChild(_dom);
			//this.options["option2"].dinamic = true;
			this.options["option2"].main = true;
			this.options["option3"] = {
				dinamic:false
				, dom : _dom
			};
		}
	}
}

function ValidateGiftProduct(sfrm) {
    oform = document.forms[sfrm];
    //#305286 START
    if (!emailValid(oform.txtgiftemail.value) || oform.txtgiftmsg.value=='') {
    //#305286 END
        alert(gift_val_msg);
        oform.txtgiftemail.focus();
        return (false);
    }
    return (true);
}

function AddToBasketGift(sfrm) {
    if (this.ValidateGiftProduct(sfrm))
        document.forms[sfrm].submit();
}

function emailValid(email) {
    var reg = /^[a-zA-Z0-9][a-zA-Z0-9-_\.]*@[a-zA-Z0-9-_]*\.[a-zA-Z0-9-_]*[a-zA-Z0-9-_\.]*[a-zA-Z0-9-_]$/;
    var result = 1;
    if (reg.test(email) == false) { result = 0 }
    return result;
}

function limittext(field, maxlimit) {
    if (field.value.length > maxlimit)
        field.value = field.value.substring(0, maxlimit);
}

function checkSubmit(e) { if (e && e.keyCode == 13) { SubmitFormWithCaptcha(); } }
//#305286 START
function checkSubmitGiftCard(e) { if (e && e.keyCode == 13) { return ValidateGiftProduct('selectFrm'); } }
//#305286 END

//REM -- Enhanced Review Module (#294947) - 01/06/2012 11:02 ------START
function ReplaceSpecialCharacter(fieldname) {

    var sfname;
    sfname = fieldname;

    for (var i = 0; i < fieldname.length; i++) {

        if (fieldname[i] == ';' || fieldname[i] == '<' || fieldname[i] == '>' || fieldname[i] == '--') {
            sfname = sfname.replace(';', '');
            sfname = sfname.replace('<', '');
            sfname = sfname.replace('>', '');
            sfname = sfname.replace('--', '');
        }
    }
    return sfname;
}
function SubmitFormWithCaptcha() {

    submitForm = 1;
    var frm = document.forms['customercommentsform'];

    //if (frm.elements['comment_title'].value != '') {
    //		document.getElementById('commentTitleError').style.display = 'none';
    //	} else {
    //		submitForm = 0;
    //		document.getElementById('commentTitleError').style.display = 'block';
    //}


    frm.elements['comment_title'].value = ReplaceSpecialCharacter(frm.elements['comment_title'].value);
    frm.elements['actual_comment'].value = ReplaceSpecialCharacter(frm.elements['actual_comment'].value);
    frm.elements['customer_name'].value = ReplaceSpecialCharacter(frm.elements['customer_name'].value);


    if (frm.elements['actual_comment'].value != '') {
        document.getElementById('actualCommentError').style.display = 'none';
    } else {
        submitForm = 0;
        document.getElementById('actualCommentError').style.display = 'block';
    }
    if (frm.elements['star'].value == '') {
        submitForm = 0;
        document.getElementById('error_rating').style.display = 'block';
    } else {
        document.getElementById('error_rating').style.display = 'none';
    }
    if (frm.elements['customer_email'].value != '') {
        //frm.elements['emailError'].style.display = 'none';
        var re = new RegExp("^[a-zA-Z0-9][a-zA-Z0-9-_\.']*@[a-zA-Z0-9-_']*\.[a-zA-Z0-9-_']*[a-zA-Z0-9-_\.']*[a-zA-Z0-9-_']$");
        if (!frm.elements['customer_email'].value.match(re)) {
            submitForm = 0;
            document.getElementById('InvalidEmailError').style.display = 'block';
            document.getElementById('emailError').style.display = 'none';
        } else {
            document.getElementById('InvalidEmailError').style.display = 'none';
            document.getElementById('emailError').style.display = 'none';
        }
    } else {
        submitForm = 0;
        document.getElementById('emailError').style.display = 'block';
        document.getElementById('InvalidEmailError').style.display = 'none';
    }
    if (frm.elements['captcha_code'].value == '') {
        submitForm = 0;
        document.getElementById('captchaInvalid').style.display = 'none';
        document.getElementById('captchaError').style.display = 'block';
    } else {
        document.getElementById('captchaError').style.display = 'none';
    }

   // alert(submitForm);

    if (submitForm == 1) {
        ajaxGET('/ajx_captcha_field.asp?requestid=' + document.getElementById('requestid').value + '&captcha=' + document.getElementById('captcha_code').value, 'captchavalidation', false);
    }
}

function submitServiceReview() {
    var frm = document.forms['customercommentsform'];
    frm.submit = function() {
        return false;
    }
    SubmitFormWithCaptcha();
    var checkCaptcha = setInterval(function() {
        var _cdom = document.getElementById('captchavalidation');
        if (_cdom.innerHTML.replace(/"/g, '').indexOf('value=1') >= 0) {
            clearInterval(checkCaptcha);
            var _params = '';
            for (var i = 0; i < frm.elements.length; i++) {
                switch (frm.elements[i].tagName) {
                    case 'SELECT':
                        _params += '&' + frm.elements[i].name + '=' + escape(frm.elements[i][frm.elements[i].selectedIndex].value);
                        break;
                    case 'INPUT':
                        switch (frm.elements[i].type) {
                            case 'radio':
                                if (frm.elements[i].checked) _params += '&' + frm.elements[i].name + '=' + escape(frm.elements[i].value);
                                break;
                            case 'checkbox':
                                if (frm.elements[i].checked) _params += '&' + frm.elements[i].name + '=' + escape(frm.elements[i].value);
                                break;
                            default:
                                _params += '&' + frm.elements[i].name + '=' + escape(frm.elements[i].value);
                                break;
                        }
                        break;
                    default:
                        _params += '&' + frm.elements[i].name + '=' + escape(frm.elements[i].value);
                        break;
                }
            }
            //console.log(_params)
            ajaxGET(frm.action + _params, 'ajaxServiceReview', false);
        }
    }, 100);
}
//REM -- Enhanced Review Module (#294947) - 01/06/2012 11:02 ------END