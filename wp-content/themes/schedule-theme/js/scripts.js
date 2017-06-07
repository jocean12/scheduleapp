(function ($, root, undefined) {
	"use strict";
	$(function () {		
		

		
		jQuery(document).ready(function($){
			$('form').areYouSure();
		});
		// DOM ready, take it away
		jQuery(document).ready(function($) { //noconflict wrapper
			$('input[type=submit]').addClass('btn-default btn');
		});//end noconflict
		jQuery(document).ready(function($) { //noconflict wrapper
			$('button[type=submit]').addClass('btn-default btn');
		});
		jQuery(document).ready(function($) { //noconflict wrapper
			$('input[type=text]').addClass('form-control');
		});
		jQuery(document).ready(function($) { //noconflict wrapper
			$('input[type=search]').addClass('form-control');
		});
		jQuery(document).ready(function($) { //noconflict wrapper
			$('input[type=password]').addClass('form-control');
		});
		
		$('.nav-tabs li:first-of-type').addClass('active');
		
		$('.tab-panes ul:first-of-type').addClass('active');
		$('.tab-panes ul:first-of-type').addClass('in');
		
		jQuery("#addform").click(function(){
			var copyformnum=Number($('#copyformnum').val());
			var numform=$('#numform').val();
			//var len=$('#formbody tr').length;
			
			if(copyformnum){
//		    		alert('copy form: '+copyformnum);

				var row=$('#formbody tr').eq(copyformnum-1);

				console.log(row);
				var i;
				var rowCount = $('#formbody tr').length;
				
				for(i=0;i<numform;i++){
					
					var defaultrow=row.clone(true).appendTo('#formbody');					
					
					defaultrow.find(':input:not(:button)').each(function(){
						var be=$(this).attr('name');
						var n = be.lastIndexOf("_");
						var af=be.substring(0,n+1);
						$(this).attr('name',af+rowCount);				
					});
					rowCount++;					
				}
			}			
		}); 
	
	
		jQuery("#plusone").click(function(){
			var rowCount = $('#formbody tr').length;
			var newRowID = rowCount + 1;
			var defaultrow=$('#formbody').children('tr:first').clone(true).appendTo('#formbody');
			
			defaultrow.attr("id", "form_" + newRowID);
			defaultrow.find(':input:text').val('');
			
			defaultrow.find('input:checked').attr('checked', false);
			
			defaultrow.find(':input:not(:button)').each(function(){
				var be=$(this).attr('name');
				var n = be.lastIndexOf("_");
				var af=be.substring(0,n+1);
				$(this).attr('name',af+rowCount);
				
			});

		});
		
		jQuery("#copyLastRow").click(function(){
			var rowCount = $('#formbody tr').length;
			var newRowID = rowCount + 1;
			var defaultrow = $('#formbody').children('tr:last').clone(true).appendTo('#formbody');
			defaultrow.attr("id", "form_" + newRowID);
			
			defaultrow.find(':input:not(:button)').each(function(){
				var be=$(this).attr('name');
				var n = be.lastIndexOf("_");
				var af=be.substring(0,n+1);
				$(this).attr('name',af+rowCount);				
			});
		});
		
		jQuery(".deleteRow").click(function(){
			var rowCount = $('#formbody tr').length;
			if (rowCount > 1){
				
				//Delete from Database
				var data_to_send = [];
					
				$(this).closest('tr').find('td input').each(function(){
					data_to_send.push($(this).attr('name'));
				});	
				
				jQuery.ajax({
					url: ajaxurl,
					type: 'POST',
					data: {
							action: 'delete_form_row',
						    postid: $('#postID').val(),
							data_to_send :data_to_send
					},
					success: function(response) {
						if(!response){
							alert("There is error to update record. Sorry for the inconvenience. Please contact IT.");
						}
						//alert(response);
					}
				});	
				
				// Delete on front end
				$(this).closest('tr').nextAll('tr').each(function(){
//					var rowNum = ($(this).index())-1;
//					alert(rowNum);			
					$(this).find('td input').each(function(){
						var be=$(this).attr('name');
						var n = be.lastIndexOf("_");
						var af=be.substring(0,n+1);
						var formn=parseInt(be.substring(n+1,be.length))-1;
						
					    $(this).attr('name',af+formn);
					});
				});
				$(this).closest('tr').remove();
			} else {
				alert("This is the last row, it cannot be deleted.");			
			}		
		});
		
		// Sortable Scheduler page
			$( ".sortable" ).sortable({
				connectWith: '.sortable',
				handle: 'button',
				cancel: '',
				update: function(){
					var sortable1 = $(this).sortable( "toArray" );
//					alert(sortable1);
					var wellID = $(this).attr("id");
					var pageID = $(this).closest('.container').attr('id');
//					var thisID = $('.panel').closest('li').attr('id').value;
//					alert(thisID);
					$.ajax({
						url: ajaxurl,
						type: 'POST',
						data: {
							action: 'sort_jobs',
							pageID_to_send: pageID,
							wellID_to_send: wellID,
							sorted_to_send: sortable1
						},
//						success: function(response) {
////							if(!response){
////								alert("There is error to update record. Sorry for the inconvenience. Please contact IT.");
////								}
////							alert(response);
//						}	
					});
				}
			});
	
//			$( "#timeBlockWell" ).sortable({
//				connectWith: "#scheduleWell",
//				remove: function(event, ui) {
//					ui.item.clone().appendTo('#scheduleWell');
////					$('.timeBlock').uniqueId();
//					$(this).sortable('cancel');
//				}
//			}).disableSelection();
		
			
		
			// make date picker function
//			$( ".datepicker" ).datepicker();

				// Get value from date input
//			$('.datepicker').on('input', function(){
//				alert("anything");
////				var inputDate = this.value;
////				var parsedDate = Date.parse(inputDate);
////				alert(parsedDate);
////				$(this).closest('li').attr('id', parsedDate);
//			});
			// user drags time block into well
			$('.timeBlockBtn').draggable({
				connectToSortable: ".sortable",
				helper: "clone",
				revert: "invalid",
				start: function() {
					// Remove id and make new div datapicker
					$('.datepicker').removeClass('hasDatepicker');
					$('.datepicker').removeAttr('id');
				},
				stop: function() {
					// date/time picker
					$.datetimepicker.setLocale('en');
//					
					// get current date & time
					var d = new Date();

					var month = d.getMonth()+1;
					var day = d.getDate();

					var currentDate = d.getFullYear() + '/' +
						((''+month).length<2 ? '0' : '') + month + '/' +
						((''+day).length<2 ? '0' : '') + day;

					$('.datepicker').datetimepicker({
						dayOfWeekStart : 1,
						lang:'en',
						startDate:	currentDate,
						format: 'm/d/Y h:i a',
						step:30
					});
					
					
					//End date/time picker
					$('.datepicker').change(function(){
						var inputDate = this.value;
						var parsedDate = Date.parse(inputDate);
//						alert(parsedDate);
						$(this).closest('li').attr('id', parsedDate);
						var sortable1 = $(this).closest('ul').sortable( "toArray" );
//						alert (sortable1);
						var wellID = $(this).closest('ul').attr("id");
						var pageID = $('.sortable').closest('.container').attr('id');
						$.ajax({
							url: ajaxurl,
							type: 'POST',
							data: {
								action: 'sort_jobs',
								pageID_to_send: pageID,
								wellID_to_send: wellID,
								sorted_to_send: sortable1
							},
	//						success: function(response) {
	////							if(!response){
	////								alert("There is error to update record. Sorry for the inconvenience. Please contact IT.");
	////								}
	////							alert(response);
	//						}	
						});
					});
				}
			});
			// when user changes date trigger this
			$('.datepicker').change(function(){
//				alert("this is something");
				var inputDate = this.value;
				var parsedDate = Date.parse(inputDate);
//						alert(parsedDate);	
				$(this).closest('li').attr('id', parsedDate);
			
				var sortable1 = $(this).closest('ul').sortable( "toArray" );
//						alert (sortable1);
				var wellID = $(this).closest('ul').attr("id");
//				var wellID = $(this).closest('.sortable').attr('id');
				var pageID = $('.sortable').closest('.container').attr('id');
				$.ajax({
					url: ajaxurl,
					type: 'POST',
					data: {
						action: 'sort_jobs',
						pageID_to_send: pageID,
						wellID_to_send: wellID,
						sorted_to_send: sortable1
					},
//						success: function(response) {
////							if(!response){
////								alert("There is error to update record. Sorry for the inconvenience. Please contact IT.");
////								}
////							alert(response);
//						}	
				});
			});
		
			// date/time picker
			$.datetimepicker.setLocale('en');
			
			
			// get current date & time
//			var d = new Date();
//
//			var month = d.getMonth()+1;
//			var day = d.getDate();
//
//			var currentDate = d.getFullYear() + '/' +
//				((''+month).length<2 ? '0' : '') + month + '/' +
//				((''+day).length<2 ? '0' : '') + day;

			$('.datepicker').datetimepicker({
				dayOfWeekStart : 1,
				lang:'en',
//				startDate:	currentDate
			});
			
		
			
			$('.datepicker').datetimepicker({
//				value: currentDate,
				format: 'm/d/Y h:i a',
				step:30
			});
			//End date/time picker
			
			$('.timeBlockBtn').sortable({
				connectWith: '.sortable',
				handle: 'button'
			});
			
			jQuery(".deleteBlock").click(function(){
				// establish this before deleting
				var closestUL = $(this).closest('ul');
				var wellID = closestUL.attr("id");
				// Delete on front end
				$(this).closest('li').remove();
				var sortable1 = closestUL.sortable( "toArray" );
				var pageID = $('.sortable').closest('.container').attr('id');
//				alert(wellID);
				$.ajax({
					url: ajaxurl,
					type: 'POST',
					data: {
						action: 'sort_jobs',
						pageID_to_send: pageID,
						wellID_to_send: wellID,
						sorted_to_send: sortable1
					},
//						success: function(response) {
////							if(!response){
////								alert("There is error to update record. Sorry for the inconvenience. Please contact IT.");
////								}
////							alert(response);
//						}	
				});
				
			});

			$( ".sortable" ).disableSelection();
			
			
		
			
//		//popover 
		$(document).ready(function(){
			$('[data-toggle="popover"]').popover();
		});
//	
//	function addFormID() {
//		return('Test Function');
//	}
	
		


		
	});
	

	
})(jQuery);

