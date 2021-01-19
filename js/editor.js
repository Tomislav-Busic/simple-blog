function checkTitle (event) {
    var title = document.querySelector("input[name='title']");
    var warning = document.querySelector("form #title-warning");
    //ako je naslov prazan...
    if (title.value === "") {
        // prevenDefault, tj. nemojte slati obrazac
        event.preventDefault();
        // prikazuje upozorenje
        warning.innerHTML = "*You must write a title for the entry!";
    }
}

function updateEditorMessage () {
    var p = document.querySelector("#editor-message");
    p.innerHTML = "Changes not saved!";
}

function init(){
    var editorForm = document.querySelector("form#editor");
    var title = document.querySelector("input[name='title']");
    // ovo će spriječiti standardni postupak obrade potrebnog atributa u pregledniku
    title.required = false;

    var textarea = document.querySelector( "form textarea");
    textarea.addEventListener("keyup", updateEditorMessage, false);

    title.addEventListener("keyup", updateEditorMessage, false)

    editorForm.addEventListener("submit", checkTitle, false);
}

document.addEventListener("DOMContentLoaded", init, false);


