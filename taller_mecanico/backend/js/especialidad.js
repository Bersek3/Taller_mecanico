$(function(){

    // Lista de docente
    $.post( '../../frontend/funciones/speciality.php' ).done( function(respuesta)
    {
        $( '#lab' ).html( respuesta );
    });
    
    
    // Lista de Ciudades
    $( '#lab' ).change( function()
    {
        var el_continente = $(this).val();

    });


    
    
    

})
