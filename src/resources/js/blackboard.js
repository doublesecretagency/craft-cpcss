$(function () {
    CodeMirror.fromTextArea(document.getElementById('settings-additionalCss'), {
        indentUnit: 4,
        styleActiveLine: true,
        lineNumbers: true,
        lineWrapping: true,
        theme: 'blackboard'
    });
});