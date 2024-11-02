$(function(){

    //-- initialize tooltips
    $("[data-toggle='tooltip']").tooltip();
    //-- initialize popovers
    $("[data-toggle='popover']").popover();
    
    //-- attach fancybox to the link of all images
    //-- !!! caught inappropriate images !!!
    var tagA = $('a.admin_gallery');
    tagA.each(function() {
    	var foundImg = $(this).find('img');
    	if(foundImg.length > 0) {
    		$(this).attr('data-fancybox', 'admin_gallery');
    	}
    });
    
    var body = $('body');
    body.on('click', '.confirm-delete', function(){
        var button = $(this).addClass('disabled');
        var title = button.attr('title');

        if(confirm(title ? title+'?' : 'Confirm the deletion')){
            if(button.data('reload')){
                return true;
            }
            $.getJSON(button.attr('href'), function(response){
                button.removeClass('disabled');
                if(response.result === 'success'){
                    notify.success(response.message);
                    button.closest('tr').fadeOut(function(){
                        this.remove();
                    });
                } else {
                    alert(response.error);
                }
            });
        }
        return false;
    });

    body.on('click', '.move-up, .move-down', function(){
        var button = $(this).addClass('disabled');

        $.getJSON(button.attr('href'), function(response){
            button.removeClass('disabled');
            if(response.result === 'success' && response.swap_id){
                var current = button.closest('tr');
                var swap = $('tr[data-id=' + response.swap_id + ']', current.parent());

                if (swap.get(0)) {
                    if (button.hasClass('move-up')) {
                        swap.before(current);
                    } else {
                        swap.after(current);
                    }
                } else {
                    location.reload();
                }
            }
            else if(response.error){
                alert(response.error);
            }
        });

        return false;
    });

    $('.switch').switcher({copy: {en: {yes: '', no: ''}}}).on('change', function(){
        var checkbox = $(this);
        checkbox.switcher('setDisabled', true);

        $.getJSON(checkbox.data('link') + '/' + (checkbox.is(':checked') ? 'on' : 'off') + '/' + checkbox.data('id'), function(response){
            if(response.result === 'error'){
                alert(response.error);
            }
            if(checkbox.data('reload')){
                location.reload();
            }else{
                checkbox.switcher('setDisabled', false);
            }
        });
    });

    $(document).bind('keydown', function (e) {
        if(e.ctrlKey && e.which === 83){ // Check for the Ctrl key being pressed, and if the key = [S] (83)
            $('.model-form').submit();
            e.preventDefault();
            return false;
        }
    });

    window.notify = new Notify();
    
    setDependencies();
});

var Notify = function() {
    var div = $('<div id="notify-alert"></div>').appendTo('body');
    var queue = [];
    var _this = this;

    this.success = function(text)
    {
        queue.push({type : 'success', text: text, icon: 'ok-sign'});
        _this.proceedQueue();
    }
    this.error = function(text)
    {
        queue.push({type : 'danger', text: text, icon: 'info-sign'});
        _this.proceedQueue();
    }

    this.proceedQueue = function()
    {
        if(queue.length > 0 && !div.is(":visible"))
        {
            div.removeClass().addClass('alert alert-' + queue[0].type).html('<span class="glyphicon glyphicon-' + queue[0].icon + '"></span> ' + queue[0].text);
            div.fadeToggle();

            setTimeout(function(){
                queue.splice(0,1);
                div.fadeToggle(function(){ _this.proceedQueue();});
            }, 3000);
        }
    }
};

