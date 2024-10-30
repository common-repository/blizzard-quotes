// JavaScript Document
    (function() {  
        tinymce.create('tinymce.plugins.plumwd_blizzardquote_display', {  
            init : function(ed, url) {  
			var newurl = url.substring(0, url.length -3);
                ed.addButton('plumwd_blizzardquote_display', {  
                    title : 'Insert Blue Quote',  
                    image : newurl+'/img/bluequote.png',  
                    onclick : function() {  
                         ed.selection.setContent('[blizzardquote author="The post author" link="The blue tracker link" source="The official post link"]Replace with the blue post text[/blizzardquote]');        
                    }  
                }); 
				
            },  
            createControl : function(n, cm) {  
                return null;  
            },  
        });  
        tinymce.PluginManager.add('plumwd_blizzardquote_display', tinymce.plugins.plumwd_blizzardquote_display);  
    })();  