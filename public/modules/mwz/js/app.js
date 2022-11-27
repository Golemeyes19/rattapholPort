// redirect to page
mwz_redirect=function(url){
    window.location.href = url ;
}
// form validation
mwz_frm_validate=function(selector,rules, messages){
     $(selector).validate( {
                    rules: rules,
                    messages: messages,
                    errorPlacement: function ( error, element ) {
                        error.addClass( "invalid-feedback" );
                        if ( element.prop( "type" ) === "checkbox" ) {
                            error.insertAfter( element.next( "label" ) );
                        } else {
                            error.insertAfter( element );
                        }
                    },
                    errorElement: 'div',
                    errorClass: 'invalid-feedback',
                    highlight: function ( element, errorClass, validClass ) {
                        $( element ).addClass( "is-invalid" ).removeClass( "is-valid" );
                    },
                    unhighlight: function (element, errorClass, validClass) {
                        $( element ).addClass( "is-valid" ).removeClass( "is-invalid" );
                    }
                } );

}

// notification
mwz_noti=function(type,msg) {
    console.log('mwz_noti'+type+" "+msg);
    switch(type){
        case 'success':
            return $.growl.notice({
            title: "success",
            message: msg
        });
        break;
        case 'warning':
            return $.growl.warning({
            title: "warning",
            message: msg
        });
        break;
        case 'error':
            return $.growl.error({
            title: "error",
            message: msg
        });
        break;
        default:
            return $.growl({
                title: "notice",
                message: msg
            });
        break;
    }
};

(function($) {

    if($(".texteditor").length > 0){
        
        tinymce.init({
        selector: "textarea.texteditor" ,
        theme: "modern",
        height:200,
        plugins: [
            "advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker",
            "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
            "save table contextmenu directionality emoticons template paste textcolor"
        ],
        toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | l      ink image | print preview media fullpage | forecolor backcolor emoticons",
        style_formats: [
            {title: 'Bold text', inline: 'b'},
            {title: 'Red text', inline: 'span', styles: {color: '#ff0000'}},
            {title: 'Red header', block: 'h1', styles: {color: '#ff0000'}},
            {title: 'Example 1', inline: 'span', classes: 'example1'},
            {title: 'Example 2', inline: 'span', classes: 'example2'},
            {title: 'Table styles'},
            {title: 'Table row 1', selector: 'tr', classes: 'tablerow1'}
        ]
        });
    }

    if($(".texteditor").length > 0){
        // Select2 by showing the search
        $('.select2-show-search').select2({
            minimumResultsForSearch: ''
        });
    }
    
})(jQuery);