function setDependencies()
{
	var depsFieldMain = $('.deps_field_main');
	var depsFields = $('.deps_field');
	var depsFieldsShowSubst = 'deps_show-';

	//-- look for the main field...
	if(depsFieldMain.length === 1) {
		//-- found: the main field!
		
		//-- look for the main field input...
		var inputObj = depsFieldMain.find('input');
		var selectObj = depsFieldMain.find('select');
		var depsFieldMainObj = null;
		var depsFieldMainValue = null;
		var depsFieldMainId = null;
		var depsListValues = new Array();
		if(selectObj.length === 1) {
			//-- found: the SELECT field!
			depsFieldMainObj = selectObj;
			depsFieldMainId = depsFieldMainObj.attr('id');
			depsFieldMainValue = depsFieldMainObj.val();
			$('#'+depsFieldMainId+' option').each(function() {
    		depsListValues[depsListValues.length] = $(this).val();
			});
		} else if(inputObj.length === 1) {
			//-- found: the INPUT field!
			depsFieldMainObj = inputObj;
			depsFieldMainId = depsFieldMainObj.attr('id');
			depsFieldMainValue = depsFieldMainObj.val();
			depsListValues[0] = depsFieldMainValue;
		}
		if(depsFieldMainObj !== null) {
			depsFieldMainObj.unbind('change');
			depsFieldMainObj.bind('change', function() {
				//-- if the value of the object has been changed...
				processDependencies();
			});
			//-- initial value of the object...
			processDependencies();
		}
	}
	function processDependencies()
	{
		//-- get current value
		depsFieldMainValue = depsFieldMainObj.val();
		//-- iterate over all fields
		depsFields.each(function() {
			var showClass = depsFieldsShowSubst+depsFieldMainValue;
			//-- look for a class for the current value
			var isFound = $(this).hasClass(showClass);
			$(this).css('display', 'none');
			if(isFound) {
				//-- show the field
				$(this).css('display', 'block');
			}
		});
		
	}
}

$(document).ready(function()
{
	//-- divide MultiCheckbox list into separate columns
	//-- (CMS. "Ресурсы - Форма - Параметры формы": "oneColumn" => "return true;")
	$('.form-group').each(function() {
		var formGroup = $(this);
		//-- look for all "checkbox" elements
		var children = formGroup.find('.checkbox');
		if(children.length > 1) {
			formGroup.addClass('float-frmrgp');
			children.each(function() {
				var checkBox = $(this);
				var inputCheckBox = checkBox.find('input');
				//-- if "one-column" class not defined
				if(!inputCheckBox.hasClass('one-column')) {
					//-- divide list into columns
					checkBox.addClass('float-chkbox');
				}
			});
		}
	});
	
	//-- handle states for AuthRule-Sections
	try {
		$('#authrule-sections')
			.html(
				$('#authrule-sections')
					.html()
					.replace(/!space!/g, '&nbsp;&nbsp;&nbsp;')
					.replace(/!iv!/g, '<font color="#c00"><i class="fas fa-eye-slash" title="Невидимый в меню"></i></font>')
					.replace(/!ia!/g, '<font color="#c00"><i class="fas fa-check" title="Неактивный"></i></font>')
					.replace(/!v!/g, '<font color="#0c0"><i class="fas fa-eye" title="Видимый в меню"></i></font>')
					.replace(/!a!/g, '<font color="#0c0"><i class="fas fa-check" title="Активный"></i></font>')
			);
	} catch(e) {}

	
	//-- show/hide left menu
	var leftMenu = $('.box.sidebar');
	var leftMenuStateBtn = $('i.left-menu-state');
	leftMenuStateBtn.click(function() {
		leftMenu.toggle();
		chkLeftMenuState();
	});
	

});

//-- show/hide left menu
document.addEventListener("DOMContentLoaded", function(event) {
	setLeftMenuState();
});
//-- sets left menu state
function setLeftMenuState()
{
	var leftMenu = $('.box.sidebar');
	var leftMenuStateBtn = $('i.left-menu-state');

	if(leftMenuStateBtn.length === 1) {
		var id = leftMenuStateBtn.attr('id');
		//var stateCookie = $.cookie(id);
		var stateCookie = window.localStorage.getItem(id);
		if(typeof(stateCookie) !== 'undefined') {
			if(stateCookie === '1') {
				leftMenu.show();
			} else {
				leftMenu.hide();
			}
		} else {
			//-- default: SHOW
			leftMenu.show();
		}
		chkLeftMenuState();
	}
}
//-- check left menu state
function chkLeftMenuState()
{
	var leftMenu = $('.box.sidebar');
	var leftMenuStateBtn = $('i.left-menu-state');
	
	var id = leftMenuStateBtn.attr('id');
	if(leftMenu.is(":hidden")) {
		//$.cookie(id, '0', {'path':'/'});
		window.localStorage.setItem(id, '0');
		leftMenuStateBtn.removeClass('fa-angle-double-left');
		leftMenuStateBtn.addClass('fa-angle-double-right');
		leftMenuStateBtn.attr('title', 'Показать меню');
	} else {
		//$.cookie(id, '1', {'path':'/'});
		window.localStorage.setItem(id, '1');
		leftMenuStateBtn.removeClass('fa-angle-double-right');
		leftMenuStateBtn.addClass('fa-angle-double-left');
		leftMenuStateBtn.attr('title', 'Скрыть меню');
	}
}
