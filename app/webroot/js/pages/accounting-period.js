var handlerPI = false;
var handlerIW = false;
var count 	= 0;
var ranges;

var AccountingPeriod = function () {
    return {
        // main function
        init: function () {},
        
        initDatePicker: function() {
        	$('.date-picker-month').datepicker({
    	        autoclose	: true,
    	        format		: 'M-yyyy',
    	        viewMode	: 'months', 
    	    	minViewMode	: 'months',
    	    	clearBtn	: true
    	    });        	
        	$('.date-picker').datepicker({
    	        autoclose	: true,
    	        format		: 'yyyy-mm-dd',
    	    	clearBtn	: true
    	    });        	
        },
        
        updateProjectIssues: function(projectURL, worklogURL) {
        	var startWorkLog = 0;
    		if(!handlerPI){
    			handlerPI = $.ajax({
    				type 		: 'GET',
    				url 		: projectURL,
    				success		: function(response){
    					var object 		= $.parseJSON(response)
    					var maxResults 	= object.maxResults;
    					var startAt 	= object.startAt;
    					var updated 	= object.updated;
    					startWorkLog	= object.total;
    				},
    				complete	: function(response){
    					handlerPI = false;
		        		/*setTimeout(function() {
		        			AccountingPeriod.updateProjectIssues(projectURL, worklogURL);
		        		}, 60000);*/
		        		if(startWorkLog != 0) {
		        			AccountingPeriod.updateIssueWorklogs(worklogURL);
		        		}
		        	}
    			});
    		}
        },

        updateIssueWorklogs: function(worklogURL) {
        	var continueWorkLog = 0;
    		if(!handlerIW){
    			handlerIW = $.ajax({
    				type 		: 'GET',
    				url 		: worklogURL,
    				success		: function(response){
    					continueWorkLog = response;
    				},
    				complete	: function(response){
    					handlerIW = false;
		        		if(continueWorkLog != 0) {
			        		setTimeout(function() {
			        			AccountingPeriod.updateIssueWorklogs(worklogURL);
			        		}, 20000); //60000 = 1 Min
		        		}
    				}
    			});
    		}
        },
        
        SaveEpic: function() {
    	    $('.date-picker').datepicker({
    	        autoclose	: true,
    	        format		: 'M-yyyy',
    	        viewMode	: 'months', 
    	    	minViewMode	: 'months',
    	    	clearBtn	: true
    	    }).on('changeDate', function(ev){
    			$.ajax({
    				cache		: false,
    				beforeSend	: function(){},
    				type		: 'POST',
    				data		: $(this).serializeArray(),
    				url			: $(this).attr('save-link'),
    				success		: function(data){},
    				error		: function(){},
    				complete	: function(){}
    			});
    	    });
    		$('.epic-update').delegate('#EpicBusinessValue, #EpicOriginalContractHour, #EpicAdditionalHours, #EpicAdditionalRate, select', 
    									 'focusout', function(event) {
    			$.ajax({
    				cache		: false,
    				beforeSend	: function(){},
    				type		: 'POST',
    				data		: $(this).serializeArray(),
    				url			: $(this).attr('save-link'),
    				success		: function(data){},
    				error		: function(){},
    				complete	: function(){}
    			});
    		});
        },
        
        ChangeEpic: function() {
    		$('.issues').delegate('select', 'focusout', function(event) {
				$.ajax({
					cache		: false,
					beforeSend	: function(){},
					type		: 'POST',
					data		: $(this).serializeArray(),
					url			: $(this).attr('save-link'),
					success		: function(data){},
					error		: function(){},
					complete	: function(){}
				});
			});
        }
    };
}();