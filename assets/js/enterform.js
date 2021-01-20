var code = document.getElementById("code");
var qte = document.getElementById("qte");
var sub = document.getElementById("submit");
function focusfirst(){
    code.focus();
}
focusfirst();

function focus1(){
    var keyName = event.key;
    if(keyName==="Enter"){
        event.preventDefault();
        qte.focus();
    }  
}

function focus2(){
    var keyName = event.key;
    if(keyName==="Enter"){
        event.preventDefault();
        sub.focus();
    }  
}