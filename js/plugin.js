(function(){
    tinymce.PluginManager.add( 'simple_alert_boxes', function(editor, url){

        editor.addButton( 'alert_boxes_button_key', {

            text: 'Insert Alert Box',
            onclick: function(){
                // Open window
                editor.windowManager.open({
                    title: 'Insert Alert Box',                    
                    body: [{
                        type: 'textbox',
                        name: 'text',                        
                        label: 'Text',
                        multiline: true,
                        minWidth: 300,
                        minHeight: 100
                    },
                    {
                        type: 'listbox',
                        name: 'type',
                        label: 'Type',
                        'values': [
                            {text: 'Success Box', value: 'success'},
                            {text: 'Info Box', value: 'info'},
                            {text: 'Warning Box', value: 'warning'},
                            {text: 'Danger Box', value: 'danger'},
                        ]
                    }],                    
                    onsubmit: function(e){
                        // Insert content when the window form is submitted
                        editor.insertContent( '[alert  type='+ e.data.type +']' + e.data.text + '[/alert]');
                    }
                });
            }
        });
    });
})();