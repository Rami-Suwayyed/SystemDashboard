window.editors = {};

// document.querySelectorAll( '.editor' ).forEach( ( node, index ) => {
//     ClassicEditor
//         .create( node, {} )
//         .then( newEditor => {
//             window.editors[ index ] = newEditor
//         } );
// } );
document.querySelectorAll( '.editor' ).forEach( ( node, index ) => {
    CKEDITOR.ClassicEditor.create(node, {
        toolbar: {
            items: [
                'heading', '|',
                'bold', 'italic', 'underline', 'code', 'subscript', 'superscript', 'removeFormat', '|',
                'bulletedList', 'numberedList', 'todoList', '|',
                'outdent', 'indent', '|',
                'undo', 'redo',
                '-',
                'fontSize', 'fontFamily', 'fontColor', 'fontBackgroundColor', 'highlight', '|',
                'alignment', '|',
                'link', 'insertImage', 'blockQuote', 'insertTable', 'mediaEmbed','|',
                'specialCharacters', 'horizontalLine', '|',
                'textPartLanguage'
            ],
            shouldNotGroupWhenFull: true
        },
        list: {
            properties: {
                styles: true,
                startIndex: true,
                reversed: true
            }
        },
        heading: {
            options: [
                { model: 'paragraph', title: 'Paragraph', class: 'ck-heading_paragraph' },
                { model: 'heading1', view: 'h1', title: 'Heading 1', class: 'ck-heading_heading1' },
                { model: 'heading2', view: 'h2', title: 'Heading 2', class: 'ck-heading_heading2' },
                { model: 'heading3', view: 'h3', title: 'Heading 3', class: 'ck-heading_heading3' },
                { model: 'heading4', view: 'h4', title: 'Heading 4', class: 'ck-heading_heading4' },
                { model: 'heading5', view: 'h5', title: 'Heading 5', class: 'ck-heading_heading5' },
                { model: 'heading6', view: 'h6', title: 'Heading 6', class: 'ck-heading_heading6' }
            ]
        },
        placeholder: "Description English",
        fontFamily: {
            options: [
                'default',
                'Arial, Helvetica, sans-serif',
                'Courier New, Courier, monospace',
                'Georgia, serif',
                'Lucida Sans Unicode, Lucida Grande, sans-serif',
                'Tahoma, Geneva, sans-serif',
                'Times New Roman, Times, serif',
                'Trebuchet MS, Helvetica, sans-serif',
                'Verdana, Geneva, sans-serif'
            ],
            supportAllValues: true
        },
        fontSize: {
            options: [ 10, 12, 14, 'default', 18, 20, 22 ],
            supportAllValues: true
        },
        htmlSupport: {
            allow: [
                {
                    name: /.*/,
                    attributes: true,
                    classes: true,
                    styles: true
                }
            ]
        },
        htmlEmbed: {
            showPreviews: true
        },
        link: {
            decorators: {
                addTargetToExternalLinks: true,
                defaultProtocol: 'https://',
                toggleDownloadable: {
                    mode: 'manual',
                    label: 'Downloadable',
                    attributes: {
                        download: 'file'
                    }
                }
            }
        },
        mention: {
            feeds: [
                {
                    marker: '@',
                    feed: [
                        '@apple', '@bears', '@brownie', '@cake', '@cake', '@candy', '@canes', '@chocolate', '@cookie', '@cotton', '@cream',
                        '@cupcake', '@danish', '@donut', '@dragée', '@fruitcake', '@gingerbread', '@gummi', '@ice', '@jelly-o',
                        '@liquorice', '@macaroon', '@marzipan', '@oat', '@pie', '@plum', '@pudding', '@sesame', '@snaps', '@soufflé',
                        '@sugar', '@sweet', '@topping', '@wafer'
                    ],
                    minimumCharacters: 1
                }
            ]
        },
        removePlugins: [
            'AIAssistant',
            'CKBox',
            'CKFinder',
            'EasyImage',
            'RealTimeCollaborativeComments',
            'RealTimeCollaborativeTrackChanges',
            'RealTimeCollaborativeRevisionHistory',
            'PresenceList',
            'Comments',
            'TrackChanges',
            'TrackChangesData',
            'RevisionHistory',
            'Pagination',
            'WProofreader',
            'MathType',
            'SlashCommand',
            'Template',
            'DocumentOutline',
            'FormatPainter',
            'TableOfContents',
            'PasteFromOfficeEnhanced'
        ]
    })
        .then( newEditor => {
            window.editors[ index ] = newEditor
        } );
} );

