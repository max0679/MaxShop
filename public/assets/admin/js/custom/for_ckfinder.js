// ClassicEditor
//     .create( document.querySelector( '#description' ), {
//         // ckfinder: {
//         //     uploadUrl: '/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files&responseType=json',
//         // },
//         toolbar: [ /*'ckfinder', 'imageUpload', '|',*/ 'heading', '|', 'bold', 'italic', '|', 'undo', 'redo' ]
//     } )
//     .catch( error => {
//         console.error( error );
//     } );


ClassicEditor
    .create( document.querySelector( '#description' ), {
        ckfinder: {
            uploadUrl: '/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files&responseType=json'
        },
        image: {
            // You need to configure the image toolbar, too, so it uses the new style buttons.
            toolbar: [ 'imageTextAlternative', '|', 'imageStyle:alignLeft', 'imageStyle:full', 'imageStyle:alignRight' ],

            styles: [
                // This option is equal to a situation where no style is applied.
                'full',

                // This represents an image aligned to the left.
                'alignLeft',

                // This represents an image aligned to the right.
                'alignRight'
            ]
        },
        toolbar: {
            items: [
                'heading',
                '|',
                'bold',
                'italic',
                'link',
                'bulletedList',
                'numberedList',
                '|',
                'indent',
                'outdent',
                'alignment',
                '|',
                'blockQuote',
                'insertTable',
                'undo',
                'redo',
                'CKFinder',
                'mediaEmbed'
            ]
        },
        language: 'ru',
        table: {
            contentToolbar: [
                'tableColumn',
                'tableRow',
                'mergeTableCells'
            ]
        },
     } )
    .catch( function( error ) {
        console.error( error );
    } );
