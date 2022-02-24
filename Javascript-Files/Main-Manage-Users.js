$(document).ready(function() {
    $('#example').DataTable();
});

let Select = document.querySelector('.Select');
let check = document.querySelectorAll('.check');

if(Select && check){

    Select.addEventListener('change',(e)=>{


        if(e.target.value == "Admin"){
    
            check.forEach(element => {
    
                element.setAttribute("checked" , true);
    
                element.style.pointerEvents = "none";
    
            });
    
        }else{
            
            check.forEach(element => {
    
                element.removeAttribute("checked");
    
                element.style.pointerEvents = "all";
    
            });
    
        }
    
    });

}



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



