
(function() {
    var called = false;
    tinymce.create('tinymce.plugins.mybutton', {
        init : function(ed, url) {
            ed.addButton('mybutton', {
                title : 'Box',
                image : url + '/images/mybutton.png',
                cmd : 'mceMyButtonInsert',
            });

            ed.addCommand('mceMyButtonInsert', function(ui, v) {
                tb_show('', ajaxurl + '?action=mybutton_shortcodePrinter');
                if(called == false) {
                    called = true;
                    jQuery('#mytmceb_button').live("click", function(e) {
                        e.preventDefault();
                        tinyMCE.triggerSave();

                        tinyMCE.editors[0].execCommand('mceInsertContent', 0, mybutton_create_shortcode());

                        tb_remove();

                    });
                }
            });
        },
        createControl : function(n, cm) {
            return null;
        }
    });
    tinymce.PluginManager.add('mybutton', tinymce.plugins.mybutton);
})();

function mybutton_create_shortcode() {
    return '[mybox]' + nl2br(jQuery('#mytmceb_text').val(),false) +'[/mybox]';
}

function nl2br (str, is_xhtml) {   
    var breakTag = (is_xhtml || typeof is_xhtml === 'undefined') ? '<br />' : '<br>';    
    return (str + '').replace(/([^>\r\n]?)(\r\n|\n\r|\r|\n)/g, '$1'+ breakTag +'$2');
}