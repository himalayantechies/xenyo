var TableManaged = function () {

    return {
    	epicIndex: function () {

	    	if (!jQuery().dataTable) {
	            return;
	        }
	
	        var table = $('#epic-index');
	
	        table.dataTable({
	
	            "language": {
	                "aria": {
	                    "sortAscending": ": activate to sort column ascending",
	                    "sortDescending": ": activate to sort column descending"
	                },
	                "emptyTable": "No data available in table",
	                "info": "Showing _START_ to _END_ of _TOTAL_ entries",
	                "infoEmpty": "No entries found",
	                "infoFiltered": "(filtered1 from _MAX_ total entries)",
	                "lengthMenu": "Show _MENU_ entries",
	                "search": "Search:",
	                "zeroRecords": "No matching records found"
	            },
	
	            "bStateSave": true, // save datatable state(pagination, sort, etc) in cookie.
	
	            "columns": [
	                        {"orderable": true}, 
	                        {"orderable": true}, 
	                        {"orderable": false}, 
	                        {"orderable": false}, 
	                        {"orderable": false}, 
	                        {"orderable": false}, 
	                        {"orderable": false}, 
	                        {"orderable": false}
	            ],
	            "lengthMenu": [
	                [10, 25, 50, -1],
	                [10, 25, 50, "All"] // change per page values here
	            ],
	            "pageLength": 25,            
	            "pagingType": "bootstrap_full_number",
	            "language": {
	                "search": "Search: ",
	                "lengthMenu": "  _MENU_ records",
	                "paginate": {
	                    "previous":"Prev",
	                    "next": "Next",
	                    "last": "Last",
	                    "first": "First"
	                }
	            },
	            "columnDefs": [{  // set default column settings
	                'orderable': true,
	                'targets': [0]
	            }, {
	                "searchable": true,
	                "targets": [0]
	            }],
	            "order": [[0, "asc"]] // set first column as a default sort by asc
	        });
	    },

    	issueIndex: function () {

	    	if (!jQuery().dataTable) {
	            return;
	        }
	
	        var table = $('#issue-index');
	
	        table.dataTable({
	
	            "language": {
	                "aria": {
	                    "sortAscending": ": activate to sort column ascending",
	                    "sortDescending": ": activate to sort column descending"
	                },
	                "emptyTable": "No data available in table",
	                "info": "Showing _START_ to _END_ of _TOTAL_ entries",
	                "infoEmpty": "No entries found",
	                "infoFiltered": "(filtered1 from _MAX_ total entries)",
	                "lengthMenu": "Show _MENU_ entries",
	                "search": "Search:",
	                "zeroRecords": "No matching records found"
	            },
	
	            "bStateSave": true, // save datatable state(pagination, sort, etc) in cookie.
	
	            "columns": [
	                        {"orderable": true}, 
	                        {"orderable": true}, 
	                        {"orderable": true}, 
	                        {"orderable": false}, 
	                        {"orderable": false}, 
	                        {"orderable": false}, 
	                        {"orderable": false}
	            ],
	            "lengthMenu": [
	                [10, 25, 50, -1],
	                [10, 25, 50, "All"] // change per page values here
	            ],
	            "pageLength": 25,            
	            "pagingType": "bootstrap_full_number",
	            "language": {
	                "search": "Search: ",
	                "lengthMenu": "  _MENU_ records",
	                "paginate": {
	                    "previous":"Prev",
	                    "next": "Next",
	                    "last": "Last",
	                    "first": "First"
	                }
	            },
	            "columnDefs": [{  // set default column settings
	                'orderable': true,
	                'targets': [0]
	            }, {
	                "searchable": true,
	                "targets": [0]
	            }],
	            "order": [[0, "asc"]] // set first column as a default sort by asc
	        });
	    },

    	worklogIndex: function () {

	    	if (!jQuery().dataTable) {
	            return;
	        }
	
	        var table = $('#worklog-index');
	
	        table.dataTable({
	
	            "language": {
	                "aria": {
	                    "sortAscending": ": activate to sort column ascending",
	                    "sortDescending": ": activate to sort column descending"
	                },
	                "emptyTable": "No data available in table",
	                "info": "Showing _START_ to _END_ of _TOTAL_ entries",
	                "infoEmpty": "No entries found",
	                "infoFiltered": "(filtered1 from _MAX_ total entries)",
	                "lengthMenu": "Show _MENU_ entries",
	                "search": "Search:",
	                "zeroRecords": "No matching records found"
	            },
	
	            "bStateSave": true, // save datatable state(pagination, sort, etc) in cookie.
	
	            "columns": [
	                        {"orderable": true}, 
	                        {"orderable": true}, 
	                        {"orderable": true}, 
	                        {"orderable": false}, 
	                        {"orderable": false}, 
	                        {"orderable": false}, 
	                        {"orderable": false}
	            ],
	            "lengthMenu": [
	                [10, 25, 50, -1],
	                [10, 25, 50, "All"] // change per page values here
	            ],
	            "pageLength": 25,            
	            "pagingType": "bootstrap_full_number",
	            "language": {
	                "search": "Search: ",
	                "lengthMenu": "  _MENU_ records",
	                "paginate": {
	                    "previous":"Prev",
	                    "next": "Next",
	                    "last": "Last",
	                    "first": "First"
	                }
	            },
	            "columnDefs": [{  // set default column settings
	                'orderable': true,
	                'targets': [0]
	            }, {
	                "searchable": true,
	                "targets": [0]
	            }],
	            "order": [[0, "asc"]] // set first column as a default sort by asc
	        });
	    }
    };
}();