

function ActionPopup(popup){
    console.log(document.getElementById(popup).style.display);
    if(document.getElementById(popup).style.display == "none" || document.getElementById(popup).style.display== "" ){
        document.getElementById(popup).style.display ="flex"
    }else{
        document.getElementById(popup).style.display = "none"
    }
    
}