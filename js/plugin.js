(function(){
    tinymce.PluginManager.add( 'simple_alert_boxes', function(editor, url){

        editor.addButton( 'alert_boxes_button_key', {

            tooltip: 'Insert Alert Box',
            icon: 'icon dashicons-warning',
            onclick: function(){
                var selection = tinymce.activeEditor.selection.getContent();
                // Open window
                editor.windowManager.open({
                    title: 'Insert Alert Box',
                    body: [
                        {
                            type: 'textbox',
                            name: 'text',
                            label: 'Text',
                            value: selection,
                            multiline: true,
                            minWidth: 300,
                            minHeight: 100
                        },
                        {
                            type: 'listbox',
                            name: 'box_type',
                            label: 'Box Type',
                            'values': [
                                {text: 'Info Box', value: 'info'},
                                {text: 'Success Box', value: 'success'},
                                {text: 'Warning Box', value: 'warning'},
                                {text: 'Danger Box', value: 'danger'}
                            ]
                        },
                        {
                            type: 'listbox',
                            name: 'icon_size',
                            label: 'Icon Size',
                            'values': [
                                {text: 'Normal', value: 'normal'},
                                {text: 'Small', value: 'small'},
                                {text: 'Big', value: 'big'},
                                {text: 'Hide Icon', value: 'hide-icon'}
                            ]
                        }
                    ],
                    onsubmit: function(e){
                        // Insert content when the window form is submitted
                        editor.insertContent( '[alert  type="'+ e.data.box_type +'" icon-size="'+ e.data.icon_size +'"]' + e.data.text + '[/alert]');
                    }
                });
            }
        });
    });
})();