// CKEDITOR.ClassicEditor.create(document.querySelectorAll( '.editor' ), {
//     toolbar: {
//         items: [
//             'heading', '|',
//             'bold', 'italic', 'underline', 'code', 'subscript', 'superscript', 'removeFormat', '|',
//             'bulletedList', 'numberedList', 'todoList', '|',
//             'outdent', 'indent', '|',
//             'undo', 'redo',
//             '-',
//             'fontSize', 'fontFamily', 'fontColor', 'fontBackgroundColor', 'highlight', '|',
//             'alignment', '|',
//             'link', 'insertImage', 'blockQuote', 'insertTable', 'mediaEmbed','|',
//             'specialCharacters', 'horizontalLine', '|',
//             'textPartLanguage'
//         ],
//         shouldNotGroupWhenFull: true
//     },
//     list: {
//         properties: {
//             styles: true,
//             startIndex: true,
//             reversed: true
//         }
//     },
//     heading: {
//         options: [
//             { model: 'paragraph', title: 'Paragraph', class: 'ck-heading_paragraph' },
//             { model: 'heading1', view: 'h1', title: 'Heading 1', class: 'ck-heading_heading1' },
//             { model: 'heading2', view: 'h2', title: 'Heading 2', class: 'ck-heading_heading2' },
//             { model: 'heading3', view: 'h3', title: 'Heading 3', class: 'ck-heading_heading3' },
//             { model: 'heading4', view: 'h4', title: 'Heading 4', class: 'ck-heading_heading4' },
//             { model: 'heading5', view: 'h5', title: 'Heading 5', class: 'ck-heading_heading5' },
//             { model: 'heading6', view: 'h6', title: 'Heading 6', class: 'ck-heading_heading6' }
//         ]
//     },
//     placeholder: "Description English",
//     fontFamily: {
//         options: [
//             'default',
//             'Arial, Helvetica, sans-serif',
//             'Courier New, Courier, monospace',
//             'Georgia, serif',
//             'Lucida Sans Unicode, Lucida Grande, sans-serif',
//             'Tahoma, Geneva, sans-serif',
//             'Times New Roman, Times, serif',
//             'Trebuchet MS, Helvetica, sans-serif',
//             'Verdana, Geneva, sans-serif'
//         ],
//         supportAllValues: true
//     },
//     fontSize: {
//         options: [ 10, 12, 14, 'default', 18, 20, 22 ],
//         supportAllValues: true
//     },
//     htmlSupport: {
//         allow: [
//             {
//                 name: /.*/,
//                 attributes: true,
//                 classes: true,
//                 styles: true
//             }
//         ]
//     },
//     htmlEmbed: {
//         showPreviews: true
//     },
//     link: {
//         decorators: {
//             addTargetToExternalLinks: true,
//             defaultProtocol: 'https://',
//             toggleDownloadable: {
//                 mode: 'manual',
//                 label: 'Downloadable',
//                 attributes: {
//                     download: 'file'
//                 }
//             }
//         }
//     },
//     mention: {
//         feeds: [
//             {
//                 marker: '@',
//                 feed: [
//                     '@apple', '@bears', '@brownie', '@cake', '@cake', '@candy', '@canes', '@chocolate', '@cookie', '@cotton', '@cream',
//                     '@cupcake', '@danish', '@donut', '@dragée', '@fruitcake', '@gingerbread', '@gummi', '@ice', '@jelly-o',
//                     '@liquorice', '@macaroon', '@marzipan', '@oat', '@pie', '@plum', '@pudding', '@sesame', '@snaps', '@soufflé',
//                     '@sugar', '@sweet', '@topping', '@wafer'
//                 ],
//                 minimumCharacters: 1
//             }
//         ]
//     },
//     removePlugins: [
//         'AIAssistant',
//         'CKBox',
//         'CKFinder',
//         'EasyImage',
//         'RealTimeCollaborativeComments',
//         'RealTimeCollaborativeTrackChanges',
//         'RealTimeCollaborativeRevisionHistory',
//         'PresenceList',
//         'Comments',
//         'TrackChanges',
//         'TrackChangesData',
//         'RevisionHistory',
//         'Pagination',
//         'WProofreader',
//         'MathType',
//         'SlashCommand',
//         'Template',
//         'DocumentOutline',
//         'FormatPainter',
//         'TableOfContents',
//         'PasteFromOfficeEnhanced'
//     ]
// });
//
//
//
// CKEDITOR.ClassicEditor.create(document.getElementById("editor_arabic"), {
//     toolbar: {
//         items: [
//             'heading', '|',
//             'bold', 'italic', 'underline', 'code', 'subscript', 'superscript', 'removeFormat', '|',
//             'bulletedList', 'numberedList', 'todoList', '|',
//             'outdent', 'indent', '|',
//             'undo', 'redo',
//             '-',
//             'fontSize', 'fontFamily', 'fontColor', 'fontBackgroundColor', 'highlight', '|',
//             'alignment', '|',
//             'link', 'insertImage', 'blockQuote', 'insertTable', 'mediaEmbed','|',
//             'specialCharacters', 'horizontalLine', '|',
//             'textPartLanguage'
//         ],
//         shouldNotGroupWhenFull: true
//     },
//     list: {
//         properties: {
//             styles: true,
//             startIndex: true,
//             reversed: true
//         }
//     },
//     heading: {
//         options: [
//             { model: 'paragraph', title: 'Paragraph', class: 'ck-heading_paragraph' },
//             { model: 'heading1', view: 'h1', title: 'Heading 1', class: 'ck-heading_heading1' },
//             { model: 'heading2', view: 'h2', title: 'Heading 2', class: 'ck-heading_heading2' },
//             { model: 'heading3', view: 'h3', title: 'Heading 3', class: 'ck-heading_heading3' },
//             { model: 'heading4', view: 'h4', title: 'Heading 4', class: 'ck-heading_heading4' },
//             { model: 'heading5', view: 'h5', title: 'Heading 5', class: 'ck-heading_heading5' },
//             { model: 'heading6', view: 'h6', title: 'Heading 6', class: 'ck-heading_heading6' }
//         ]
//     },
//     placeholder: 'Description Arabic',
//     fontFamily: {
//         options: [
//             'default',
//             'Arial, Helvetica, sans-serif',
//             'Courier New, Courier, monospace',
//             'Georgia, serif',
//             'Lucida Sans Unicode, Lucida Grande, sans-serif',
//             'Tahoma, Geneva, sans-serif',
//             'Times New Roman, Times, serif',
//             'Trebuchet MS, Helvetica, sans-serif',
//             'Verdana, Geneva, sans-serif'
//         ],
//         supportAllValues: true
//     },
//     fontSize: {
//         options: [ 10, 12, 14, 'default', 18, 20, 22 ],
//         supportAllValues: true
//     },
//     htmlSupport: {
//         allow: [
//             {
//                 name: /.*/,
//                 attributes: true,
//                 classes: true,
//                 styles: true
//             }
//         ]
//     },
//     htmlEmbed: {
//         showPreviews: true
//     },
//     link: {
//         decorators: {
//             addTargetToExternalLinks: true,
//             defaultProtocol: 'https://',
//             toggleDownloadable: {
//                 mode: 'manual',
//                 label: 'Downloadable',
//                 attributes: {
//                     download: 'file'
//                 }
//             }
//         }
//     },
//     mention: {
//         feeds: [
//             {
//                 marker: '@',
//                 feed: [
//                     '@apple', '@bears', '@brownie', '@cake', '@cake', '@candy', '@canes', '@chocolate', '@cookie', '@cotton', '@cream',
//                     '@cupcake', '@danish', '@donut', '@dragée', '@fruitcake', '@gingerbread', '@gummi', '@ice', '@jelly-o',
//                     '@liquorice', '@macaroon', '@marzipan', '@oat', '@pie', '@plum', '@pudding', '@sesame', '@snaps', '@soufflé',
//                     '@sugar', '@sweet', '@topping', '@wafer'
//                 ],
//                 minimumCharacters: 1
//             }
//         ]
//     },
//     // The "super-build" contains more premium features that require additional configuration, disable them below.
//     // Do not turn them on unless you read the documentation and know how to configure them and set up the editor.
//     removePlugins: [
//         'AIAssistant',
//         'CKBox',
//         'CKFinder',
//         'EasyImage',
//         'RealTimeCollaborativeComments',
//         'RealTimeCollaborativeTrackChanges',
//         'RealTimeCollaborativeRevisionHistory',
//         'PresenceList',
//         'Comments',
//         'TrackChanges',
//         'TrackChangesData',
//         'RevisionHistory',
//         'Pagination',
//         'WProofreader',
//         'MathType',
//         'SlashCommand',
//         'Template',
//         'DocumentOutline',
//         'FormatPainter',
//         'TableOfContents',
//         'PasteFromOfficeEnhanced'
//     ]
// });
