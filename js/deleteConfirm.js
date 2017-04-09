function ConfirmDelete(url){
    if (confirm("Delete Serial?")){
      newwindow=window.open(url,'name','height=50,width=350');
      if (window.focus) {newwindow.focus()}
          return true;
    }
    else {
       return false;
    }
} 