//Data table
	$(document).ready(function() {
		"use strict";
    $('#example').DataTable();
	} );

/*!
 * jQuery Plugin: Are-You-Sure (Dirty Form Detection)
 * https://github.com/codedance/jquery.AreYouSure/
 *
 * Copyright (c) 2012-2014, Chris Dance and PaperCut Software http://www.papercut.com/
 * Dual licensed under the MIT or GPL Version 2 licenses.
 * http://jquery.org/license
 *
 * Author:  chris.dance@papercut.com
 * Version: 1.9.0
 * Date:    13th August 2014
 */
(function($) {
  
  $.fn.areYouSure = function(options) {
      
    var settings = $.extend(
      {
        'message' : 'You have unsaved changes!',
        'dirtyClass' : 'dirty',
        'change' : null,
        'silent' : false,
        'addRemoveFieldsMarksDirty' : false,
        'fieldEvents' : 'change keyup propertychange input',
        'fieldSelector': ":input:not(input[type=submit]):not(input[type=button])"
      }, options);

    var getValue = function($field) {
      if ($field.hasClass('ays-ignore')
          || $field.hasClass('aysIgnore')
          || $field.attr('data-ays-ignore')
          || $field.attr('name') === undefined) {
        return null;
      }

      if ($field.is(':disabled')) {
        return 'ays-disabled';
      }

      var val;
      var type = $field.attr('type');
      if ($field.is('select')) {
        type = 'select';
      }

      switch (type) {
        case 'checkbox':
        case 'radio':
          val = $field.is(':checked');
          break;
        case 'select':
          val = '';
          $field.find('option').each(function(o) {
            var $option = $(this);
            if ($option.is(':selected')) {
              val += $option.val();
            }
          });
          break;
        default:
          val = $field.val();
      }

      return val;
    };

    var storeOrigValue = function($field) {
      $field.data('ays-orig', getValue($field));
    };

    var checkForm = function(evt) {

      var isFieldDirty = function($field) {
        var origValue = $field.data('ays-orig');
        if (undefined === origValue) {
          return false;
        }
        return (getValue($field) != origValue);
      };

      var $form = ($(this).is('form')) 
                    ? $(this)
                    : $(this).parents('form');

      // Test on the target first as it's the most likely to be dirty
      if (isFieldDirty($(evt.target))) {
        setDirtyStatus($form, true);
        return;
      }

      $fields = $form.find(settings.fieldSelector);

      if (settings.addRemoveFieldsMarksDirty) {              
        // Check if field count has changed
        var origCount = $form.data("ays-orig-field-count");
        if (origCount != $fields.length) {
          setDirtyStatus($form, true);
          return;
        }
      }

      // Brute force - check each field
      var isDirty = false;
      $fields.each(function() {
        $field = $(this);
        if (isFieldDirty($field)) {
          isDirty = true;
          return false; // break
        }
      });
      
      setDirtyStatus($form, isDirty);
    };

    var initForm = function($form) {
      var fields = $form.find(settings.fieldSelector);
      $(fields).each(function() { storeOrigValue($(this)); });
      $(fields).unbind(settings.fieldEvents, checkForm);
      $(fields).bind(settings.fieldEvents, checkForm);
      $form.data("ays-orig-field-count", $(fields).length);
      setDirtyStatus($form, false);
    };

    var setDirtyStatus = function($form, isDirty) {
      var changed = isDirty != $form.hasClass(settings.dirtyClass);
      $form.toggleClass(settings.dirtyClass, isDirty);
        
      // Fire change event if required
      if (changed) {
        if (settings.change) settings.change.call($form, $form);

        if (isDirty) $form.trigger('dirty.areYouSure', [$form]);
        if (!isDirty) $form.trigger('clean.areYouSure', [$form]);
        $form.trigger('change.areYouSure', [$form]);
      }
    };

    var rescan = function() {
      var $form = $(this);
      var fields = $form.find(settings.fieldSelector);
      $(fields).each(function() {
        var $field = $(this);
        if (!$field.data('ays-orig')) {
          storeOrigValue($field);
          $field.bind(settings.fieldEvents, checkForm);
        }
      });
      // Check for changes while we're here
      $form.trigger('checkform.areYouSure');
    };

    var reinitialize = function() {
      initForm($(this));
    }

    if (!settings.silent && !window.aysUnloadSet) {
      window.aysUnloadSet = true;
      $(window).bind('beforeunload', function() {
        $dirtyForms = $("form").filter('.' + settings.dirtyClass);
        if ($dirtyForms.length == 0) {
          return;
        }
        // Prevent multiple prompts - seen on Chrome and IE
        if (navigator.userAgent.toLowerCase().match(/msie|chrome/)) {
          if (window.aysHasPrompted) {
            return;
          }
          window.aysHasPrompted = true;
          window.setTimeout(function() {window.aysHasPrompted = false;}, 900);
        }
        return settings.message;
      });
    }

    return this.each(function(elem) {
      if (!$(this).is('form')) {
        return;
      }
      var $form = $(this);
        
      $form.submit(function() {
        $form.removeClass(settings.dirtyClass);
      });
      $form.bind('reset', function() { setDirtyStatus($form, false); });
      // Add a custom events
      $form.bind('rescan.areYouSure', rescan);
      $form.bind('reinitialize.areYouSure', reinitialize);
      $form.bind('checkform.areYouSure', checkForm);
      initForm($form);
    });
  };
})(jQuery);


