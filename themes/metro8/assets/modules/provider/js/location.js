// document ready
$(function () {
    // initiating data table
    var DataTableInstance = new DataTableFactory();
    DataTableInstance.init({
        dt_id : '_datatable',
        columns: [
            { data: 'selectRow', name: 'selectRow' },
            { data: 'id', name: 'id' },
            { data: 'latitude', name: 'latitude' },
            { data: 'longitude', name: 'longitude' },
            { data: 'created_at', name: 'created_at', 
                render: function(data, type, row){
                    return new Date(row.created_at).toLocaleDateString();
                } 
            },
            { data: 'action', name: 'action' },
        ],
    });
    // initiating modal form management
    var ManageModalFormInstance = new ManageModalForm();
    ManageModalFormInstance.init(DataTableInstance,{
        'latitude': {
            validators: {
                notEmpty: {
                    message: 'latitiude is required'
                }
            }
        },
        'longitude': {
            validators: {
                notEmpty: {
                    message: 'longitiude is required'
                }
            }
        },

        
    });
});