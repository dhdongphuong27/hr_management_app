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
    $(".table_row").not(".table-secondary").toggle('fast');
    $(".waitFilter").toggleClass('active');
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
function toggleChangePwdForm(){
    document.querySelector(".password_row").style.display = 'none';
    document.querySelector(".form_change_password").style.display = 'block';
}
function unfinishedTaskOnly(){
    $(".table_row").not(".table-primary").not(".table-danger").not(".table-info").toggle('fast');
    $(".waitFilter").toggleClass('active');
}
function thisYearOnly(){
    var year = new Date().getFullYear();
    $(".table_row").not("." + year).toggle('fast');
}

