$(document).ready(function() {
    $('#example').DataTable();
} );

ClassicEditor
.create( document.querySelector( '#editor' ), {
    // toolbar: [ 'heading', '|', 'bold', 'italic', 'link' ]
} )
.then( editor => {
    window.editor = editor;
} )
.catch( err => {
    console.error( err.stack );
} );