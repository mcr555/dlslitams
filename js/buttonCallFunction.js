function buttonCall (x) {
$.ajax( { type : 'GET',
          data : { },
          url  : x,              // <=== CALL THE PHP FUNCTION HERE.
          success: function ( data ) {
            window.location.reload();               // <=== VALUE RETURNED FROM FUNCTION.
          },
          error: function ( xhr ) {
            alert( "error" );
          }
        });
}