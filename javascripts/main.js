function toggleEdit(e) {
    e.preventDefault();
    document.querySelector(".editBtn").style.display = 'none';
    document.querySelector(".saveBtn").style.display = 'block';
    textareas = document.getElementsByTagName("textarea");
    for (var i = 0; i < textareas.length; i++){
        textareas[i].readOnly = false;
    }
    document.querySelector("#head_id").disabled = false;
}
function responseDetails(report_id){
    var response = document.getElementById(report_id);
    $(response).toggle('slow');
}
function waitingTaskOnly(){
    $(".table_row").not(".Waiting").toggle('fast');
}
function toggleEditE(e){
    e.preventDefault();
    document.querySelector(".editEBtn").style.display = 'none';
    document.querySelector(".saveEBtn").style.display = 'block';
    textareas = document.getElementsByTagName("textarea");
    for (var i = 0; i < textareas.length; i++) {
        textareas[i].readOnly = false;
    }
}
