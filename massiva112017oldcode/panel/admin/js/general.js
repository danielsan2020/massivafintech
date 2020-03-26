// JavaScript Document
 $(document).ready(function(){
	 //seccion para el data table
	
	//seccion para los archivos personales
	   $('#jstree1').jstree({
            'core' : {
                'check_callback' : true
            },
            'plugins' : [ 'types', 'dnd' ],
            'types' : {
                'default' : {
                    'icon' : 'fa fa-folder'
                },
                'html' : {
                    'icon' : 'fa fa-file-code-o'
                },
                'svg' : {
                    'icon' : 'fa fa-file-picture-o'
                },
                'css' : {
                    'icon' : 'fa fa-file-code-o'
                },
                'img' : {
                    'icon' : 'fa fa-file-image-o'
                },
                'js' : {
                    'icon' : 'fa fa-file-text-o'
                }

            }
        });
	
 
});
