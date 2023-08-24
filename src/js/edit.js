function change_to_mode_edit(mode_edit,mode_view,button){
    console.log(document.getElementById(mode_edit).style.display);
    if(document.getElementById(mode_edit).style.display == "none" || document.getElementById(mode_edit).style.display== "" ){
        document.getElementById(mode_edit).style.display ="flex"
        document.getElementById(button).style.display ="flex"
        document.getElementById(mode_view).style.display ="none"
    }else{
        document.getElementById(mode_edit).style.display = "none"
        document.getElementById(button).style.display ="none"
        document.getElementById(mode_view).style.display ="flex"
    }
    
}           // document.getElementsByClassName(mode_view).style.display ="block";;

function change_to_input_date(input_date){

}