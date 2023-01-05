/**
 * Управление доступом полей формы
 *
 * @param formName
 * @param disable
 */
window.onEdit = function (formName, disable) {

    var form = $('form[data-form-name="' + formName + '"]');
    var btnEdit = $(form).find('div[data-role="edit"]');
    var btnCancel = $(form).find('div[data-role="cancel"]').show();
    var btnSendForm = $(form).find("button");

    $(form).find('select, textarea, input').prop('disabled', Boolean(disable));

    if(Boolean(disable)){
        btnCancel.hide();
        btnSendForm.hide();
        btnEdit.show()
    }else{
        btnCancel.show();
        btnSendForm.show();
        btnEdit.hide();
    }
}

/**
 * Управление поиском
 */
window.searchToggle = function(){
    var containerSearch = $('#search');
    containerSearch.slideToggle('slow')
}
