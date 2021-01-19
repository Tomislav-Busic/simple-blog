<?php
// provjeravamo jesu li dostupni potrebni podaci
$entryDataFound = isset( $entryData );
if($entryDataFound === false ) {
    // zadane vrijednosti za prazan editor
    $entryData = new stdClass();
    $entryData->entry_id = 0;
    $entryData->title = "";
    $entryData->entry_text = "";
    // obavijest $entryData-> poruka je prazna kada je uređivač prazan
    $entryData->message = "";
}
return "
<form method='post' action='admin.php?page=editor' id='editor'>
    <input type='hidden' name='id' value='$entryData->entry_id' />
    <fieldset>
        <legend>New Entry Submission</legend>
        <label>Title</label>
        <input type='text' name='title' maxlength='150' value='$entryData->title' required /> 
        <p id='title-warning'></p>
        <label>Entry</label>
        <textarea name='entry'>$entryData->entry_text</textarea>
        
        <fieldset id='editor-buttons'>
            <input type='submit' name='action' value='save'>
            <input type='submit' name='action' value='delete'>
            <p id='editor-message'>$entryData->message</p>
        </fieldset>
    </fieldset>
</form>

<script type='text/javascript' src='js/tinymce/js/tinymce/tinymce.min.js'></script>
<script type='text/javascript'>
    tinymce.init({
        selector: 'textarea',
        plugins: 'image'
        // dodajte kôd za pozivanje vaše funkcije updateEditorMessage ...
        setup: function (editor) {
            editor.on ('change', function (e) {
                updateEditorMessage();
            });
        }
        });
</script>";