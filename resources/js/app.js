console.log('Start');

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

    console.log(btnEdit, btnCancel, btnSendForm, disable)

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

    $(form).find('select[name="client_id[]"], select[name="author_id[]"]').prop('disabled', true);
}

/**
 * автозаполнение всех select
 */
$('body select').each(function () {
    var select = $(this);
    var	value = select.attr('value');
    select.children('option').prop('selected', false);
    select.children('option:contains("'+value+'")').prop('selected', true);
    select.children('option[value="'+value+'"]').prop('selected', true);
});


/**
 * Управление поиском
 */
window.searchToggle = function(){
    var containerSearch = $('#search');

    containerSearch.slideToggle('slow')
    // containerSearch.toggle();
}
