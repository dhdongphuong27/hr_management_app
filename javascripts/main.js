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
function saveDepartmentInfo(){
    console.log(document.querySelector("#head_id").value)
    var formData = new FormData();
    formData.append("department_name", document.querySelector("#department_name").innerHTML)
    formData.append("room_id", document.querySelector("#room_id").innerHTML)
    formData.append("department_description", document.querySelector("#department_description").innerHTML)
    formData.append("head_id", document.querySelector("#head_id").value)
    var request = new XMLHttpRequest();
    request.open("POST", "/webfinal/edit_department_submit.php");
    request.send(formData);
}
